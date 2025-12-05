<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<!-- section -->
<section <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-l team tc-grey <?php echo $bg_color; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-head section-md mtm-10">
                    <?php echo (get_field('sobre_titulo_equipe')) ? '<h5 class="heading-xs dash dash-both">'.get_field('sobre_titulo_equipe').'</h5>' : '';?>
                    <?php echo (get_field('titulo_equipe')) ? '<h2>'.get_field('titulo_equipe').'</h2>' : '';?>
                    <?php echo (get_field('texto_equipe')) ? '<p class="lead">'.get_field('texto_equipe').'</p>' : '';?>
                </div>
            </div>
        </div><!-- .row -->

        <?php if( have_rows('equipe') ): ?>
            <div class="row justify-content-center gutter-vr-30px">

                <?php $ci=0; while( have_rows('equipe') ) : the_row(); ?>
                    <?php $foto = get_sub_field('foto'); ?>
                    <div class="col-md-4 col-sm-6 col-10">
                        <div class="team-single text-center">
                            <div class="team-image is-shadow">
                                <img src="<?php echo ($foto) ? $foto['url'] : image('team-i.jpg'); ?>" alt="<?php echo ($foto) ? $foto['alt'] : get_sub_field('nome'); ?>">
                            </div>
                            <div class="team-content team-content-s2">
                                <?php echo (get_sub_field('nome')) ? '<h5 class="team-name">'.get_sub_field('nome').'</h5>' : '';?>
                                <?php echo (get_sub_field('informacao')) ? '<p>'.get_sub_field('informacao').'</p>' : '';?>
                                <?php echo (get_sub_field('texto_do_membro')) ? '<p>'.get_sub_field('texto_do_membro').'</p>' : '';?>
                            </div>
                        </div>
                    </div><!-- .col -->
                <?php $ci++; endwhile; ?>
                
            </div><!-- .row -->
        <?php else : ?>
            <!-- Não faz nada -->
        <?php endif; ?>
    </div><!-- .container -->
</section>
<!-- end section -->