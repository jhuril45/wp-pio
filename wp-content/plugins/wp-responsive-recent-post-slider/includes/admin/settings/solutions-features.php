<?php
/**
 * Plugin Solutions & Features Page
 *
 * @package WP Responsive Recent Post Slider/Carousel
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Taking some variables
$popup_add_link = add_query_arg( array( 'post_type' =>WPRPS_POST_TYPE ), admin_url( 'post-new.php' ) );
?>

<div id="wrap">
	<div class="wprps-sf-wrap">
		<div class="wprps-sf-inr">
			<!-- Start - Welcome Box -->
			<div class="wprps-sf-welcome-wrap">
				<div class="wprps-sf-welcome-inr">
					<div class="wprps-sf-welcome-left">
						<div class="wprps-sf-subtitle">Getting Started</div>
						<h2 class="wprps-sf-title">Welcome to Recent Post Slider</h2>
						<p class="wprps-sf-content">Get your website & blog a slide-wise display to show your recent blogs/posts in a slider/carousel form with excerpts and unique slider & carousel designs.</p>
						<a href="<?php echo esc_url( $popup_add_link ); ?>" class="wprps-sf-btn">Launch Recent Post Slider</a></br> <b>OR</b> </br><a href="<?php echo WPRPS_PLUGIN_LINK_UNLOCK; ?>"  target="_blank" class="wprps-sf-btn wprps-sf-btn-orange">Grab Now Pro Features</a>
						<div class="wprps-rc-wrap">
							<div class="wprps-rc-inr wprps-rc-bg-box">
								<div class="wprps-rc-icon">
									<img src="<?php echo esc_url( WPRPS_URL ); ?>assets/images/popup-icon/14-days-money-back-guarantee.png" alt="14-days-money-back-guarantee" title="14-days-money-back-guarantee" />
								</div>
								<div class="wprps-rc-cont">
									<h3>14 Days Refund Policy. 0 risk to you.</h3>
									<p>14-day No Question Asked Refund Guarantee</p>
								</div>
							</div>
							<div class="wprps-rc-inr wprps-rc-bg-box">
								<div class="wprps-rc-icon">
									<img src="<?php echo esc_url( WPRPS_URL ); ?>assets/images/popup-icon/popup-design.png" alt="popup-design" title="popup-design" />
								</div>
								<div class="wprps-rc-cont">
									<h3>Include Done-For-You Recent Post Slider Setup ($99 Value)</h3>
									<p>Our  experts team will design 1 free Recent Post Slider for you as per your need.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="wprps-sf-welcome-right">
						<div class="wprps-sf-fp-ttl">Free vs Pro</div>
						<div class="wprps-sf-fp-box-wrp">
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-slides"></i>
								<div class="wprps-sf-box-ttl">4 Designs for Slider</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-slides"></i>
								<div class="wprps-sf-box-ttl">1 Designs for Carousel</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-format-image"></i>
								<div class="wprps-sf-box-ttl">Image Lazyload</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-admin-post"></i>
								<div class="wprps-sf-box-ttl">Display Slide for Post Type</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-category"></i>
								<div class="wprps-sf-box-ttl">Display Slides for Particular Categories</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-block-default"></i>
								<div class="wprps-sf-box-ttl">Gutenbreg, Divi, and Avada Page Builder Support</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box">
								<i class="dashicons dashicons-editor-rtl"></i>
								<div class="wprps-sf-box-ttl">Slider RTL Support</div>
								<div class="wprps-sf-tag">Free</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-slides"></i>
								<div class="wprps-sf-box-ttl">4 Layouts (Slider, Carousel, Centermode, Gridbox Slider )</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-art"></i>
								<div class="wprps-sf-box-ttl">60+ Designs</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-html"></i>
								<div class="wprps-sf-box-ttl">WP Templating Features </div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-layout"></i>
								<div class="wprps-sf-box-ttl">Elementor, Beaver, SiteOrigin, and VC Page Builder Support</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-move"></i>
								<div class="wprps-sf-box-ttl">Drag & Drop Slide Order Change</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-admin-links"></i>
								<div class="wprps-sf-box-ttl">Custom Read More link for Post</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-sticky"></i>
								<div class="wprps-sf-box-ttl">Ignore Sticky Post</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
							<div class="wprps-sf-fp-box wprps-sf-pro-box">
								<i class="dashicons dashicons-shortcode"></i>
								<div class="wprps-sf-box-ttl">Shortcode Generator</div>
								<div class="wprps-sf-tag">Pro</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End - Welcome Box -->

			<!-- Start - WP Responsive Recent Post Slider/Carousel - Features -->
			<div class="wprps-features-section">
				<div class="wprps-center wprps-features-ttl">
					<h2 class="wprps-sf-ttl">Powerful Pro Features, Simplified</h2>
				</div>
				<div class="wprps-features-section-inr">
					<div class="wprps-features-box-wrap">
						<ul class="wprps-features-box-grid">
							<li>
							<div class="wprps-popup-icon"><img src="<?php echo WPRPS_URL; ?>/assets/images/popup-icon/slider.png" /></div>
							Recent Post Slider View</li>
							<li>
							<div class="wprps-popup-icon"><img src="<?php echo WPRPS_URL; ?>/assets/images/popup-icon/slider-carousel.png" /></div>
							Recent Post Carousel View</li>
							<li>
							<div class="wprps-popup-icon"><img src="<?php echo WPRPS_URL; ?>/assets/images/popup-icon/grid-box.png" /></div>
							Recent Post Gridbox View</li>
							<!-- <li>
							<div class="wprps-popup-icon"><img src="<?php //echo WPRPS_URL; ?>/assets/images/popup-icon/centermode.png" /></div>
							Center Mode View</li> -->
						</ul>
					</div>
					<a href="<?php echo WPRPS_PLUGIN_LINK_UNLOCK; ?>" target="_blank" class="wprps-sf-btn wprps-sf-btn-orange"><span class="dashicons dashicons-cart"></span> Grab Now Pro Features</a>
					<div class="wprps-rc-wrap">
						<div class="wprps-rc-inr wprps-rc-bg-box">
							<div class="wprps-rc-icon">
								<img src="<?php echo esc_url( WPRPS_URL ); ?>assets/images/popup-icon/14-days-money-back-guarantee.png" alt="14-days-money-back-guarantee" title="14-days-money-back-guarantee" />
							</div>
							<div class="wprps-rc-cont">
								<h3>14 Days Refund Policy. 0 risk to you.</h3>
								<p>14-day No Question Asked Refund Guarantee</p>
							</div>
						</div>
						<div class="wprps-rc-inr wprps-rc-bg-box">
							<div class="wprps-rc-icon">
								<img src="<?php echo esc_url( WPRPS_URL ); ?>assets/images/popup-icon/popup-design.png" alt="popup-design" title="popup-design" />
							</div>
							<div class="wprps-rc-cont">
								<h3>Include Done-For-You Recent Post Slider Setup ($99 Value)</h3>
								<p>Our  experts team will design 1 free Recent Post Slider for you as per your need.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End - Logo Showcase - Features -->

			<!-- Start - Testimonial Section -->
			<div class="wprps-sf-testimonial-wrap">
				<div class="wprps-center wprps-features-ttl">
					<h2 class="wprps-sf-ttl">Looking for a Reason to Use Recent Post Slider? Here are 80+...</h2>
				</div>
				<div class="wprps-testimonial-section-inr">
					<div class="wprps-testimonial-box-wrap">
						<div class="wprps-testimonial-box-grid">
							<h3 class="wprps-testimonial-title">Nice looking result with a very simple setup</h3>
							<div class="wprps-testimonial-desc">Thank you for the work done with this plugin. It was the solution we were looking for.</div>
							<div class="wprps-testimonial-clnt">@dfasite</div>
							<div class="wprps-testimonial-rating"><img src="<?php echo WPRPS_URL; ?>/assets/images/rating.png" /></div>
						</div>
						<div class="wprps-testimonial-box-grid">
							<h3 class="wprps-testimonial-title">Excellent plugin & support</h3>
							<div class="wprps-testimonial-desc">Excellent plugin & support The perfect solution i need</div>
							<div class="wprps-testimonial-clnt">@vitomartin_com</div>
							<div class="wprps-testimonial-rating"><img src="<?php echo WPRPS_URL; ?>/assets/images/rating.png" /></div>
						</div>
						<div class="wprps-testimonial-box-grid">
							<h3 class="wprps-testimonial-title">Nice plugin and best support</h3>
							<div class="wprps-testimonial-desc">A simple but very nice plugin that does what it promises. In addition, I had an incompatibility problem with my theme (Extra theme from ET) with which they have helped me quickly and effectively, so I highly recommend them!</div>
							<div class="wprps-testimonial-clnt">@dtemporetti</div>
							<div class="wprps-testimonial-rating"><img src="<?php echo WPRPS_URL; ?>/assets/images/rating.png" /></div>
						</div>
						<div class="wprps-testimonial-box-grid">
							<h3 class="wprps-testimonial-title">Good plugin and best support!</h3>
							<div class="wprps-testimonial-desc">I’ve had issue with incompatibility with my theme, but support responded quickly and resolved the issue even quicker! Kudos to them! Earned my recommendation.</div>
							<div class="wprps-testimonial-clnt">@skyteamdesign2020</div>
							<div class="wprps-testimonial-rating"><img src="<?php echo WPRPS_URL; ?>/assets/images/rating.png" /></div>
						</div>
						<div class="wprps-testimonial-box-grid">
							<h3 class="wprps-testimonial-title">A must have for every blog and news website</h3>
							<div class="wprps-testimonial-desc">Best and awesome plugin out there even compare to premium ones. A truly working plugin with a lot of flexibility.Support RTL languages like my native Persian out of the box. And last but not least a great support team. </div>
							<div class="wprps-testimonial-clnt">@tikroute</div>
							<div class="wprps-testimonial-rating"><img src="<?php echo WPRPS_URL; ?>/assets/images/rating.png" /></div>
						</div>
						<div class="wprps-testimonial-box-grid">
							<h3 class="wprps-testimonial-title">One of the best plug in I ever use</h3>
							<div class="wprps-testimonial-desc">This plugin is easy to set up and their customer support is extremely helpful which make this plugin one of the best in the market.</div>
							<div class="wprps-testimonial-clnt">@fahad121</div>
							<div class="wprps-testimonial-rating"><img src="<?php echo WPRPS_URL; ?>/assets/images/rating.png" /></div>
						</div>
					</div>
					<a href="https://wordpress.org/support/plugin/wp-responsive-recent-post-slider/reviews/?filter=5" target="_blank" class="wprps-sf-btn"><span class="dashicons dashicons-star-filled"></span> View All Reviews</a> OR <a href="<?php echo WPRPS_PLUGIN_LINK_UNLOCK; ?>"  target="_blank" class="wprps-sf-btn wprps-sf-btn-orange">Grab Now Pro Features</a>
					<div class="wprps-rc-wrap">
						<div class="wprps-rc-inr wprps-rc-bg-box">
							<div class="wprps-rc-icon">
								<img src="<?php echo esc_url( WPRPS_URL ); ?>assets/images/popup-icon/14-days-money-back-guarantee.png" alt="14-days-money-back-guarantee" title="14-days-money-back-guarantee" />
							</div>
							<div class="wprps-rc-cont">
								<h3>14 Days Refund Policy. 0 risk to you.</h3>
								<p>14-day No Question Asked Refund Guarantee</p>
							</div>
						</div>
						<div class="wprps-rc-inr wprps-rc-bg-box">
							<div class="wprps-rc-icon">
								<img src="<?php echo esc_url( WPRPS_URL ); ?>assets/images/popup-icon/popup-design.png" alt="popup-design" title="popup-design" />
							</div>
							<div class="wprps-rc-cont">
								<h3>Include Done-For-You Recent Post Slider Setup ($99 Value)</h3>
								<p>Our  experts team will design 1 free Recent Post Slider for you as per your need.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End - Testimonial Section -->
		</div>
	</div><!-- end .wprps-sf-wrap -->
</div><!-- end .wrap -->