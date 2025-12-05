<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<?php 
$images = get_field('galeria_de_imagens');
if( $images ) { ?>

    <!-- section -->
    <section data-id="galeria" <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-x section-project pb-0 <?php echo $bg_color; ?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-7 text-center">
                    <div class="section-head">
                        <?php echo (get_field('sobre_titulo_da_galeria')) ? '<h5 class="heading-xs">' . get_field('sobre_titulo_da_galeria') . '' : '</h5>'; ?>
                        <?php echo (get_field('titulo_da_galeria')) ? '<h2>' . get_field('titulo_da_galeria') . '' : '</h2>'; ?>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- project filter -->
                    <ul class="project-filter project-md">
                        <li class="active" data-filter="all">Todas</li>
                        <?php
                        if( have_rows('categoria_das_imagens') ) {
                            $cat=1;
                            while( have_rows('categoria_das_imagens') ) : the_row();

                                $sub_value = get_sub_field('texto_para_categoria');
                                echo '<li data-filter="'.$cat.'">'.$sub_value.'</li>';
                            
                            $cat++;
                            endwhile;
                        } ?>
                    </ul>
                    <!-- .project-filter -->
                </div>
            </div>
        </div><!-- .container -->

        <div class="project-area">
            <div class="row project project-v5 no-gutters" id="project1">
                <?php foreach( $images as $image ): ?>

                    <div class="col-sm-6 col-lg-3 filtr-item" data-category="<?php echo ($image['description']) ? $image['description'] : '1'; ?>">
                        <span>
                            <div class="project-item">
                                <div class="project-image">
                                    <img src="<?php echo ($image) ? $image['url'] : image('project-a.jpg'); ?>" alt="<?php echo ($image) ? $image['alt'] : get_the_title(); ?>">
                                </div>
                                <div class="project-over">
                                    <div class="project-content">
                                        <h4><?php echo esc_html($image['alt']); ?></h4>
                                        <p><?php echo esc_html($image['caption']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div><!-- .col -->
                    
                <?php endforeach; ?>
            </div>
            <!-- project -->
        </div>
    </section>
<?php } ?>