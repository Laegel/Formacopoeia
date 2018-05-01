<?php
namespace Formacopoeia\All;

class Field_Controller extends Registerable_Controller {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        self::$items[] = [
            'name' => 'text',
            'options' => [
                'label' => 'Text',
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'placeholder' => [
                        'type' => 'text'
                    ],
                    'required' => [
                        'type' => 'checkbox'
                    ]
                ],
                'template' => '<div><label>{{label}}</label><input type="text" placeholder="{{placeholder}}"></div>'
            ]
        ];
        
        self::$items[] = [
            'name' => 'submit',
            'options' => [
                'label' => 'Submit',
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'text' => [
                        'type' => 'text'
                    ]
                ],
                template => '<div><input type="submit" value="{{text}}"></div>'
            ]
        ];
        self::$items[] = [
            'name' => 'select',
            'options' => [
                'label' => 'Select',
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'choices' => [
                        'type' => 'associative',
                    ]
                ],
                template => '<div><label>{{label}}</label><select type="submit" name="{{name}}">{{#each choices}}<option value="{{key}}">{{value}}</option>{{/each}}</select>'
            ]
        ];
        self::$inited = true;
    }
}

