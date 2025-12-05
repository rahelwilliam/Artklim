<?php get_header(); ?>
        <?php $img_404 = get_field('imagem_de_fundo_404', 'option'); ?>
        <?php $title_404 = get_field('titulo_para_pagina_404', 'option'); ?>
        <?php $text_404 = get_field('texto_para_pagina_404', 'option'); ?>
	<!-- banner -->
        <div class="banner banner-s2 banner-s2-inner tc-bunker">
                <div class="banner-block">
                        <div class="container">
                                <div class="row justify-content-center">
                                        <div class="col-lg-6 col-md-8 text-center">
                                                <div class="error-content">
                                                        <span class="error-text-large">404</span>
                                                        <h5><?php echo ($title_404) ? $title_404 : 'Opps! Por que você está aqui?'; ?></h5>
                                                        <p><?php echo ($text_404) ? $text_404 : 'Sentimos muito pelo inconveniente. Parece que você está tentando acessar uma página que foi excluída ou nunca existiu.'; ?></p>
                                                        <a href="<?php echo home_url(); ?>" class="btn">Voltar para o início</a>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="bg-image overlay-theme-dark overlay-opacity-80">
                                <img src="<?php echo ($img_404) ? $img_404['url'] : image('banner-sm-c.jpg'); ?>" alt="error 404" />
                        </div>
                </div>
        </div>
        <!-- .banner --> 
<?php get_footer(); ?>
