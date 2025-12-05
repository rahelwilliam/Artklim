<?php
/**
 * ACF Master Page
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
        'page_title'  => 'Master',
        'menu_title'  => 'Master',
        'menu_slug'   => 'master',
        'position'    => 1,
        'icon_url'    => 'dashicons-editor-code',
    ));	
}

/**
 * Create and get elements default for theme
 */
global $autor; global $url_autor;

$emp = get_bloginfo( 'name' );
$url_emp = home_url();
$url_autor = get_field( 'url_da_empresa_desenvolvedora', 'option' );
$autor = get_field( 'nome_da_empresa_desenvolvedora', 'option' );
$text = 'Este é um tema criado pela empresa '.$autor.', exclusivamente para a empresa '.$emp.'. O tema traz um layout intuitivo, com responsividade e com suporte para a maioria dos dispositivos da atualidade. Seu gerenciador permite flexibilidade na criação das páginas, com uso dos blocos gutenberg e tecnologia de ponta.';
$tag = 'blog, landing-page, background-cutomizado, logo-customizado, scripts-adicionais, blocos-flexiveis, slide-imagens, responsivo, redes-sociais';
$v = date("F d Y H:i:s.", filemtime( get_template_directory() . '/inc/blocks.php' ));
$v_req = get_bloginfo('version');
$v_php = phpversion();
$lic = 'GNU General Private Copying License v2 or later';
$lic_url = 'http://www.gnu.org/licenses/gpl-2.0.html';

$GLOBALS['autor'] = $autor;
$GLOBALS['url_autor'] = $url_autor;

/**
 * Custom footer admin
 */
function remove_footer_admin () {
    echo 'Obrigado por escolher a <a href="'.$GLOBALS['url_autor'].'" target="_blank">'.$GLOBALS['autor'].'</a>.</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/**
 * Create custom card for painel
 */
function isb_custom_dashboard() {
    echo '<p>Seja bem vindo ao painel administrativo desenvolvido pela empresa '.$GLOBALS['autor'].'!<br/>
    Esse é o nosso painel informativo com dados importantes. Para dúvidas, sugestões ou reclamações, por favor acesse <a href="'.$GLOBALS['url_autor'].'" target="_blank">'.$GLOBALS['url_autor'].'</a>.<br/><br/></p>';
}

/**
 * Apply custom card for painel
 */
function isb_dashboard_widgets() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget('custom_help_widget', 'Informações úteis', 'isb_custom_dashboard');
}
add_action('wp_dashboard_setup', 'isb_dashboard_widgets');

/**
 * Create style.css for theme infos
 */
function builder_theme_css($emp = '', $url_emp = '', $autor = '', $url_autor = '', $text = '', $tag = '', $v = '', $v_req = '', $v_php = '', $lic = '', $lic_url = '') {
    // criando layout do arquivo
    $in = "/*\n";
    $theme_name = "Theme Name: ".$emp."\n";
    $theme_url = "Theme URI: ".$url_emp."\n";
    $theme_autor = "Author: ".$autor."\n";
    $autor_url = "Author URI: ".$url_autor."\n";
    $desc = "Description: ".$text."\n";
    $tags = "Tags: ".$tag."\n";
    $version = "Version: ".$v."\n";
    $req_wp = "Requires at least: ".$v_req."\n";
    $req_test = "Tested up to: ".$v_req."\n";
    $req_php = "Requires PHP: ".$v_php."\n";
    $license = "License: ".$lic."\n";
    $license_url = "License URI: ".$lic_url."\n";
    $domain = "Text Domain: ".$autor."\n";
    $exclusive = "Use-o exclusivamente para sua empresa.\n";
    $out = "*/";

    // criando arquivo style.css para o tema
    $content = $in.$theme_name.$theme_url.$theme_autor.$autor_url.$desc.$tags.$version.$req_wp.$req_test.$req_php.$license.$license_url.$domain.$exclusive.$out;
    $myfile = fopen( get_template_directory() . "/style.css", "w");
    fwrite($myfile, $content);
    fclose($myfile);
}

/**
 * Apply archives for theme infos
 */
if(get_field( 'gerador_de_tema', 'option' ) == true) {
    builder_theme_css($emp, $url_emp, $autor, $url_autor, $text, $tag, $v, $v_req, $v_php, $lic, $lic_url);
}