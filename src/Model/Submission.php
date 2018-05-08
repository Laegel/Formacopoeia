<?php
namespace Formacopoeia\Model;

use Formacopoeia\All\Form_Controller as Form;
use Formacopoeia\Configurable\Field;
use Formacopoeia\Configurable\Behaviour;

class Submission {

    /** @var Form */
    private $form;

    private $values;
    private $date;

    private $fields_validation = [];

    public function __construct(Form $form, array $values = []) {
        $this->form = $form;
        $this->values = $values;
    }

    public function get_form() {
        return $this->form;
    }

    public function __get($key) {
        return $this->values[$key];
    }

    public function __set($key, $value) {
        $this->values[$key] = $value;
    }

    public function walk($callback) {
        foreach ($this->values as $key => $value) {
            $callback($key, $value);
        }
    }

    public function validate() {
        $form_fields = $this->form->get_fields();
        apply_filters('formacopoeia_before_validate', $form_fields);
        $this->fields_validation = [];
        foreach ($form_fields as $form_field) {
            $out = $this->validate_field($form_field);
            if (isset($out['is_valid']) && !$out['is_valid']) {
                $this->fields_validation[] = $out;
            }
        }
        return 0 === count($this->fields_validation);
    }

    private function validate_field($form_field) {
        do_action('formacopoeia_before_validate_' . $form_field->props->name, $this->{$form_field->props->name}, $this);
        do_action('formacopoeia_before_validate_type_' . $form_field->type, $this->{$form_field->props->name}, $this);
        $field = Field::get_by_name($form_field->type);
        if (isset($field['options']['validate']) && is_callable($field['options']['validate'])) {
            return call_user_func_array($field['options']['validate'], [$this->{$form_field->props->name}, $this]);
        }
    }

    public function dispatch_behaviours() {
        $behaviours = $this->form->get_tabs()->behaviours;
        apply_filters('formacopoeia_before_behaviours', $behaviours);
        foreach ($behaviours as $behaviour) {
            $this->dispatch_behaviour($behaviour->name);
        }
    }

    private function dispatch_behaviour($behaviour_name) {
        do_action('formacopoeia_before_behaviour_' . $behaviour_name, $this);
        $behaviour = Behaviour::get_by_name($behaviour_name);
        if (isset($behaviour['options']['callback']) && is_callable($behaviour['options']['callback'])) {
            call_user_func_array($behaviour['options']['callback'], [$this]);
        }
    }

    public function get_errors() {
        return $this->fields_validation;
    }
}