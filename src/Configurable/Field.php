<?php
namespace Formacopoeia\Configurable;

class Field extends Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'both' . DIRECTORY_SEPARATOR . 'fields' . DIRECTORY_SEPARATOR;
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
                'path' => $path . 'text.component.html'
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
                'path' => $path . 'submit.component.html'
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
                'path' => $path . 'select.component.html'
            ]
        ];
        self::$items[] = [
            'name' => 'email',
            'options' => [
                'label' => 'Email',
                'categories' => ['default'],
                'props' => [
                    'label' => [
                        'type' => 'text'
                    ],
                    'placeholder' => [
                        'type' => 'text'
                    ],
                    'name' => [
                        'type' => 'text'
                    ],
                    'class' => [
                        'type' => 'text'
                    ]
                ],
                'path' => $path . 'email.component.html',
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
                'path' => $path . 'file.component.html',
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
                'path' => $path . 'checkbox.component.html'
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
                'path' => $path . 'radio.component.html'
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
                'path' => $path . 'textarea.component.html'
            ]
        ];

        self::$inited = true;
    }
}

