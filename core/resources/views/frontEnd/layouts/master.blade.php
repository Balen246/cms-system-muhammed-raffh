<!DOCTYPE html>
<html lang="{{ @Helper::currentLanguage()->code }}" dir="{{ @Helper::currentLanguage()->direction }}">

<head>
    <!-- ======= Meta & CSS ======= -->
    @stack('before-styles')
    @include('frontEnd.layouts.head')
    @include('frontEnd.layouts.colors')
    @yield('headInclude')
    @stack('after-styles')
    @if(Helper::GeneralSiteSettings("css")!="")
        <style type="text/css">
            {!! Helper::GeneralSiteSettings("css") !!}
        </style>
    @endif
    
    <!-- Smooth Hover Effects for Links and Titles -->
    <style type="text/css">
        /* Smooth hover effects for read more links */
        .read-more-link, 
        a[href*="moreDetails"],
        .slider-link,
        .btn-theme {
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }
        
        .read-more-link:hover, 
        a[href*="moreDetails"]:hover {
            transform: translateY(-1px);
        }
        
        .slider-link:hover,
        .btn-theme:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
        
        /* Smooth hover effects for titles */
        .card-title a,
        h3 a,
        h4 a,
        .slider-title {
            transition: all 0.3s ease-in-out;
            text-decoration: none;
        }
        
        .card-title a:hover,
        h3 a:hover,
        h4 a:hover {
            color: #007bff !important;
            transform: translateY(-1px);
        }
        
        /* Smooth hover effects for topic cards */
        .card {
            transition: all 0.3s ease-in-out;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        /* Smooth hover effects for buttons */
        .btn {
            transition: all 0.3s ease-in-out;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }
        
        /* Smooth hover effects for breadcrumb titles and section headings */
        .breadcrumbs h2,
        .breadcrumbs ol li,
        .breadcrumbs ol li a {
            transition: all 0.3s ease-in-out;
        }
        
        .breadcrumbs ol li a:hover {
            transform: translateY(-1px);
        }
        
        .breadcrumbs h2:hover {
            transform: translateY(-1px);
        }
        
        /* Smooth hover effects for section titles and headings */
        h1, h2, h3, h4, h5, h6,
        .section-title,
        .page-title,
        .content-title {
            transition: all 0.3s ease-in-out;
        }
        
        h1:hover, h2:hover, h3:hover, h4:hover, h5:hover, h6:hover,
        .section-title:hover,
        .page-title:hover,
        .content-title:hover {
            transform: translateY(-1px);
        }
        
        /* Make all cards the same height */
        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-text {
            flex: 1;
        }
        
        /* Ensure card images are consistent */
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
        
        /* Scroll-based animations - elements animate when they come into view */
        .scroll-animate {
            opacity: 0;
            transform: translateY(20px);
            transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .scroll-animate.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Different animation types for variety */
        .scroll-animate-left {
            opacity: 0;
            transform: translateX(-30px);
            transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .scroll-animate-left.animate-in {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-animate-right {
            opacity: 0;
            transform: translateX(30px);
            transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .scroll-animate-right.animate-in {
            opacity: 1;
            transform: translateX(0);
        }
        
        .scroll-animate-scale {
            opacity: 0;
            transform: scale(0.9);
            transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .scroll-animate-scale.animate-in {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Staggered animation for cards within sections */
        .card {
            opacity: 0;
            transform: translateY(15px);
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .card.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Banner animation - appears immediately */
        .banner-section {
            opacity: 0;
            transform: scale(0.95);
            animation: bannerZoomIn 1s ease-out forwards;
        }
        
        @keyframes bannerZoomIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Navigation animation - appears immediately */
        .navbar {
            opacity: 0;
            transform: translateY(-20px);
            animation: navSlideDown 0.8s ease-out forwards;
        }
        
        @keyframes navSlideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <style type="text/css">
        /* RTL normalization: keep sizes equal to LTR */
        [dir="rtl"] body {
            font-size: 16px;
            line-height: 1.6;
        }
        /* Fix logo size in RTL */
        [dir="rtl"] .navbar-brand img,
        [dir="rtl"] .site-logo img {
            height: 42px !important;
            max-height: 42px !important;
            width: auto !important;
        }
        /* Headings consistency */
        [dir="rtl"] h1 { font-size: 2rem; }
        [dir="rtl"] h2 { font-size: 1.75rem; }
        [dir="rtl"] h3 { font-size: 1.5rem; }
    </style>
    {!! Helper::GeneralSiteSettings("js") !!}
    
    <!-- Scroll-based Animation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let ticking = false;
            
            // Function to check if element is in viewport with offset for smoother triggering
            function isInViewport(element, offset = 100) {
                const rect = element.getBoundingClientRect();
                const windowHeight = window.innerHeight || document.documentElement.clientHeight;
                return rect.top < windowHeight - offset && rect.bottom > offset;
            }
            
            // Function to animate elements with throttling for better performance
            function animateOnScroll() {
                if (!ticking) {
                    requestAnimationFrame(function() {
                        const elements = document.querySelectorAll('.scroll-animate, .scroll-animate-left, .scroll-animate-right, .scroll-animate-scale');
                        
                        elements.forEach(function(element, index) {
                            if (isInViewport(element, 150) && !element.classList.contains('animate-in')) {
                                // Add staggered delay for smoother appearance
                                setTimeout(function() {
                                    element.classList.add('animate-in');
                                }, index * 50); // 50ms delay between each element
                            }
                        });
                        
                        // Animate cards within sections with smoother staggering
                        const cards = document.querySelectorAll('.card:not(.animate-in)');
                        cards.forEach(function(card, index) {
                            if (isInViewport(card, 100)) {
                                setTimeout(function() {
                                    card.classList.add('animate-in');
                                }, index * 100); // 100ms delay between cards
                            }
                        });
                        
                        ticking = false;
                    });
                    ticking = true;
                }
            }
            
            // Throttled scroll event listener for better performance
            window.addEventListener('scroll', animateOnScroll, { passive: true });
            
            // Run animation on page load for elements already in view
            setTimeout(animateOnScroll, 100);
            
            // Run animation on resize with debouncing
            let resizeTimeout;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(animateOnScroll, 250);
            });
        });
    </script>
</head>

<body class="dir-{{ @Helper::currentLanguage()->direction }} lang-{{ @Helper::currentLanguage()->code }} {{ (!Helper::GeneralSiteSettings("style_change") && Helper::GeneralSiteSettings("style_type"))?"dark":"" }}">
<!-- ======= Top Bar ======= -->
@include('frontEnd.layouts.topbar')

<!-- ======= Header ======= -->
@include('frontEnd.layouts.header')

<!-- ======= Main contents ======= -->
<main id="main" class="{{ (Helper::GeneralSiteSettings("style_header"))?"fixed-top-margin":"" }}">
    @yield('content')
</main>
<!-- ======= Footer ======= -->
@include('frontEnd.layouts.footer')
@if(Helper::GeneralSiteSettings("style_preload"))
    <div id="preloader"></div>
@endif
<!-- ======= JS Including ======= -->
@stack('before-scripts')
@include('frontEnd.layouts.foot')
@yield('footInclude')
@stack('after-scripts')
{!! Helper::GeneralSiteSettings("body") !!}
</body>
</html>
