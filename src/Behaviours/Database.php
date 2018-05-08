<?php
namespace Formacopoeia\Behaviours;

use Formacopoeia\Model\Submission;

use Formacopoeia\All\Submission_Controller;

use Formacopoeia\Translations\Translator;

class Database extends Behaviour {

    public static function handle(Submission $submission) {
        $form = $submission->get_form();
        $title = '#' .$form->ID;
        $keys = [
            'message' => function($value) {
                return '"' . wp_trim_excerpt($value) . '"';
            },
            'email' => function($value) {
                return Translator::t('from %s', $value);
            },
            'name' => function($value) {
                return Translator::t('from %s', $value);
            }
        ];
        $submission->walk(function($key, $value) use ($keys, &$title) {
            if (isset($keys[$key])) {
                $title = $keys[$key]($value);
                break;
            }
        });
        $id = wp_insert_post([
            'post_title' => $title,
            'post_type' => 'fc_submission'
        ]);
        $submission->walk(function($key, $value) use ($id) {
            add_post_meta($id, $key, $value);
        });
    }

}

