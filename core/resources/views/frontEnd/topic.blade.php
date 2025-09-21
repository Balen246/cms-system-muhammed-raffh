@extends('frontEnd.layouts.master')

@section('content')
<div>
    <?php

use App\Helpers\Helper;
use Illuminate\Support\Facades\URL;

        $title_var = "title_" . @Helper::currentLanguage()->code;
        $title_var2 = "title_" . config('smartend.default_language');
        $details_var = "details_" . @Helper::currentLanguage()->code;
        $details_var2 = "details_" . config('smartend.default_language');
        if ($Topic->$title_var != "") {
            $title = $Topic->$title_var;
        } else {
            $title = $Topic->$title_var2;
        }
        if ($Topic->$details_var != "") {
            $details = $details_var;
        } else {
            $details = $details_var2;
        }
        $section = "";
        try {
            if ($Topic->section->$title_var != "") {
                $section = $Topic->section->$title_var;
            } else {
                $section = $Topic->section->$title_var2;
            }
        } catch (Exception $e) {
            $section = "";
        }


        $webmaster_section_title = "";
        $category_title = "";
        $page_title = "";
        $category_image = "";

        if (@$WebmasterSection != "none") {
            if (@$WebmasterSection->$title_var != "") {
                $webmaster_section_title = @$WebmasterSection->$title_var;
            } else {
                $webmaster_section_title = @$WebmasterSection->$title_var2;
            }
            $page_title = $webmaster_section_title;
            if (@$WebmasterSection->photo != "") {
                $category_image = URL::to('uploads/topics/' . @$WebmasterSection->photo);
            }
        }
        if (!empty($CurrentCategory)) {
            if (@$CurrentCategory->$title_var != "") {
                $category_title = @$CurrentCategory->$title_var;
            } else {
                $category_title = @$CurrentCategory->$title_var2;
            }
            $page_title = $category_title;
            if (@$CurrentCategory->photo != "") {
                $category_image = URL::to('uploads/sections/' . @$CurrentCategory->photo);
            }
        }

        $attach_file = @$Topic->attach_file;
        if (@$Topic->attach_file != "") {
            $file_ext = strrchr($Topic->attach_file, ".");
            $file_ext = strtolower($file_ext);
            if (in_array($file_ext, [".jpg", ".jpeg", ".png", ".gif", ".webp"])) {
                $category_image = URL::to('uploads/topics/' . @$Topic->attach_file);
                $attach_file = "";
            }
        }
        ?>
    @if($category_image !="")
    @include("frontEnd.topic.cover")
    @endif
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>{!! (@$WebmasterSection->id ==1)?$title:$page_title !!}</h2>
                <ol>
                    <li><a href="{{ Helper::homeURL() }}">{{ __("backend.home") }}</a></li>
                    @if($webmaster_section_title !="")
                    <li class="active"><a href="{{ Helper::sectionURL(@$WebmasterSection->id) }}">{!!
                            (@$WebmasterSection->id ==1)?$title:$webmaster_section_title !!}</a>
                    </li>
                    @else
                    <li class="active">{{ $title }}</li>
                    @endif
                    @if($category_title !="")
                    <li class="active"><a
                            href="{{ Helper::categoryURL(@$CurrentCategory->id) }}">{{ $category_title }}</a>
                    </li>
                    @endif
                </ol>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="container topic-page">
            <div class="row">
                @if($Categories->count() >1)
                @include('frontEnd.layouts.side')
                @endif
                <div
                    class="col-lg-{{($Categories->count()>1)? "9":"12"}} col-md-{{($Categories->count()>1)? "7":"12"}} col-sm-12 col-xs-12">
                    <article class="mb-5">
                        @if($WebmasterSection->type==2 && $Topic->video_file!="")
                        {{--video--}}
                        <div class="post-video">
                            @if($WebmasterSection->title_status)
                            <div class="post-heading">
                                <h1>
                                    @if($Topic->icon !="")
                                    <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                    @endif
                                    {{ $title }}
                                </h1>
                            </div>
                            @endif
                            <div class="video-container">
                                @if($Topic->video_type ==1)
                                <?php
                                            $Youtube_id = Helper::Get_youtube_video_id($Topic->video_file);
                                            ?>
                                @if($Youtube_id !="")
                                {{-- Youtube Video --}}
                                <iframe allowfullscreen class="video-iframe"
                                    src="https://www.youtube.com/embed/{{ $Youtube_id }}?autoplay=1&mute=1"
                                    allow="autoplay">
                                </iframe>
                                @endif
                                @elseif($Topic->video_type ==2)
                                <?php
                                            $Vimeo_id = Helper::Get_vimeo_video_id($Topic->video_file);
                                            ?>
                                @if($Vimeo_id !="")
                                {{-- Vimeo Video --}}
                                <iframe allowfullscreen class="video-iframe"
                                    src="https://player.vimeo.com/video/{{ $Vimeo_id }}?title=0&amp;byline=0">
                                </iframe>
                                @endif

                                @elseif($Topic->video_type ==3)
                                @if($Topic->video_file !="")

                                <?php
                                // Get all embed video topics in the same section
                                $embedTopics = \App\Models\Topic::where([
                                    ['webmaster_id', '=', $Topic->webmaster_id],
                                    ['status', 1],
                                    ['video_type', 3], // Embed video type
                                    ['video_file', '!=', ''],
                                    ['video_file', '!=', null]
                                ])
                                ->where(function($query) {
                                    $query->where([['expire_date', '>=', date("Y-m-d")], ['expire_date', '<>', null]])
                                          ->orWhere('expire_date', null);
                                })
                                ->orderby('row_no', 'asc')
                                ->get();

                                $currentIndex = -1;
                                $nextTopic = null;
                                $prevTopic = null;
                                
                                if (count($embedTopics) > 1) {
                                    foreach ($embedTopics as $index => $embedTopic) {
                                        if ($embedTopic->id == $Topic->id) {
                                            $currentIndex = $index;
                                            break;
                                        }
                                    }
                                    
                                    if ($currentIndex !== -1) {
                                        // Get next topic (circular)
                                        $nextIndex = ($currentIndex + 1) % count($embedTopics);
                                        $nextTopic = $embedTopics[$nextIndex];
                                        
                                        // Get previous topic (circular)
                                        $prevIndex = ($currentIndex - 1 + count($embedTopics)) % count($embedTopics);
                                        $prevTopic = $embedTopics[$prevIndex];
                                    }
                                }

                                // Prepare all embed videos data for JavaScript
                                $allEmbedVideos = [];
                                foreach ($embedTopics as $index => $embedTopic) {
                                    $allEmbedVideos[] = [
                                        'id' => $embedTopic->id,
                                        'title' => $embedTopic->$title_var ?: $embedTopic->$title_var2,
                                        'video' => $embedTopic->video_file,
                                        'url' => Helper::topicURL($embedTopic->id)
                                    ];
                                }
                                
                                // Set current index for JavaScript
                                $currentIndex = $currentIndex;
                                ?>

                                {{-- Embed Video with Reel Styling --}}
                                <div class="cont">
                                    <button type="button" class="prev-btn" id="prev-embed-btn"
                                        title="Previous Video"></button>
                                    <div class="reel-style-container" id="embed-video-container">
                                        {!! $Topic->video_file !!}
                                    </div>
                                    <button type="button" class="next-btn" id="next-embed-btn"
                                        title="Next Video"></button>
                                </div>

                                <style>
                                .cont {
                                    position: relative;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    gap: 20px;
                                    max-width: 600px;
                                    margin: 0 auto;
                                }

                                .next-btn,
                                .prev-btn {
                                    width: 52px;
                                    height: 52px;
                                    border-radius: 50%;
                                    background: rgba(255, 255, 255, 0.95);
                                    border: 2px solid rgba(24, 119, 242, 0.3);
                                    cursor: pointer;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                                    transition: all 0.3s ease;
                                    font-size: 0;
                                    position: relative;
                                    backdrop-filter: blur(10px);
                                }

                                .next-btn::before,
                                .prev-btn::before {
                                    content: '';
                                    width: 0;
                                    height: 0;
                                    border-style: solid;
                                }

                                .next-btn::before {
                                    border-left: 8px solid #1877f2;
                                    border-top: 6px solid transparent;
                                    border-bottom: 6px solid transparent;
                                    margin-left: 2px;
                                }

                                .prev-btn::before {
                                    border-right: 8px solid #1877f2;
                                    border-top: 6px solid transparent;
                                    border-bottom: 6px solid transparent;
                                    margin-right: 2px;
                                }

                                .next-btn:hover,
                                .prev-btn:hover {
                                    background: rgba(255, 255, 255, 1);
                                    transform: scale(1.1);
                                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                                }

                                .next-btn:active,
                                .prev-btn:active {
                                    transform: scale(0.95);
                                }

                                .next-btn:focus,
                                .prev-btn:focus {
                                    outline: none;
                                    box-shadow: 0 0 0 3px rgba(24, 119, 242, 0.3);
                                }

                                /* Facebook-style loading animation */
                                .next-btn.loading,
                                .prev-btn.loading {
                                    pointer-events: none;
                                    opacity: 0.7;
                                }

                                .next-btn.loading::before,
                                .prev-btn.loading::before {
                                    animation: spin 1s linear infinite;
                                }

                                @keyframes spin {
                                    0% {
                                        transform: rotate(0deg);
                                    }

                                    100% {
                                        transform: rotate(360deg);
                                    }
                                }

                                /* Tablet responsiveness */
                                @media (max-width: 1024px) and (min-width: 769px) {
                                    .cont {
                                        max-width: 500px;
                                        gap: 15px;
                                    }

                                    .reel-style-container {
                                        max-width: 350px;
                                    }

                                    .next-btn,
                                    .prev-btn {
                                        width: 48px;
                                        height: 48px;
                                    }
                                }

                                /* Mobile responsiveness */
                                @media (max-width: 768px) {
                                    .cont {
                                        flex-direction: row;
                                        gap: 15px;
                                        max-width: 100%;
                                        padding: 10px;
                                        align-items: center;
                                        justify-content: center;
                                    }

                                    .reel-style-container {
                                        max-width: 280px;
                                        width: 280px;
                                        flex-shrink: 0;
                                    }

                                    .next-btn,
                                    .prev-btn {
                                        width: 48px;
                                        height: 48px;
                                    }

                                    .next-btn::before {
                                        border-left: 8px solid #1877f2;
                                        border-top: 6px solid transparent;
                                        border-bottom: 6px solid transparent;
                                    }

                                    .prev-btn::before {
                                        border-right: 8px solid #1877f2;
                                        border-top: 6px solid transparent;
                                        border-bottom: 6px solid transparent;
                                    }
                                }

                                .reel-style-container {
                                    max-width: 400px;
                                    width: 100%;
                                    border-radius: 15px;
                                    overflow: hidden;
                                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
                                    background: #000;
                                    position: relative;
                                    cursor: grab;
                                    user-select: none;
                                    -webkit-user-select: none;
                                    -moz-user-select: none;
                                    -ms-user-select: none;
                                    flex-shrink: 0;
                                }

                                /* Animation styles for smooth transitions */
                                .reel-style-container>* {
                                    transition: transform 0.5s ease-in-out, opacity 0.3s ease-in-out;
                                }

                                /* Mobile-specific fixes - same functionality, better display */
                                @media (max-width: 768px) {
                                    .cont {
                                        width: 100% !important;
                                        max-width: 100% !important;
                                        margin: 0 auto !important;
                                        padding: 10px !important;
                                        flex-direction: row !important;
                                        gap: 15px !important;
                                        align-items: center !important;
                                        justify-content: center !important;
                                    }

                                    .reel-style-container {
                                        max-width: 280px !important;
                                        width: 280px !important;
                                        margin: 0 !important;
                                        padding: 0 !important;
                                        border-radius: 15px !important;
                                        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
                                        position: relative !important;
                                        display: block !important;
                                        visibility: visible !important;
                                        opacity: 1 !important;
                                        background: #000 !important;
                                        overflow: hidden !important;
                                        flex-shrink: 0 !important;
                                    }
                                }

                                .reel-style-container:active {
                                    cursor: grabbing;
                                }

                                .reel-style-container iframe,
                                .reel-style-container video,
                                .reel-style-container embed,
                                .reel-style-container object {
                                    width: 100% !important;
                                    height: 710px !important;
                                    border-radius: 15px;
                                    display: block;
                                }

                                /* Mobile iframe fixes - same functionality, better display */
                                @media (max-width: 768px) {

                                    .reel-style-container iframe,
                                    .reel-style-container video,
                                    .reel-style-container embed,
                                    .reel-style-container object {
                                        width: 100% !important;
                                        height: 530px !important;
                                        border-radius: 15px !important;
                                        display: block !important;
                                        visibility: visible !important;
                                        opacity: 1 !important;
                                        position: relative !important;
                                        z-index: 1 !important;
                                        border: none !important;
                                    }
                                }

                                .reel-style-container::before {
                                    content: '';
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background: linear-gradient(45deg, rgba(240, 148, 51, 0.1) 0%, rgba(230, 104, 60, 0.1) 25%, rgba(220, 39, 67, 0.1) 50%, rgba(204, 35, 102, 0.1) 75%, rgba(188, 24, 136, 0.1) 100%);
                                    pointer-events: none;
                                    z-index: 1;
                                    border-radius: 15px;
                                }

                                .reel-style-container::after {
                                    content: 'REEL';
                                    position: absolute;
                                    top: 15px;
                                    left: 15px;
                                    background: rgba(0, 0, 0, 0.7);
                                    color: white;
                                    padding: 6px 12px;
                                    border-radius: 15px;
                                    font-size: 11px;
                                    font-weight: bold;
                                    z-index: 2;
                                    pointer-events: none;
                                }
                                </style>

                                <script>
                                // Simple and reliable embed video navigation
                                document.addEventListener('DOMContentLoaded', function() {
                                    const nextBtn = document.getElementById('next-embed-btn');
                                    const prevBtn = document.getElementById('prev-embed-btn');
                                    const videoContainer = document.getElementById('embed-video-container');

                                    // Get video data from server
                                    const allVideos = @json($allEmbedVideos ?? []);
                                    let currentVideoIndex = {{ $currentIndex ?? 1}};



                                    // Validate current index
                                    if (currentVideoIndex < 0 || currentVideoIndex >= allVideos.length) {
                                        currentVideoIndex = 0;
                                    }

                                    // Hide navigation if only one video
                                    if (allVideos.length <= 1) {
                                        if (nextBtn) nextBtn.style.display = 'none';
                                        if (prevBtn) prevBtn.style.display = 'none';
                                        return;
                                    }

                                    // Safe DOM update function with smooth animations
                                    function safeUpdateVideoContent(container, newContent, direction = 'none') {
                                        if (!container) return;

                                        // Create a temporary container
                                        const tempDiv = document.createElement('div');
                                        tempDiv.style.display = 'none';
                                        document.body.appendChild(tempDiv);

                                        // Set the new content in the temporary container
                                        tempDiv.innerHTML = newContent;

                                        // Get the new content
                                        const newElement = tempDiv.firstElementChild;

                                        if (newElement) {
                                            // Add animation classes based on direction
                                            if (direction === 'next') {
                                                newElement.style.transform = 'translateX(100%)';
                                                newElement.style.transition = 'transform 0.5s ease-in-out';
                                            } else if (direction === 'previous') {
                                                newElement.style.transform = 'translateX(-100%)';
                                                newElement.style.transition = 'transform 0.5s ease-in-out';
                                            }

                                            // Clear the original container safely
                                            while (container.firstChild) {
                                                container.removeChild(container.firstChild);
                                            }

                                            // Append the new content
                                            container.appendChild(newElement);

                                            // Trigger animation
                                            if (direction === 'next' || direction === 'previous') {
                                                setTimeout(() => {
                                                    newElement.style.transform = 'translateX(0)';
                                                }, 50);
                                            }
                                        }

                                        // Clean up temporary container
                                        document.body.removeChild(tempDiv);

                                        // Force garbage collection hint
                                        if (window.gc) {
                                            window.gc();
                                        }
                                    }

                                    // Navigation function with smooth animations
                                    function navigateToVideo(direction) {
                                        if (!videoContainer || allVideos.length === 0) return;

                                        // Calculate new index
                                        let newIndex;
                                        if (direction === 'next') {
                                            newIndex = (currentVideoIndex + 1) % allVideos.length;
                                        } else {
                                            newIndex = (currentVideoIndex - 1 + allVideos.length) % allVideos
                                                .length;
                                        }

                                        // Add exit animation to current video
                                        const currentVideo = videoContainer.firstElementChild;
                                        if (currentVideo) {
                                            currentVideo.style.transition =
                                                'transform 0.3s ease-in-out, opacity 0.3s ease-in-out';
                                            if (direction === 'next') {
                                                currentVideo.style.transform = 'translateX(-100%)';
                                            } else {
                                                currentVideo.style.transform = 'translateX(100%)';
                                            }
                                            currentVideo.style.opacity = '0';
                                        }

                                        // Show loading overlay without changing container size
                                        setTimeout(() => {
                                            const currentHeight = videoContainer.clientHeight || (window
                                                .matchMedia('(max-width: 768px)').matches ? 530 :
                                                710);
                                            videoContainer.style.height = currentHeight + 'px';
                                            videoContainer.style.position = 'relative';
                                            const overlay = document.createElement('div');
                                            overlay.className = 'reel-loading-overlay';
                                            overlay.setAttribute('aria-hidden', 'true');
                                            overlay.style.position = 'absolute';
                                            overlay.style.inset = '0';
                                            overlay.style.display = 'flex';
                                            overlay.style.alignItems = 'center';
                                            overlay.style.justifyContent = 'center';
                                            overlay.style.background = '#000';
                                            overlay.style.zIndex = '2';
                                            overlay.innerHTML =
                                                '<div style="width:50px;height:50px;border:4px solid rgba(255,255,255,0.3);border-top:4px solid #1877f2;border-radius:50%;animation:spin 1s linear infinite;"></div>' +
                                                '<style>@keyframes spin{0%{transform:rotate(0deg)}100%{transform:rotate(360deg)}}</style>';
                                            // Remove existing children but keep container dimensions
                                            while (videoContainer.firstChild) {
                                                videoContainer.removeChild(videoContainer.firstChild);
                                            }
                                            videoContainer.appendChild(overlay);
                                        }, 300);

                                        // Update video after delay with smooth entrance animation
                                        setTimeout(() => {
                                            const newVideo = allVideos[newIndex];
                                            if (newVideo) {
                                                safeUpdateVideoContent(videoContainer, newVideo.video,
                                                    direction);
                                                document.title = newVideo.title;
                                                currentVideoIndex = newIndex;
                                                // Clear loading overlay and restore auto height
                                                const loader = videoContainer.querySelector(
                                                    '.reel-loading-overlay');
                                                if (loader) {
                                                    try {
                                                        videoContainer.removeChild(loader);
                                                    } catch (_) {}
                                                }
                                                videoContainer.style.height = '';

                                                // Re-initialize Facebook plugins if needed
                                                if (typeof FB !== 'undefined' && FB.XFBML) {
                                                    try {
                                                        FB.XFBML.parse(videoContainer);
                                                    } catch (e) {
                                                        console.log(
                                                            'Facebook plugin re-initialization skipped'
                                                        );
                                                    }
                                                }
                                            }
                                        }, 800);
                                    }

                                    // Button click events with error handling
                                    if (nextBtn) {
                                        nextBtn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            try {
                                                navigateToVideo('next');
                                            } catch (error) {
                                                console.log('Navigation error:', error);
                                            }
                                        });
                                    }

                                    if (prevBtn) {
                                        prevBtn.addEventListener('click', function(e) {
                                            e.preventDefault();
                                            e.stopPropagation();
                                            try {
                                                navigateToVideo('previous');
                                            } catch (error) {
                                                console.log('Navigation error:', error);
                                            }
                                        });
                                    }

                                    // Keyboard navigation with error handling
                                    document.addEventListener('keydown', function(e) {
                                        try {
                                            if (e.key === 'ArrowRight' || e.key === ' ') {
                                                e.preventDefault();
                                                navigateToVideo('next');
                                            } else if (e.key === 'ArrowLeft') {
                                                e.preventDefault();
                                                navigateToVideo('previous');
                                            }
                                        } catch (error) {
                                            console.log('Keyboard navigation error:', error);
                                        }
                                    });

                                    // Touch/swipe navigation with error handling
                                    if (videoContainer) {
                                        let startX = 0;
                                        let startY = 0;

                                        videoContainer.addEventListener('touchstart', function(e) {
                                            try {
                                                startX = e.touches[0].clientX;
                                                startY = e.touches[0].clientY;
                                            } catch (error) {
                                                console.log('Touch start error:', error);
                                            }
                                        }, {
                                            passive: true
                                        });

                                        videoContainer.addEventListener('touchend', function(e) {
                                            try {
                                                const endX = e.changedTouches[0].clientX;
                                                const endY = e.changedTouches[0].clientY;
                                                const deltaX = endX - startX;
                                                const deltaY = endY - startY;

                                                // Check for horizontal swipe
                                                if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(
                                                        deltaX) > 50) {
                                                    if (deltaX > 0) {
                                                        navigateToVideo('previous');
                                                    } else {
                                                        navigateToVideo('next');
                                                    }
                                                }
                                            } catch (error) {
                                                console.log('Touch end error:', error);
                                            }
                                        }, {
                                            passive: true
                                        });

                                        // Mouse drag navigation with error handling
                                        let isDragging = false;
                                        let mouseStartX = 0;

                                        videoContainer.addEventListener('mousedown', function(e) {
                                            try {
                                                isDragging = true;
                                                mouseStartX = e.clientX;
                                                e.preventDefault();
                                            } catch (error) {
                                                console.log('Mouse down error:', error);
                                            }
                                        });

                                        videoContainer.addEventListener('mouseup', function(e) {
                                            try {
                                                if (isDragging) {
                                                    const deltaX = e.clientX - mouseStartX;
                                                    if (Math.abs(deltaX) > 50) {
                                                        if (deltaX > 0) {
                                                            navigateToVideo('previous');
                                                        } else {
                                                            navigateToVideo('next');
                                                        }
                                                    }
                                                    isDragging = false;
                                                }
                                            } catch (error) {
                                                console.log('Mouse up error:', error);
                                            }
                                        });

                                        videoContainer.addEventListener('mouseleave', function() {
                                            try {
                                                isDragging = false;
                                            } catch (error) {
                                                console.log('Mouse leave error:', error);
                                            }
                                        });
                                    }
                                });
                                </script>
                                @endif

                                @else
                                <video class="video-js" controls autoplay preload="auto" width="100%" height="500"
                                    poster="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" data-setup="{}">
                                    <source src="{{ URL::to('uploads/topics/'.$Topic->video_file) }}"
                                        type="video/mp4" />
                                    <p class="vjs-no-js">
                                        To view this video please enable JavaScript, and consider upgrading
                                        to a
                                        web browser that
                                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports
                                            HTML5 video</a>
                                    </p>
                                </video>
                                @endif

                            </div>
                        </div>
                        @elseif($WebmasterSection->type==3 && $Topic->audio_file!="")
                        {{--audio--}}
                        <div class="post-audio">
                            @if($WebmasterSection->title_status)
                            <div class="post-heading">
                                <h1>
                                    @if($Topic->icon !="")
                                    <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                    @endif
                                    {{ $title }}
                                </h1>
                            </div>
                            @endif
                            @if($Topic->photo_file !="")
                            <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" loading="lazy"
                                alt="{{ $title }}" />
                            @endif
                            <div class="audio-player">
                                <audio crossorigin preload="none">
                                    <source src="{{ URL::to('uploads/topics/'.$Topic->audio_file) }}" type="audio/mpeg">
                                </audio>
                            </div>
                        </div>
                        <br>
                        @elseif(count($Topic->photos)>0)
                        {{--photo slider--}}
                        <div>
                            @if($WebmasterSection->title_status)
                            <div class="post-heading" ">
                                            <h1>
                                                @if($Topic->icon !="")
                                                    <i class=" fa {!! $Topic->icon !!} "></i>&nbsp;
                                @endif
                                {{ $title }}
                                </h1>
                            </div>
                            @endif

                            @if($Topic->photo_file !="")
                            <div class="post-image mb-2">
                                <a href="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" class="galelry-lightbox"
                                    title="{{ $title }}">
                                    <img loading="lazy" src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                        alt="{{ $title }}" class="post-main-photo" width="100%" />
                                </a>
                            </div>
                            @endif

                            <div id="gallery" class="gallery line-frame mb-3 post-gallery">
                                <div class="row g-0 m-0">
                                    <?php
                                            $cols_lg = 3;
                                            $cols_md = 4;
                                            if ($Categories->count() > 1) {
                                                $cols_lg = 4;
                                                $cols_md = 6;
                                            }
                                            if ($Topic->photos->count() == 3) {
                                                $cols_lg = 4;
                                                $cols_md = 4;
                                            }
                                            if ($Topic->photos->count() == 2) {
                                                $cols_lg = 6;
                                                $cols_md = 6;
                                            }
                                            ?>
                                    @foreach($Topic->photos as $photo)
                                    <div class="col-lg-{{ $cols_lg }} col-md-{{ $cols_md }}">
                                        <div class="gallery-item">
                                            <a href="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                                class="galelry-lightbox" title="{{ $photo->title }}">
                                                <img src="{{ URL::to('uploads/topics/'.$photo->file) }}" loading="lazy"
                                                    alt="{{ $photo->title }}" class="img-fluid">
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        {{--one photo--}}
                        <div class="post-image">
                            @if($WebmasterSection->title_status)
                            <div class="post-heading" style="display: block">
                                <h1>
                                    @if($Topic->icon !="")
                                    <i class="fa {!! $Topic->icon !!} "></i>&nbsp;
                                    @endif
                                    {{ $title }}
                                </h1>
                            </div>
                            @endif
                            @if($Topic->photo_file !="")

                            <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" loading="lazy"
                                alt="{{ $title }}" title="{{ $title }}" class="post-main-photo" width="100%" />

                            <br>
                            @endif
                        </div>
                        @endif

                        @include("frontEnd.topic.fields",["cols"=>6,"Fields"=>@$Topic->webmasterSection->customFields->where("in_page",true)])

                        <div class="article-body">
                            {!! str_replace('"#','"'.Request::url().'#',$Topic->$details) !!}
                        </div>

                        @if($attach_file !="")
                        <?php
                                $file_ext = strrchr($Topic->attach_file, ".");
                                $file_ext = strtolower($file_ext);
                                ?>
                        <div class="bottom-article">
                            <a href="{{ URL::to('uploads/topics/'.$Topic->attach_file) }}" target="_blank">
                                <strong>
                                    {!! Helper::GetIcon(URL::to('uploads/topics/'),$Topic->attach_file) !!}
                                    &nbsp;{{ __('frontend.downloadAttach') }}</strong>
                            </a>
                        </div>
                        @endif
                    </article>
                    @include("frontEnd.topic.files")

                    @include("frontEnd.topic.maps")

                    @include("frontEnd.topic.tags")

                    @if($WebmasterSection->type == 7)
                    <a href="{!! Helper::sectionURL($Topic->webmaster_id) !!}" class="btn btn-lg btn-secondary"
                        style="width: 100%"><i class="fa-solid fa-reply"></i> {{ __('backend.clickToNewSearch') }}
                    </a>
                    @else
                    @include("frontEnd.topic.share")
                    @endif

                    @include("frontEnd.topic.comments")

                    @if(@$Topic->form_id >0)
                    <br>
                    @include('frontEnd.form',["FormSectionID"=>@$Topic->form_id])
                    @elseif($WebmasterSection->order_status)
                    @include("frontEnd.topic.order")
                    @endif

                    @include("frontEnd.topic.related")

                </div>
            </div>
        </div>
    </section>
