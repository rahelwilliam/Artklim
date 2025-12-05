<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>
<?php $image = get_field('imagem_empresa'); ?>
<?php $button = get_field('botao_de_direcionamento_empresa'); ?>

<!-- section -->
<div <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-x tc-grey-alt <?php echo $bg_color; ?>">
    <div class="container">
        <div class="row gutter-vr-30px align-items-center">
            <div class="col-lg-6">
                <div class="box-image">
                    <img src="<?php echo ($image) ? $image['url'] : image('post-thumb-b.jpg'); ?>" alt="<?php echo ($image) ? $image['alt'] : get_the_title(); ?>">
                </div>
            </div><!-- .col -->
            <div class="col-lg-5 offset-lg-1">
                <div class="text-block">
                    <h5 class="heading-xs"><?php echo (get_field('sobre_titulo_empresa')) ? get_field('sobre_titulo_empresa') : 'Sobre'; ?></h5>
                    <h2><?php echo (get_field('titulo_empresa')) ? get_field('titulo_empresa') : 'Uma empresa inovadora'; ?></h2>
                    <p>
                        <?php echo (get_field('texto_empresa')) ? get_field('texto_empresa') : 'Uma empresa especializada nos serviços prestados, oferecendo uma gama de soluções completa. Com mais de 10 anos de mercado, trazendo qualidade e segurança nos produtos e serviços.'; ?>
                    </p>
                    <?php echo ($button) ? '<a href="'.$button['url'].'" target="'.$button['target'].'" class="btn">'.$button['title'].'</a>' : ''; ?>
                </div><!-- .text-block  -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<!-- .section -->