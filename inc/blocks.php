<?php
add_filter( 'allowed_block_types', 'misha_allowed_block_types', 10, 2 );

function misha_allowed_block_types( $allowed_blocks, $post ) {
    $allowed_blocks = array(
        'acf/space',
        'acf/slider',
        'acf/cards',
        'acf/cards-featured',
        'acf/gallery',
        'acf/clients',
        'acf/blog',
        'acf/form',
        'acf/cta',
        'acf/about',
        'acf/hero',
        'acf/products',
        'acf/posts',
        'acf/team'
	);
    if ( $post->post_type === 'post' ) {
        $allowed_blocks = array(
            'core/heading',
            'core/paragraph',
            'core/image',
            'core/quote',
            'core/file',
            'core/code',
            'core/separator',
            'core/embed',
			'core/list'
        );
    }
    if ( $post->post_type === 'docs' ) {
		$allowed_blocks = array(
			'core/heading',
			'core/paragraph',
			'core/image',
			'core/quote',
			'core/list'
		);
	}
    return $allowed_blocks;
}

// Removendo blocos do gutenberg post type post
// add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
// function prefix_disable_gutenberg($current_status, $post_type)
// {
//     if ($post_type === 'page') return false;
//     return $current_status;
// }

/**
 * Create categories for gutenberg blocks
 * @param  string $categories
 * @param  string $post
 * @return string New category in gutenberg blocks
 */
function my_plugin_block_categories( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'codix',
                'title' => __( 'Codix', 'codix' ),
                'icon'  => 'smiley',
            ),
        )
    );
}
add_filter( 'block_categories', 'my_plugin_block_categories', 10, 2 );

add_theme_support('align-wide');

/**
 * Create categories for gutenberg blocks
 * @param  string $name_block use in allowed blocks and $template_location
 * @param  string $title_block name for user
 * @param  string $description text for user
 * @param  string $icon for view frindly block. Search icon in https://developer.wordpress.org/resource/dashicons/
 * @param string $keywords is array keys for user search
 * @return block block content
 */
function regBlocks($name_block, $title_block, $description, $icon, $keywords) {
    $temp = $name_block;
    $ico = ($icon) ? $icon : 'table-row-before';
    if( function_exists('acf_register_block') ) {	
        $result = acf_register_block(array(
            'name'			 	    => $name_block,
            'title'				    => __($title_block),
            'description'           => __($description),
            'render_template'	    => 'partials/blocks/'.$temp.'.php',
            'category'		        => 'codix',
            'icon'			  	    => $ico,
            'keywords'		 	    => $keywords,
            'mode'                  => 'edit',
            'align'                 => 'full',
        ));
    }
}

// Bloco Espaçador
$keyBlock = array('espacador', 'space', 'espaçador', 'padding', 'margin', 'margem', 'espaço', 'espaco');
regBlocks('space', 'Espaçador', 'Este bloco pode ser utilizado para adicionar espaços entre os blocos da página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('slider', 'slides', 'imagens', 'images', 'imagem', 'carrossel', 'caroussel', 'carousel');
regBlocks('slider', 'Slide de imagens', 'Este bloco pode ser utilizado para adicionar um slide de imagens na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('cards', 'icones', 'icons', 'texto', 'sobre', 'empresa', 'about', 'cardis', 'servicos', 'serviços', 'services');
regBlocks('cards', 'Cards de conteúdo', 'Este bloco pode ser utilizado para adicionar cards de conteúdo na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('cards', 'images', 'imagens', 'texto', 'imagem', 'intercalados', 'destacados', 'featured', 'interspersed', 'mídia', 'destaque');
regBlocks('cards-featured', 'Cards destacados', 'Este bloco pode ser utilizado para adicionar cards destacados com texto e imagem na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('gallery', 'images', 'imagens', 'galeria', 'imagem', 'galery', 'galeri', 'galleri', 'galerias', 'fotos', 'photos');
regBlocks('gallery', 'Galeria de imagens', 'Este bloco pode ser utilizado para adicionar uma galeria de imagens na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('gallery', 'images', 'imagens', 'galeria', 'imagem', 'galery', 'galeri', 'galleri', 'galerias', 'fotos', 'photos', 'logotipo', 'clientes', 'clients', 'marca');
regBlocks('clients', 'Logotipo de clientes', 'Este bloco pode ser utilizado para adicionar logotipos de clientes na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('cards', 'blog', 'noticias', 'notícias', 'notices', 'posts', 'info', 'infotmativo', 'informative', 'publicação', 'publicacao');
regBlocks('blog', 'Blog de notícias', 'Este bloco pode ser utilizado para adicionar posts de notícias na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('form', 'formulário', 'formulario', 'contato', 'contact', 'input', 'contatos', 'fale', 'conosco');
regBlocks('form', 'Formulário de contato', 'Este bloco pode ser utilizado para adicionar um formulário de contato na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('cta', 'whatsapp', 'destaque', 'imagem', 'video', 'image', 'images', 'imagens', 'midia');
regBlocks('cta', 'Contato direto', 'Este bloco pode ser utilizado para adicionar um botão com contato direto na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('about', 'sobre', 'empresa', 'businees', 'business', 'image', 'images', 'imagens', 'midia', 'text', 'texto', 'imagem');
regBlocks('about', 'Sobre a empresa', 'Este bloco pode ser utilizado para adicionar um texto e imagem sobre a empresa na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('hero', 'image', 'images', 'imagens', 'imagem', 'page', 'cabeçalho', 'páginas', 'pagina', 'pages', 'topo', 'header', 'título', 'titulo', 'title');
regBlocks('hero', 'Hero', 'Este bloco pode ser utilizado para adicionar um título com imagem na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('posts', 'publicações', 'produtos', 'products', 'imagem', 'images', 'imagens', 'publicacoes', 'publicação', 'publicacao');
regBlocks('products', 'Produtos', 'Este bloco pode ser utilizado para adicionar posts de produtos na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('posts', 'publicações', 'noticias', 'notícias', 'notices', 'images', 'imagens', 'publicacoes', 'publicação', 'publicacao');
regBlocks('posts', 'Publicações', 'Este bloco pode ser utilizado para adicionar posts de notícias na página.', 'media-spreadsheet', $keyBlock);

$keyBlock = array('team', 'time', 'membros', 'members', 'presidents', 'presidentes', 'funcionarios', 'funcionários', 'equipe', 'work');
regBlocks('team', 'Equipe', 'Este bloco pode ser utilizado para adicionar membros da equipe na página.', 'media-spreadsheet', $keyBlock);
?>
