<!doctype html>
<html lang="<?php bloginfo( 'language' ) ?>">
<head>    
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php
        $entry = get_query_var('ENTRY');
        load_assets(['main', $entry]);
        wp_head();
    ?>
</head>
<body <?php body_class(); ?>>
<header>
    <?php
        if (get_field('franja_informativa','options')){
    ?>
    <div class="top-frame">
        <div class="x-container">
            <div class="x-frame">
                <?php echo get_field('franja_informativa','options'); ?>
            </div>            
            <div class="x-close"></div>
        </div>
    </div>
    <?php } ?>
    <div class="bot-frame">        
        <div class="x-container">
            <div class="bot-frame__flex">
                <div class="bot-frame__logo">
                    <a href="<?php echo site_url(); ?>">
                        <img src="<?php echo get_field('logo','options'); ?>">
                        <p>Pekokis Etiquetas personalizadas y viniles, para niños , para madres</p>
                    </a>
                </div>
                <div class="bot-frame__list">
                    <ul>
                        <?php 
                            $list_menu = get_field('menu_top','options');
                            if ($list_menu) {
                                foreach ($list_menu as $li) {
                                    ?>
                            <li>
                                <a href="<?php echo $li['link']; ?>"><?php echo $li['text']; ?></a>
                            </li>
                                    <?php
                                }
                            }
                        ?>                                        
                    </ul>
                </div>
                <div class="flex_asap">
                    <div class="searchInputContent">
                        <div class="bodySearchInput">
                            <?php echo do_shortcode('[wcas-search-form]'); ?>
                        </div>
                    </div> 
                </div>
                <div class="bot-frame__cart">
                    <a href="javascript:void(0)" class="iconSearchInput">
                        <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.0258 11.4789H12.2358L11.9728 11.2139C12.9801 10.0334 13.5533 8.54382 13.5973 6.99257C13.6412 5.44131 13.1532 3.92169 12.2144 2.68605C11.2755 1.4504 9.9422 0.573059 8.4359 0.199717C6.9296 -0.173624 5.34094 -0.0205095 3.93367 0.633639C2.5264 1.28779 1.38521 2.40361 0.699601 3.79583C0.0139969 5.18804 -0.174773 6.77289 0.164628 8.28719C0.504029 9.8015 1.35117 11.1542 2.56542 12.1206C3.77966 13.087 5.28792 13.609 6.83977 13.5999C8.49255 13.5953 10.0857 12.9819 11.3148 11.8769L11.5778 12.1419V12.9419L16.8428 18.2419L18.4228 16.6509L13.0258 11.4789ZM6.70778 11.4789C5.76231 11.4858 4.83609 11.2118 4.04659 10.6916C3.25708 10.1713 2.63987 9.42834 2.27324 8.55682C1.90661 7.6853 1.80706 6.72453 1.98726 5.79636C2.16746 4.8682 2.61925 4.01446 3.28536 3.34344C3.95146 2.67242 4.80184 2.21435 5.72865 2.02732C6.65547 1.8403 7.61697 1.93276 8.49117 2.29296C9.36536 2.65317 10.1129 3.26489 10.6389 4.05055C11.1649 4.83621 11.4458 5.76039 11.4458 6.70589C11.4507 7.3311 11.3317 7.9511 11.0957 8.53011C10.8598 9.10911 10.5116 9.63567 10.0711 10.0794C9.63061 10.5231 9.10663 10.8753 8.52937 11.1155C7.95212 11.3557 7.33301 11.4792 6.70778 11.4789Z" fill="#808080"/>
                        </svg>
                    </a>        
                    <a href="<?php echo site_url();?>/mi-cuenta" class="myaccountt">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="14" cy="7" r="6.5" stroke="#262626"/>
                            <path d="M27 27C27 19.8203 21.1797 14 14 14C6.8203 14 1 19.8203 1 27" stroke="#262626" stroke-linecap="round"/>
                        </svg>
                    </a>
                    <a href="<?php echo site_url(); ?>/carrito">
                        <?php if(WC()->cart->get_cart_contents_count() > 0) { ?>
                            <span class="count">
                                <?php echo WC()->cart->get_cart_contents_count(); ?>
                            </span>
                        <?php } else { ?>
                            0
                        <?php } ?>
                        <span class="amount">
                        <?php echo WC()->cart->get_cart_total(); ?></span>
                    </a>      
                </div>
            </div>
            <div class="bot-frame__menu">
                <ul>
                    <?php 
                        $menu = get_field('menu_bot','options');
                        if ($menu) {
                            foreach ($menu as $li) {
                                ?>
                        <li>
                            <a href="<?php echo $li['link']; ?>">
                                <span style="background-image:url(<?php echo $li['imagen']; ?>);" class="backgroundIcon">
                                <span class="valueText"><?php echo $li['text']; ?></span>
                            </a>                            
                            <?php
                                $submenu = $li['submenu'];
                                if ($submenu) {
                                ?>
                                <ul class="submenu">
                                <?php
                                    foreach ($submenu as $sub) {
                                        ?>
                                    <li>
                                        <a href="<?php echo $sub['link']; ?>"><?php echo $sub['text']; ?></a>
                                    </li>
                                        <?php
                                    }
                                }
                                ?>
                                </ul>
                                <?php
                            ?>
                        </li>
                                <?php
                            }
                        }
                    ?> 
                </ul>             
            </div>
        </div>
    </div>
</header>