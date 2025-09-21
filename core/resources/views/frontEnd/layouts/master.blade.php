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
    </style>
    {!! Helper::GeneralSiteSettings("js") !!}
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
