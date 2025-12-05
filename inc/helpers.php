<?php

/**
 * Get CSS file path
 * @param  string $file Filename
 * @return string       File path
 */
function css($file = '') {
    return CSS_PATH . $file;
}

/**
 * Get JavaScript file path
 * @param  string $file Filename
 * @return string       File path
 */
function javascript($file = '') {
    return JS_PATH . $file;
}

/**
 * Get image file path
 * @param  string $file Filename
 * @return string       File path
 */
function image($file = '') {
    return IMAGES_PATH . $file;
}

/**
 * Get site base URL
 * @param  string $url Path
 * @return string      Base path
 */
function base_url($url = '') {
    return BASE_URL . $url;
}

/**
 * Get asset path
 * @param  string $file File name
 * @param  string $dir  Assets directory
 * @return string       Asset path
 */
function asset($file, $dir = 'assets') {
    return get_template_directory_uri() . '/' . ltrim($dir, '/') . '/' . ltrim($file, '/');
}

/**
 * Get file path from asset manifest
 * @param  string $file           File path
 * @param  string $buildDirectory Assets directory
 * @return string                 Versioned file path
 */
function manifest($file, $buildDirectory = 'build') {
    $manifest = [];
    $buildDirectory = '/' . ltrim($buildDirectory, '/');

    if (empty($manifest)) {
        $path = get_template_directory() . $buildDirectory . '/rev-manifest.json';

        if (file_exists($path)) {
            $manifest = json_decode(file_get_contents($path), true);
        }
    }

    $file = ltrim($file, '/');

    if (isset($manifest[$file])) {
        return asset($manifest[$file], $buildDirectory);
    }

    $unversioned = get_template_directory() . $buildDirectory . '/' . $file;

    if (file_exists($unversioned)) {
        return asset($file, $buildDirectory);
    }
}

/**
 * Like get_template_part() but lets you pass args to the template file
 * Args are available in the template as $args array.
 * Args can be passed in as url parameters, e.g 'key1=value1&key2=value2'.
 * Args can be passed in as an array, e.g. ['key1' => 'value1', 'key2' => 'value2']
 * Filepath is available in the template as $file string.
 * @param string      $slug The slug name for the generic template.
 * @param string|null $name The name of the specialized template.
 * @param array       $args The arguments passed to the template
 */
function _get_template_part( $slug, $args = array(), $name = null ) {
    if ( isset( $name ) && $name !== 'none' ) $slug = "{$slug}-{$name}.php";
    else $slug = "{$slug}.php";
    $dir = get_template_directory();
    $file = "{$dir}/{$slug}";

    ob_start();
    $args = wp_parse_args( $args );
    $slug = $dir = $name = null;
    require( $file );
    echo ob_get_clean();
}

/**
 * Resumo do conteúdo do post limitado a um numero de caracteres, 
 * exibe o excerpt (caso exista), ou o conteúdo da página cortado e sem tags html.
 * @param int $id ID do post, opcional
 * @param int $total Máximo de caracteres, opcional, padrão = 115
 * @return string
 */
function resume($id = '', $total = '') {
    global $post;
    $num = ($total) ? $total : 115;
    $post_id = ($id) ? $id : $post->ID;
    $content = (get_the_excerpt($post_id)) ? get_the_excerpt($post_id) : get_the_content($post_id);
    $resume = wp_strip_all_tags( mb_strimwidth($content, 0, $num, '...') );
    return $resume;
}

/**
 * Resumo do conteúdo do post limitado a um numero de caracteres, 
 * exibe o excerpt (caso exista), ou o conteúdo da página cortado e sem tags html.
 * @param string $file name file in partial or child folders
 * @return file 
 */
function partial($file = '') {
    get_template_part('partials/'. $file);
}

/**
 * Gerar slug com base na string passada, remove espaços e caracteres especiais,
 * adicionando hippen no lugar do espaço e ponto.
 * @param string $string texto a ser convertido, obrigatorio
 * @return string
 */
