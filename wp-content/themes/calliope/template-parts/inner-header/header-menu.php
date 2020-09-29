<?php $component = \ColibriWP\Theme\View::getData( 'component' ); ?>
<div data-colibri-component="dropdown-menu" role="navigation" h-use-smooth-scroll-all="true" data-colibri-id="10-h9" class="h-menu h-global-transition-all h-ignore-global-body-typography has-offcanvas-tablet h-menu-horizontal h-dropdown-menu style-41 style-local-10-h9 position-relative h-element <?php $component->printContainerClasses(); ?>">
  <div class="h-global-transition-all h-main-menu">
    <?php $component->printHeaderMenu(); ?>
  </div>
  <div data-colibri-id="10-h10" class="h-mobile-menu h-global-transition-disable style-42 style-local-10-h10 position-relative h-element">
    <a data-click-outside="true" data-target="#offcanvas-wrapper-10-h10" data-target-id="offcanvas-wrapper-10-h10" data-offcanvas-overlay-id="offcanvas-overlay-10-h10" href="#" data-colibri-component="offcanvas" data-direction="right" data-push="false" title="Menu" class="h-hamburger-button">
      <div class="icon-container h-hamburger-icon">
        <div class="h-icon-svg" style="width: 100%; height: 100%;">
          <!--Icon by Font Awesome (https://fontawesome.com)-->
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="bars" viewBox="0 0 1536 1896.0833">
            <path d="M1536 1344v128q0 26-19 45t-45 19H64q-26 0-45-19t-19-45v-128q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19H64q-26 0-45-19T0 960V832q0-26 19-45t45-19h1408q26 0 45 19t19 45zm0-512v128q0 26-19 45t-45 19H64q-26 0-45-19T0 448V320q0-26 19-45t45-19h1408q26 0 45 19t19 45z"></path>
          </svg>
        </div>
      </div>
    </a>
    <div id="offcanvas-wrapper-10-h10" class="h-offcanvas-panel offcanvas offcanvas-right hide force-hide style-42-offscreen style-local-10-h10-offscreen">
      <div data-colibri-id="10-h11" class="d-flex flex-column h-offscreen-panel style-43 style-local-10-h11 position-relative h-element">
        <div class="offscreen-header h-ui-empty-state-container">
          <div data-colibri-id="10-h13" class="h-row-container gutters-row-lg-0 gutters-row-md-0 gutters-row-0 gutters-row-v-lg-0 gutters-row-v-md-0 gutters-row-v-0 style-44 style-local-10-h13 position-relative">
            <div class="h-row justify-content-lg-center justify-content-md-center justify-content-center align-items-lg-stretch align-items-md-stretch align-items-stretch gutters-col-lg-0 gutters-col-md-0 gutters-col-0 gutters-col-v-lg-0 gutters-col-v-md-0 gutters-col-v-0">
              <div class="h-column h-column-container d-flex h-col-none style-45-outer style-local-10-h14-outer">
                <div data-colibri-id="10-h14" class="d-flex h-flex-basis h-column__inner h-px-lg-2 h-px-md-2 h-px-2 v-inner-lg-2 v-inner-md-2 v-inner-2 style-45 style-local-10-h14 position-relative">
                  <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
                    <?php colibriwp_theme()->get('logo')->render(); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="offscreen-content">
          <div data-colibri-component="accordion-menu" role="navigation" h-use-smooth-scroll-all="true" data-colibri-id="10-h12" class="h-menu h-global-transition-all h-ignore-global-body-typography h-mobile-menu h-menu-accordion style-50 style-local-10-h12 position-relative h-element">
            <div class="h-global-transition-all h-mobile-menu">
              <?php $component->printHeaderMenu(); ?>
            </div>
          </div>
        </div>
        <div class="offscreen-footer h-ui-empty-state-container">
          <div data-colibri-id="10-h16" class="h-row-container gutters-row-lg-0 gutters-row-md-0 gutters-row-0 gutters-row-v-lg-0 gutters-row-v-md-0 gutters-row-v-0 style-47 style-local-10-h16 position-relative">
            <div class="h-row justify-content-lg-center justify-content-md-center justify-content-center align-items-lg-stretch align-items-md-center align-items-stretch gutters-col-lg-0 gutters-col-md-0 gutters-col-0 gutters-col-v-lg-0 gutters-col-v-md-0 gutters-col-v-0">
              <div class="h-column h-column-container d-flex h-col-none align-self-md-center style-48-outer style-local-10-h17-outer">
                <div data-colibri-id="10-h17" class="d-flex h-flex-basis h-column__inner h-px-lg-2 h-px-md-2 h-px-2 v-inner-lg-2 v-inner-md-2 v-inner-2 style-48 style-local-10-h17 position-relative">
                  <div class="w-100 h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
                    <div data-colibri-id="10-h18" class="style-49 style-local-10-h18 position-relative h-element">
                      <div class="h-global-transition-all">
                        <?php colibriwp_copyright(); ?>
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
    <div id="offcanvas-overlay-10-h10" class="offscreen-overlay style-42-offscreenOverlay style-local-10-h10-offscreenOverlay"></div>
  </div>
</div>
