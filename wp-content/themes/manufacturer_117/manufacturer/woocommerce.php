<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package manufacturer
 */
get_header();
$main_sidebar = 'col-md-9';


if ( is_singular( 'product' ) ) { 

    if ( class_exists( 'ReduxFramework' ) ) { 
        if (isset($theme_options['shopsettings-fullwidth-onsinglepage'])) {
            if ($theme_options['shopsettings-fullwidth-onsinglepage'] == 1){
                $main_sidebar = 'col-md-12 col-lg-9';
            }else{
                $main_sidebar = 'col-md-12';
            }
        }else{
            $main_sidebar = 'col-md-12 col-lg-9';
        }
    }
               
}else{
    if ( class_exists( 'ReduxFramework' ) ) { 
        if (isset($theme_options['shopsettings-fullwidth'])) {
            if ($theme_options['shopsettings-fullwidth'] == 1){
                $main_sidebar = 'col-md-12 col-lg-9';
            }else{
                $main_sidebar = 'col-md-12';
            }
        }else{
            $main_sidebar = 'col-md-9';
        }
    }
}



?>


<div class="container">
    <div class="row">
            <div class="<?php echo esc_attr($main_sidebar); ?> man_main_sidebar">

                <div class="content-area">
                    
                    <?php 

                        if ( is_singular( 'product' ) ) {
                         woocommerce_content();

                        }else{
                         wc_get_template( 'archive-product.php' );
                        }

                    ?>

                </div><!-- #primary -->

            </div>
                
            <?php if ( is_singular( 'product' ) ) { ?>

                <?php if ( class_exists( 'ReduxFramework' ) ) { ?>
                    <?php if (isset($theme_options['shopsettings-fullwidth-onsinglepage'])) { ?>
                        <?php if ($theme_options['shopsettings-fullwidth-onsinglepage'] == 1) {?>
                            <div class="col-lg-3 man_sidebar_col">
                                <div class="man_sidebar">
                                <?php dynamic_sidebar('sidebar-woo'); ?>
                                </div>
                            </div>
                        <?php } ?>

                    <?php }else{ ?>
                        <div class="col-lg-3 man_sidebar_col">
                            <div class="man_sidebar">
                            <?php dynamic_sidebar('sidebar-woo'); ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{ //else Redux ?>
                    <div class="col-lg-3 man_sidebar_col">
                        <div class="man_sidebar">
                        <?php dynamic_sidebar('sidebar-main'); ?>
                        </div>
                    </div>
                <?php } ?>
                
            <?php }else{ ?>

                <?php if ( class_exists( 'ReduxFramework' ) ) { ?>
                    <?php if (isset($theme_options['shopsettings-fullwidth'])) { ?>
                        <?php if ($theme_options['shopsettings-fullwidth'] == 1) {?>
                            <div class="col-lg-3 man_sidebar_col">
                                <div class="man_sidebar">
                                <?php dynamic_sidebar('sidebar-woo'); ?>
                                </div>
                            </div>
                        <?php } ?>

                    <?php }else{ ?>
                        <div class="col-lg-3 man_sidebar_col">
                            <div class="man_sidebar">
                            <?php dynamic_sidebar('sidebar-woo'); ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php }else{ //else Redux ?>
                    <div class="col-lg-3 man_sidebar_col">
                        <div class="man_sidebar">
                        <?php dynamic_sidebar('sidebar-main'); ?>
                        </div>
                    </div>
                <?php } ?>

            <?php } ?>
            
            
    </div>

    

</div>

<?php  

if ( !isset($theme_options['shopsettings-navigation']) ) {
    $theme_options['shopsettings-navigation'] = '1';
}
if ( is_singular( 'product' ) && $theme_options['shopsettings-navigation'] == 1 ) {
?>

<div class="man_nearby_posts row">
    
    <?php 
    $prevPost = get_previous_post($in_same_term = true, $excluded_terms = '', $taxonomy = 'product_cat');
    $nextPost = get_next_post($in_same_term = true, $excluded_terms = '', $taxonomy = 'product_cat');
    

    if($prevPost) {?>
    <div class="nav-box man_nav_previous man_image_bck col-md-6" data-image="<?php echo get_the_post_thumbnail_url( $prevPost->ID, 'medium_large'); ?>" data-color="#292929">
    <a href="<?php echo esc_url(get_permalink($prevPost->ID)); ?>"></a>
    <div class="man_nav_over"></div>
    <div class="man_nav_txt">
        <span><i class="ti ti-angle-left"></i>Previous</span> 
        <h3><?php echo get_the_title($prevPost->ID); ?></h3>
    </div>
    </div>
    <?php }else{ ?>
        <div class="nav-box man_nav_previous man_image_bck col-md-6" data-image="<?php echo get_the_post_thumbnail_url( $post->ID, 'medium_large'); ?>" data-color="#292929">
        <div class="man_nav_over"></div>
        <div class="man_nav_txt">
            <h3><?php echo get_the_title($post->ID); ?></h3>
        </div>
        </div>
    <?php } ?>
     
    <?php 
    if($nextPost) { ?>
    <div class="nav-box man_nav_next man_image_bck col-md-6" data-image="<?php echo get_the_post_thumbnail_url( $nextPost->ID, 'medium_large'); ?>" data-color="#292929">
    <a href="<?php echo esc_url(get_permalink($nextPost->ID)); ?>"></a>
    <div class="man_nav_over"></div>
    <div class="man_nav_txt">
        <span>Next <i class="ti ti-angle-right"></i></span> 
        <h3><?php echo get_the_title($nextPost->ID); ?></h3>
    </div>
    </div>
    <?php }else{ ?>
        <div class="nav-box man_nav_next man_image_bck col-md-6" data-image="<?php echo get_the_post_thumbnail_url( $post->ID, 'medium_large'); ?>" data-color="#292929">
        <div class="man_nav_over"></div>
        <div class="man_nav_txt">
            <h3><?php echo get_the_title($post->ID); ?></h3>
        </div>
        </div>
    <?php } ?>
    

</div>

<?php
} 
?>


<?php

get_footer();