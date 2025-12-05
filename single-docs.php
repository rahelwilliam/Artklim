<?php get_template_part('docs/header'); ?>

<?php if( is_user_logged_in() ) { ?>

    <main class="main-docs">
        <section class="hero-docs">
            <div class="container">
                <div class="hero-flex">
                    <h1 class="hero-title"><?php echo get_the_title(); ?></h1>
                    <div class="hero-text">
                        <?php $content = (get_the_excerpt()) ? get_the_excerpt() : get_the_content(); ?>
                        <?php echo wp_strip_all_tags( mb_strimwidth($content, 0, 150, '...') );?>
                    </div>
                    <!-- <form action="/search" class="hero-search w-form"><input type="search" class="hero-input w-input"
                            maxlength="256" name="query" placeholder="Buscar..." id="search" required="" /><input
                            type="submit" value="" class="hero-button w-button" /></form> -->
                </div>
            </div>
        </section>
        <div class="single-docs">
            <div class="container2">
                <div class="single-docs-content">
                    <br>
                    <div class="w-richtext">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
        <section class="faq-docs">
            <div class="container">
                <div class="faq-flex">
                    <h1 class="hero-title">Ainda tem dúvidas?</h1>
                    <div class="hero-text">Entre em contato conosco!</div><a href="https://santins.com.br/contato"
                        target="_blank" class="faq-button w-inline-block">
                        <div>Entrar em contato</div>
                    </a>
                </div>
            </div>
        </section>
    </main>
    
<?php } else {
    echo '<script> window.location.replace("'.home_url().'/sntadm/"); </script>';
} ?>

<?php get_template_part('docs/footer'); ?>