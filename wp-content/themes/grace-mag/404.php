<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Grace_Mag
 */

get_header();
?>
<div class="not-found-page">
    <div class="gm-not-found-wrap lrg-padding">
        <div class="container center">
            <div class="img-holder ">
                <?php
                $page_not_found_image = get_template_directory_uri() . '/everestthemes/admin/images/404.jpg';
                if( !empty( $page_not_found_image ) ) {
                ?>
                <figure>
                    <img src="<?php echo esc_url( $page_not_found_image ); ?>" alt="broken">
                </figure>
                <?php
                }
                ?>
                <div class="not-page-content">
                    <h2 class="l-title"><?php echo esc_html__( 'Page not Found', 'grace-mag' ); ?></h2>
                    <h1 class="xl-title"><?php echo esc_html__( '404', 'grace-mag' ); ?></h1>
                    <h3 class="md-title"><?php echo esc_html__( 'Sometimes getting lost....', 'grace-mag' ); ?></h3>
                </div>
            </div>  
        </div>
    </div>
</div> <!--not found page-->
<?php
get_footer();
