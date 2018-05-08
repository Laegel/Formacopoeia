<?php
namespace Formacopoeia\Configurable;

class Field extends Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        self::$items[] = [
            'name' => 'text',
            'options' => [
                'label' => 'Text',
                'categories' => ['default'],
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
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><input type="text" name="formacopoeia[{{name}}]" placeholder="{{placeholder}}"></div>'
            ]
        ];
        
        self::$items[] = [
            'name' => 'submit',
            'options' => [
                'label' => 'Submit',
                'categories' => ['default'],
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'text' => [
                        'type' => 'text'
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><input type="submit" name="formacopoeia[{{name}}]" value="{{text}}"></div>',
            ]
        ];
        self::$items[] = [
            'name' => 'select',
            'options' => [
                'label' => 'Select',
                'categories' => ['default'],
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'choices' => [
                        'type' => 'associative',
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><select name="formacopoeia[{{name}}]">{{#each choices}}<option value="{{key}}">{{value}}</option>{{/each}}</select></div>'
            ]
        ];
        self::$items[] = [
            'name' => 'email',
            'options' => [
                'label' => 'Email',
                'categories' => ['default'],
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><input type="email" name="formacopoeia[{{name}}]"></div>',
                'validate' => function($value, $submission) {
                    $is_valid = !!filter_var($value, FILTER_VALIDATE_EMAIL);
                    return [
                        'is_valid' => $is_valid,
                        'message' => $is_valid ? '' : 'Invalid email'
                    ];
                }
            ]
        ];
        self::$items[] = [
            'name' => 'file',
            'options' => [
                'label' => 'File',
                'categories' => ['default'],
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'maxsize' => [
                        'type' => 'number'
                    ],
                    'extensions' => [
                        'type' => 'list'
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><input type="file" name="formacopoeia[{{name}}]"></div>',
                'validate' => function($value, $submission) {
                    // Check file extension + filesize (server)

                    return [
                        'is_valid' => $is_valid,
                        'message' => $is_valid ? '' : 'Invalid email'
                    ];
                }
            ]
        ];

        self::$items[] = [
            'name' =>  'checkbox', 
            'options' => [
                'label' => 'Checkbox',
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><input type="checkbox" name="formacopoeia[{{name}}]"></div>'
            ]
        ];

        self::$items[] = [
            'name' => 'radio', 
            'options' => [
                'label' => 'Radio',
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'choices' => [
                        'type' => 'associative',
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><div>{{#each choices}}<label>{{value}}</label><input type="radio" name="formacopoeia[{{name}}]" value="{{key}}">{{/each}}</div></div>'
            ]
        ];

        self::$items[] = [
            'name' => 'textarea',
            'options' => [
                'label' => 'Textarea',
                'props' => [
                    'name' => [
                        'type' => 'text'
                    ],
                    'label' => [
                        'type' => 'text'
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'template' => '<div class="{{class}}"><label>{{label}}</label><textarea name="formacopoeia[{{name}}]">{{value}}</textarea></div>'
            ]
        ];

        self::$inited = true;
    }
}

