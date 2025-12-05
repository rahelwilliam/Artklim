<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>

<?php 
$args = array(
    'post_type' => 'galeria'
);
 
$posts = new WP_Query( $args ); ?>

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
                    <!-- <li class="active" data-filter="all">Todas</li> -->
                    <?php $filters = array("Todas"); ?>
                    <?php if ( $posts->have_posts() ) { ?>
                        <?php while ( $posts->have_posts() ) { $posts->the_post(); global $post; ?>
                            <?php array_push($filters, get_field('tipo_de_produto', $post->ID)); ?>
                        <?php } ?>
                    <?php } ?>
                    <?php $distinct = array_unique($filters); ?>
                    <?php 
                    foreach ($distinct as $tipo) {
                        if($tipo == 'Todas') {
                            echo '<li class="active" data-filter="all">Todas</li>';
                        } else {
                            echo '<li data-filter="'.slugify($tipo).'">'.$tipo.'</li>';
                        }
                    }
                    ?>
                </ul>
                <!-- .project-filter -->
            </div>
        </div>
    </div><!-- .container -->

    <div class="project-area">
        <div class="row project project-v5 no-gutters">
            <?php if ( $posts->have_posts() ) { ?>
                <?php while ( $posts->have_posts() ) { $posts->the_post(); global $post; ?>

                    <a href="<?php echo get_the_permalink($post->ID); ?>" class="col-sm-6 col-lg-3 filtr-item" data-category="<?php echo slugify(get_field('tipo_de_produto', $post->ID)); ?>">
                        <span>
                            <div class="project-item">
                                <div class="project-image">
                                    <img src="<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_url($post->ID) : image('project-a.jpg'); ?>" alt="<?php echo (has_post_thumbnail($post->ID)) ? the_post_thumbnail_caption($post->ID) : get_the_title($post->ID); ?>">
                                </div>
                                <div class="project-over">
                                    <div class="project-content">
                                        <h4><?php echo get_the_title($post->ID); ?></h4>
                                        <p><?php echo get_field('tipo_de_produto', $post->ID) ; ?></p>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </a><!-- .col -->

                <?php } ?>    
            <?php } ?>
        </div>
        <!-- project -->
    </div>
</section>