<!DOCTYPE html>
<html <?php language_attributes()?>>
<head>
    <meta charset="<?php bloginfo('charset')?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="app">
<nav id="nav">
            <div class="main-nav centralize">
                <div class="brand">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php endif; ?>
                
                </div>
                
                    <?php wp_nav_menu([
                        'theme_location' => 'menu-top',
                        'container_class'=> 'menu',
                        'menu_class' => ''
                    ])?>
                   
                
                
            </div>
        </nav>
        
        <div class="centralize">

        