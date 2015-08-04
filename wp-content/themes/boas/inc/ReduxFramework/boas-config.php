<?php

/*
 * @package WP-@IllusiveDesign
 * @subpackage RideFlag
 * @since RideFlag 1.0
 * 2015(c) IllusiveDesign
 */
if (!class_exists('Redux')) {
    return;
}

class BoasOptionConfig {

    var $opt_name = "boas_opt";
    var $theme;
    var $args;
    var $media_url;
    var $gfont;

    function __construct() {
        $this->theme = wp_get_theme();
        $this->media_url = BOAS_ASSETS_URI . '/images/';
        $this->opt_name = apply_filters('boas_opt', $this->opt_name);

        $this->addActions();
        $this->setArgs();
        $this->load_gfont();
        $this->init();
        $this->addFilters();
    }

    public function addActions() {
        add_action("redux/extensions/{$this->opt_name}/before", array($this, 'addExtensions'), 0);
    }

    public function load_gfont() {
        $gfont = get_option('gfont');
        if (empty($gfont)) {
            $fontsSeraliazed = file_get_contents('http://phat-reaction.com/googlefonts.php?format=php');
            //$fontArray = unserialize($fontsSeraliazed);
            update_option('gfont', $fontsSeraliazed, true);
            $gfont = $fontsSeraliazed;
        }
        $fontArray = unserialize($gfont);
        $gfont_option = array();
        foreach ($fontArray as $key => $font) {
            $gfont_option[$font['css-name']] = $font['font-name'];
        }
        $this->gfont = $gfont_option;
    }

    public function addFilters() {
        
    }

    public function init() {
        Redux::setArgs($this->opt_name, $this->args);
        $sections = $this->addSections();
        Redux::setSections($this->opt_name, $sections);
    }

