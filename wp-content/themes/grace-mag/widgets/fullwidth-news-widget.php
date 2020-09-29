<?php
/**
 * Fullwidth News Widget Class
 *
 * @package Grace_Mag
 */

if( ! class_exists( 'Grace_Mag_Fullwidth_News_Widget' ) ) :

    class Grace_Mag_Fullwidth_News_Widget extends WP_Widget {
 
        function __construct() { 

            parent::__construct(
                'grace-mag-fullwidth-news-widget',  // Widget ID
                esc_html__( 'GM: Fullwidth News Widget', 'grace-mag' ),   // Widget Name
                array(
                    'description' => esc_html__( 'Fullwidth News Widget', 'grace-mag' ), 
                )
            ); 
     
        }
     
        public function widget( $args, $instance ) {

            $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

            $posts_no = !empty( $instance[ 'post_no' ] ) ? $instance[ 'post_no' ] : 9;

            $layout = !empty( $instance[ 'layout' ] ) ? $instance[ 'layout' ] : 'full_one';
            
            $post_type = !empty( $instance[ 'post_type' ] ) ? $instance[ 'post_type' ] : 'recent_posts';
            
            $select_cat    = !empty( $instance['select_cat'] ) ? $instance['select_cat'] : 0;

            $post_args = array(
                'post_type' => 'post'
            );
            
            if( absint( $select_cat ) > 0) {
                $post_args['cat'] = absint( $select_cat );
            }
            
            if( $post_type == 'popular_posts' ) {
                
                $post_args['orderby'] = 'comment_count';
            }

            if( absint( $posts_no ) > 0 ) {
                $post_args['posts_per_page'] = absint( $posts_no );
            }

            $post_query = new WP_Query( $post_args );

            if( $post_query->have_posts() ) {

                if( $layout == 'full_one' ) {
                    ?>
                    <div class="primary-widget gm-primary-sec">
                        <div class="container">
                            <?php
                            if( !empty( $title ) ) {
                            ?>
                            <div class="title-sec">
                                <h2 class="md-title"><?php echo esc_html( $title ); ?></h2>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="primary-content-area">
                                    <?php
                                    
                                    $count = 1;
                                    
                                    while( $post_query->have_posts() ) :

                                        $post_query->the_post();
                    
                                        if( $count == 1 ) {
                    
                                            $post_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                            ?>
                                            <div class="primary-main-bdy<?php grace_mag_has_image_class( $post_image_url ); ?>"<?php grace_mag_has_image_url( $post_image_url ); ?>>
                                                <div class="caption">
                                                    <?php grace_mag_categories_meta( true ); ?>
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <div class="meta">
                                                        <?php grace_mag_posted_on( true ); ?>
                                                        <?php grace_mag_comments_no( true ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        <ul class="primary-list1 ">
                                        <?php
                                        
                                        $count = 1;

                                        while( $post_query->have_posts() ) :

                                            $post_query->the_post();

                                            if( $count > 1 && $count <= 3 ) {

                                            ?>
                                            <li class="clearfix">
                                                <?php
                                                if( has_post_thumbnail() ) {
                                                ?>
                                                <figure>
                                                    <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                                </figure>
                                                <?php
                                                }
                                                ?>
                                                <div class="list-content">
                                                    <?php grace_mag_categories_meta( true ); ?>
                                                    <h4 class="sm-title">
                                                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- col-lg-4 -->
                                <div class="col-12  col-lg-4">
                                    <div class="primary-content-area">
                                    <?php

                                    $count = 1;

                                    while( $post_query->have_posts() ) :

                                        $post_query->the_post();

                                        if( $count == 4 ) {

                                            $post_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                            ?>
                                            <div class="primary-main-bdy<?php grace_mag_has_image_class( $post_image_url ); ?>"<?php grace_mag_has_image_url( $post_image_url ); ?>>
                                                <div class="caption">
                                                    <?php grace_mag_categories_meta( true ); ?>
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <div class="meta">
                                                        <?php grace_mag_posted_on( true ); ?>
                                                        <?php grace_mag_comments_no( true ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        <ul class="primary-list1 ">
                                        <?php

                                        $count = 1;

                                        while( $post_query->have_posts() ) :

                                            $post_query->the_post();

                                            if( $count > 4 && $count <= 6 ) {

                                            ?>
                                            <li class="clearfix">
                                                <?php
                                                if( has_post_thumbnail() ) {
                                                ?>
                                                <figure>
                                                    <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                                </figure>
                                                <?php
                                                }
                                                ?>
                                                <div class="list-content">
                                                    <?php grace_mag_categories_meta( true ); ?>
                                                    <h4 class="sm-title">
                                                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- col-lg-4 -->
                                <div class="col-12  col-lg-4">
                                    <div class="primary-content-area">
                                    <?php

                                    $count = 1;

                                    while( $post_query->have_posts() ) :

                                        $post_query->the_post();

                                        if( $count == 7 ) {

                                            $post_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
                                            ?>
                                            <div class="primary-main-bdy<?php grace_mag_has_image_class( $post_image_url ); ?>"<?php grace_mag_has_image_url( $post_image_url ); ?>>
                                                <div class="caption">
                                                    <?php grace_mag_categories_meta( true ); ?>
                                                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                    <div class="meta">
                                                        <?php grace_mag_posted_on( true ); ?>
                                                        <?php grace_mag_comments_no( true ); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        <ul class="primary-list1 ">
                                        <?php

                                        $count = 1;

                                        while( $post_query->have_posts() ) :

                                            $post_query->the_post();

                                            if( $count > 7 && $count <= 9 ) {

                                            ?>
                                            <li class="clearfix">
                                                <?php
                                                if( has_post_thumbnail() ) {
                                                ?>
                                                <figure>
                                                    <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                                </figure>
                                                <?php
                                                }
                                                ?>
                                                <div class="list-content">
                                                    <?php grace_mag_categories_meta( true ); ?>
                                                    <h4 class="sm-title">
                                                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h4>
                                                </div>
                                            </li>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- col-lg-4 -->
                            </div>
                        </div>
                    </div>
                    <!-- primary-widget -->
                    <?php
                } else {
                    ?>
                    <div class="full-layout5">
                        <div class="container">
                            <?php
                            if( !empty( $title ) ) {
                            ?>
                            <div class="title-sec orange">
                                <h2 class="md-title"><?php echo esc_html( $title ); ?></h2>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="row ">
                                <div class="col-12 col-lg-6">
                                    <div class="full-layout5-aside">
                                        <ul class="row">
                                        <?php

                                        $count = 1;

                                        while( $post_query->have_posts() ) :

                                            $post_query->the_post();

                                            if( $count == 1 || $count <= 4 ) {
                                            
                                            ?>
                                            <li class="col-12 col-lg-6">
                                                <figure class="img-hover">
                                                    <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                                </figure>
                                                <h4 class="sub-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h4>
                                            </li>
                                            <?php
                                            }
                                            $count++;
                                        endwhile;
                                        wp_reset_postdata();
                                        ?>
                                        </ul>
                                        <!--3rd inner-row-->
                                    </div>
                                </div>
                                <?php
                                $count = 1;

                                while( $post_query->have_posts() ) :

                                    $post_query->the_post();

                                    if( $count == 5 ) {
                                    ?>
                                    <!--inner-col-lg-6-->
                                    <div class="col-12 col-lg-6">
                                        <div class="full-layout5-content">
                                            <figure class="img-hover">
                                                <?php the_post_thumbnail( 'grace-mag-thumbnail-one', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                                            </figure>
                                            <div class="full-layout-bdy">
                                                <?php grace_mag_categories_meta( true ); ?>
                                                <h3 class="sm-title">
                                                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                                <div class="meta"> 
                                                    <?php grace_mag_posted_on( true ); ?>
                                                    <?php grace_mag_comments_no( true ); ?> 
                                                </div>
                                                <!--meta-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--col-lg-6-->
                                    <?php
                                    }
                                    $count++;
                                endwhile;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- full layout5 -->
                    <?php
                }           
            }
        }
     
        public function form( $instance ) {
            $defaults = array(
                'title'        => '',
                'post_no'      => 9,
                'layout'       => 'full_one',
                'post_type'    => 'recent_posts',
                'select_cat'   => 0,
            );

            $instance = wp_parse_args( (array) $instance, $defaults );
            
            $fullwidth_layouts = grace_mag_fullwidth_layouts_array();
            
            $post_types = grace_mag_post_types_array();

            ?>
            
            <p class="layout-options-image">
                <label for="<?php echo esc_attr( $this->get_field_id('layout') ); ?>">
                    <strong><?php esc_html_e('Chooose Layout', 'grace-mag'); ?></strong>
                </label>
                
                <br>
                <br>
                <?php 
            
                foreach( $fullwidth_layouts as $key => $fullwidth_layout ) {
                    
                ?>
                <label for="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" class="rad">
                    <input 
                      type="radio" name="<?php echo esc_attr( $this->get_field_name('layout') ); ?>"
                      id="<?php echo esc_attr( $this->get_field_id('layout') ); ?>" class="input-hidden" <?php checked($instance['layout'],$key); ?> value="<?php echo esc_attr( $key ); ?>">
                    <img class="rad-image" src="<?php echo esc_url( $fullwidth_layout ); ?>" />
                </label>
                
                <?php
                }
                ?>
                
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
                    <strong><?php esc_html_e( 'Post Type' , 'grace-mag' ); ?></strong>
                </label>
                <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_type' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_type' ) ); ?>">
                <?php
                    
                foreach( $post_types as $key => $post_type ){
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $instance['post_type'], $key ); ?>>
                        <?php 
                            echo esc_html( $post_type );
                        ?>
                    </option>
                    <?php
                }
                ?>
                </select>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
                    <strong><?php esc_html_e('Title', 'grace-mag'); ?></strong>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />   
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'select_cat' ) ); ?>">
                    <strong><?php echo esc_html_e( 'Select Category' , 'grace-mag' ); ?></strong>
                </label>
                <?php
                    wp_dropdown_categories( array(
                        'id'               => esc_attr( $this->get_field_id( 'select_cat' ) ),
                        'class'            => 'widefat',
                        'name'             => esc_attr( $this->get_field_name( 'select_cat' ) ),
                        'orderby'          => 'name',
                        'selected'         => esc_attr( $instance [ 'select_cat' ] ),
                        'show_option_all'  => esc_html__( 'Select To Show Category Posts' , 'grace-mag' ),
                        )
                    );
                ?>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>">
                    <strong><?php esc_html_e('No of Posts', 'grace-mag'); ?></strong>
                    <span class="description-layout full_one <?php echo esc_attr( ($instance['layout']=='full_one') ? 'active-layout' : '' ); ?>">
                        <?php echo esc_html__( 'You can use maximum upto 9 number of posts.', 'grace-mag' ); ?>
                    </span>
                    <span class="description-layout full_two <?php echo esc_attr( ($instance['layout']=='full_two') ? 'active-layout' : '' ); ?>">
                        <?php echo esc_html__( 'You can use maximum upto 5 number of posts.', 'grace-mag' ); ?>
                    </span>
                </label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_no') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_no') ); ?>" type="number" value="<?php echo esc_attr( $instance['post_no'] ); ?>" />   
            </p>

            <?php
        }
     
        public function update( $new_instance, $old_instance ) {
     
            $instance = $old_instance;

            $instance['title']        = sanitize_text_field( $new_instance['title'] );
            
            $instance['select_cat']   = absint( $new_instance['select_cat'] );

            $instance['post_no']      = absint( $new_instance['post_no'] );

            $instance['layout']       = sanitize_text_field( $new_instance['layout'] );
            
            $instance['post_type']    = sanitize_text_field( $new_instance['post_type'] );

            return $instance;
        }
    }
endif;
