<?php
/**
 * Class for creating meta field of sidebar position for page and post.
 *
 * @package Grace_Mag
 */

if( ! class_exists( 'Grace_Mag_Sidebar_Position_Custom_Field' ) ) :

	class Grace_Mag_Sidebar_Position_Custom_Field {

		public function __construct() {

			$this->init();
		}

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function init() {
			// Register post meta fields and save meta fields values.
			add_action( 'admin_init', array( $this, 'register_post_meta' ) );
			add_action( 'save_post', array( $this, 'save_sidebar_position_meta' ) );
		}

		/**
		 * Register post custom meta fields.
		 *
		 * @since    1.0.0
		 */
		public function register_post_meta() {   

		    add_meta_box( 'sidebar_position_metabox', esc_html__( 'Sidebar Position', 'grace-mag' ), array( $this, 'sidebar_position_meta' ), array( 'post', 'page' ), 'side', 'default' );
		}

		/**
		 * Custom Sidebar Post Meta.
		 *
		 * @since    1.0.0
		 */
		public function sidebar_position_meta() {

			global $post;

			global $grace_mag_theme_prefix;

			$sidebar_position_key = $grace_mag_theme_prefix . '_sidebar_position';

			$sidebar_position = get_post_meta( $post->ID, $sidebar_position_key, true );

			if( empty( $sidebar_position ) ) {
				$sidebar_position = 'right';
			}

		    wp_nonce_field( 'sidebar_position_meta_nonce', 'sidebar_position_meta_nonce_id' );

		    $choices = array(
		        'right' => esc_html__( 'Right', 'grace-mag' ),
		        'left' => esc_html__( 'Left', 'grace-mag' ),
		        'none' => esc_html__( 'Fullwidth', 'grace-mag' ),
		    );

		    ?>

		    <table width="100%" border="0" class="options" cellspacing="5" cellpadding="5">
		        <tr>
		        	<td>
			        	<select class="widefat" name="sidebar_position" id="sidebar_position">
			        		<?php
			        		foreach( $choices as $key => $choice ) {
			        			?>
			        			<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $sidebar_position, $key ); ?>><?php echo esc_html( $choice ); ?></option>
			        			<?php
			        		}
			        		?>
			        	</select>
		        	</td>
		        </tr> 
		    </table>   
		    <?php   
		}

		/**
		 * Save Custom Sidebar Position Post Meta.
		 *
		 * @since    1.0.0
		 */
		public function save_sidebar_position_meta() {

		    global $post;  

		    // Bail if we're doing an auto save
		    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		        return;
		    }
		    
		    // if our nonce isn't there, or we can't verify it, bail
		    if( !isset( $_POST['sidebar_position_meta_nonce_id'] ) || !wp_verify_nonce( sanitize_key( $_POST['sidebar_position_meta_nonce_id'] ), 'sidebar_position_meta_nonce' ) ) {
		        return;
		    }
		    
		    // if our current user can't edit this post, bail
		    if ( ! current_user_can( 'edit_post', $post->ID ) ) {
		        return;
		    } 

		    global $grace_mag_theme_prefix;

			$sidebar_position_key = $grace_mag_theme_prefix . '_sidebar_position';

		    if( isset( $_POST['sidebar_position'] ) ) {

				update_post_meta( $post->ID, $sidebar_position_key, sanitize_text_field( wp_unslash( $_POST['sidebar_position'] ) ) ); 
			}
		}
	}
endif;

$Grace_Mag_Sidebar_Position_Custom_Field = new Grace_Mag_Sidebar_Position_Custom_Field();