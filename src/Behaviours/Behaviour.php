<?php
namespace Formacopoeia\Behaviours;

use Formacopoeia\Model\Submission;

abstract class Behaviour {
    abstract public static function handle(Submission $submission);
}