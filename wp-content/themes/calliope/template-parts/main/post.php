<div data-colibri-id="16-m1" class="style-67 style-local-16-m1 position-relative">
  <div data-colibri-component="section" data-colibri-id="16-m2" id="blog-post" class="h-section h-section-global-spacing d-flex align-items-lg-center align-items-md-center align-items-center style-68 style-local-16-m2 position-relative">
    <div class="h-section-grid-container h-section-fluid-container">
      <div data-colibri-id="16-m3" class="h-row-container gutters-row-lg-0 gutters-row-md-0 gutters-row-0 gutters-row-v-lg-0 gutters-row-v-md-0 gutters-row-v-0 style-73 style-local-16-m3 position-relative">
        <div class="h-row justify-content-lg-start justify-content-md-start justify-content-start align-items-lg-stretch align-items-md-stretch align-items-stretch gutters-col-lg-0 gutters-col-md-0 gutters-col-0 gutters-col-v-lg-0 gutters-col-v-md-0 gutters-col-v-0">
          <div class="h-column h-column-container d-flex h-col-lg-auto h-col-md-auto h-col-auto style-74-outer style-local-16-m4-outer">
            <div data-colibri-id="16-m4" class="d-flex h-flex-basis h-column__inner h-px-lg-0 h-px-md-0 h-px-3 v-inner-lg-0 v-inner-md-0 v-inner-3 style-74 style-local-16-m4 position-relative">
              <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
                <div data-colibri-id="16-m5" class="h-row-container gutters-row-lg-0 gutters-row-md-0 gutters-row-0 gutters-row-v-lg-0 gutters-row-v-md-0 gutters-row-v-0 colibri-dynamic-list colibri-single-post-loop style-75 style-local-16-m5 position-relative">
                  <div class="h-row justify-content-lg-center justify-content-md-center justify-content-center align-items-lg-stretch align-items-md-stretch align-items-stretch gutters-col-lg-0 gutters-col-md-0 gutters-col-0 gutters-col-v-lg-0 gutters-col-v-md-0 gutters-col-v-0">
                    <?php colibriwp_theme()->get('post-loop')->render(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div data-colibri-component="section" data-colibri-id="16-m27" id="comments-2" class="h-section h-section-global-spacing d-flex align-items-lg-center align-items-md-center align-items-center style-93 style-local-16-m27 position-relative">
    <div class="h-section-grid-container h-section-boxed-container">
      <div data-colibri-id="16-m28" class="h-row-container gutters-row-lg-0 gutters-row-md-0 gutters-row-0 gutters-row-v-lg-0 gutters-row-v-md-0 gutters-row-v-0 style-98 style-local-16-m28 position-relative">
        <div class="h-row justify-content-lg-center justify-content-md-center justify-content-center align-items-lg-stretch align-items-md-stretch align-items-stretch gutters-col-lg-0 gutters-col-md-0 gutters-col-0 gutters-col-v-lg-0 gutters-col-v-md-0 gutters-col-v-0">
          <div class="h-column h-column-container d-flex h-col-lg-auto h-col-md-auto h-col-auto style-99-outer style-local-16-m29-outer">
            <div data-colibri-id="16-m29" class="d-flex h-flex-basis h-column__inner h-px-lg-0 h-px-md-0 h-px-2 v-inner-lg-0 v-inner-md-0 v-inner-2 style-99 style-local-16-m29 position-relative">
              <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
                <div data-colibri-id="16-m30" class="style-100 style-local-16-m30 position-relative">
                  <div class="h-global-transition-all blog-post-comments">
                    <?php colibriwp_post_comments(array (
                      'none' => __('No responses yet', 'calliope'),
                      'one' => __('One response', 'calliope'),
                      'multiple' => __('{COMMENTS-COUNT} Responses', 'calliope'),
                      'disabled' => 'Comments are closed',
                      'avatar_size' => 30,
                    )); ?>
                  </div>
                </div>
                <div data-colibri-id="16-m31" class="position-relative">
                  <div class="h-global-transition-all">
                    <?php colibriwp_post_comment_form(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
