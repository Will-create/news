<?php
/**
 * Radio Image Custom Control
 */

if( ! class_exists( 'Grace_Mag_Radio_Image_Control' ) ) {

    class Grace_Mag_Radio_Image_Control extends WP_Customize_Control {
        
        public $type = 'radio-image';

        public function render_content() {
            
            $name = '_customize-radio-' . $this->id;
            ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if($this->description) { ?>
                <span class="description customize-control-description">
                    <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php } ?>
            <div id="input_<?php echo esc_attr( $this->id ); ?>" class="image">
                <?php 
                foreach ( $this->choices as $value => $label ) : 
                    ?>                
                    <label for="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>">
                        <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $this->id ) . esc_attr( $value ); ?>" <?php esc_url( $this->link() ); checked( $this->value(), $value ); ?>>
                        <img src="<?php echo esc_url( $label ); ?>"/>
                    </label>
                    <?php 
                endforeach; 
                ?>
            </div>
            <?php
        }
    }
}