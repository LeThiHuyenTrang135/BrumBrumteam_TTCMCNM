<!doctype html>
<html lang="en">

<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - CodeLean eShop</title>
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description"
        content="This is an example dashboard (CodeLean) created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <link href="./dashboard/main.css" rel="stylesheet">
    <link href="./dashboard/my_style.css" rel="stylesheet">
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div style="font-size:22px; font-weight:800; color:#0d6efd; letter-spacing:1px;">
            BrumBrum
        </div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        <div class="input-holder">
                            <input type="text" class="search-input" placeholder="Type to search">
                            <button class="search-icon"><span></span></button>
                        </div>
                        <button class="close"></button>
                    </div>
                    <ul class="header-megamenu nav">
                       
                        <li class="btn-group nav-item">
                            <a class="nav-link" data-toggle="dropdown" aria-expanded="false">
                                <span class="badge badge-pill badge-danger ml-0 mr-2">4</span> Cài đặt
                                <i class="fa fa-angle-down ml-2 opacity-5"></i>
                            </a>
                           
                        </li>
                        <li class="dropdown nav-item">
                            <a aria-haspopup="true" data-toggle="dropdown" class="nav-link" aria-expanded="false">
                                <i class="nav-link-icon pe-7s-settings"></i> Cập nhật
                                <i class="fa fa-angle-down ml-2 opacity-5"></i>
                            </a>
                            
                        </li>
                    </ul>
                </div>
                <div class="app-header-right">
                    <div class="header-dots">
                        <div class="dropdown">
                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                class="p-0 mr-2 btn btn-link">
                                <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-primary"></span>
                                    <i class="icon text-primary ion-android-apps"></i>
                                </span>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-plum-plate">
                                        <div class="menu-header-image"
                                            style="background-image: url('dashboard/assets/images/dropdown-header/abstract4.jpg');">
                                        </div>                                      
                                    </div>
                                </div>
                                        
                            </div>
                        </div>
                        <div class="dropdown">
                            <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                class="p-0 mr-2 btn btn-link">
                                <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-danger"></span>
                                    <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                                    <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                                </span>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header mb-0">
                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                        <div class="menu-header-image opacity-1"
                                            style="background-image: url('dashboard/assets/images/dropdown-header/city3.jpg');">
                                        </div>
                                        <div class="menu-header-content text-dark">
                                            <h5 class="menu-header-title">Notifications</h5>
                                            <h6 class="menu-header-subtitle">You have <b>21</b> unread messages</h6>
                                        </div>
                                    </div>
                                </div>
                                <ul
                                    class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link active" data-toggle="tab"
                                            href="#tab-messages-header">
                                            <span>Messages</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" data-toggle="tab" href="#tab-events-header">
                                            <span>Events</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" class="nav-link" data-toggle="tab" href="#tab-errors-header">
                                            <span>System Errors</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="p-3">
                                                    <div class="notifications-box">
                                                        <div
                                                            class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                            <div
                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                <div><span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <p>Yet another one, at <span
                                                                                class="text-success">15:00 PM</span></p>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production
                                                                            release
                                                                            <span
                                                                                class="badge badge-danger ml-2">NEW</span>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Something not
                                                                            important

                                                                            <div
                                                                                class="avatar-wrapper mt-2 avatar-wrapper-overlap">
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                  
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/2.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/3.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/4.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/5.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/9.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/7.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                    <div class="avatar-icon">
                                                                                        <img src="dashboard/assets/images/avatars/8.jpg"
                                                                                            alt="">
                                                                                    </div>
                                                                                </div>
                                                                                <div
                                                                                    class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                                    <div class="avatar-icon"><i>+</i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">This dot has an info
                                                                            state</h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">All Hands Meeting
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                <div>
                                                                    <span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <p>Yet another one, at <span
                                                                                class="text-success">15:00 PM</span>
                                                                        </p><span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                <div><span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">Build the production
                                                                            release
                                                                            <span
                                                                                class="badge badge-danger ml-2">NEW</span>
                                                                        </h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                <div><span
                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                    <div
                                                                        class="vertical-timeline-element-content bounce-in">
                                                                        <h4 class="timeline-title">This dot has a dark
                                                                            state</h4>
                                                                        <span
                                                                            class="vertical-timeline-element-date"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-events-header" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="p-3">
                                                    <div
                                                        class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-success">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">All Hands Meeting</h4>
                                                                    <p>Lorem ipsum dolor sic amet, today at
                                                                        <a href="javascript:void(0);">12:00 PM</a>
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-warning">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <p>Another meeting today, at <b
                                                                            class="text-danger">12:00 PM</b></p>
                                                                    <p>Yet another one, at <span
                                                                            class="text-success">15:00 PM</span></p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-danger">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">Build the production
                                                                        release</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur eiusmdd
                                                                        tempor incididunt ut
                                                                        labore et dolore magna elit enim at minim veniam
                                                                        quis nostrud
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-primary">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title text-success">Something
                                                                        not important</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur elit enim
                                                                        at minim veniam quis nostrud</p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-success">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">All Hands Meeting</h4>
                                                                    <p>Lorem ipsum dolor sic amet, today at
                                                                        <a href="javascript:void(0);">12:00 PM</a>
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-warning">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <p>Another meeting today, at <b
                                                                            class="text-danger">12:00 PM</b></p>
                                                                    <p>Yet another one, at <span
                                                                            class="text-success">15:00 PM</span></p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-danger">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title">Build the production
                                                                        release</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur eiusmdd
                                                                        tempor incididunt ut
                                                                        labore et dolore magna elit enim at minim veniam
                                                                        quis nostrud
                                                                    </p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vertical-timeline-item vertical-timeline-element">
                                                            <div>
                                                                <span class="vertical-timeline-element-icon bounce-in">
                                                                    <i
                                                                        class="badge badge-dot badge-dot-xl badge-primary">
                                                                    </i>
                                                                </span>
                                                                <div
                                                                    class="vertical-timeline-element-content bounce-in">
                                                                    <h4 class="timeline-title text-success">Something
                                                                        not important</h4>
                                                                    <p>Lorem ipsum dolor sit amit,consectetur elit enim
                                                                        at minim veniam quis nostrud</p>
                                                                    <span class="vertical-timeline-element-date"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-errors-header" role="tabpanel">
                                        <div class="scroll-area-sm">
                                            <div class="scrollbar-container">
                                                <div class="no-results pt-3 pb-0">
                                                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                                        <div class="swal2-success-circular-line-left"
                                                            style="background-color: rgb(255, 255, 255);"></div>
                                                        <span class="swal2-success-line-tip"></span>
                                                        <span class="swal2-success-line-long"></span>
                                                        <div class="swal2-success-ring"></div>
                                                        <div class="swal2-success-fix"
                                                            style="background-color: rgb(255, 255, 255);"></div>
                                                        <div class="swal2-success-circular-line-right"
                                                            style="background-color: rgb(255, 255, 255);"></div>
                                                    </div>
                                                    <div class="results-subtitle">All caught up!</div>
                                                    <div class="results-title">There are no system errors!</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View Latest
                                            Changes</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                      
                        <div class="dropdown">
                            <button type="button" aria-haspopup="true" data-toggle="dropdown" aria-expanded="false"
                                class="p-0 btn btn-link dd-chart-btn">
                                <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                    <span class="icon-wrapper-bg bg-success"></span>
                                    <i class="icon text-success ion-ios-analytics"></i>
                                </span>
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true"
                                class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-premium-dark">
                                        <div class="menu-header-image"
                                            style="background-image: url('dashboard/assets/images/dropdown-header/abstract4.jpg');">
                                        </div>
                                        <div class="menu-header-content text-white">
                                            <h5 class="menu-header-title">Users Online</h5>
                                            <h6 class="menu-header-subtitle">Recent Account Activity Overview</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-chart">
                                    <div class="widget-chart-content">
                                        <div class="icon-wrapper rounded-circle">
                                            <div class="icon-wrapper-bg opacity-9 bg-focus"></div>
                                            <i class="lnr-users text-white"></i>
                                        </div>
                                        <div class="widget-numbers">
                                            <span>344k</span>
                                        </div>
                                        <div class="widget-subheading pt-2">
                                            Profile views since last login
                                        </div>
                                        <div class="widget-description text-danger">
                                            <span class="pr-1"><span>176%</span></span>
                                            <i class="fa fa-arrow-left"></i>
                                        </div>
                                    </div>
                                    <div class="widget-chart-wrapper">
                                        <div id="dashboard-sparkline-carousel-3-pop"></div>
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider mt-0 nav-item"></li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
                                            <i class="fa fa-cog fa-spin mr-2"></i>View Details
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                        
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-info">
                                                    <div class="menu-header-image opacity-2"
                                                        style="background-image: url('dashboard/assets/images/dropdown-header/city3.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-left">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                             
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Alina Mcloughlin</div>
                                                                    <div class="widget-subheading opacity-8">A short
                                                                        profile description</div>
                                                                </div>
                                                                <div class="widget-content-right mr-2">
                                                                    <button
                                                                        class="btn-pill btn-shadow btn-shine btn btn-focus">Logout</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="scroll-area-xs" style="height: 150px;">
                                                <div class="scrollbar-container ps">
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-header nav-item">Activity</li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Chat
                                                                <div class="ml-auto badge badge-pill badge-info">8</div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Recover
                                                                Password</a>
                                                        </li>
                                                        <li class="nav-item-header nav-item">My Account
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Settings
                                                                <div class="ml-auto badge badge-success">New</div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Messages
                                                                <div class="ml-auto badge badge-warning">512</div>
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a href="javascript:void(0);" class="nav-link">Logs</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mb-0 nav-item"></li>
                                            </ul>
                                            <div class="grid-menu grid-menu-2col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6">
                                                        <button
                                                            class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                                                            <i
                                                                class="pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                                                            Message Inbox
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <button
                                                            class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                            <i
                                                                class="pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                            <b>Support Tickets</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider nav-item">
                                                </li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <button class="btn-wide btn btn-primary btn-sm"> Open Messages
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="widget-content-right header-user-info ml-3">
    <a href="http://127.0.0.1:8000/account/login"
       class="btn-shadow p-1 btn btn-danger btn-sm"
       title="Đăng xuất">
        <i class="fa fa-sign-out-alt text-white"></i>
    </a>
