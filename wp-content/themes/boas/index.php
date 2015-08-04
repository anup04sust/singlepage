<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $boas_opt;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!--[if lt IE 9]>
        <script src="<?php echo BOAS_ASSETS_URI ?>/js/html5.js"></script>
        <script src="<?php echo BOAS_ASSETS_URI ?>/js/respond.min.js"></script>
        <![endif]-->
        <?php if (!empty($boas_opt['custom_favicon'])): ?>
            <link rel="shortcut icon" href="<?php echo $boas_opt['custom_favicon']['url'] ?>" type="image/x-icon"/>
        <?php endif; ?>
        <?php wp_head(); ?>
        <?php if (!empty($boas_opt['content_load_animae'])): ?>
            <style>
                .wow:first-child {
                    visibility: hidden;
                }
            </style>
            <script>
                wow = new WOW();
                wow.init();
            </script>
        <?php endif; ?>
    </head>
    <body <?php body_class(); ?>>
        <div id="site-wrap">
            <header id="header" class="clearfix">
                <div class="<?php boas_layout(); ?>">
                    <div class="row">
                        <div class="col-xs-10 col-sm-10 col-md-2">
                            <div class="navbar-header">
                                <?php if ($boas_opt['show_logo']): ?>
                                    <a rel="home" class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo $boas_opt['logo_url']['url'] ?>" alt="<?php bloginfo('name'); ?>"/></a>
                                <?php else: ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                <?php endif; ?>
                                <?php
                                if ($boas_opt['show_tagline']):
                                    $description = get_bloginfo('description', 'display');
                                    ?>
                                    <p class="site-description"><?php echo $description; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-10 col-sm-10  hidden-lg hidden-md">
                            <a class="navbar-toggle" href="#parimery-mobilemenu-container">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>
                        </div>
                        <div class="hidden-xs hidden-sm col-md-10">
                           <?php boas_primary_menu();?>
                        </div>
                    </div>
                </div>
            </header>
            <section id="main-content" class="clearfix">
                <div class="<?php boas_layout(); ?>">
                    <?php
                    if (have_posts()):
                        while (have_posts()):the_post();
                            the_content();

                        endwhile;
                    endif;
                    ?>
                </div>
            </section>
            <footer id="footer" class="clearfix"></footer>
        </div>

        <?php wp_footer(); ?>
    </body>
</html>