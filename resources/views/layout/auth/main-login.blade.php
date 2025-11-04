<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/assets/css/index.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/kkpress.min.css?ver=2.6.14" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkcommerce-core.css?ver=1.0.8" />
    <link rel="stylesheet" href="/assets/css/mentions.min.css?ver=14.4.0" media="all" />
    <link rel="stylesheet" href="/assets/css/kmkpress.min.css?ver=14.4.0" media="screen" />
    <link rel="stylesheet" href="/assets/css/main.css?ver=1760540595" media="all" />
    <link rel="stylesheet" href="/assets/css/job-listings.css?ver=598383a28ac5f9f156e4" media="all" />
    <link rel="stylesheet" href="/assets/css/brands.css?ver=10.3.0" media="all" />


    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dashicons.min.css?ver=6.8.3" media="all" />
    <link rel="stylesheet" href="/assets/css/ionicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/unicons.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mscrollbar.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/animate.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/hiraku.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/job-manager.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/rtmedia.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/adverts-frontend.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/woocommerce-layout.min.css" media="all" />

    <link rel="stylesheet" href="/assets/css/kmk.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/mediaelementplayer-legacy.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/wp-mediaelement.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/godam-player-frontend.css?ver=1760540595" media="all" />
    <link rel="stylesheet" href="/assets/css/godam-player.css?ver=1760540595" media="all" />
    <link rel="stylesheet" href="/assets/css/rtm-upload-terms.min.css" media="all" />
    <link rel="stylesheet" href="/assets/css/dynamic-styles.css" media="all" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,300italic,400italic,600italic,700italic|Quicksand:700&ver=1.4.5" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&display=swap" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400,500,700,900&display=swap" />

    <link rel="stylesheet" href="/assets/css/frontend.min.css?ver=3.32.4" />
    <link rel="stylesheet" href="/assets/css/post-95.css?ver=1761620622" />

    <link rel="stylesheet" href="/assets/css/mainCss.css" media="all" />

</head>

<body
	class="home-page bp-nouveau home  page-template page-template-page-templates page-template-full-width page-template-page-templatesfull-width-php page page-id-95 wp-theme-kmk theme-kmk woocommerce-no-js kmk kmk-guest-user kmk-default kmk-kit-30 kmk-page kmk-page-95 desktop-slidenav full-width no-js">

	<div id="kmk-page" class="site">

	@include('layout.auth.login-header')


		<div id="content" class="site-content">

			<div id="primary" class="content-area">
				<div class="layout full">
					<div class="container">
						<div class="row">


							<div class="col-lg-12 col-main">
								<main id="main" class="main-content">

                                    @yield('breadcrumbs')

									<article id="post-95"
										class="post-95 page type-page status-publish hentry kmk-post">
										<div class="entry-content clearfix">
											<div data-kmk-type="wp-page" data-kmk-id="95" class="kmk kmk-95"
												data-kmk-post-type="page">
												<section
													class="kmk-section kmk-top-section kmk-element kmk-element-0405d30 kmk-section-height-min-height kmk-section-boxed kmk-section-height-default kmk-section-items-middle"
													data-id="0405d30" data-element_type="section"
													data-settings="{&quot;background_background&quot;:&quot;video&quot;,&quot;background_video_link&quot;:&quot;http:\/\/mythemestore.com\/friend-finder\/videos\/8.mp4&quot;}">
													<div class="kmk-background-video-container kmk-hidden-mobile"
														aria-hidden="true">
														<video src="/assets/videos/bg-video.mp4" class="kmk-background-video-hosted" autoplay muted
															playsinline loop></video>
													</div>
													<div class="kmk-background-overlay"></div>
													<div class="kmk-container kmk-column-gap-default">
														<div class="kmk-column kmk-col-16 kmk-top-column kmk-element kmk-element-e541bc9"
															data-id="e541bc9" data-element_type="column">
															<div class="kmk-widget-wrap">
															</div>
														</div>
														<div class="kmk-column kmk-col-66 kmk-top-column kmk-element kmk-element-296c3b9"
															data-id="296c3b9" data-element_type="column">
															<div class="kmk-widget-wrap kmk-element-populated">
                                                                @yield('login-section')
                                                                @include('layout.auth.auth-footer')
															</div>
														</div>
														<div class="kmk-column kmk-col-16 kmk-top-column kmk-element kmk-element-33e6f1f"
															data-id="33e6f1f" data-element_type="column">
															<div class="kmk-widget-wrap">
															</div>
														</div>
													</div>
												</section>
											</div>
										</div><!-- .entry-contents -->
									</article>

								</main><!-- #main -->
							</div><!-- .col-main -->

						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .layout -->
			</div><!-- #primary -->

		</div><!-- #content -->

	</div><!-- #kmk-page -->

    @include('layout.auth.login-modal')

</body>

<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/mscrollbar.min.js"></script>
<script src="/assets/js/wow.min.js"></script>
<script src="/assets/js/hiraku.min.js"></script>
<script src="/assets/js/hiraku.min.js"><script>
<script src="/assets/js/flexmenu.min.js"></script>
<script src="/assets/js/masonry.min.js"></script>
<script src="/assets/js/jquery.fitvids.min.js"></script>
<script>
	const lazyloadRunObserver = () => {
		const lazyloadBackgrounds = document.querySelectorAll('.e-con.e-parent:not(.e-lazyloaded)');
		const observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.add('e-lazyloaded');
					observer.unobserve(entry.target);
				}
			});
		}, { rootMargin: '200px 0px 200px 0px' });
		lazyloadBackgrounds.forEach(el => observer.observe(el));
	};
	['DOMContentLoaded', 'kmk/lazyload/observe']
		.forEach(e => document.addEventListener(e, lazyloadRunObserver));
</script>

</html>
