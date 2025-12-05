<?php 
/**
 * Bloco de Cards com Suporte a Imagem e Vídeo
 * Suporta o grupo ACF 'tipo_de_midia' com opções 'imagem' e 'video'
 */

// Configurações do bloco
$bg_color = get_field('cor_do_bloco');
$id = get_field('identificacao_do_bloco');
$block_id = $id ? 'id="' . sanitize_title($id) . '"' : '';
?>

<?php if (have_rows('cards_destacados')) : ?>
    <!-- section -->
    <section data-id="cards2" <?php echo $block_id; ?> class="section section-x pt-0 <?php echo esc_attr($bg_color); ?>">
        <div class="container">
            <?php 
            $ci = 0;
            while (have_rows('cards_destacados')) : the_row();
                
                // Obter tipo de mídia (imagem ou vídeo)
                $tipo_midia = get_sub_field('tipo_de_midia');
                $media_html = '';
                
                // Determinar conteúdo da mídia baseado no tipo
                if ($tipo_midia === 'video') {
                    $video = get_sub_field('video_do_card');
                    if ($video) {
                        $media_html = '
                        <div class="bg-img video-container">
                            <div class="bg-image">
                                <video class="video-player" 
                                       controls 
                                       preload="metadata" 
                                       poster="' . getFallBack() . '">
                                    <source src="' . esc_url($video['url']) . '" type="' . esc_attr($video['mime_type']) . '">
                                    ' . __('Seu navegador não suporta a tag de vídeo.', 'codix') . '
                                </video>
                                <div class="video-play-button">
                                    <i class="ri-play-fill"></i>
                                </div>
                            </div>
                        </div>';
                    } else {
                        // Fallback para imagem se vídeo não configurado
                        $media_html = get_media_fallback_image($ci);
                    }
                } else {
                    // Tipo imagem (padrão)
                    $media_html = get_media_image($ci);
                }
                
                // Determinar classes baseadas na posição
                $is_even = ($ci % 2 == 0);
                $col_order_class = $is_even ? 'order-md-last' : '';
                $text_block_class = $is_even ? 'tc-light bg-primary' : 'bg-secondary';
                $heading_class = $is_even ? '' : 'no-line tc-alt';
                $paragraph_class = $is_even ? '' : 'tc-grey';
                $btn_class = $is_even ? 'btn-outline' : '';
                
                // Obter dados do card
                $sobre_titulo = get_sub_field('sobre_titulo');
                $titulo = get_sub_field('titulo');
                $texto = get_sub_field('texto_do_card');
                $botao = get_sub_field('botao_do_card');
                ?>
                
                <div class="row gutter-vr-30px">
                    <!-- Coluna da Mídia -->
                    <div class="col-md-6 <?php echo esc_attr($col_order_class); ?>">
                        <?php echo $media_html; ?>
                    </div><!-- .col -->
                    
                    <!-- Coluna do Texto -->
                    <div class="col-md-6">
                        <div class="text-block fw-3 <?php echo esc_attr($text_block_class); ?> block-pad-xl">
                            <?php if ($sobre_titulo) : ?>
                                <h5 class="heading-xs <?php echo esc_attr($heading_class); ?>">
                                    <?php echo esc_html($sobre_titulo); ?>
                                </h5>
                            <?php endif; ?>
                            
                            <?php if ($titulo) : ?>
                                <h2><?php echo esc_html($titulo); ?></h2>
                            <?php endif; ?>
                            
                            <?php if ($texto) : ?>
                                <p class="<?php echo esc_attr($paragraph_class); ?>">
                                    <?php echo wp_kses_post($texto); ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php if ($botao) : ?>
                                <a href="<?php echo esc_url($botao['url']); ?>" 
                                   class="btn <?php echo esc_attr($btn_class); ?>" 
                                   target="<?php echo esc_attr($botao['target']); ?>">
                                    <?php echo esc_html($botao['title']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
                
                <div class="gap"></div>
                
            <?php $ci++; endwhile; ?>
        </div>
    </section>
    <!-- .section -->
    
    <!-- Estilos específicos para vídeo -->
    <style>
        .video-container {
            position: relative;
            overflow: hidden;
        }

        .bg-image {
            opacity: 1;
        }
        
        .video-container .bg-image {
            position: relative;
            padding-bottom: 0; /* 16:9 Aspect Ratio */
            height: auto;
        }
        
        .video-container video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .video-play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 2;
            transition: all 0.3s ease;
        }
        
        .video-play-button:hover {
            background: white;
            transform: translate(-50%, -50%) scale(1.1);
        }
        
        .video-play-button i {
            font-size: 30px;
            color: #333;
            margin-left: 5px;
        }
        
        .video-playing .video-play-button {
            opacity: 0;
            visibility: hidden;
        }
    </style>
    
    <!-- Script para controle de vídeo -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.video-player').forEach(function(video) {
            const container = video.closest('.video-container');
            const playButton = container.querySelector('.video-play-button');
            
            if (playButton) {
                playButton.addEventListener('click', function() {
                    video.play();
                    container.classList.add('video-playing');
                });
            }
            
            video.addEventListener('play', function() {
                container.classList.add('video-playing');
            });
            
            video.addEventListener('pause', function() {
                container.classList.remove('video-playing');
            });
            
            video.addEventListener('ended', function() {
                container.classList.remove('video-playing');
            });
        });
    });
    </script>
    
<?php else : ?>
    <!-- Bloco oculto quando não há cards -->
    <!-- Não faz nada -->
<?php endif; ?>

<?php
/**
 * Função auxiliar para obter HTML da imagem com fallback
 */
function get_media_image($index) {
    $img_card = get_sub_field('imagem_do_card');
    
    // Usar função getFallBack() conforme especificado
    $img_final = $img_card ? $img_card['url'] : getFallBack();
    $img_thumb = $img_card ? $img_card['sizes']['thumbnail'] : getFallBack();
    
    $title = get_sub_field('titulo') ?: get_sub_field('sobre_titulo') ?: '';
    
    return '
    <div class="bg-img">
        <div class="bg-image">
            <img data-src="' . esc_url($img_final) . '" 
                 loading="lazy" 
                 src="' . esc_url($img_thumb) . '" 
                 class="img-fluid w-100 scroll-image" 
                 alt="' . esc_attr($title) . '">
        </div>
    </div>';
}

/**
 * Função auxiliar para imagem de fallback
 */
function get_media_fallback_image($index) {
    $title = get_sub_field('titulo') ?: get_sub_field('sobre_titulo') ?: '';
    
    return '
    <div class="bg-img">
        <div class="bg-image">
            <img data-src="' . esc_url(getFallBack()) . '" 
                 loading="lazy" 
                 src="' . esc_url(getFallBack()) . '" 
                 class="img-fluid w-100 scroll-image" 
                 alt="' . esc_attr($title) . '">
        </div>
    </div>';
}
?>

