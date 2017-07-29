@extends('layouts.app')
@section('content')
<!-- PAGE HEADER -->
<section class="gl-page-header-wrapper">
  <div class="container">
    <div class="row">
      <h1>Blue Sea</h1>
      <p><i class="ion-ios-location-outline"></i>Highway Road 3, Lane 56, California, USA</p>
      <span class="gl-item-rating"><i class="ion-ios-star"></i>4.5</span>

      <div class="gl-page-head-btn-wrapper">
            <a data-remodal-target="modal-share" class="gl-btn gl-icon-btn gl-share-btn">Share</a>
            <a href="#" class="gl-btn gl-icon-btn"><i class="fa fa-heart-o"></i>Favourite</a>
      </div>
    </div>
  </div>
</section>
<!-- PAGE HEADER -->

<!-- TAB NAV & META -->
<section class="gl-tab-profile-meta-section">
  <div class="container">
    <div class="row">
      <div class="gl-tab-nav-wrapper col-md-8 col-sm-8 col-xs-12">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">Overview</a></li>
          <li role="presentation"><a href="#similar-listing" aria-controls="similar-listing" role="tab" data-toggle="tab">Similar Listing</a></li>
        </ul>
      </div>

      <div class="gl-profile-meta-wrapper col-md-4 col-sm-4 col-xs-12">
        <ul>
          <li><i class="fa fa-link"></i>domain.com</li>
          <li><i class="fa fa-phone"></i>096 535 11</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<!-- TAB NAV & META END -->

