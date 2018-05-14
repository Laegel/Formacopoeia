<?php return array (
  'Formacopoeia\\All\\Form_Controller' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'name' => 'init',
        'callback' => 'Formacopoeia\\All\\Form_Controller::action_init',
        'priority' => 0,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
    ),
  ),
  'Formacopoeia\\All\\Main_Controller' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'name' => 'init',
        'callback' => 'Formacopoeia\\All\\Main_Controller::action_init',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
    ),
  ),
  'Formacopoeia\\All\\Submission_Controller' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'name' => 'init',
        'callback' => 'Formacopoeia\\All\\Submission_Controller::action_init',
        'priority' => 0,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
    ),
  ),
  'Formacopoeia\\All\\Test_Controller' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'name' => 'formacopoeia_before_behaviour_database',
        'callback' => 'Formacopoeia\\All\\Test_Controller::action_formacopoeia_before_behaviour_database',
        'priority' => 10,
        'args_count' => 1,
        'data' => 
        array (
        ),
      ),
    ),
  ),
  'Formacopoeia\\Admin\\Admin_Controller' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'name' => 'init',
        'callback' => 'Formacopoeia\\Admin\\Admin_Controller::action_init',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
    ),
  ),
  'Formacopoeia\\Admin\\Form_Controller' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'name' => 'admin_menu',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_admin_menu',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      1 => 
      array (
        'name' => 'wp_ajax_save_form',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_save_form',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      2 => 
      array (
        'name' => 'wp_ajax_get_form',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_get_form',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      3 => 
      array (
        'name' => 'wp_ajax_nopriv_get_form',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_get_form',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      4 => 
      array (
        'name' => 'wp_ajax_get_fields',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_get_fields',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
          'cache' => '3600',
        ),
      ),
      5 => 
      array (
        'name' => 'wp_ajax_nopriv_get_fields',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_get_fields',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
          'cache' => '3600',
        ),
      ),
      6 => 
      array (
        'name' => 'wp_ajax_formacopoeia_submit',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_formacopoeia_submit',
        'priority' => 0,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      7 => 
      array (
        'name' => 'wp_ajax_nopriv_formacopoeia_submit',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_formacopoeia_submit',
        'priority' => 0,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      8 => 
      array (
        'name' => 'admin_post_formacopoeia_submit',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_formacopoeia_submit',
        'priority' => 0,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      9 => 
      array (
        'name' => 'admin_post_nopriv_formacopoeia_submit',
        'callback' => 'Formacopoeia\\Admin\\Form_Controller::action_formacopoeia_submit',
        'priority' => 0,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
      10 => 
      array (
        'name' => 'init',
        'callback' => 'Formacopoeia\\Admin\\Admin_Controller::action_init',
        'priority' => 10,
        'args_count' => 0,
        'data' => 
        array (
        ),
      ),
    ),
  ),
);