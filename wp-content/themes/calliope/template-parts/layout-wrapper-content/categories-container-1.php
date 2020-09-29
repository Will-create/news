<div data-colibri-id="16-m10" class="h-row-container gutters-row-lg-0 gutters-row-md-0 gutters-row-0 gutters-row-v-lg-0 gutters-row-v-md-0 gutters-row-v-0 style-80 style-local-16-m10 position-relative">
  <div class="h-row justify-content-lg-center justify-content-md-center justify-content-center align-items-lg-stretch align-items-md-stretch align-items-stretch gutters-col-lg-0 gutters-col-md-0 gutters-col-0 gutters-col-v-lg-0 gutters-col-v-md-0 gutters-col-v-0">
    <div class="h-column h-column-container d-flex h-col-lg-auto h-col-md-auto h-col-auto style-81-outer style-local-16-m11-outer">
      <div data-colibri-id="16-m11" class="d-flex h-flex-basis h-column__inner h-px-lg-0 h-px-md-0 h-px-0 v-inner-lg-0 v-inner-md-0 v-inner-0 style-81 style-local-16-m11 position-relative">
        <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
          <div data-colibri-id="16-m12" class="h-blog-categories style-82 style-local-16-m12 position-relative h-element">
            <div class="h-global-transition-all">
              <?php colibriwp_post_categories(array (
                'prefix' => '',
              )); ?>
            </div>
          </div>
          <?php if ( apply_filters( 'colibriwp_show_post_meta', true ) ): ?>
          <div data-colibri-id="16-m13" class="h-blog-meta style-83 style-local-16-m13 position-relative h-element">
            <div name="1" class="metadata-item">
              <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">
                <?php echo esc_html(get_the_author_meta( 'display_name', get_the_author_meta( 'ID' ) )); ?>
              </a>
              <span class="meta-separator">
                <?php esc_html_e('-','calliope'); ?>
              </span>
            </div>
            <div name="2" class="metadata-item">
              <a href="<?php colibriwp_post_meta_date_url(); ?>">
                <?php colibriwp_the_date('F j, Y'); ?>
              </a>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
