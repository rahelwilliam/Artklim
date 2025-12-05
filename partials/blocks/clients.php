<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<!-- logo -->
<section data-id="clientes" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-x <?php echo $bg_color; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="section-head section-md">
                    <h5 class="heading-xs"><?php echo (get_field('sobre_titulo_clientes')) ? get_field('sobre_titulo_clientes') : 'Clientes'; ?></h5>
                    <h2><?php echo (get_field('titulo_clientes')) ? get_field('titulo_clientes') : 'Parceiros que confiam no nosso trabalho'; ?></h2>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->

        <div class="row justify-content-center gutter-vr-40px">
            <?php 
            $galeria_de_clientes = get_field('galeria_de_clientes');
            if( $galeria_de_clientes ) { ?>

                <?php foreach( $galeria_de_clientes as $image_cli ): ?>
                    <div class="col-sm-3 col-5 d-flex align-items-center">
                        <div class="logo-item">
                            <img src="<?php echo ($image_cli) ? $image_cli['url'] : image('client-a.png'); ?>" alt="<?php echo ($image_cli['alt']) ? $image_cli['alt'] : get_the_title(); ?>">
                        </div>
                    </div><!-- .col -->
                <?php endforeach; ?>

            <?php } else { ?>
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-a.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-b.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-c.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-d.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-e.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-a.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('client-b.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
            <?php } ?>
        </div><!-- .row -->
    </div><!-- .container -->
</section>
<!-- .logo -->