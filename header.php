<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php  
            wp_title("|","true",'right');
            bloginfo('name'); 
        ?>
     </title>
    <link rel="pingback" link="<?php bloginfo('pingback_url') ?>" />
    <?php wp_head(); ?> <!-- this must be put to add WP headers  -->
</head>
<body>
    <?php /* bootstrap_menu(); */ ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="<?php bloginfo('url'); ?> "><?php bloginfo('name'); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="<?php esc_html_e( 'Toggle Navigation', 'theme-textdomain' ); ?>">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse float-right" id="navbar-content">
        <?php
            bootstrap_menu();
        ?>
    </div>
</nav>
