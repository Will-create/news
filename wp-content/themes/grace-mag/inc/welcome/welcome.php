<?php
    if(!class_exists('Grace_Mag_Welcome')) :

        class Grace_Mag_Welcome {

            public $tab_sections = array(); // Welcome Page Tab Sections
            public $theme_name = null; // For storing Theme Name
            public $theme_slug = null; // For storing Theme Slug
            public $theme_version = null; // For Storing Theme Current Version Information
            public $free_plugins = array(); // Displayed Under Recommended Tabs
            public $pro_plugins = array(); // Will be displayed under Recommended Plugins
            public $req_plugins = array(); // Will be displayed under Required Plugins Tab
            public $companion_plugins = array(); // Will be displayed under Demo Import Tab
            public $strings = array(); // Common Display Strings

            /**
             * Get notice screenshot based on previous theme.
             *
             * @return string Image url.
             */
            private function get_notice_picture() {

                $main_dir = get_template_directory_uri();

                return $main_dir . '/screenshot.png';
            }

            public function __construct( $strings ) {

                /** Useful Variables **/
                $theme = wp_get_theme();
                $this->theme_name = $theme->Name;
                $this->theme_slug = $theme->TextDomain;
                $this->theme_version = $theme->Version;
                $this->theme_page = esc_html( 'welcome-page' );
                $this->plugin_install_page = esc_html( 'tgmpa-install-plugins' );
                $this->import_demo_page = esc_html( 'everest-demo-importer' );
                $this->doc_link = esc_url( 'https://everestthemes.com/doc/grace-mag-wordpress-theme-documentation/' );
                $this->pro_link = esc_url( 'https://everestthemes.com/themes/grace-mag-pro/' );
                $this->review_link = esc_url( 'https://wordpress.org/support/theme/grace-mag/reviews/#new-post' );
                $this->support_link = esc_url( 'https://everestthemes.com/support-forum/' );

                /** Tabs **/
                $this->tab_sections = array(
                    'getting_started'       => esc_html__('Getting Started', 'grace-mag'),
                    'changelogs'            => esc_html__('Changelogs','grace-mag'),
                    'free_vs_pro'           => esc_html__('Free Vs Pro','grace-mag'),
                    'support'               => esc_html__('Support', 'grace-mag'),
                );

                /** Strings **/
                $this->strings = $strings;

                /* Theme Activation Notice */
                add_action( 'load-themes.php', array( $this, 'activation_admin_notice' ) );

                /* Create a Welcome Page */
                add_action( 'admin_menu', array( $this, 'welcome_register_menu' ) );

                /* Enqueue Styles & Scripts for Welcome Page */
                add_action( 'admin_enqueue_scripts', array( $this, 'welcome_styles_and_scripts' ) );

            }

            /** Welcome Message Notification on Theme Activation **/
            public function activation_admin_notice() {

                global $pagenow;

                if( is_admin() && ('themes.php' == $pagenow)  ) {

                    add_action( 'admin_notices', array( $this, 'welcome_admin_notice_display' ) );
                }
            }

            /**
             * Render welcome notice content
             */
            public function welcome_admin_notice_display() {

                $name       = $this->theme_name;
                $slug       = $this->theme_slug;
                $theme_page = $this->theme_page;

                if( class_exists( 'Everest_Toolkit' ) ) {

                    $plugin_page = $theme_page;
                    $plugin_text = esc_html__( 'Already Activated', 'grace-mag' );

                } else {

                    $plugin_page = $this->plugin_install_page;
                    $plugin_text = esc_html__( 'Install and Activate Plugin', 'grace-mag' );
                }


                $welcome_admin_notice_template = '
                    <div class="et-welcome-admin-notice-wrapper notice notice-success is-dismissible">
                    %1$s
                    <hr/>
                        <div class="et-welcome-admin-notice-column-container">
                            <div class="et-welcome-admin-notice-column et-welcome-admin-notice-image">%2$s</div>
                            <div class="et-welcome-admin-notice-column et-welcome-admin-notice-starter-sites">%3$s</div>
                            <div class="et-welcome-admin-notice-column et-welcome-admin-notice-recommendation">%4$s</div>
                        </div>
                    </div>';

                $welcome_admin_notice_header = sprintf(
                    /* translators: %1$s - notice title, %2$s - notice message */
                    '<h2>%1$s <span class="dashicons dashicons-smiley"></span></h2><p class="about-description">%2$s</p></hr>',
                    esc_html__( 'Congratulations!', 'grace-mag' ),
                    sprintf(
                        /* translators: %s - theme name */
                        esc_html__( '%s is now installed and ready to use. Before you begin, please follow the link to setup theme steps by steps.', 'grace-mag' ),
                        $name
                    )
                );

                $ob_btn = sprintf(
                    /* translators: %1$s - theme name, %2$s - button text */
                    '<a href="%1$s" class="button button-primary button-hero install-now" >%2$s</a>',
                    esc_url( admin_url( 'themes.php?page=' . $theme_page ) ), esc_html__( 'Start to setup theme', 'grace-mag' )
                );

                $ob_recom_btn = sprintf(
                    /* translators: %1$s - button url, %2$s - button text */
                    '<a href="%1$s" class="ti-return-dashboard  button button-secondary button-hero install-now" ><span>%2$s</span></a>',
                    esc_url( admin_url( 'themes.php?page=' . $plugin_page ) ), $plugin_text
                );

                $welcome_admin_notice_picture = sprintf(
                    '<picture>
                            <source media="(max-width: 1024px)">
                            <img src="%1$s">
                        </picture>',
                    esc_url( $this->get_notice_picture() )
                );

                $welcome_admin_notice_recommendation = sprintf(
                    /* translators: %1$s - title, %2$s - text, %3$s - button */
                    '<div><h3><span class="dashicons dashicons-warning"></span> %1$s</h3><p>%2$s</p></div><div> <p>%3$s</p></div>',
                    __( 'Recommended Action', 'grace-mag' ),
                    // translators: %s - theme name
                    sprintf( esc_html__( 'Please install everest toolkit plugin before you move to setup introduction. This plugin is necessary and extends the feature to demo import for %s.', 'grace-mag' ), $name ),
                    $ob_recom_btn
                );

                $welcome_admin_notice_setup_list = sprintf(
                    /* translators: %1$s - title, %2$s - text, %3$s - button */
                    '<div><h3><span class="dashicons dashicons-admin-generic"></span> %1$s</h3><p>%2$s</p></div><div> <p>%3$s</p></div>',
                    __( 'Setup Introduction', 'grace-mag' ),
                    // translators: %s - theme name
                    sprintf( esc_html__( '%s comes with handy customizer to setup the theme. Different widgets, layouts comes through out the site with tons of options. It will take around 5 minutes to setup. Click the button below to get started.', 'grace-mag' ), $name ),
                    $ob_btn
                );

                echo sprintf(
                    $welcome_admin_notice_template, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    $welcome_admin_notice_header, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    $welcome_admin_notice_picture, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    $welcome_admin_notice_recommendation, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    $welcome_admin_notice_setup_list // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                );
            }

            /** Register Menu for Welcome Page **/
            public function welcome_register_menu() {

                $title        = esc_html($this->strings['welcome_menu_text']);
                add_theme_page( esc_html($this->strings['welcome_menu_text']), $title , 'edit_theme_options', 'welcome-page', array( $this, 'welcome_screen' ));
            }

            /** Welcome Page **/
            public function welcome_screen() {

                $tabs = $this->tab_sections;

                $current_section = isset($_GET['section']) ? sanitize_text_field( wp_unslash( $_GET['section'] ) ) : 'getting_started';

                $section_inline_style = '';
                ?>
                <div class="et-welcome-header" style="">
                    <div class="inner-header-wrapp">
                    <h1><?php echo esc_html($this->theme_name); ?></h1>
                    <span><?php echo esc_html($this->theme_version); ?></span>
                    <div class="about-text"><?php echo wp_kses_post($this->strings['theme_short_description']); ?></div>
                    </div>
                </div>
                <div class="wrap about-wrap">
                    <div class="nav-tab-wrapper clearfix">
                        <?php foreach($tabs as $id => $label) : ?>
                            <?php
                                $section = isset($_REQUEST['section']) ? sanitize_text_field( wp_unslash( $_REQUEST['section'] ) ) : 'getting_started';
                                $nav_class = 'nav-tab';
                                if($id == $section) {
                                    $nav_class .= ' nav-tab-active';
                                }
                            ?>
                            <a href="<?php echo esc_url(admin_url('themes.php?page=welcome-page&section='.$id)); ?>" class="<?php echo esc_attr($nav_class); ?>" >
                                <?php echo esc_html( $label ); ?>
                                <?php if($id == 'recommended_plugins') : $not = $this->get_required_plugin_notification(); ?>
                                    <?php if($not) : ?>
                                        <span class="pending-tasks">
                                            <?php echo esc_html($not); ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="welcome-section-wrapper">
                        <?php $section = isset($_REQUEST['section']) ? sanitize_text_field( wp_unslash( $_REQUEST['section'] ) ) : 'getting_started'; ?>
                        <div class="welcome-section <?php echo esc_attr($section); ?> clearfix">
                            <?php require_once get_template_directory() . '/inc/welcome/sections/'.esc_html($section).'.php'; ?>
                        </div>
                    </div>
                </div>
                <?php
            }

            /** Enqueue Necessary Styles and Scripts for the Welcome Page **/
            public function welcome_styles_and_scripts() {

                wp_enqueue_style( 'grace-mag' . '-welcome-screen', get_template_directory_uri() . '/inc/welcome/css/welcome.css' );
                wp_enqueue_script( 'grace-mag' . '-welcome-screen', get_template_directory_uri() . '/inc/welcome/js/welcome.js', array( 'jquery' ) );
            }

            public function admin_sidebar_contents() {

                $pro_link = $this->pro_link;
                $doc_link = $this->doc_link;
                $review_link = $this->review_link;

                ?>
                <div class="operation-admin-side-wrapper">

                    <div class="operation-side-box-wrapper operation-welcome-box-white">
                        <div class="box-header et-box-header"><?php esc_html_e('Buy Pro','grace-mag'); ?></div>
                        <div class="box-content">
                            <p><?php esc_html_e('Get advance options to customize your site and more layouts.','grace-mag'); ?></p>
                            <a href="<?php echo esc_url( $pro_link );?>" class="button button-primary btn" target="_blank"><?php esc_html_e('Pro Details','grace-mag'); ?></a>
                        </div>
                    </div>

                    <div class="operation-side-box-wrapper operation-welcome-box-white">
                        <div class="box-header et-box-header"><?php esc_html_e('Theme Documentation','grace-mag'); ?></div>
                        <div class="box-content">
                            <p><?php esc_html_e('We have online proper documentation to know every options and use them, go through the documentation to get more familiar with theme','grace-mag'); ?></p>
                            <a href="<?php echo esc_url( $doc_link );?>" class="button button-primary" target="_blank"><?php esc_html_e('Read Now','grace-mag'); ?></a>
                        </div>
                    </div>

                    <div class="operation-side-box-wrapper operation-welcome-box-white">
                        <div class="box-header et-box-header"><?php printf(esc_html__('Loving %1$s ? ','grace-mag'),$this->theme_name); ?></div>
                        <div class="box-content">
                            <p><?php printf( esc_html__( 'Are you are enjoying %1$s? We would love to hear your feedback.','grace-mag' ),$this->theme_name); ?></p>
                            <a href="<?php echo esc_url( $review_link );?>" class="button button-primary" target="_blank"><?php esc_html_e('Leave Us Review','grace-mag'); ?></a>
                        </div>
                    </div>

                </div>
            <?php
            }

        }

    endif;
?>
