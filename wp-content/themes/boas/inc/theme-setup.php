<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('boas_setup')) :

    function boas_setup() {
        load_theme_textdomain(BOAS_LANG, BOAS_DIR . '/languages');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary-nav' => __('Primary Menu', BOAS_LANG),
            'primary-sm-nav' => __('Primary Small Device Menu', BOAS_LANG),
            'footer-nav' => __('Footer Links Menu', BOAS_LANG),
            'topbar-nav' => __('Topbar Links Menu', BOAS_LANG),
        ));
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio',
        ));
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(825, 510, true);
        add_image_size('square-thumb', 480, 480, true);
    }

    add_action('after_setup_theme', 'boas_setup');
endif;
if (!function_exists('boas_scripts')) :

    function boas_scripts() {
        global $boas_opt;       
        //Bootstrap Customized      
        wp_enqueue_script('bootstarp', BOAS_ASSETS_URI . '/js/bootstrap.min.js', array('jquery'), BOAS_VAR, FALSE);
        //Icon front
        wp_enqueue_style('font-awesome', BOAS_ASSETS_URI . '/css/font-awesome.min.css', array(), BOAS_VAR);
        wp_enqueue_style('animate.css', BOAS_ASSETS_URI . '/animate.min.css', array(), BOAS_VAR);
        //Page Loader
        //wp_enqueue_style('pageloader-css', BOAS_ASSETS_URI . '/page-loader/css/introLoader.css', array(), '1.6.2');
        //wp_enqueue_script('pageloader-js', BOAS_ASSETS_URI . '/page-loader/jquery.introLoader.pack.min.js', array('jquery'), '1.6.2', FALSE);

        //Mobile MEnu
        wp_enqueue_style('mmenu-style', BOAS_ASSETS_URI . '/css/jquery.mmenu.all.css', array(),BOAS_VAR);
        wp_enqueue_script('mmenu-js', BOAS_ASSETS_URI . '/js/jquery.mmenu.min.all.js', array('jquery'), BOAS_VAR, FALSE);
        
       // wp_enqueue_script('tubeplayer', BOAS_ASSETS_URI . '/js/jQuery.tubeplayer.min.js', array('jquery'), '5.3.0', FALSE);
        wp_enqueue_style('flexslider-style', BOAS_ASSETS_URI . '/css/flexslider.css', array(),BOAS_VAR);
        wp_enqueue_script('flexslider', BOAS_ASSETS_URI . '/js/jquery.flexslider-min.js', array('jquery'), BOAS_VAR, FALSE);
        //Slider script       
        if ( !empty($boas_opt['content_load_animae'])) {
             wp_enqueue_script('wow', BOAS_ASSETS_URI . '/js/wow.min.js', array('jquery'), BOAS_VAR, FALSE);
           
        }
        
        //wp_enqueue_script('yt', BOAS_ASSETS_URI . '/js/vapi.js', array(''), BOAS_VAR, FALSE);
        //jquery magnific popup
        //wp_enqueue_style('magnific-popup', BOAS_ASSETS_URI . '/css/magnific-popup.css', array(), '1.0.0');
        //wp_enqueue_script('jquery.magnific-popup', BOAS_ASSETS_URI . '/js/jquery.magnific-popup.min.js', array('jquery'), '1.0.0', FALSE);
        wp_enqueue_script('sticky', BOAS_ASSETS_URI . '/js/jquery.stickyNavbar.min.js', array('jquery'), BOAS_VAR,TRUE);
        wp_enqueue_style('boas-style', BOAS_ASSETS_URI . '/css/boas.css', array(), BOAS_VAR);
        wp_enqueue_script('boas-script', BOAS_ASSETS_URI . '/js/boas-script.js', array('jquery'), BOAS_VAR,TRUE);
        wp_localize_script('boas-script', 'boas_obj', array(
            'site_url' => get_site_url(),
            'ajaxUrl' => admin_url('ajax.php'),
            'mm_theme' => $boas_opt['mobile_menu_theme'],
            'mm_show_logo' => ($boas_opt['show_logo_sx']) ? TRUE : FALSE,
            'mm_logo' => $boas_opt['logo_url_sx']['url'],
                )
        );
    }

    add_action('wp_enqueue_scripts', 'boas_scripts');
endif;