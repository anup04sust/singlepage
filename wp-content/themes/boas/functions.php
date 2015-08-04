<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;
define('BOAS_LANG', 'boas');
define('BOAS_VAR', '0.1');

define('BOAS_DIR', get_template_directory());
define('BOAS_URI', get_template_directory_uri());
define('BOAS_INC_DIR', BOAS_DIR.'/inc');
define('BOAS_ASSETS_URI', BOAS_URI.'/assets');


 if ( !class_exists( 'ReduxFramework' )) {
    require_once( BOAS_INC_DIR . '/ReduxFramework/ReduxCore/framework.php' );   
    require_once( BOAS_INC_DIR . '/ReduxFramework/boas-config.php' );    
  }
 require_once( BOAS_INC_DIR . '/theme-setup.php' );
 require_once( BOAS_INC_DIR . '/theme-functions.php' );
 require_once( BOAS_INC_DIR . '/bootstrap-navwalker.php' );
 require_once( BOAS_INC_DIR . '/shortcodes/shortcodes.php' );
 require_once( BOAS_INC_DIR . '/widgets/widgets-init.php' );
 //  Register TGM_Plugin_Activation class to install Redux Framework.
//require_once BOAS_INC_DIR . '/tgm-plugin-activation.php';
 
function wpprint($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}