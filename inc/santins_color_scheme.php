<?php 

/**
 * Colours theme
 */
$bg = get_field( 'cor_de_fundo', 'option' );
$text = get_field( 'cor_do_texto', 'option' );
$button = get_field( 'cor_dos_botoes', 'option' );
$comp = get_field( 'cor_complementar', 'option' );
$logologin = get_field( 'logotipo_para_o_login', 'option' );
$logoLoginUrl = $logologin['url'];

global $bg; global $text; global $button; global $comp; global $logoLoginUrl;

$GLOBALS['bg'] = $bg;
$GLOBALS['text'] = $text;
$GLOBALS['button'] = $button;
$GLOBALS['comp'] = $comp;
$GLOBALS['logoLoginUrl'] = $logoLoginUrl;

/**
 * Santins color scheme
 */
function santins_admin_color_scheme() {
    //Get the theme directory
    $theme_dir = get_template_directory_uri();

    //santins
    wp_admin_css_color( 'santins', __( 'santins' ),
        $theme_dir . '../santins.css',
        array( $GLOBALS['bg'], $GLOBALS['text'], $GLOBALS['button'], $GLOBALS['comp'])
    );
}

add_action('admin_init', 'santins_admin_color_scheme');

/**
 * Login logo
 */
function my_login_logo() { ?>
    <style type="text/css">
        .login {
            background-color: <?php echo $GLOBALS['bg']; ?>;
        }

        .login #backtoblog a, .login #nav a {
            color: <?php echo $GLOBALS['text']; ?> !important;
        }

        .wp-core-ui .button-primary {
            background: <?php echo $GLOBALS['button']; ?> !important;
            border-color: <?php echo $GLOBALS['comp']; ?> !important;
        }

        .wp-core-ui .button-primary:hover, 
        .wp-core-ui .button-primary:focus {
            background: <?php echo $GLOBALS['button']; ?> !important;
            border-color: <?php echo $GLOBALS['comp']; ?> !important;
            opacity: 0.8 !important;
        }

        #login h1 a, .login h1 a {
            background-image: url(<?php echo ($GLOBALS['logoLoginUrl']) ? $GLOBALS['logoLoginUrl'] : image('login-logo.svg'); ?>);
            height: 65px;
            width: 320px;
            background-size: 320px 65px;
            background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'my_login_logo' );