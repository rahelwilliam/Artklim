<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>
<?php $botao_cta = (get_field('tipo_de_conteudo') == 'local') ? get_field('botao_de_direcionamento_cta') : get_field('botao_de_direcionamento_cta', 'option'); ?>
<?php $tipo = (get_field('tipo_de_conteudo') == 'local') ? get_field('tipo_de_fundo') : get_field('tipo_de_fundo', 'option'); ?>
<?php $imagem = (get_field('tipo_de_conteudo') == 'local') ? get_field('imagem_para_o_fundo') : get_field('imagem_para_o_fundo', 'option'); ?>
<?php $video = (get_field('tipo_de_conteudo') == 'local') ? get_field('video_para_o_fundo') : get_field('video_para_o_fundo', 'option'); ?>

<!-- section -->
<section data-id="card3" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-cta section-cta-alt tc-light section-x <?php echo ($bg_color) ? $bg_color : 'bg-dark'; ?>">
    <div class="container">
        <div class="row gutter-vr-30px align-items-center justify-content-between">
            <div class="col-lg-8 text-center text-lg-left">
                <div class="cta-text cta-text-s3">
                    <h2>
                        <strong><?php echo (get_field('tipo_de_conteudo') == 'local') ? get_field('titulo_para_o_cta') : get_field('titulo_para_o_cta', 'option'); ?></strong>
                        <?php echo (get_field('tipo_de_conteudo') == 'local') ? get_field('texto_para_o_cta') : get_field('texto_para_o_cta', 'option'); ?>
                    </h2>
                </div>
            </div>
            <div class="col-lg-3 text-lg-right text-center">
                <div class="cta-btn cta-btn-s3">                    
                    <a href="<?php echo $botao_cta['url'];  ?>" target="<?php echo $botao_cta['target'];  ?>" class="btn btn-outline"><?php echo $botao_cta['title'];  ?></a>
                </div>
            </div>
        </div>
    </div><!-- .container -->

    <!-- bg -->
    <?php if($tipo == 'video') { ?>
        <video autoplay loop muted poster="<?php echo $imagem['url']; ?>" class="bg_video">
            <source src="<?php echo $video['url']; ?>" type="video/webm">
            <source src="<?php echo $video['url']; ?>" type="video/mp4">
        </video>
    <?php } else { ?>
        <div class="bg-image bg-fixed overlay-theme-dark overlay-opacity-60">
            <img src="<?php echo $imagem['url']; ?>" alt="<?php echo $imagem['alt']; ?>">
        </div>
    <?php } ?>
    <!-- .bg -->
</section>
<!-- .section -->