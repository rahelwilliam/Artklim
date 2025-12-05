    </div><!-- /#app -->

<?php $lg = get_field('logotipo_principal', 'option'); $logo = ($lg) ? $lg['url'] : image('logotipo-simple.png');  ?>
<?php $lgi = get_field('logotipo_invertido', 'option'); $logo_i = ($lgi) ? $lgi['url'] : image('logotipo-white.png');  ?>
<?php $tm = get_field('tamanho_da_imagem_em_px', 'option'); ?>

<!-- footer -->
<footer class="section footer bg-light footer-alt">
    <div class="container">
        <div class="row gutter-vr-30px">
            <div class="col-lg-4 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <div class="wgs-logo">
                            <a href="#">
                                <img src="<?php echo $logo; ?>"  <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?>
                                    srcset="<?php echo $logo; ?>" alt="logo">
                            </a>
                        </div>
                        <p>Artklim Móveis e Esquadrias é comprometida em oferecer produtos de qualidade e acabamento para satisfação dos clientes.</p>
                    </div>
                </div><!-- .wgs -->
            </div><!-- .col -->
            <div class="col-lg-2 offset-lg-1 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <h3 class="wgs-title t-u"><?php echo get_bloginfo('name'); ?></h3>
                        <ul class="wgs-menu">
                            <?php 
                            if( have_rows('menus', 'option') ) {
                                while ( have_rows('menus', 'option') ) : 
                                    the_row(); $link = get_sub_field('item_do_menu'); ?>
                                    <li>
                                        <a target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                                    </li>
                                <?php 
                                endwhile;
                            } ?>
                        </ul>
                    </div>
                </div><!-- .wgs -->
            </div><!-- .col -->
            <div class="col-lg-2 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <h3 class="wgs-title t-u">Privacidade</h3>
                        <ul class="wgs-menu">
                            <li><a href="#contato">Contato</a></li>
                            <li><a href="#">Politica de Privacidade</a></li>
                            <li><a href="#">Termos de Uso</a></li>
                        </ul>
                    </div>
                </div><!-- .wgs -->
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <h3 class="wgs-title t-u">Newsletter</h3>
                        <form class="genox-form" action="#" method="POST">
                            <div class="form-results"></div>
                            <div class="field-group btn-inline">
                                <input type="email" name="s_email" class="input required" placeholder="Seu  E-mail">
                                <input type="text" class="d-none" name="form-anti-honeypot" value="">
                                <button type="submit" class="far fa-paper-plane button"></button>
                            </div>
                        </form>
                    </div>
                </div><!-- .wgs -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</footer>
<!-- .footer -->

<!-- copyright -->
<div class="copyright bg-light">
    <div class="container bdr-copyright">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6">
                <div class="copyright-content">
                    <p>&copy; 2023. Todos os direitos reservados. Desenvolvido por <a href="https://codix.digital" target="_blank">Codix Digital</a></p>
                </div>
            </div>
            <div class="col-md-6 text-md-right">
                <div class="copyright-content">
                    <ul class="social social-style-icon">
                        <li><a href="https://www.facebook.com/Artklim.com.br/" target="_blank" class="fab fa-facebook-f"></a></li>
                        <li><a href="https://www.instagram.com/artklim_me/" class="fab fa-instagram" target="_blank"></a></li>
                        <li><a href="https://wa.me/5551992659289?text=Oi,%20estava%20acessando%20o%20site%20e%20gostaria%20de%20saber%20mais,%20voc%C3%AA%20pode%20me%20ajudar?" class="fab fa-whatsapp" target="_blank"></a></li>
                        <li><a href="tel:555134938281" class="fa fa-phone" target="_blank"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end code -->

<style>
    .codix-lazy {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .codix-lazy.lazy-loaded {
        opacity: 1;
    }

    .bg-image {
        position: relative;
        overflow: hidden;
    }

    .bg-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<?php
/**
 * Footer Scripts
 * Incluir antes do fechamento do </body>
 */
?>

<!-- Lazy Load Inline Script -->
<script id="codix-lazy-load">
(function(w,d){
    'use strict';
    
    var config = {
        rootMargin: '100px 0px',
        threshold: 0.01,
        useNative: false
    };
    
    // Verifica se o navegador já suporta lazy loading nativo
    if ('loading' in HTMLImageElement.prototype) {
        config.useNative = true;
    }
    
    function loadImage(img) {
        var src = img.getAttribute('data-src');
        var srcset = img.getAttribute('data-srcset');
        
        if (src) {
            img.src = src;
            img.removeAttribute('data-src');
        }
        
        if (srcset) {
            img.srcset = srcset;
            img.removeAttribute('data-srcset');
        }
        
        // Adiciona classe para transição suave
        img.classList.add('lazy-loaded');
        
        // Dispara evento para possível uso externo
        var event = new CustomEvent('lazyloaded', {
            detail: { element: img }
        });
        img.dispatchEvent(event);
    }
    
    function initLazyLoad() {
        // Se o navegador já suporta lazy loading nativo
        if (config.useNative) {
            // Converte data-src para src para navegadores nativos
            var images = d.querySelectorAll('img[loading="lazy"][data-src]');
            images.forEach(function(img) {
                loadImage(img);
            });
            return;
        }
        
        // Usa IntersectionObserver
        if ('IntersectionObserver' in w) {
            var io = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        loadImage(entry.target);
                        io.unobserve(entry.target);
                    }
                });
            }, {
                rootMargin: config.rootMargin,
                threshold: config.threshold
            });
            
            var lazyImages = d.querySelectorAll('img[loading="lazy"]');
            lazyImages.forEach(function(img) {
                io.observe(img);
            });
            
            // Expõe o observer para controle externo
            w.codixLazyObserver = io;
        } else {
            // Fallback para navegadores antigos
            var scrollHandler = function() {
                var images = d.querySelectorAll('img[loading="lazy"]');
                var windowHeight = w.innerHeight || d.documentElement.clientHeight;
                
                images.forEach(function(img) {
                    var rect = img.getBoundingClientRect();
                    if (rect.top <= windowHeight + 200) {
                        loadImage(img);
                    }
                });
                
                // Remove listener se todas as imagens foram carregadas
                if (!d.querySelector('img[loading="lazy"][data-src]')) {
                    w.removeEventListener('scroll', scrollHandler);
                    w.removeEventListener('resize', scrollHandler);
                }
            };
            
            // Carrega imagens iniciais
            scrollHandler();
            
            // Adiciona listeners
            w.addEventListener('scroll', scrollHandler);
            w.addEventListener('resize', scrollHandler);
        }
    }
    
    // Inicialização otimizada
    function ready(fn) {
        if (d.readyState !== 'loading') {
            setTimeout(fn, 1);
        } else {
            d.addEventListener('DOMContentLoaded', fn);
        }
    }
    
    ready(initLazyLoad);
    
    // API global para uso externo
    w.codixLazyLoad = {
        load: loadImage,
        refresh: initLazyLoad,
        config: config
    };
    
})(window,document);
</script>

<!-- preloader -->
<div class="preloader preloader-light preloader-florida no-split">
    <span class="spinner spinner-alt">
        <img class="spinner-brand" <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?> src="<?php echo $logo_i; ?>" alt="<?php echo $lgi['alt']; ?>" />
    </span>
</div>

<!-- JavaScript -->
<script src="<?php echo asset('js/bundle.js?ver=141'); ?>"></script>
<script src="<?php echo asset('js/alaska.js?ver=141'); ?>"></script>

<?php //wp_footer() ?>

</body>
</html>
