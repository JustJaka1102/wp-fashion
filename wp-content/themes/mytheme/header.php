<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $siteOption = get_option('site_theme_option');
    if (!empty($siteOption['site_favicon'])): ?>
        <link rel="icon" href="<?php echo $siteOption['site_favicon']['url'] ?>" type="image/x-icon">
    <?php endif; ?>
    <link rel="stylesheet" href="node_modules/@glidejs/glide/dist/css/glide.core.min.css">
    <?php
    wp_head();
    ?>
</head>

<body>
    <header>
        <div class="container" id="top-header">
            <div class="logo">
                <?php
                if (!$siteOption['site_logo']['url']) {
                    ?>
                    <h2 class="poppins-bold" style="font-size: 29px;" id="header-logo"><a href="<?php echo get_home_url(); ?>">YOUR LOGO</a></h2>
                    <?php
                } else {
                    ?>
                    <a href="<?php echo get_home_url(); ?>">
                        <img class="mb-3 auto img-logo" src="<?php echo $siteOption['site_logo']['url'] ?>" alt="logo">
                    </a>
                    <?php
                }
                ?>
            </div>

            <div id="navbar">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'navmenu',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul class="row">%3$s<ul>',
                    )
                )
                    ?>
            </div>
            <div id="subnav">
                <div class="subnav-icon"><a href="#" id="item-nav1"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
                <div class="subnav-icon"><a href="#" id="item-nav2"><i class="fa-regular fa-heart"></i></a></div>
                <div class="subnav-icon"><a href="<?php echo home_url() . '/cart' ?>" id="item-nav3"><i class="fa-solid fa-cart-shopping"></i></a></div>
            </div>
            <div id="menu-dropd-down">
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample"
                    aria-expanded="false" aria-controls="collapseWidthExample"><i class="fa-solid fa-bars"></i></button>
            </div>
        </div>
        <div st>
            <div class="collapse" id="collapseWidthExample" style="border: 2px solid;">
                <?php
                wp_nav_menu(
                    array(
                        'menu' => 'navmenu',
                        'container' => '',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul class="row cl-menu">%3$s<ul>',
                    )
                )
                    ?>
            </div>
        </div>
    </header>