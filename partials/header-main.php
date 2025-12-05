<?php $lg = get_field('logotipo_principal', 'option'); $logo = ($lg) ? $lg['url'] : image('logotipo-simple.png');  ?>
<?php $lgi = get_field('logotipo_invertido', 'option'); $logo_i = ($lgi) ? $lgi['url'] : image('logotipo-white.png');  ?>
<?php $tm = get_field('tamanho_da_imagem_em_px', 'option'); ?>

<!-- Header -->
<header class="is-transparent is-sticky is-shrink" id="header">
    <div class="header-main">
        <div class="header-container container">
            <div class="header-wrap">
                <!-- Logo  -->
                <div class="header-logo logo">
                    <a href="<?php echo home_url(); ?>" class="logo-link">
                        <img class="logo-dark" <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?> src="<?php echo $logo; ?>"
                            srcset="<?php echo $logo; ?> 2x" alt="<?php echo $lg['alt']; ?>">
                        <img class="logo-light" <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?> src="<?php echo $logo_i; ?>"
                            srcset="<?php echo $logo_i; ?> 2x" alt="<?php echo $lgi['alt']; ?>">
                    </a>
                </div>

                <!-- Menu start -->
                    <?php partial('header-menu'); ?>
                <!-- Menu end -->

                <!-- header-search -->
                <!-- <div class="header-search">
                    <form role="search" method="POST" class="search-form" action="#">
                        <div class="search-group">
                            <input type="text" class="input-search" placeholder="Digite sua busca aqui ...">
                            <button class="search-submit" type="submit"><i class="icon ti-search"></i></button>
                        </div>
                    </form>
                </div> -->
                <!-- . header-search -->
            </div>
        </div>
    </div>        
</header>
<!-- end header -->

<?php if(get_field('numero_do_whatsapp', 'option')) { ?>
    <a href="https://wa.me/<?php echo get_field('numero_do_whatsapp', 'option'); ?>?text=Oi,%20estava%20acessando%20o%20site%20e%20gostaria%20de%20saber%20mais,%20voc%C3%AA%20pode%20me%20ajudar?" target="_blank" class="header-whatsapp">
        <i class="fab fa-whatsapp"></i>
    </a>
<?php } ?>