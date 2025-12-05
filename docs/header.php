<!DOCTYPE html><!-- This site was created in Webflow. http://www.webflow.com -->
<!-- Last Published: Wed Feb 24 2021 14:07:25 GMT+0000 (Coordinated Universal Time) -->
<html data-wf-domain="docs-santins.webflow.io" data-wf-page="60365ca71791199c516b1762" data-wf-site="603649186bcfc27fa69d2755" data-wf-status="1">
<?php global $archives; $archives = get_template_directory_uri().'/docs/dist/'; ?>

<head>
    <meta charset="utf-8" />
    <title>Documentação - <?php echo get_the_title(); ?></title>
    <meta content="Post" property="og:title" />
    <meta content="Post" property="twitter:title" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Webflow" name="generator" />
    <link href="<?php echo $GLOBALS['archives'].'css/docs-santins.css'; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo $GLOBALS['archives'].'css/style.css'; ?>" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js" type="text/javascript"></script>
    <script type="text/javascript">
        WebFont.load({
            google: {
                families: [
                    "Poppins:200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,900,900italic"
                ]
            }
        });
    </script>
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif]-->
    <script type="text/javascript">
        ! function (o, c) {
            var n = c.documentElement,
                t = " w-mod-";
            n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n
                .className += t + "touch")
        }(window, document);
    </script>
    <link href="<?php echo $GLOBALS['archives'].'img/logo_santins.png'; ?>" rel="shortcut icon" type="image/x-icon" />
    <link href="https://uploads-ssl.webflow.com/img/webclip.png" rel="apple-touch-icon" />
</head>

<body class="body-docs">
    <header class="header-docs">
        <div class="container">
            <div class="header-flex">
                <a href="<?php echo home_url().'/docs'; ?>" class="header-brand">
                    <img
                        src="<?php echo $GLOBALS['archives'].'img/logo_santins.png'; ?>"
                        loading="lazy" alt="" class="header-logo" />
                </a>
                <a href="<?php echo (is_single()) ? home_url().'/docs' : home_url(); ?>" class="header-back w-inline-block">
                    <div><span class="icon"></span> <?php echo (is_single()) ? 'Voltar para a home' : 'Voltar para o site'; ?></div>
                </a>
            </div>
        </div>
    </header>