<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $boas_opt;
get_header();
?>
<?php 
if(is_home()|| is_front_page())
    get_template_part('templates/fullpage','slider');    
    ?>
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
<?php get_footer(); ?>        