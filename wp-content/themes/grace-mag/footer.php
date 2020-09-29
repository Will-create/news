<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Grace_Mag
 */

?>

<footer class="footer-bg">
    <?php 
    
    if( is_active_sidebar( 'grace-mag-footer-left' ) || is_active_sidebar( 'grace-mag-footer-middle' ) || is_active_sidebar( 'grace-mag-footer-right' ) ) {
        
        /**
        * Hook - grace_mag_footer_container.
        *
        * @hooked grace_mag_footer_container_action - 10
        */
        do_action( 'grace_mag_footer_container' );
    
    }
    
    /**
    * Hook - grace_mag_footer_copyright.
    *
    * @hooked grace_mag_footer_copyright_action - 10
    */
    do_action( 'grace_mag_footer_copyright' );
    ?>
    
</footer>
<?php
/**
* Hook - grace_mag_footer_scroll_top.
*
* @hooked grace_mag_footer_scroll_top_action - 10
*/
do_action( 'grace_mag_footer_scroll_top' );
?>
</div><!-- #page -->
<?php

/**
* Hook - grace_mag_sticky_news.
*
* @hooked grace_mag_sticky_news_action - 50
*/
do_action( 'grace_mag_sticky_news' );

wp_footer();

?>

</body>
</html>
