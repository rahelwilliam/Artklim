<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<?php if( have_rows('cards_de_conteudo') ): ?>
<!-- section -->
<section data-id="cards" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-x <?php echo $bg_color; ?> <?php echo (get_field('posicao_dos_cards')) ? get_field('posicao_dos_cards') : 'section-feature-overlap'; ?>">
    <div class="container">
        <div class="row justify-content-center gutter-vr-30px">

            <?php while( have_rows('cards_de_conteudo') ) : the_row(); ?>
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="feature feature-alt feature-s3 shadow-alt">
                        <div class="feature-icon">
                            <em class="<?php echo get_sub_field('icone_do_card'); ?>"></em>
                        </div>
                        <div class="feature-content">
                            <h3><?php echo get_sub_field('titulo_do_card'); ?></h3>
                            <p><?php echo get_sub_field('texto_do_card'); ?></p>
                            <!-- <a href="florida-service-single.html" class="btn btn-arrow">Read More</a> -->
                        </div>
                    </div>
                </div><!-- .col -->
            <?php endwhile; ?>

            </div><!-- .row -->
    </div><!-- .container -->
</section>
<!-- .section -->
<?php else : ?>
    <!-- Não faz nada -->
<?php endif; ?>