    public function setArgs() {
        $this->args = array(
            'opt_name' => $this->opt_name,
            'display_name' => $this->theme->get('Name'),
            'display_version' => $this->theme->get('Version'),
            'menu_type' => 'menu',
            'allow_sub_menu' => true,
            'menu_title' => __('Theme Options', BOAS_LANG),
            'page_title' => __('BOAS Theme Options', BOAS_LANG),
            'google_api_key' => '',
            'google_update_weekly' => false,
            'async_typography' => true,
            'admin_bar' => true,
            'admin_bar_icon' => 'dashicons-admin-tools',
            'admin_bar_priority' => 50,
            'global_variable' => '',
            'dev_mode' => FALSE,
            'update_notice' => FALSE,
            'customizer' => true,
            'page_priority' => 50,
            'page_parent' => 'themes.php',
            'page_permissions' => 'manage_options',
            'menu_icon' => $this->media_url . '/logo16.png',
            'last_tab' => '',
            'page_icon' => 'dashicons-admin-tools',
            'page_slug' => '',
            'save_defaults' => false,
            'default_show' => false,
            'default_mark' => '',
            'show_import_export' => true,
            'transient_time' => 60 * MINUTE_IN_SECONDS,
            'output' => true,
            'output_tag' => true,
            'footer_credit' => '',
            'database' => '',
            'hints' => array(
                'icon' => 'el el-question-sign',
                'icon_position' => 'right',
                'icon_color' => 'lightgray',
                'icon_size' => 'normal',
                'tip_style' => array(
                    'color' => 'red',
                    'shadow' => true,
                    'rounded' => false,
                    'style' => '',
                ),
                'tip_position' => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ),
                'tip_effect' => array(
                    'show' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'mouseover',
                    ),
                    'hide' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'click mouseleave',
                    ),
                ),
            )
        );

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
        $this->args['admin_bar_links'][] = array(
            'id' => 'redux-docs',
            'href' => 'http://docs.reduxframework.com/',
            'title' => __('Documentation', 'redux-framework-demo'),
        );

        $this->args['admin_bar_links'][] = array(
            //'id'    => 'redux-support',
            'href' => 'https://github.com/ReduxFramework/redux-framework/issues',
            'title' => __('Support', 'redux-framework-demo'),
        );

        $this->args['admin_bar_links'][] = array(
            'id' => 'redux-extensions',
            'href' => 'reduxframework.com/extensions',
            'title' => __('Extensions', 'redux-framework-demo'),
        );

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
        $this->args['share_icons'][] = array(
            'url' => 'https://github.com/anup04sust',
            'title' => 'Follow me on GitHub',
            'icon' => 'el el-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://www.facebook.com/anup04sust',
            'title' => 'Like us on Facebook',
            'icon' => 'el el-facebook'
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://twitter.com/anup04sust',
            'title' => 'Follow me on Twitter',
            'icon' => 'el el-twitter'
        );
        $this->args['share_icons'][] = array(
            'url' => 'https://bd.linkedin.com/pub/anup-biswas/26/730/110',
            'title' => 'Connect me on LinkedIn',
            'icon' => 'el el-linkedin'
        );

        // Panel Intro text -> before the form
        if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
            if (!empty($this->args['global_variable'])) {
                $v = $this->args['global_variable'];
            } else {
                $v = str_replace('-', '_', $this->args['opt_name']);
            }
            $this->args['intro_text'] = sprintf(__('<p>To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', BOAS_LANG), $v);
        } else {
            $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', BOAS_LANG);
        }

        // Add content after the form.
        $this->args['footer_text'] = __("<p>&copy;2015 Modified by <a href=\"{$this->theme->ThemeURI}\">{$this->theme->Author}</a></p>", BOAS_LANG);
    }

    public function addSections() {
        $sections[] = $this->optionBasic();
        $sections[] = $this->optionTypography();
        $sections[] = $this->optionHeader();
        $sections[] = $this->optionSlider();
        $sections[] = $this->optionSocial();
        //$sections[] = $this->optionContent();
        // $sections[] = $this->optionFooter();
        //$sections[] = $this->optionContact();
        // $sections[] = $this->optionLogin();
        // $sections[] = $this->optionPreLoader();

        return apply_filters('add_boas_theme_option', $sections);
    }

    function optionBasic() {
        $fields = array(
            array(
                'id' => 'show_logo',
                'type' => 'switch',
                'title' => __('Show Logo', BOAS_LANG),
                'subtitle' => __('Others showing site title.', BOAS_LANG),
                'default' => true,
            ),
            array(
                'id' => 'logo_url',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', BOAS_LANG),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Basic media uploader with disabled URL input field.', BOAS_LANG),
                'default' => array('url' => $this->media_url . 'logo-l2.png'),
                'required' => array('show_logo', '=', '1'),
            ),
            array(
                'id' => 'show_logo_sx',
                'type' => 'switch',
                'title' => __('Enable Mobile Logo', BOAS_LANG),
                'subtitle' => __('In small device  show a alternative Logo', BOAS_LANG),
                'default' => true,
            ),
            array(
                'id' => 'logo_url_sx',
                'type' => 'media',
                'url' => true,
                'title' => __('Logo', BOAS_LANG),
                'compiler' => 'true',
                //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => __('Basic media uploader with disabled URL input field.', BOAS_LANG),
                'default' => array('url' => $this->media_url . 'logo-xs.png'),
                'required' => array('show_logo_sx', '=', '1'),
            ),
            array(
                'id' => 'show_tagline',
                'type' => 'switch',
                'title' => __('Show Tagline', BOAS_LANG),
                'default' => FALSE,
            ),
            array(
                'id' => 'custom_favicon',
                'type' => 'media',
                'url' => true,
                'title' => __('Custom Favicon Icon', BOAS_LANG),
                'default' => array('url' => $this->media_url . 'favicon.ico'),
                'preview' => false,
            ),
            array(
                'id' => 'site_layout',
                'type' => 'switch',
                'title' => __('Site Layout', BOAS_LANG),
                'default' => 1,
                'on' => 'Boxed',
                'off' => 'Fluid',
            ),
            array(
                'id' => 'use_gfont',
                'type' => 'switch',
                'title' => __('Use Google Font', BOAS_LANG),
                'default' => true,
            ),
        );
        return array(
            'title' => __('Basic Fields', BOAS_LANG),
            'id' => 'boas-basic',
            'desc' => __('', BOAS_LANG),
            'customizer_width' => '400px',
            'icon' => 'el el-home',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-basic/fields', $fields),
        );
    }

    function optionTypography() {
        $fields = array(
            array(
                'id' => 'body-font',
                'type' => 'typography',
                'title' => __('Body Font', BOAS_LANG),
                'google' => true,
                'font-backup' => FALSE,
                'output' => array('html,body'),
                'units' => 'px',              
                'default' => array(
                    'color' => '#333',
                    'font-style' => '400',
                    'font-family' => 'Abel',
                    'google' => true,
                    'font-size' => '16px',
                    'line-height' => '20'
                ),
            ),
        );
        return array(
            'title' => __('Typography', BOAS_LANG),
            'id' => 'boas-typography',
            'icon' => 'el el-font',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-typography/fields', $fields),
                //'subsection' => TRUE,
        );
    }
    function optionSocial() {
        $fields = array(
            array(
                'id' => 'social_facebook',
                'type' => 'text',
                'title' => __('Facebook', BOAS_LANG),                
                'default' => 'https://www.facebook.com/anup04sust',
            ),
            array(
                'id' => 'social_twitter',
                'type' => 'text',
                'title' => __('Twitter', BOAS_LANG),                
                'default' => 'https://twitter.com/anup04sust',
            ),
            array(
                'id' => 'social_linkedin',
                'type' => 'text',
                'title' => __('linkedin', BOAS_LANG),                
                'default' => 'https://bd.linkedin.com/pub/anup-biswas/26/730/110',
            ),
        );
        return array(
            'title' => __('Social Links', BOAS_LANG),
            'id' => 'boas-social',
            'icon' => 'el el-network',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-social/fields', $fields),
                //'subsection' => TRUE,
        );
    }
    function optionHeader() {
        $fields = array(
            array(
                'id' => 'logo_bg',
                'type' => 'color',
                'title' => __('Logo Background', BOAS_LANG),                
                'default' => true,
                'output' => array('.navbar-brand'),
                 'mode'     => 'background',
            ),
            array(
                'id' => 'menu_add_social',
                'type' => 'switch',
                'title' => __('Show Social Icon in Menu', BOAS_LANG),              
                'default' => true,
                'on'=>'Yes',
                'off'=>'No',
                
            ),
        );
        return array(
            'title' => __('Header', BOAS_LANG),
            'id' => 'boas-header',
            'desc' => __('', BOAS_LANG),
            'icon' => 'el el-bookmark',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-header/fields', $fields),
        );
    }

    function optionSlider() {
        $fields = array(
            array(
                'id' => 'home_slider',
                'type' => 'select',
                'title' => __('Home Page Slider', BOAS_LANG),
                'options' => array(
                    'revslider' => 'Revolution Sliders',
                    'theme-camera' => 'Theme Default Slider(camera)',
                ),
                'default' => 'revslider'
            ),
            array(
                'id' => 'home_slider_shortcode',
                'type' => 'text',
                'title' => __('Slider Shortcode', BOAS_LANG),
                'default' => '[rev_slider home-page]',
                'required' => array('home_slider', '=', array('revslider')),
            ),
            array(
                'id' => 'home_slider_layout',
                'type' => 'switch',
                'title' => __('Slider Type', BOAS_LANG),
                'default' => 1,
                'on' => 'Content Width',
                'off' => 'Full Width',
            ),
            array(
                'id' => 'theme_slides',
                'type' => 'slides',
                'title' => __('Slides', BOAS_LANG),
                'required' => array('home_slider', '=', 'theme-camera'),
                'placeholder' => array(
                    'title' => __('This is a title', 'redux-framework-demo'),
                    'description' => __('Description Here', 'redux-framework-demo'),
                    'url' => __('Give us a link!', 'redux-framework-demo'),
                ),
            ),
            array(
                'id' => 'theme_slides_height',
                'type' => 'text',
                'title' => __('Slider Height', BOAS_LANG),
                'default' => '30%',
                'required' => array('home_slider', '=', 'theme-camera'),
            ),
            array(
                'id' => 'theme_slides_caption_bg',
                'type' => 'color_rgba',
                'title' => __('Caption Background', BOAS_LANG),
                'default' => '30%',
                'default' => array(
                    'color' => '#000000',
                    'alpha' => '.5'
                ),
                'required' => array('home_slider', '=', 'theme-camera'),
                'compiler' => TRUE,
                'output' => array('.cameraContent'),
                'mode' => 'background',
            ),
            array(
                'id' => 'theme_slides_colors',
                'type' => 'color',
                'title' => __('Color Theme', BOAS_LANG),
                'default' => '#333',
                'required' => array('home_slider', '=', 'theme-camera'),
            ),
        );
        return array(
            'title' => __('Slider', BOAS_LANG),
            'id' => 'boas-slider',
            'icon' => 'el el-picture',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-slider/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionContent() {
        $fields = array(
            array(
                'id' => 'content_load_animae',
                'type' => 'switch',
                'title' => __('Content load animation', BOAS_LANG),
                'default' => 1,
                'on' => 'WOW',
                'off' => 'NONE',
            ),
            array(
                'id' => 'default_banner',
                'type' => 'media',
                'url' => true,
                'title' => __('Default Banner', BOAS_LANG),
                'default' => array('url' => $this->media_url . 'default_banner.jpg'),
                'preview' => true,
            ),
            array(
                'id' => 'default_banner_height',
                'type' => 'text',
                'title' => __('Default Banner Height', BOAS_LANG),
                'description' => __('You can use fixed height in px. eg. 25px', BOAS_LANG),
                'default' => '25%',
            ),
        );
        return array(
            'title' => __('Content Details', BOAS_LANG),
            'id' => 'boas-content',
            'icon' => 'el el-th-large',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-content/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionFooter() {
        $fields = array(
            array(
                'id' => 'show_footer_nav',
                'type' => 'switch',
                'title' => __('Show Footer Navigation', BOAS_LANG),
                'default' => true,
            ),
            array(
                'id' => 'site_copyright',
                'type' => 'editor',
                'title' => __('Copyright', BOAS_LANG),
                'default' => '&copy; ' . date('Y') . ' <a href="' . get_bloginfo('site_url') . '">' . get_bloginfo('name') . '</a>',
            ),
        );
        return array(
            'title' => __('Footer', BOAS_LANG),
            'id' => 'boas-footer',
            'icon' => 'el el-adjust',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-footer/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionContact() {
        $fields = array(
            array(
                'id' => 'contact_address',
                'type' => 'editor',
                'title' => __('Address', BOAS_LANG),
                'default' => '',
                'args' => array(
                    'wpautop' => false,
                    'media_buttons' => false,
                    'textarea_rows' => 5,
                    'teeny' => true,
                    'quicktags' => true,
                )
            ),
            array(
                'id' => 'contact_phone',
                'type' => 'text',
                'title' => __('Phone', BOAS_LANG),
                'default' => '',
            ),
            array(
                'id' => 'contact_email',
                'type' => 'text',
                'title' => __('Email', BOAS_LANG),
                'default' => '',
            ),
            array(
                'id' => 'contact_form',
                'type' => 'text',
                'title' => __('Form Shortcode', BOAS_LANG),
                'default' => '',
            ),
        );
        return array(
            'title' => __('Contact Details', BOAS_LANG),
            'id' => 'boas-contact-details',
            'icon' => 'el el-phone',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-contact-details/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionLogin() {
        $fields = array(
            array(
                'id' => 'enable_loogin_screen',
                'type' => 'switch',
                'title' => __('Show Custom Login Screen', BOAS_LANG),
                'default' => true,
            ),
        );
        return array(
            'title' => __('Login Screen', BOAS_LANG),
            'id' => 'boas-login-screen',
            'icon' => 'el el-screen',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-login-screen/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    function optionPreLoader() {
        $fields = array(
            array(
                'id' => 'loader-background',
                'type' => 'background',
                'output' => array('#introLoaderSpinner'),
                'title' => __('Page Loader Background', BOAS_LANG),
            //'default'   => '#FFFFFF',
            ),
        );
        return array(
            'title' => __('Page PreLoader', BOAS_LANG),
            'id' => 'boas-preloader',
            'icon' => 'el el-repeat-alt',
            'fields' => apply_filters('redux/' . $this->opt_name . '/sections/boas-preloader/fields', $fields),
                //'subsection' => TRUE,
        );
    }

    public function addExtensions($ReduxFramework) {
        $path = dirname(__FILE__) . '/extensions/';
        $folders = scandir($path, 1);
        foreach ($folders as $folder) {
            if ($folder === '.' or $folder === '..' or ! is_dir($path . $folder)) {
                continue;
            }
            $extension_class = 'ReduxFramework_Extension_' . $folder;
            if (!class_exists($extension_class)) {
                // In case you wanted override your override, hah.
                $class_file = $path . $folder . '/extension_' . $folder . '.php';
                $class_file = apply_filters('redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file);
                if ($class_file) {
                    require_once( $class_file );
                }
            }
            if (!isset($ReduxFramework->extensions[$folder])) {
                $ReduxFramework->extensions[$folder] = new $extension_class($ReduxFramework);
            }
        }
    }

}

$theme_options = new BoasOptionConfig();
$theme_options->init();

