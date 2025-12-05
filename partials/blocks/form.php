<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>
<?php $name_1 = get_field('nome_endereco_1'); ?>
<?php $address_1 = get_field('endereco_1'); ?>
<?php $name_2 = get_field('nome_endereco_2'); ?>
<?php $address_2 = get_field('endereco_2'); ?>

<!-- section -->
<section data-id="form" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-x contact-bg-map <?php echo $bg_color; ?>">
    <div class="container container-lg-custom">
        <div class="row gutter-vr-40px justify-content-between align-items-center">
            <div class="col-lg-7 col-md-6 order-last pl-xl-5">
                <div class="row gutter-vr-30px">
                    <?php if($name_1 || $address_1) { ?>
                        <div class="col-sm-6 col-md-12 col-lg-6">
                            <div class="contact-text contact-text-s3 bg-light box-pad box-pad-md">
                                <div class="text-box">
                                    <h4><?php echo $name_1; ?></h4>
                                    <p><?php echo $address_1; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if($name_2 || $address_2) { ?>
                        <div class="col-sm-6 col-md-12 col-lg-6 order-lg-last order-first">
                            <div class="contact-text contact-text-s3 bg-light box-pad mt-top box-pad-md">
                                <div class="text-box">
                                    <h4><?php echo $name_2; ?></h4>
                                    <p><?php echo $address_2; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg-5 col-md-6">
                <div class="section-head section-md">
                    <h5 class="heading-xs"><?php echo (get_field('titulo_formulario')) ? get_field('titulo_formulario') : 'Estamos aqui para ajudar'; ?></h5>
                    <h2><?php echo (get_field('texto_formulario')) ? get_field('texto_formulario') : 'Fale conosco, temos a solução ideal para você!'; ?></h2>
                </div>
                <?php echo do_shortcode(get_field('shortcode_do_formulario')); ?>
            </div><!-- .col -->
        </div>
    </div><!-- .container -->
    <div class="bg-image">
        <img src="<?php echo image('contact-bg.png'); ?>" alt="banner contato">
    </div>
</section>
<!-- .section -->