</div>

                            </div>
                        </div>
                    </div>
                    <div class="header-btn-lg">
                        <button type="button" class="hamburger hamburger--elastic open-right-drawer">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 1.5rem 1rem;">
                    <div style="font-size: 24px; font-weight: 800; color: white; letter-spacing: 2px;">
                        <i class="fa fa-cube" style="margin-right: 8px;"></i>BrumBrum
                    </div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading" style="color: #667eea; font-weight: 700; padding: 1.5rem 1rem 1rem;">
                                <i class="fa fa-bars" style="margin-right: 8px;"></i>Quản lý
                            </li>

                            <li>
                                <a href="./admin/user" style="display: flex; align-items: center; padding: 0.75rem 1rem; transition: all 0.3s ease; border-left: 3px solid transparent;" class="nav-item-link {{ request()->is('admin/user*') ? 'active-nav' : '' }}">
                                    <i class="fa fa-users" style="margin-right: 12px; min-width: 20px; font-size: 16px;"></i>
                                    <span style="flex: 1;">Người dùng</span>
                                    @if(request()->is('admin/user*'))
                                        <i class="fa fa-check" style="margin-left: 8px; color: #667eea;"></i>
                                    @endif
                                </a>
                            </li>

                            <li>
                                <a href="./admin/order" style="display: flex; align-items: center; padding: 0.75rem 1rem; transition: all 0.3s ease; border-left: 3px solid transparent;" class="nav-item-link {{ request()->is('admin/order*') ? 'active-nav' : '' }}">
                                    <i class="fa fa-shopping-cart" style="margin-right: 12px; min-width: 20px; font-size: 16px;"></i>
                                    <span style="flex: 1;">Đơn hàng</span>
                                    @if(request()->is('admin/order*'))
                                        <i class="fa fa-check" style="margin-left: 8px; color: #667eea;"></i>
                                    @endif
                                </a>
                            </li>

                            <li>
                                <a href="./admin/product" style="display: flex; align-items: center; padding: 0.75rem 1rem; transition: all 0.3s ease; border-left: 3px solid transparent;" class="nav-item-link {{ request()->is('admin/product') || request()->is('admin/product/*') && !request()->is('admin/product-category*') ? 'active-nav' : '' }}">
                                    <i class="fa fa-cube" style="margin-right: 12px; min-width: 20px; font-size: 16px;"></i>
                                    <span style="flex: 1;">Sản phẩm</span>
                                    @if(request()->is('admin/product') || (request()->is('admin/product/*') && !request()->is('admin/product-category*')))
                                        <i class="fa fa-check" style="margin-left: 8px; color: #667eea;"></i>
                                    @endif
                                </a>
                            </li>

                            <li>
                                <a href="./admin/product-category" style="display: flex; align-items: center; padding: 0.75rem 1rem; transition: all 0.3s ease; border-left: 3px solid transparent;" class="nav-item-link {{ request()->is('admin/product-category*') ? 'active-nav' : '' }}">
                                    <i class="fa fa-list" style="margin-right: 12px; min-width: 20px; font-size: 16px;"></i>
                                    <span style="flex: 1;">Danh mục</span>
                                    @if(request()->is('admin/product-category*'))
                                        <i class="fa fa-check" style="margin-left: 8px; color: #667eea;"></i>
                                    @endif
                                </a>
                            </li>

                            <li style="margin-top: 2rem;">
                                <a href="#" style="display: flex; align-items: center; transition: all 0.3s ease; padding: 0.75rem 1rem; opacity: 0.7;">
                                    <i class="fa fa-cog" style="margin-right: 12px; min-width: 20px; font-size: 16px;"></i>
                                    <span style="flex: 1;">Cài đặt</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <style>
                    .nav-item-link {
                        color: #5a6c7d !important;
                    }

                    .nav-item-link:hover {
                        background-color: rgba(102, 126, 234, 0.1);
                        border-left-color: #667eea !important;
                        color: #667eea !important;
                    }

                    .nav-item-link.active-nav {
                        background-color: rgba(102, 126, 234, 0.15);
                        border-left-color: #667eea !important;
                        color: #667eea !important;
                        font-weight: 600;
                    }
                </style>
            </div>

            <div class="app-main__outer">

        <!-- Main -->
             @yield('body')
            <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <div class="footer-dots">
                                    <div class="dropdown">
                                        <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                            class="dot-btn-wrapper">
                                            <i class="dot-btn-icon lnr-bullhorn icon-gradient bg-mean-fruit"></i>
                                            <div class="badge badge-dot badge-abs badge-dot-sm badge-danger">
                                                Notifications</div>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu-xl rm-pointers dropdown-menu">
                                            <div class="dropdown-menu-header mb-0">
                                                <div class="dropdown-menu-header-inner bg-deep-blue">
                                                    <div class="menu-header-image opacity-1"
                                                        style="background-image: url('dashboard/assets/images/dropdown-header/city3.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-dark">
                                                        <h5 class="menu-header-title">Notifications</h5>
                                                        <h6 class="menu-header-subtitle">You have <b>21</b> unread
                                                            messages</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul
                                                class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                                                <li class="nav-item">
                                                    <a role="tab" class="nav-link active" data-toggle="tab"
                                                        href="#tab-messages-header1">
                                                        <span>Messages</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a role="tab" class="nav-link" data-toggle="tab"
                                                        href="#tab-events-header1">
                                                        <span>Events</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a role="tab" class="nav-link" data-toggle="tab"
                                                        href="#tab-errors-header1">
                                                        <span>System Errors</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-messages-header1" role="tabpanel">
                                                    <div class="scroll-area-sm">
                                                        <div class="scrollbar-container">
                                                            <div class="p-3">
                                                                <div class="notifications-box">
                                                                    <div
                                                                        class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                                        <div
                                                                            class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands
                                                                                        Meeting</h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <p>Yet another one, at
                                                                                        <span class="text-success">15:00
                                                                                            PM</span>
                                                                                    </p>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the
                                                                                        production release
                                                                                        <span
                                                                                            class="badge badge-danger ml-2">NEW</span>
                                                                                    </h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Something
                                                                                        not important
                                                                                        
                                                                                    </h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">This dot
                                                                                        has an info state</h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands
                                                                                        Meeting</h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <p>Yet another one, at
                                                                                        <span class="text-success">15:00
                                                                                            PM</span>
                                                                                    </p>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the
                                                                                        production release
                                                                                        <span
                                                                                            class="badge badge-danger ml-2">NEW</span>
                                                                                    </h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                            <div>
                                                                                <span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">This dot
                                                                                        has a dark state</h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab-events-header1" role="tabpanel">
                                                    <div class="scroll-area-sm">
                                                        <div class="scrollbar-container">
                                                            <div class="p-3">
                                                                <div
                                                                    class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-success"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <h4 class="timeline-title">All Hands
                                                                                    Meeting</h4>
                                                                                <p>Lorem ipsum dolor sic amet, today at
                                                                                    <a href="javascript:void(0);">12:00
                                                                                        PM</a>
                                                                                </p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-warning"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <p>Another meeting today, at
                                                                                    <b class="text-danger">12:00 PM</b>
                                                                                </p>
                                                                                <p>Yet another one, at <span
                                                                                        class="text-success">15:00
                                                                                        PM</span></p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-danger"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <h4 class="timeline-title">Build the
                                                                                    production release</h4>
                                                                                <p>Lorem ipsum dolor sit
                                                                                    amit,consectetur eiusmdd tempor
                                                                                    incididunt ut labore et dolore magna
                                                                                    elit enim at
                                                                                    minim veniam quis nostrud
                                                                                </p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-primary"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <h4 class="timeline-title text-success">
                                                                                    Something not important</h4>
                                                                                <p>Lorem ipsum dolor sit
                                                                                    amit,consectetur elit enim at
                                                                                    minim veniam quis nostrud</p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-success"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <h4 class="timeline-title">All Hands
                                                                                    Meeting</h4>
                                                                                <p>Lorem ipsum dolor sic amet, today at
                                                                                    <a href="javascript:void(0);">12:00
                                                                                        PM</a>
                                                                                </p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-warning"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <p>Another meeting today, at
                                                                                    <b class="text-danger">12:00 PM</b>
                                                                                </p>
                                                                                <p>Yet another one, at <span
                                                                                        class="text-success">15:00
                                                                                        PM</span></p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-danger"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <h4 class="timeline-title">Build the
                                                                                    production release</h4>
                                                                                <p>Lorem ipsum dolor sit
                                                                                    amit,consectetur eiusmdd tempor
                                                                                    incididunt ut labore et dolore magna
                                                                                    elit enim at
                                                                                    minim veniam quis nostrud
                                                                                </p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="vertical-timeline-item vertical-timeline-element">
                                                                        <div>
                                                                            <span
                                                                                class="vertical-timeline-element-icon bounce-in">
                                                                                <i
                                                                                    class="badge badge-dot badge-dot-xl badge-primary"></i>
                                                                            </span>
                                                                            <div
                                                                                class="vertical-timeline-element-content bounce-in">
                                                                                <h4 class="timeline-title text-success">
                                                                                    Something not important</h4>
                                                                                <p>Lorem ipsum dolor sit
                                                                                    amit,consectetur elit enim at
                                                                                    minim veniam quis nostrud
                                                                                </p>
                                                                                <span
                                                                                    class="vertical-timeline-element-date"></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab-errors-header1" role="tabpanel">
                                                    <div class="scroll-area-sm">
                                                        <div class="scrollbar-container">
                                                            <div class="no-results pt-3 pb-0">
                                                                <div
                                                                    class="swal2-icon swal2-success swal2-animate-success-icon">
                                                                    <div class="swal2-success-circular-line-left"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                    <span class="swal2-success-line-tip"></span>
                                                                    <span class="swal2-success-line-long"></span>
                                                                    <div class="swal2-success-ring"></div>
                                                                    <div class="swal2-success-fix"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                    <div class="swal2-success-circular-line-right"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                    </div>
                                                                </div>
                                                                <div class="results-subtitle">All caught up!</div>
                                                                <div class="results-title">There are no system errors!
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider nav-item"></li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <button
                                                        class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View
                                                        Latest Changes</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dots-separator"></div>
                                    <div class="dropdown">
                                        <a class="dot-btn-wrapper" aria-haspopup="true" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="dot-btn-icon lnr-earth icon-gradient bg-happy-itmeo"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="rm-pointers dropdown-menu">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner pt-4 pb-4 bg-focus">
                                                    <div class="menu-header-image opacity-05"
                                                        style="background-image: url('dashboard/assets/images/dropdown-header/city2.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-center text-white">
                                                        <h6 class="menu-header-subtitle mt-0"> Choose Language</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <h6 tabindex="-1" class="dropdown-header"> Popular Languages</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <span class="mr-3 opacity-8 flag large US"></span> USA
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <span class="mr-3 opacity-8 flag large CH"></span> Switzerland
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <span class="mr-3 opacity-8 flag large FR"></span>France
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <span class="mr-3 opacity-8 flag large ES"></span>Spain
                                            </button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <h6 tabindex="-1" class="dropdown-header">Others</h6>
                                            <button type="button" tabindex="0" class="dropdown-item active">
                                                <span class="mr-3 opacity-8 flag large DE"></span>Germany
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <span class="mr-3 opacity-8 flag large IT"></span> Italy
                                            </button>
                                        </div>
                                    </div>
                                    <div class="dots-separator"></div>
                                    <div class="dropdown">
                                        <a class="dot-btn-wrapper dd-chart-btn-2" aria-haspopup="true"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <i class="dot-btn-icon lnr-pie-chart icon-gradient bg-love-kiss"></i>
                                            <div class="badge badge-dot badge-abs badge-dot-sm badge-warning">
                                                Notifications</div>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu-xl rm-pointers dropdown-menu">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-premium-dark">
                                                    <div class="menu-header-image"
                                                        style="background-image: url('dashboard/assets/images/dropdown-header/abstract4.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-white">
                                                        <h5 class="menu-header-title">Users Online</h5>
                                                        <h6 class="menu-header-subtitle">Recent Account Activity
                                                            Overview</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-chart">
                                                <div class="widget-chart-content">
                                                    <div class="icon-wrapper rounded-circle">
                                                        <div class="icon-wrapper-bg opacity-9 bg-focus"></div>
                                                        <i class="lnr-users text-white"></i>
                                                    </div>
                                                    <div class="widget-numbers">
                                                        <span>344k</span>
                                                    </div>
                                                    <div class="widget-subheading pt-2"> Profile views since last login
                                                    </div>
                                                    <div class="widget-description text-danger">
                                                        <span class="pr-1"> <span>176%</span></span>
                                                        <i class="fa fa-arrow-left"></i>
                                                    </div>
                                                </div>
                                                <div class="widget-chart-wrapper">
                                                    <div id="dashboard-sparkline-carousel-4-pop"></div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider mt-0 nav-item"></li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <button class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
                                                        <i class="fa fa-cog fa-spin mr-2"></i> View Details
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="app-footer-right">
                                <ul class="header-megamenu nav">
                                    <li class="nav-item">
                                        <a data-placement="top" rel="popover-focus" data-offset="300"
                                            data-toggle="popover-custom" class="nav-link">
                                            Footer Menu
                                            <i class="fa fa-angle-up ml-2 opacity-8"></i>
                                        </a>
                                        <div class="rm-max-width rm-pointers">
                                            <div class="d-none popover-custom-content">
                                                <div class="dropdown-mega-menu dropdown-mega-menu-sm">
                                                    <div class="grid-menu grid-menu-2col">
                                                        <div class="no-gutters row">
                                                            <div class="col-sm-6 col-xl-6">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item-header nav-item">Overview</li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            <i class="nav-link-icon lnr-inbox"></i>
                                                                            <span>Contacts</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            <i class="nav-link-icon lnr-book"></i>
                                                                            <span>Incidents</span>
                                                                            <div
                                                                                class="ml-auto badge badge-pill badge-danger">
                                                                                5</div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">
                                                                            <i class="nav-link-icon lnr-picture"></i>
                                                                            <span>Companies</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a disabled="" class="nav-link disabled">
                                                                            <i class="nav-link-icon lnr-file-empty"></i>
                                                                            <span>Dashboards</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-6 col-xl-6">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item-header nav-item">Sales &amp;
                                                                        Marketing</li>
                                                                    <li class="nav-item"><a class="nav-link">Queues</a>
                                                                    </li>
                                                                    <li class="nav-item"><a class="nav-link">Resource
                                                                            Groups</a></li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link">Goal Metrics
                                                                            <div class="ml-auto badge badge-warning">3
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item"><a
                                                                            class="nav-link">Campaigns</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a data-placement="top" rel="popover-focus" data-offset="300"
                                            data-toggle="popover-custom" class="nav-link">
                                            Grid Menu
                                            <div class="badge badge-dark ml-0 ml-1">
                                                <small>NEW</small>
                                            </div>
                                            <i class="fa fa-angle-up ml-2 opacity-8"></i>
                                        </a>
                                        <div class="rm-max-width rm-pointers">
                                            <div class="d-none popover-custom-content">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-tempting-azure">
                                                        <div class="menu-header-image opacity-1"
                                                            style="background-image: url('dashboard/assets/images/dropdown-header/city5.jpg');">
                                                        </div>
                                                        <div class="menu-header-content text-dark">
                                                            <h5 class="menu-header-title">Two Column Grid</h5>
                                                            <h6 class="menu-header-subtitle">Easy grid navigation inside
                                                                popovers</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="grid-menu grid-menu-2col">
                                                    <div class="no-gutters row">
                                                        <div class="col-sm-6">
                                                            <button
                                                                class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-dark">
                                                                <i
                                                                    class="lnr-lighter text-dark opacity-7 btn-icon-wrapper mb-2"></i>Automation
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <button
                                                                class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                                <i
                                                                    class="lnr-construction text-danger opacity-7 btn-icon-wrapper mb-2"></i>Reports
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <button
                                                                class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-success">
                                                                <i
                                                                    class="lnr-bus text-success opacity-7 btn-icon-wrapper mb-2"></i>Activity
                                                            </button>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <button
                                                                class="btn-icon-vertical btn-transition-text btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-focus">
                                                                <i
                                                                    class="lnr-gift text-focus opacity-7 btn-icon-wrapper mb-2"></i>Settings
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider nav-item"></li>
                                                    <li class="nav-item-btn clearfix nav-item">
                                                        <div class="float-left">
                                                            <button class="btn btn-link btn-sm">Link Button</button>
                                                        </div>
                                                        <div class="float-right">
                                                            <button class="btn-shadow btn btn-info btn-sm">Info
                                                                Button</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            </div>
        </div>

    </div>

    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    
    <script src="./dashboard/assets/scripts/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="./dashboard/assets/scripts/main.js"></script>
    <script type="text/javascript" src="./dashboard/assets/scripts/my_script.js"></script>
</body>

</html>