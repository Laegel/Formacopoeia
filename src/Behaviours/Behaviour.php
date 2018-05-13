<?php
namespace Formacopoeia\Behaviours;

abstract class Behaviour {
    abstract public static function handle(Submission $submission, $index);
}