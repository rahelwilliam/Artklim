<!DOCTYPE html>
<html <?php language_attributes(); ?> style="--color-primary: <?php echo get_field('cor_primaria', 'option'); ?>; --color-secondary: <?php echo get_field('cor_secundaria', 'option'); ?>; --color-white: <?php echo get_field('cor_branca', 'option'); ?>; --color-text: <?php echo get_field('cor_texto', 'option'); ?>; --color-clean: <?php echo get_field('cor_clara', 'option'); ?>; --color-dark: <?php echo get_field('cor_dark', 'option'); ?>; --color-green: <?php echo get_field('cor_verde', 'option'); ?>;">
<head>
    <meta charset="<?php echo bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if IE]><![endif]-->

    <?php $favicon = get_field('favicon', 'option'); ?>
    <link rel="icon" type="image/png" href="<?php echo $favicon['url']; ?>">

    <meta name="description" content="<?php echo get_bloginfo('description'); ?>">
    <meta name="author" content="">
    <meta property="og:title" content="<?php echo get_bloginfo('name'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?php echo get_bloginfo('description'); ?>">
    <meta property="og:url" content="<?php echo get_bloginfo('url'); ?>">
    <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
    <meta property="og:image" content="<?php echo image('share.jpg'); ?>">

    <?php wp_head(); ?>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5DGRL8CJ');</script>
    <!-- End Google Tag Manager -->
</head>

<body <?php (is_page('modelo-2')) ? body_class('body-wider body-boxed body-grad') : body_class('body-wider'); ?>>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DGRL8CJ"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    <div id="app">

    <?php partial('header-main'); ?>