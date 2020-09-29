<?php
/**
 * The template for displaying the footer.
 *
 * Closes the <div> for #content, #content-main and #container, <body> and <html> tags.
 *
 * @package Graphene
 * @since Graphene 1.0
 */
global $graphene_settings;
?>  

<?php if ( ! graphene_has_custom_layout() ) : ?>
        <?php do_action( 'graphene_bottom_content' ); ?>
        </div><!-- #content-main -->
        
        <?php
            if ( ! $graphene_settings['mobile_left_column_first'] ) {
                /* Sidebar2 on the left side? */
                if ( in_array( graphene_column_mode(), array( 'three_col_right', 'three_col_center', 'two_col_right' ) ) ) get_sidebar( 'two' );
                
                /* Sidebar1 on the left side? */            
                if ( in_array( graphene_column_mode(), array( 'three_col_right' ) ) ) get_sidebar();
            }
            
            /* Sidebar 2 on the right side? */
            if ( graphene_column_mode() == 'three_col_left' ) get_sidebar( 'two' );
            
            /* Sidebar 1 on the right side? */
            if ( in_array( graphene_column_mode(), array( 'two_col_left', 'three_col_left', 'three_col_center' ) ) ) get_sidebar();
        ?>
        
        <?php do_action( 'graphene_after_content' ); ?>

    <?php graphene_container_wrapper( 'end' ); ?>
</div><!-- #content -->
<?php endif; ?>

<?php do_action( 'graphene_before_footer_widget_area' ); ?>

<?php /* Get the footer widget area */ ?>
<?php get_template_part( 'sidebar', 'footer' ); ?>

<?php do_action( 'graphene_before_footer' ); ?>

<div id="footer" class="row <?php if ( ! is_active_sidebar('footer-bar' ) ) echo 'default-footer'; ?>">
    <?php graphene_container_wrapper( 'start' ); ?>

        <?php if ( ! dynamic_sidebar( 'footer-bar' ) ) : ?>

            <?php 
                if ( ( stripos( $graphene_settings['social_media_location'], 'footer' ) !== false && $graphene_settings['social_profiles'] ) || has_nav_menu( 'footer-menu' ) ) :
            ?>
                <div class="footer-right">
                    <?php if ( stripos( $graphene_settings['social_media_location'], 'footer' ) !== false ) graphene_social_profiles(); ?>

                    <?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
                        <div class="footer-menu-wrap widget_nav_menu flip">
                            <?php
                                /* Footer menu */
                                $args = array(
                                    'container'         => false,
                                    'fallback_cb'       => 'none',
                                    'depth'             => 2,
                                    'theme_location'    => 'footer-menu',
                                    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                );
                                wp_nav_menu( apply_filters( 'graphene_footer_menu_args', $args ) );
                            ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="copyright-developer">
                <?php if ( ! $graphene_settings['hide_copyright'] ) : ?>
                    <div id="copyright">
                        <?php 
                            if ( $graphene_settings['copy_text'] == '' ) printf( '<p>&copy; %1$s %2$s.</p>', date( 'Y' ), get_bloginfo( 'name' ) );
                            else echo ( ! stristr( $graphene_settings['copy_text'], '</p>' ) ) ? wpautop( $graphene_settings['copy_text'] ) : $graphene_settings['copy_text'];

                            do_action('graphene_copyright');
                        ?>
                    </div>
                <?php endif; ?>

                <?php if ( ! $graphene_settings['disable_credit'] ) : ?>
                    <div id="developer">
                        <p>
                            <?php /* translators: %1$s is heart icon, %2$s is the theme's developer */ ?>
                            <?php 
                                printf( 
                                    __( 'Made with %1$s by %2$s.', 'graphene'), 
                                    '<i class="fa fa-heart"></i>', 
                                    '<a href="https://www.graphene-theme.com/" rel="nofollow">' . __('Graphene Themes', 'graphene') . '</a>'
                                ); 
                            ?>
                        </p>

                        <?php do_action('graphene_developer'); ?>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>

        <?php do_action('graphene_footer'); ?>
        
    <?php graphene_container_wrapper( 'end' ); ?>
</div><!-- #footer -->

<?php do_action('graphene_after_footer'); ?>

</div><!-- #container -->

<?php wp_footer(); ?>
</body>
</html>