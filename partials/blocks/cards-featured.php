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
                        // Tenta obter a thumbnail do vídeo
                        $video_id = $video['ID'];
                        $video_thumb = wp_get_attachment_image_src($video_id, 'large');
                        $poster_url = $video_thumb ? $video_thumb[0] : getFallBack();
                        
                        $media_html = '
                        <div class="bg-img video-container">
                            <div class="bg-image video-wrapper" data-aspect-ratio="">
                                <video class="video-player" 
                                    controls 
                                    preload="metadata" 
                                    poster="' . esc_url($poster_url) . '">
                                    <source src="' . esc_url($video['url']) . '" type="' . esc_attr($video['mime_type']) . '">
                                    ' . __('Seu navegador não suporta a tag de vídeo.', 'codix') . '
                                </video>
                                <div class="video-play-button">
                                    <i class="fa fa-play"></i>
                                </div>
                                <!-- Overlay para indicar que é vídeo -->
                                <div class="video-badge">
                                    <i class="fa fa-play-circle"></i> Vídeo
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
    
    <!-- Estilos específicos para vídeo responsivo -->
    <style>
        /* Container principal mantém proporção */
        .video-container {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Wrapper responsivo para vídeo */
        .video-wrapper {
            position: relative;
            width: 100%;
            padding-top: 0; /* Removemos o padding fixo */
            height: auto;
            min-height: 300px; /* Altura mínima para mobile */
        }

        /* Vídeo responsivo */
        .video-container video {
            position: relative; /* Mude de absolute para relative */
            top: 0;
            left: 0;
            width: 100%;
            height: auto; /* Altura automática baseada na proporção */
            /* max-height: 600px; */
            display: block;
            object-fit: contain; /* Mostra vídeo inteiro sem cortar */
            background-color: #000; /* Fundo preto para bordas */
        }

        /* Para manter proporção em telas grandes */
        @media (min-width: 768px) {
            .video-wrapper {
                min-height: 400px;
            }
            
            /* .video-container video {
                max-height: 500px;
            } */
        }

        @media (min-width: 992px) {
            .video-wrapper {
                min-height: 450px;
            }
            
            /* .video-container video {
                max-height: 550px;
            } */
        }

        /* Container de imagem também precisa ser responsivo */
        .bg-img:not(.video-container) .bg-image {
            position: relative;
            padding-bottom: 75%; /* Proporção 4:3 para imagens */
            height: 0;
            overflow: hidden;
            border-radius: 8px;
        }

        .bg-img:not(.video-container) .bg-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .bg-img:not(.video-container):hover .bg-image img {
            transform: scale(1.05);
        }

        /* Botão de play centralizado */
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
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .video-play-button:hover {
            background: white;
            transform: translate(-50%, -50%) scale(1.1);
            box-shadow: 0 6px 16px rgba(0,0,0,0.3);
        }

        .video-play-button i {
            font-size: 30px;
            color: #333;
            margin-left: 5px;
        }

        .video-playing .video-play-button {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* Equalizar altura das colunas */
        .row.gutter-vr-30px {
            display: flex;
            flex-wrap: wrap;
            align-items: stretch; /* Faz as colunas terem mesma altura */
        }

        .row.gutter-vr-30px > .col-md-6 {
            display: flex;
            flex-direction: column;
        }

        /* Card de texto ocupa altura total */
        .text-block.fw-3 {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Responsividade para mobile */
        @media (max-width: 767px) {
            .row.gutter-vr-30px > .col-md-6 {
                margin-bottom: 30px;
            }
            
            .video-wrapper {
                min-height: 250px;
            }
            
            /* .video-container video {
                max-height: 400px;
            } */
            
            .video-play-button {
                width: 60px;
                height: 60px;
            }
            
            .video-play-button i {
                font-size: 25px;
            }
        }

        /* Animações suaves */
        .scroll-image {
            transition: opacity 0.5s ease;
        }

        .scroll-image.lazy-loaded {
            opacity: 1;
        }

        [data-id="cards2"] .bg-image {
            position: relative !important;
            opacity: 1 !important;
        }

        /* Badge indicador de vídeo */
        .video-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 5px;
            z-index: 3;
            backdrop-filter: blur(4px);
        }

        .video-badge i {
            font-size: 14px;
        }

        /* Container inteligente que se adapta ao conteúdo */
        .video-wrapper[data-aspect-ratio] {
            transition: padding-top 0.3s ease;
        }

        /* Classes para diferentes proporções */
        .video-wrapper.aspect-square {
            padding-bottom: 100% !important; /* 1:1 */
        }

        .video-wrapper.aspect-landscape {
            padding-bottom: 56.25% !important; /* 16:9 */
        }

        .video-wrapper.aspect-portrait {
            padding-bottom: 177.78% !important; /* 9:16 */
        }

        /* Mantém vídeo dentro do container */
        .video-container video {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            object-fit: cover; /* Corta para preencher */
        }

        /* Quando estiver tocando, mostra vídeo inteiro */
        .video-playing video {
            object-fit: contain !important;
            background-color: #000;
        }

        /* Overlay escuro na thumbnail para melhor contraste */
        .video-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.3));
            z-index: 1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-wrapper:hover::before {
            opacity: 1;
        }
    </style>
    
    <!-- Script para controle de vídeo responsivo com detecção de proporção -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar vídeos
        document.querySelectorAll('.video-player').forEach(function(video) {
            const container = video.closest('.video-container');
            const wrapper = container.querySelector('.video-wrapper');
            const playButton = container.querySelector('.video-play-button');
            
            // Função para determinar classe de proporção
            function setAspectRatioClass(width, height) {
                const aspectRatio = width / height;
                wrapper.classList.remove('aspect-square', 'aspect-landscape', 'aspect-portrait');
                
                if (aspectRatio >= 0.9 && aspectRatio <= 1.1) {
                    // Quase quadrado
                    wrapper.classList.add('aspect-square');
                    wrapper.style.paddingBottom = '100%';
                } else if (aspectRatio > 1.1) {
                    // Paisagem
                    wrapper.classList.add('aspect-landscape');
                    wrapper.style.paddingBottom = (100 / aspectRatio) + '%';
                } else {
                    // Retrato
                    wrapper.classList.add('aspect-portrait');
                    wrapper.style.paddingBottom = (100 / aspectRatio) + '%';
                }
            }
            
            // Configurar tamanho baseado na proporção do vídeo
            video.addEventListener('loadedmetadata', function() {
                setAspectRatioClass(video.videoWidth, video.videoHeight);
                
                // Se não tiver poster, cria um do primeiro frame
                if (!video.poster) {
                    createVideoThumbnail(video);
                }
            });
            
            // Se já tiver metadata
            if (video.videoWidth && video.videoHeight) {
                setAspectRatioClass(video.videoWidth, video.videoHeight);
            }
            
            // Controles de play/pause
            if (playButton) {
                playButton.addEventListener('click', function() {
                    if (video.paused) {
                        video.play().then(function() {
                            container.classList.add('video-playing');
                            // Muda object-fit para contain quando toca
                            video.style.objectFit = 'contain';
                        }).catch(function(error) {
                            console.error('Erro ao reproduzir vídeo:', error);
                        });
                    } else {
                        video.pause();
                        container.classList.remove('video-playing');
                        // Volta para cover quando pausa
                        video.style.objectFit = 'cover';
                    }
                });
            }
            
            video.addEventListener('play', function() {
                container.classList.add('video-playing');
                video.style.objectFit = 'contain';
            });
            
            video.addEventListener('pause', function() {
                container.classList.remove('video-playing');
                video.style.objectFit = 'cover';
            });
            
            video.addEventListener('ended', function() {
                container.classList.remove('video-playing');
                video.style.objectFit = 'cover';
                video.currentTime = 0;
            });
            
            // Pausar vídeo quando sair da viewport
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (!entry.isIntersecting && !video.paused) {
                        video.pause();
                    }
                });
            }, { threshold: 0.3 });
            
            observer.observe(video);
        });
        
        // Função para criar thumbnail do vídeo (fallback)
        function createVideoThumbnail(videoElement) {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            
            canvas.width = 300;
            canvas.height = 300;
            
            // Tenta capturar um frame
            videoElement.addEventListener('loadeddata', function() {
                if (videoElement.readyState >= 2) { // HAVE_CURRENT_DATA
                    context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
                    videoElement.poster = canvas.toDataURL('image/jpeg');
                }
            }, { once: true });
        }
        
        // Equalizar altura dos cards (mantido)
        function equalizeCardHeights() {
            document.querySelectorAll('.row.gutter-vr-30px').forEach(function(row) {
                const mediaCol = row.querySelector('.col-md-6:first-child');
                const textCol = row.querySelector('.col-md-6:last-child');
                
                if (mediaCol && textCol && window.innerWidth >= 768) {
                    const mediaHeight = mediaCol.offsetHeight;
                    textCol.style.minHeight = mediaHeight + 'px';
                } else {
                    document.querySelectorAll('.col-md-6').forEach(function(col) {
                        col.style.minHeight = '';
                    });
                }
            });
        }
        
        equalizeCardHeights();
        window.addEventListener('resize', equalizeCardHeights);
        document.addEventListener('lazyloaded', equalizeCardHeights);
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
                 class="img-fluid w-100 scroll-image lazy-image" 
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
                 class="img-fluid w-100 scroll-image lazy-image" 
                 alt="' . esc_attr($title) . '">
        </div>
    </div>';
}
?>