<!-- section -->
<section class="section bg-secondary section-l">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-head section-sm">
                    <h3>Você também vai gostar destes artigos</h3>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
        <div class="row justify-content-center gutter-vr-30px">
            <?php 
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID())
            );
            
            $posts = new WP_Query( $args ); ?>

            <?php if ( $posts->have_posts() ) { ?>
                <?php while ( $posts->have_posts() ) { $posts->the_post(); global $post; ?>
                    <div class="col-sm-8 col-md-4 text-center">
                        <div class="post post-alt">
                            <div class="post-thumb">
                                <a href="<?php echo get_the_permalink($post->ID); ?>"><img src="<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_url($post->ID) : image('banner-a.jpg'); ?>" alt="post"></a>
                            </div>
                            <div class="post-content">
                                <p class="post-tag"><?php echo get_the_date('j \d\e F \d\e Y'); ?></p>
                                <h4><a href="<?php echo get_the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></h4>
                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="btn btn-arrow">Ler mais</a>
                            </div>
                        </div><!-- .post -->
                    </div><!-- .col -->
                <?php } ?>
            <?php } ?>
        </div><!-- .row -->
    </div><!-- .container -->
</section>
<!-- .section -->