</div>
@include('frontEnd.layouts.popup',['Popup'=>@$Popup])
@endsection
@if (@in_array(@$WebmasterSection->type, [2]))
@push('before-styles')
<link rel="stylesheet"
    href="{{ URL::asset('assets/frontend/vendor/video-js/css/video-js.min.css') }}?v={{ Helper::system_version() }}" />
@endpush
@push('after-scripts')
<script src="{{ URL::asset('assets/frontend/vendor/video-js/js/video.min.js') }}?v={{ Helper::system_version() }}">
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof GreenAudioPlayer !== 'undefined') {
        GreenAudioPlayer.init({
            selector: '.audio-player',
            stopOthersOnPlay: true,
            showTooltips: true,
        });
    }
});
</script>
@endpush
@endif
@if (@in_array(@$WebmasterSection->type, [3]))
@push('before-styles')
<link rel="stylesheet"
    href="{{ URL::asset('assets/frontend/vendor/green-audio-player/css/green-audio-player.min.css') }}?v={{ Helper::system_version() }}" />
@endpush
@push('after-scripts')
<script
    src="{{ URL::asset('assets/frontend/vendor/green-audio-player/js/green-audio-player.min.js') }}?v={{ Helper::system_version() }}">
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof GreenAudioPlayer !== 'undefined') {
        GreenAudioPlayer.init({
            selector: '.audio-player',
            stopOthersOnPlay: true,
            showTooltips: true,
        });
    }
});
</script>
@endpush
@endif