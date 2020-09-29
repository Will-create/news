<div data-colibri-id="5-h25" id="hero" class="h-section h-hero d-flex align-items-lg-center align-items-md-center align-items-center style-25 style-local-5-h25 position-relative">
  <?php $component = \ColibriWP\Theme\View::getData( 'component' ); ?>
      <?php $component->printBackground(); ?>
  <?php $component->printSeparator(); ?>
  <div class="h-section-grid-container h-navigation-padding h-section-boxed-container">
    <div data-colibri-id="5-h26" class="h-row-container gutters-row-lg-2 gutters-row-md-2 gutters-row-0 gutters-row-v-lg-2 gutters-row-v-md-2 gutters-row-v-2 style-26 style-local-5-h26 position-relative">
      <div class="h-row justify-content-lg-center justify-content-md-center justify-content-center align-items-lg-stretch align-items-md-stretch align-items-stretch gutters-col-lg-2 gutters-col-md-2 gutters-col-0 gutters-col-v-lg-2 gutters-col-v-md-2 gutters-col-v-2">
        <div class="h-column h-column-container d-flex h-col-lg-auto h-col-md-auto h-col-auto style-27-outer style-local-5-h27-outer">
          <div data-colibri-id="5-h27" class="d-flex h-flex-basis h-column__inner h-px-lg-2 h-px-md-2 h-px-2 v-inner-lg-2 v-inner-md-2 v-inner-2 style-27 style-local-5-h27 position-relative">
            <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-center align-self-md-center align-self-center">
              <?php colibriwp_theme()->get('front-title')->render(); ?>
                              <?php colibriwp_theme()->get('front-subtitle')->render(); ?>
                              <?php colibriwp_theme()->get('front-buttons')->render(); ?>
            </div>
          </div>
        </div>
        <div class="h-column h-column-container d-flex h-col-lg-auto h-col-md-auto h-col-auto style-300-outer style-local-5-h33-outer">
          <div data-colibri-id="5-h33" class="d-flex h-flex-basis h-column__inner h-px-lg-2 h-px-md-2 h-px-2 v-inner-lg-2 v-inner-md-2 v-inner-2 style-300 style-local-5-h33 position-relative">
            <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-center align-self-md-center align-self-center">
              <?php colibriwp_theme()->get('front-image')->render(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
