<?php
namespace Formacopoeia\Behaviours;

class Mail extends Behaviour {

    public static function handle(Submission $submission, $index) {
        $form = $submission->get_form();
        $tabs = $form->get_tabs();
        $behaviour = $tabs->behaviours[$index];
        
        $recipient = $submission->replace_placeholders($behaviour->values->recipient);
        $sender = $submission->replace_placeholders($behaviour->values->sender);
        $message = $submission->replace_placeholders($behaviour->values->message);
        $subject = $submission->replace_placeholders($behaviour->values->subject);

        $headers = ['Content-Type: text/html; charset=UTF-8','From: ' . $sender];
        wp_mail($recipient, $subject, $message, $headers);
    }

}