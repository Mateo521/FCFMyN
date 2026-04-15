<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if (! current_theme_supports('title-tag')) : ?>
        <title><?php wp_title('|', true, 'right'); ?></title>
    <?php endif; ?>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <?php wp_head(); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&display=swap');

        body {
            /*
            font-family: "Merriweather", serif;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
            font-variation-settings:
                "wdth" 100;
*/


            font-family: "Figtree", sans-serif;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;


        }
    </style>
</head>

<body <?php body_class('bg-white text-slate-800 antialiased'); ?>>
    <?php wp_body_open(); ?>