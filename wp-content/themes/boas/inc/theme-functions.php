<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('boas_layout')) {

    function boas_layout($class = '') {
        global $boas_opt;
        $layout_class = !empty($boas_opt['site_layout']) ? 'container' : 'container-fluid';
        $layout_class = apply_filters('boas_layout', $layout_class);
        $layout_class .=!empty($class) ? ' ' . $class : '';
        echo $layout_class;
    }

}
if (!function_exists('boas_primary_menu')) {

    function boas_primary_menu($class = '') {
        global $boas_opt;
        echo '<div id="primary-nav-collapse" class="primary-menu clearfix">';
        if(!empty($boas_opt['menu_add_social'])){
           echo boas_social_icons();
        }
        wp_nav_menu(array(
            'menu' => 'primary',
            'theme_location' => 'primary-nav',
            'depth' => 2,
            'container' => '',
            'container_class' => '',
            'container_id' => '',
            'menu_class' => 'nav navbar-nav primary-nav pull-right',
            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
            'walker' => new wp_bootstrap_navwalker())
        );
        
        echo '</div>';
    }

}
if (!function_exists('boas_social_icons')) {
    function boas_social_icons(){
        $out_social = '<ul class="socials pull-right">';
         global $boas_opt;
         if(!empty($boas_opt['social_facebook'])){
            $out_social .= sprintf('<li class="social"><a href="%s" terget="_blank" title="Follow on Facebook"><span class="fa fa-facebook"></span></a></li>',$boas_opt['social_facebook']); 
         }
         if(!empty($boas_opt['social_twitter'])){
            $out_social .= sprintf('<li class="social"><a href="%s" terget="_blank" title="Follow on Twitter"><span class="fa fa-twitter"></span></a></li>',$boas_opt['social_twitter']); 
         }
         if(!empty($boas_opt['social_linkedin'])){
            $out_social .= sprintf('<li class="social"><a href="%s" terget="_blank" title="Follow on Linkedin"><span class="fa fa-linkedin"></span></a></li>',$boas_opt['social_linkedin']); 
         }
         if(!empty($boas_opt['social_feed'])){
            $out_social .= sprintf('<li class="social"><a href="%s" terget="_blank" title="Follow on Linkedin"><span class="fa fa-rss"></span></a></li>',$boas_opt['social_feed']); 
         }
        $out_social .= '</ul>';
        return $out_social;
    }
}