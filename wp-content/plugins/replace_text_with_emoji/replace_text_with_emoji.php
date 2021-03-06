<?php

/**
 * @package ReplaceTextWithEmoji
 */

 /**
 * 
 * Plugin Name: Replace Text With Emoji
 * Plugin URI: http://localhost:8000/plugin
 * Description: I am replacing every post with an emoji if spotted
 * Version: 1.0.0
 * Author: Me, duh!
 * Author URI: http://localhost:8000
 * License: GPLv2
 * Text Domain: ReplaceText-Plugin
 * 
 * 
 */

if (! function_exists('add_action')) {
    die('you don\'t belong here');
};


class ReplaceTextWithEmoji {
    //methods 

    //to get the args for class components, we'd need a constructor 
    function __construct() {
        add_action('init', array($this, 'create_booktype'));
    }

    function activate() {

        //just in case add_action fails. do it directly 
        $this->create_booktype();

        flush_rewrite_rules(); // flush rewrite
    }

    function deactivate() {

        flush_rewrite_rules(); // flush rewrite
    }

    function uninstall() {

    }

    function create_booktype() {
        register_post_type(
            'books',
            array(
                'labels' => array(
                    'name' => __('Books'),
                    'singular_name' => __('Book')
    
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'books'),
                'show_in_rest' => true,
                'supports' => array('title', 'excerpt', 'author', 'editor', 'thumbnail')
            )
        );
    }

}

//check to see if it exists

if (class_exists('ReplaceTextWithEmoji')) {
    //variable 
$replaceTextWithEmoji = new ReplaceTextWithEmoji();
}

//activation 
register_activation_hook( __FILE__, array($replaceTextWithEmoji, 'activate'));

//deactivate
register_deactivation_hook( __FILE__, array($replaceTextWithEmoji, 'deactivate'));

//uninstall

register_uninstall_hook(__FILE__, array($replaceTextWithEmoji, 'uninstall') );