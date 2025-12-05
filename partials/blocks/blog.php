<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<!-- section-news -->
<div <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="section section-x section-news <?php echo $bg_color; ?>">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-6 text-center">
                <div class="section-head section-sm">
                    <h5 class="heading-xs"><?php echo (get_field('sobre_titulo_blog')) ? get_field('sobre_titulo_blog') : 'Novidades'; ?></h5>
                    <h2><?php echo (get_field('titulo_blog')) ? get_field('titulo_blog') : 'Notícias de qualidade você encontra aqui'; ?></h2>
                </div>
            </div>
        </div><!-- .row -->
        <div class="row gutter-vr-30px justify-content-sm-center">
            <?php
            $itemArgs = [
                'post_type' => 'post',
                'posts_per_page' => 3
            ];

            $items = new WP_Query($itemArgs);

            if( $items->have_posts() ) :
                while( $items->have_posts() ) :                        
                    $items->the_post(); ?>
                    <div class="col-sm-8 col-md-4 text-center">
                        <div class="post post-alt">
                            <div class="post-thumb cover">
                                <a href="<?php echo get_the_permalink($post->ID); ?>">
                                    <img src="<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_url($post->ID) : image('post-thumb-b.jpg'); ?>" alt="<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_caption($post->ID) : get_the_title($post->ID); ?>" />
                                </a>
                            </div>
                            <div class="post-content">
                                <p class="post-tag"><?php echo get_the_date('d/m/Y'); ?></p>
                                <h4>
                                    <a href="<?php echo get_the_permalink($post->ID); ?>">
                                        <?php echo get_the_title($post->ID); ?>
                                    </a>
                                </h4>
                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="btn btn-arrow">Ler Mais</a>
                            </div>
                        </div><!-- .post -->
                    </div><!-- .col -->

                <?php endwhile;
            else : ?>
                    <p><?php esc_html_e( 'Desculpe, não foi possível trazer posts.' ); ?></p>
            <?php 
            endif; 
            ?>
        </div><!-- .row -->
        <div class="row">
            <div class="col-12 text-center">
                    <div class="button-area button-area-sm">
                        <a href="#" class="btn">Ver todas</a>
                    </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<!-- .section-news -->