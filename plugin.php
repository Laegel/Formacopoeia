<?php
defined('ABSPATH') or die('Nothing to see here.');
/*
Plugin Name: Formacopoeia
Version: 0.1.0
*/

require 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

register_activation_hook(__FILE__, 'Formacopoeia\Plugin::on_activate');
register_activation_hook(__FILE__, 'Formacopoeia\Plugin::on_deactivate');

Formacopoeia\Plugin::init(realpath(dirname(__FILE__)));
