<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Grace_Mag
 */

if ( ! is_active_sidebar( 'grace-mag-sidebar' ) ) {
	return;
}
?>

<div class="<?php grace_mag_sidebar_class(); ?>">
    <aside id="secondary" class="secondary-widget-area">
        <?php dynamic_sidebar( 'grace-mag-sidebar' ); ?>
    </aside><!-- // aside -->
</div><!--side-bar col-3-->