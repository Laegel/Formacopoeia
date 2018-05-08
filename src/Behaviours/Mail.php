<?php
namespace Formacopoeia\Behaviours;

use Formacopoeia\Model\Submission;

class Mail extends Behaviour {

    public static function handle(Submission $submission) {
        var_dump($submission);
    }

}