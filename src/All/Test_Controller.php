<?php
namespace Formacopoeia\All;

use Formacopoeia\Configurable\Field;

class Test_Controller extends \WP_Plugin_Maker\Controller {

    public static function action_formacopoeia_before_behaviour_database($submission) {
        $submission->name = 'M.' . $submission->name;
    }

}

