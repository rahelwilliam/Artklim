<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<?php if( have_rows('slide_de_imagens') ): ?>
    <!-- banner / slider -->
    <section data-id="slider" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="banner banner-s4 has-slider <?php echo $bg_color; ?>">
        <div class="has-carousel" data-effect="true" data-items="1" data-loop="true" data-dots="false" data-auto="true"
            data-navs="true">

            <?php while( have_rows('slide_de_imagens') ) : the_row(); ?>
                <?php $image = get_sub_field('imagem_para_o_slide'); ?>
                <div class="banner-block tc-light d-flex">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-xl-8">
                                <div class="banner-content">
                                    <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                        data-duration="0.5"><?php echo get_sub_field('titulo_para_o_slide'); ?></h1>
                                    <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.12"
                                        data-duration="0.5"><?php echo get_sub_field('texto_para_o_slide'); ?></p>
                                    <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.20"
                                        data-duration="0.9">
                                        <?php $botao_sl = get_sub_field('botao_do_slide'); ?>
                                        <?php if($botao_sl) { ?>
                                            <a href="<?php echo $botao_sl['url']; ?>" target="<?php echo $botao_sl['target']; ?>" class="menu-link btn"><?php echo $botao_sl['title']; ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bg -->
                    <div class="bg-image change-bg overlay-theme-dark overlay-opacity-60">
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
                    </div>
                    <!-- end bg -->
                </div>
            <?php endwhile; ?>

        </div>
        <div class="tes-arrow">
            <a class="slick-prev slick-arrow" style=""><i class="icon ti ti-angle-left"></i></a>
            <a class="slick-next slick-arrow" style=""><i class="icon ti ti-angle-right"></i></a>
        </div>
    </section>
    <!-- .slider / banner -->

<?php else : ?>
    <!-- banner / slider -->
    <section data-id="slider" class="banner banner-s4 has-slider">
        <div class="has-carousel" data-effect="true" data-items="1" data-loop="true" data-dots="false" data-auto="true"
            data-navs="true">
            <div class="banner-block tc-light d-flex">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-xl-8">
                            <div class="banner-content">
                                <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                    data-duration="0.5">Conectando pessoas para um futuro melhor!</h1>
                                <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.12"
                                    data-duration="0.5">Nunca foi tão fácil ter acesso a internet de qualidade como
                                    agora!</p>
                                <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.20"
                                    data-duration="0.9">
                                    <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="menu-link btn"><?php echo $botaoTitle; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bg -->
                <div class="bg-image change-bg">
                    <img src="<?php echo image('internet-black.jpg'); ?>" alt="banner">
                </div>
                <!-- end bg -->
            </div>
            <div class="banner-block tc-light d-flex">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-1 col-xl-8 offset-xl-0">
                            <div class="banner-content">
                                <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                    data-duration="0.5">1° lugar em velocidade em <?php echo $cidade; ?></h1>
                                <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.7"
                                    data-duration="0.5">Nossa solução de telecomunicações é a mais avançada e segura,
                                    permitindo a você se conectar com o mundo</p>
                                <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.10"
                                    data-duration="0.9">
                                    <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="menu-link btn"><?php echo $botaoTitle; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bg -->
                <div class="bg-image change-bg">
                    <img src="<?php echo image('internet-3.jpg'); ?>" alt="banner">
                </div>
                <!-- end bg -->
            </div>
            <div class="banner-block tc-light d-flex">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 offset-1 col-xl-8 offset-xl-0">
                            <div class="banner-content">
                                <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                    data-duration="0.5">A internet mais rápida, da sua região!</h1>
                                <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.7"
                                    data-duration="0.5">Oferecemos as melhores soluções de conectividade para que você
                                    possa usufruir dos benefícios da tecnologia</p>
                                <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.10"
                                    data-duration="0.9">
                                    <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="menu-link btn"><?php echo $botaoTitle; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- bg -->
                <div class="bg-image change-bg">
                    <img src="<?php echo image('app-slider.jpg'); ?>" alt="banner">
                </div>
                <!-- end bg -->
            </div>
        </div>
        <div class="tes-arrow">
            <a class="slick-prev slick-arrow" style=""><i class="icon ti ti-angle-left"></i></a>
            <a class="slick-next slick-arrow" style=""><i class="icon ti ti-angle-right"></i></a>
        </div>
    </section>
    <!-- .slider / banner -->
<?php endif; ?>