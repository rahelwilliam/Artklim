<?php get_template_part('docs/header'); ?>

<?php if( is_user_logged_in() ) { ?>

    <main class="main-docs">
        <section class="hero-docs">
            <div class="container">
                <div class="hero-flex">
                    <h1 class="hero-title">Documentação</h1>
                    <div class="hero-text">Tem alguma dúvida de como utilizar o nosso sistema? <br />Consulte nossa
                        documentação!</div>
                    <form class="hero-search w-form">
                        <input type="search" class="hero-input w-input" maxlength="256" placeholder="Buscar..." id="search" required="" />
                        <input type="submit" value="" class="hero-button w-button" />
                    </form>
                </div>
            </div>
        </section>
        <section class="posts-docs">
            <div class="container">
                <div class="posts-flex" id="lista-items">
                    <?php while ( have_posts() ) : the_post(); global $post; ?>
                        <div class="post-docs-item lista-li">
                            <a href="<?php echo get_the_permalink($post->ID); ?>" class="post-doc-a w-inline-block item-content">
                                <h2 class="post-docs-title"><?php echo get_the_title($post->ID); ?></h2>
                                <div class="post-docs-text">
                                    <?php $content = (get_the_excerpt($post->ID)) ? get_the_excerpt($post->ID) : get_the_content($post->ID); ?>
                                    <?php echo wp_strip_all_tags( mb_strimwidth($content, 0, 150, '...') );?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>

                    <div id="not-found" class="result-iem not-found" style="display: none;">
                        <div>Nenhum manual encontrado :(</div>
                    </div>
                </div>
            </div>
        </section>
        <section class="faq-docs">
            <div class="container">
                <div class="faq-flex">
                    <h1 class="hero-title">Ainda tem dúvidas?</h1>
                    <div class="hero-text">Entre em contato conosco!</div><a href="https://codix.digital"
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