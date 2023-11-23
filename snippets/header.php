<?php

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

?><!doctype html>
<html class="no-js" lang="de">

<head>
    <meta charset="utf-8">

    <?php
        $title = "Sonic Acts Biennial 2024 🟠 The Spell of the Sensuous";
        $description = "2 Feb – 24 Mar 2024 🐸 Celebrating 30 years of cutting-edge experiments in sound, moving image and contemporary theory";
    ?>

    <title>Sonic Acts 2024</title>

    <meta name="description" content="<?= $description ?>">

    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' >

    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://2024.sonicacts.com">
    <meta property="og:image" content="/assets/img/sonic-acts.jpg">

    <meta name="theme-color" content="transparent">

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <?php
        include 'snippets/scss.php'
    ?>

    <link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-N67ZLWP');</script>
    <!-- End Google Tag Manager -->

</head>

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N67ZLWP"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <header>
    </header>

    <main class="main-<?= $bodyClass ?>">