<!-- PAGE CONTETNT -->
<section class="gl-page-content-section">
  <div class="container">
    <div class="row">
      <!-- PAGE CONTENT DETAILS -->
      <div class="gl-page-content tab-content col-md-8 col-sm-8 col-xs-12">

        <!-- GALLERY TAB -->
        <div role="tabpanel" class="tab-pane fade in active" id="overview">
          <!-- GALLERY -->
          <div class="gl-profile-gallery">
            <ul class="gl-gallery">
              <li>
                <a href="/images/gallery-img-big-1.jpg" class="gl-lightbox-img">
                  <img src="/images/gallery-img-1.jpg" alt="Profile Gallery Image" class="gl-lazy">
                </a>
              </li>
              <li>
                <a href="/images/gallery-img-big-2.jpg" class="gl-lightbox-img">
                  <img src="/images/gallery-img-2.jpg" alt="Profile Gallery Image" class="gl-lazy">
                </a>
              </li>
              <li>
                <a href="/images/gallery-img-big-3.jpg" class="gl-lightbox-img">
                  <picture>
                    <source media="(min-width: 768px)" srcset=images/business-img-8-ws.jpg>
                    <img alt="Category Image" srcset=images/business-img-8-xs.jpg>
                </picture>
                </a>
              </li>
              <li>
                <a href="/images/gallery-img-big-4.jpg" class="gl-lightbox-img">
                  <picture>
                    <source media="(min-width: 768px)" srcset=images/gallery-img-4-ws.jpg>
                    <img alt="Category Image" srcset=images/gallery-img-4-xs.jpg>
                </picture>
                </a>
              </li>
              <li>
                <a href="/images/gallery-img-big-5.jpg" class="gl-lightbox-img">
                  <picture>
                    <source media="(min-width: 768px)" srcset=images/gallery-img-5-ws.jpg>
                    <img alt="Category Image" srcset=images/gallery-img-5-xs.jpg>
                </picture>
                </a>
              </li>
              <li>
                <a href="/images/page-header-bg.jpg" class="gl-lightbox-img"></a>
              </li>
              <li>
                <a href="/images/gallery-img-big-7.jpg" class="gl-lightbox-img"></a>
              </li>
              <li>
                <a href="/images/gallery-img-big-8.jpg" class="gl-lightbox-img"></a>
              </li>
            </ul>
          </div>
          <!-- END -->

          <!-- ABOUT COMPANY -->
          <div class="gl-about-company appear fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
            <h3 class="gl-content-title">About Company</h3>

            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bounds to ensure On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the <br>
            <br>
            of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bounds to ensure blame belongs to those who fail in their duty through weakness of will, which is the same</p>
          </div>
          <!-- END -->

          <!-- REVIEWS / COMMENT DETAILS -->
          <div class="gl-review-details appear fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
            <h3 class="gl-content-title">5 Reviews</h3>
            <!-- Reviews -->
            <div class="gl-reviews">
              <!-- USER IMG -->
              <div class="gl-user-img">
                <img src="/images/author-img.jpg" alt="User" class="gl-lazy">
              </div>
              <!-- END -->

              <!-- TEXT -->
              <div class="gl-review-text">
                <h3>David Neo</h3>
                <p>On the other hand, we denounce with righteous indignation and dislike men who beguiled and demoralized by the of pleasure</p>
                <span class="gl-item-rating"><i class="ion-ios-star"></i>4.5</span>
              </div>
              <!-- END -->
            </div>
            <!-- END -->
          </div>
          <!-- END -->

          <!-- SUBMIT REVIEW -->
          <div class="gl-review-submission appear fadeIn" data-wow-duration="1s" data-wow-delay=".3s">
            <h3 class="gl-content-title">Submit a Review</h3>

            <form action="#" class="gl-review-submission-form">
              <fieldset class="gl-form-fields">
                <div class="gl-input-area">
                  <input type="text" name="gl-reviewer-name" id="gl-reviewer-name" placeholder="Name">
                  <input type="email" name="gl-reviewer-email" id="gl-reviewer-email" placeholder="Email">
                  <textarea name="gl-reviewer-message" id="gl-reviewer-message" cols="30" rows="10" placeholder="Your Comment"></textarea>
                </div>

                <div class="gl-rating-wrapper">
                  <h4>Give your Rating</h4>

                  <!-- QUALITY -->
                  <div class="gl-rating-inputs">
                      <span class="gl-rating-title">Quality</span>
                      <div class="gl-rating-wrap">
                          <span id="gl-quality-rating"></span>
                      </div>
                  </div>
                  <!-- END -->

                  <!-- SERVICE -->
                  <div class="gl-rating-inputs">
                      <span class="gl-rating-title">Service</span>
                      <div class="gl-rating-wrap">
                          <span id="gl-service-rating"></span>
                      </div>
                  </div>
                  <!-- END -->

                  <!-- RESPONSE -->
                  <div class="gl-rating-inputs">
                      <span class="gl-rating-title">Response</span>
                      <div class="gl-rating-wrap">
                          <span id="gl-response-rating"></span>
                      </div>
                  </div>
                  <!-- END -->

                  
                  <!-- <span class="gl-rating-number">4.5</span> -->
                </div>
              </fieldset>

              <fieldset class="gl-submit-wrapper">
                <input type="submit" value="Submit" class="gl-btn">
              </fieldset>
            </form>
          </div>
          <!-- END -->
        </div>
        <!-- GALLERY TAB END -->

        <!-- PROTFOLIO TAB -->
        <div role="tabpanel" class="tab-pane fade" id="similar-listing">
             <!-- WRAPPER -->
              <div class="gl-similar-listing-wrapper">

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/featured-listing-1.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>

                    <h3>
                      <a href="#">Office Rent</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/featured-listing-2.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>

                    <h3>
                      <a href="#">Lake Heaven</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/featured-listing-3.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                    <h3>
                      <a href="#">Cafe Hapus</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/business-img-1.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                    <h3>
                      <a href="#">Lake Heaven</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/business-img-4.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                    <h3>
                      <a href="#">Office Rent</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/business-img-10.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                    <h3>
                      <a href="#">Cafe Hapus</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/business-img-3.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                    <h3>
                      <a href="#">Lake Heaven</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

                <!-- FEATURED ITEMS -->
                <div class="gl-featured-items col-md-6 col-sm-6 col-xs-12">
                  <div class="gl-feat-items-img-wrapper">
                    <img src="/images/business-img-7.jpg" alt="Featured Listing" class="gl-lazy">
                  </div>

                  <div class="gl-feat-item-details">
                    <span class="gl-item-rating">
                      <i class="ion-android-star-outline"></i>
                      4.5
                    </span>
                    <h3>
                      <a href="#">Office Rent</a>
                    </h3>
                    <div class="gl-item-location">
                      <i class="ion-ios-location-outline"></i>
                      <span>Road 3, West Portland, USA</span>
                    </div>
                  </div>
                </div>
                <!-- END -->

              </div>
              <!-- END -->
        </div>
        <!-- PROTFOLIO TAB END -->
      </div>
      <!-- PAGE CONTENT DETAILS END -->

      <!-- SIDEBAR -->
      <div class="gl-sidebar gl-page-sidebar col-md-4 col-sm-4 col-xs-12">
        <!-- SIDEBAR WIDGET -->
        <div class="gl-sidebar-widget gl-author-widget">
          <div class="gl-author-img-wrapper">
             <img src="/images/user-img.png" alt="Author" class="gl-lazy">
          </div>

          <div class="gl-author-details">
            <h3>Dave Hussy</h3>
            <p>On the other hand, we denounce with righteo On the other hand, we denounce</p>

            <ul class="gl-author-social-links">
              <li>
                <a href="#">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-tumblr"></i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <!-- END -->

        <!-- SIDEBAR WIDGET -->
        <div class="gl-sidebar-widget gl-sidebar-map-widget">
          <div id="gl-map-small" class="gl-map-small"></div>
        </div>
        <!-- END -->

        <!-- SIDEBAR WIDGET -->
        <div class="gl-sidebar-widget gl-sidebar-contact-form">
          <h3 class="gl-sidebar-title">Quick Contact</h3>

          <form action="#">
            <input type="text" name="gl-name" id="gl-name" placeholder="Name">
            <input type="email" name="gl-email" id="gl-email" placeholder="Email">
            <textarea name="gl-message" id="gl-message" cols="30" rows="4" placeholder="Message"></textarea>
            <input type="submit" value="Send" class="gl-btn">
          </form>
        </div>
        <!-- END -->


      </div>
      <!-- SIDEBAR END -->
    </div>
  </div>
</section>
<!-- PAGE CONTETNT END -->

@endsection