function slugify($string) {
    $string = preg_replace('/[\t\n]/', ' ', $string);
    $string = preg_replace('/\s{2,}/', ' ', $string);
    $list = array(
        'Š' => 'S',
        'š' => 's',
        'Đ' => 'Dj',
        'đ' => 'dj',
        'Ž' => 'Z',
        'ž' => 'z',
        'Č' => 'C',
        'č' => 'c',
        'Ć' => 'C',
        'ć' => 'c',
        'À' => 'A',
        'Á' => 'A',
        'Â' => 'A',
        'Ã' => 'A',
        'Ä' => 'A',
        'Å' => 'A',
        'Æ' => 'A',
        'Ç' => 'C',
        'È' => 'E',
        'É' => 'E',
        'Ê' => 'E',
        'Ë' => 'E',
        'Ì' => 'I',
        'Í' => 'I',
        'Î' => 'I',
        'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O',
        'Ó' => 'O',
        'Ô' => 'O',
        'Õ' => 'O',
        'Ö' => 'O',
        'Ø' => 'O',
        'Ù' => 'U',
        'Ú' => 'U',
        'Û' => 'U',
        'Ü' => 'U',
        'Ý' => 'Y',
        'Þ' => 'B',
        'ß' => 'Ss',
        'à' => 'a',
        'á' => 'a',
        'â' => 'a',
        'ã' => 'a',
        'ä' => 'a',
        'å' => 'a',
        'æ' => 'a',
        'ç' => 'c',
        'è' => 'e',
        'é' => 'e',
        'ê' => 'e',
        'ë' => 'e',
        'ì' => 'i',
        'í' => 'i',
        'î' => 'i',
        'ï' => 'i',
        'ð' => 'o',
        'ñ' => 'n',
        'ò' => 'o',
        'ó' => 'o',
        'ô' => 'o',
        'õ' => 'o',
        'ö' => 'o',
        'ø' => 'o',
        'ù' => 'u',
        'ú' => 'u',
        'û' => 'u',
        'ý' => 'y',
        'ý' => 'y',
        'þ' => 'b',
        'ÿ' => 'y',
        'Ŕ' => 'R',
        'ŕ' => 'r',
        '/' => '-',
        ' ' => '-',
        '.' => '',
        ',' => '-',
        '<' => '-',
        '>' => '-',
        ':' => '-',
    );

    $string = strtr($string, $list);
    $string = preg_replace('/-{2,}/', '-', $string);
    $string = strtolower($string);

    return $string;
}

/**
 * Permite adicionar códigos de css e script para o head, body e footer
 * @param string $string texto a ser convertido, obrigatorio
 */
function codigosAdicionais($posicao) {
    if ( have_rows( 'codigos_adicionais', 'option' ) ) :
        while ( have_rows( 'codigos_adicionais', 'option' ) ) : the_row();
          $pagina_items =  get_sub_field( 'pagina' );
          $pagina_atual = get_permalink();
          if($pagina_items) {
            foreach ( $pagina_items as $pagina_item ) {              
              if($pagina_item == $pagina_atual) {
                if(get_sub_field( 'posicao_do_codigo' ) == $posicao) {
                  the_sub_field( 'codigo' );
                } else { }
              } else { }
            }
          } else {
            if(get_sub_field( 'posicao_do_codigo' ) == $posicao) {
              the_sub_field( 'codigo' );
            } else { }
          }
          
        endwhile;
    else :
    endif;
}


/**
 * Permite adicionar srcset nas imagens, com tamanhos adaptados para cada tela
 * @param string|null $w é um texto com tamanho desejado
 * @param integer|null $image_id é o ID da imagem, recuperado no POST como exemplo: $image_id = get_post_thumbnail_id() ou no ACF como exemplo: $image = get_field('image'); $image_id = $image['id'];
 */
function srcset($w = '', $image_id = '') {
    // print_r( get_intermediate_image_sizes() ); // Verificar tamanhos disponíveis
    if($w == 'medium') {
        $srcset = 'srcset="'.wp_get_attachment_image_url($image_id, 'medium_large').' 500w, '.wp_get_attachment_image_url($image_id, 'large').' 800w" sizes="(max-width: 479px) 50vw, (max-width: 991px) 32vw, (max-width: 1279px) 25vw, (max-width: 1439px) 26vw, 23vw"';
    } elseif ($w == 'large') {
        $srcset = 'srcset="'.wp_get_attachment_image_url($image_id, 'full_hd').' 1080w, '.wp_get_attachment_image_url($image_id, 'full_hd').' 1200w" sizes="(max-width: 479px) 75vw, (max-width: 1279px) 50vw, (max-width: 1439px) 47vw, (max-width: 1919px) 50vw, 748.71533203125px"';
    } else {
        $srcset = 'srcset="'.wp_get_attachment_image_url($image_id, 'medium_large').' 500w, '.wp_get_attachment_image_url($image_id, 'large').' 800w, '.wp_get_attachment_image_url($image_id, 'default_big').' 1080w, '.wp_get_attachment_image_url($image_id, 'full_hd').' 1200w" sizes="(max-width: 479px) 75vw, (max-width: 1279px) 50vw, (max-width: 1439px) 47vw, (max-width: 1919px) 50vw, 748.71533203125px"';
    }
    return $srcset;
}

/**
 * Permite adicionar class, id e backgorund nos elementos (div, section e outros), facilitando a chamada do id para a sessão e as classes
 * @param string|null $class_block é as classes originais do elemento, podendo adicionar novas se desejar, separando eles com espaço, no mesmo formato de class do html
 * @param string|null $bg_block é a class do bootstrap que define a cor do fundo, exemplo: bg-primary, bg-secondary, bg-transparent e outros;
 * @param string|null $id_block é o identificador do bloco/sessão, sempre que usado ele cria automaticamente o atributo "id" com o conteúdo informado;
 */
function idClass($class_block = '', $bg_block = '', $id_block = '') {
    $id = get_field($id_block);
    $id = ($id) ? 'id="'.slugify($id).'"' : '';

    $bg = get_field($bg_block);
    $classes = 'class="'.$class_block.' '.$bg.'"';

    $all = $id.$classes;
    return $all;
}

function getFallBack() {
    $url_fallback = asset('blur.webp');
    return $url_fallback;
}

/**
 * Obtém HTML de mídia baseado no tipo (imagem/vídeo)
 * 
 * @param array $args Argumentos da mídia
 * @return string HTML da mídia
 */
function codix_get_media_html($args = []) {
    $defaults = [
        'type' => 'image',
        'image' => null,
        'video' => null,
        'title' => '',
        'lazy' => true,
        'classes' => '',
    ];
    
    $args = wp_parse_args($args, $defaults);
    
    // Vídeo
    if ($args['type'] === 'video' && $args['video']) {
        $video_url = is_array($args['video']) ? $args['video']['url'] : $args['video'];
        $mime_type = is_array($args['video']) ? $args['video']['mime_type'] : 'video/mp4';
        
        return sprintf(
            '<div class="video-container %s">
                <video class="video-player" controls preload="metadata" poster="%s">
                    <source src="%s" type="%s">
                    %s
                </video>
                <div class="video-play-button">
                    <i class="ri-play-fill"></i>
                </div>
            </div>',
            esc_attr($args['classes']),
            esc_url(getFallBack()),
            esc_url($video_url),
            esc_attr($mime_type),
            esc_html__('Seu navegador não suporta a tag de vídeo.', 'codix')
        );
    }
    
    // Imagem (padrão)
    $img_final = $args['image'] ? (is_array($args['image']) ? $args['image']['url'] : $args['image']) : getFallBack();
    $img_thumb = $args['image'] ? (is_array($args['image']) ? $args['image']['sizes']['thumbnail'] : $args['image']) : getFallBack();
    
    return sprintf(
        '<img data-src="%s" src="%s" loading="%s" class="img-fluid w-100 scroll-image %s" alt="%s">',
        esc_url($img_final),
        esc_url($img_thumb),
        $args['lazy'] ? 'lazy' : 'eager',
        esc_attr($args['classes']),
        esc_attr($args['title'])
    );
}