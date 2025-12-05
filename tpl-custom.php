<?php
/*
    Template Name: Custom
*/
?>
<?php get_header(); ?>

<?php $lg = get_field('logotipo_principal', 'option'); $logo = ($lg) ? $lg['url'] : image('logotipo-simple.png');  ?>
<?php $lgi = get_field('logotipo_invertido', 'option'); $logo_i = ($lgi) ? $lgi['url'] : image('logotipo-white.png');  ?>
<?php $tm = get_field('tamanho_da_imagem_em_px', 'option'); ?>
<?php $n = get_field('nome_da_empresa'); $ap = get_field('apelido_da_empresa'); ?>
<?php $nome = ($n) ? $n : get_the_title(); ?>
<?php $apelido = ($ap) ? $ap : $nome; ?>
<?php $city = get_field('cidade_ou_regiao'); $cidade = ($city) ? $city : 'Cidade'; ?>
<?php $endereco = get_field('endereco'); ?>
<?php $botao = get_field('nome_e_link_do_botao_principal'); $botaoTitle = ($botao) ? $botao['title'] : 'Assine já'; ?>

<?php
$sections = get_field('secoes_do_site');
if( $sections ) { ?>
    <style>
        <?php echo 'section { display: none; }'; ?>
    </style>
    <?php
    foreach( $sections as $section ): 
    if($section) { ?>
        <style>
            <?php echo 'section[data-id="'.$section.'"] { display: block; }'; ?>
        </style>
    <?php } 
    endforeach;
} ?>

<!-- Header -->
<header class="is-transparent is-sticky is-shrink" id="header">
    <div class="header-main">
        <div class="header-container container">
            <div class="header-wrap">
                <!-- Logo  -->
                <div class="header-logo logo">
                    <a href="<?php echo home_url(); ?>" class="logo-link">
                        <img class="logo-dark" <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?> src="<?php echo $logo; ?>"
                            srcset="<?php echo $logo; ?> 2x" alt="logo">
                        <img class="logo-light" <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?> src="<?php echo $logo_i; ?>"
                            srcset="<?php echo $logo_i; ?> 2x" alt="logo">
                    </a>
                </div>

                <!-- Menu Toogle -->
                <div class="header-nav-toggle">
                    <a href="#" class="search search-mobile search-trigger"><i class="icon ti-search "></i></a>
                    <a href="#" class="navbar-toggle" data-menu-toggle="header-menu">
                        <div class="toggle-line">
                            <span></span>
                        </div>
                    </a>
                </div>
                <!-- Menu Toogle -->

                <!-- Menu -->
                <div class="header-navbar">
                    <nav class="header-menu" id="header-menu">
                        <ul class="menu">
                            <?php 
                            if( have_rows('menus') ) {

                                while ( have_rows('menus') ) : the_row(); $link = get_sub_field('item_do_menu'); ?>
                                    <li class="menu-item">
                                        <a class="menu-link nav-link active" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                                    </li>  

                                <?php 
                                endwhile;

                            } else { ?>
                                <li class="menu-item">
                                    <a class="menu-link nav-link active" href="<?php echo home_url(); ?>">Início</a>
                                </li>
                                <li class="menu-item"><a class="menu-link nav-link" href="#">Serviços</a></li>
                                <li class="menu-item"><a class="menu-link nav-link" href="#solidariedade">Solidariedade</a>
                                </li>
                                <li class="menu-item"><a class="menu-link nav-link" href="#">Clientes</a></li>
                                <li class="menu-item"><a class="menu-link nav-link" href="#planos">Planos</a></li>
                                <li class="menu-item"><a class="menu-link nav-link" href="#contato">Contato</a></li>
                            <?php } ?>
                            
                        </ul>
                        <ul class="menu-btns">
                            <li><a href="" class="btn search search-trigger"><i class="icon ti-search "></i></a></li>
                            <li><a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="btn btn-sm"><?php echo $botaoTitle; ?></a></li>
                        </ul>
                    </nav>
                </div><!-- .header-navbar -->

                <!-- header-search -->
                <div class="header-search">
                    <form role="search" method="POST" class="search-form" action="#">
                        <div class="search-group">
                            <input type="text" class="input-search" placeholder="Digite sua busca aqui ...">
                            <button class="search-submit" type="submit"><i class="icon ti-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- . header-search -->
            </div>
        </div>
    </div>

    <?php if( have_rows('slides_de_imagens') ): ?>
        <!-- banner / slider -->
        <section data-id="slider" class="banner banner-s4 has-slider">
            <div class="has-carousel" data-effect="true" data-items="1" data-loop="true" data-dots="false" data-auto="true"
                data-navs="true">

                <?php while( have_rows('slides_de_imagens') ) : the_row(); ?>
                    <?php $image = get_sub_field('imagem_para_o_slide'); ?>
                    <div class="banner-block tc-light d-flex">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 col-xl-8">
                                    <div class="banner-content">
                                        <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                            data-duration="0.5"><?php echo get_sub_field('titulo_para_o_slide'); ?></h1>
                                        <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.12"
                                            data-duration="0.5"><?php echo get_sub_field('texto_para_o_slide'); ?></p>
                                        <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.20"
                                            data-duration="0.9">
                                            <?php $botao_sl = get_sub_field('botao_do_slide'); ?>
                                            <?php if($botao_sl) { ?>
                                                <a href="<?php echo $botao_sl['url']; ?>" target="<?php echo $botao_sl['target']; ?>" class="menu-link btn"><?php echo $botao_sl['title']; ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- bg -->
                        <div class="bg-image change-bg overlay-theme-dark overlay-opacity-60">
                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['title']; ?>">
                        </div>
                        <!-- end bg -->
                    </div>
                <?php endwhile; ?>

            </div>
            <div class="tes-arrow">
                <a class="slick-prev slick-arrow" style=""><i class="icon ti ti-angle-left"></i></a>
                <a class="slick-next slick-arrow" style=""><i class="icon ti ti-angle-right"></i></a>
            </div>
        </section>
        <!-- .slider / banner -->

    <?php else : ?>
        <!-- banner / slider -->
        <section data-id="slider" class="banner banner-s4 has-slider">
            <div class="has-carousel" data-effect="true" data-items="1" data-loop="true" data-dots="false" data-auto="true"
                data-navs="true">
                <div class="banner-block tc-light d-flex">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10 col-xl-8">
                                <div class="banner-content">
                                    <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                        data-duration="0.5">Conectando pessoas para um futuro melhor!</h1>
                                    <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.12"
                                        data-duration="0.5">Nunca foi tão fácil ter acesso a internet de qualidade como
                                        agora!</p>
                                    <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.20"
                                        data-duration="0.9">
                                        <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="menu-link btn"><?php echo $botaoTitle; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bg -->
                    <div class="bg-image change-bg">
                        <img src="<?php echo image('internet-black.jpg'); ?>" alt="banner">
                    </div>
                    <!-- end bg -->
                </div>
                <div class="banner-block tc-light d-flex">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-1 col-xl-8 offset-xl-0">
                                <div class="banner-content">
                                    <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                        data-duration="0.5">1° lugar em velocidade em <?php echo $cidade; ?></h1>
                                    <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.7"
                                        data-duration="0.5">Nossa solução de telecomunicações é a mais avançada e segura,
                                        permitindo a você se conectar com o mundo</p>
                                    <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.10"
                                        data-duration="0.9">
                                        <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="menu-link btn"><?php echo $botaoTitle; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bg -->
                    <div class="bg-image change-bg">
                        <img src="<?php echo image('internet-3.jpg'); ?>" alt="banner">
                    </div>
                    <!-- end bg -->
                </div>
                <div class="banner-block tc-light d-flex">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-1 col-xl-8 offset-xl-0">
                                <div class="banner-content">
                                    <h1 class="banner-heading animate t-u" data-animate="fade-in-up" data-delay="0.5"
                                        data-duration="0.5">A internet mais rápida, da sua região!</h1>
                                    <p class="lead lead-lg animate" data-animate="fade-in-up" data-delay="0.7"
                                        data-duration="0.5">Oferecemos as melhores soluções de conectividade para que você
                                        possa usufruir dos benefícios da tecnologia</p>
                                    <div class="banner-btn animate" data-animate="fade-in-up" data-delay="0.10"
                                        data-duration="0.9">
                                        <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="menu-link btn"><?php echo $botaoTitle; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- bg -->
                    <div class="bg-image change-bg">
                        <img src="<?php echo image('app-slider.jpg'); ?>" alt="banner">
                    </div>
                    <!-- end bg -->
                </div>
            </div>
            <div class="tes-arrow">
                <a class="slick-prev slick-arrow" style=""><i class="icon ti ti-angle-left"></i></a>
                <a class="slick-next slick-arrow" style=""><i class="icon ti ti-angle-right"></i></a>
            </div>
        </section>
        <!-- .slider / banner -->
    <?php endif; ?>
        
</header>
<!-- end header -->

<?php if( have_rows('cards_de_servico') ): ?>
    <!-- section -->
    <section data-id="cards" class="section section-x <?php echo get_field('cor_de_fundo_da_secao_cards'); ?> <?php echo (get_field('secao_flutuante')) ? get_field('secao_flutuante') : 'section-feature-overlap'; ?>">
        <div class="container">
            <div class="row justify-content-center gutter-vr-30px">

                <?php while( have_rows('cards_de_servico') ) : the_row(); ?>
                    <div class="col-md-6 col-lg-4 text-center">
                        <div class="feature feature-alt feature-s3 shadow-alt">
                            <div class="feature-icon">
                                <em class="<?php echo get_sub_field('icone_de_servico'); ?>"></em>
                            </div>
                            <div class="feature-content">
                                <h3><?php echo get_sub_field('titulo_do_card'); ?></h3>
                                <p><?php echo get_sub_field('texto_do_card'); ?></p>
                                <!-- <a href="florida-service-single.html" class="btn btn-arrow">Read More</a> -->
                            </div>
                        </div>
                    </div><!-- .col -->
                <?php endwhile; ?>

                </div><!-- .row -->
        </div><!-- .container -->
    </section>
    <!-- .section -->

<?php else : ?>
    <!-- section -->
    <section data-id="cards" class="section section-x <?php echo get_field('cor_de_fundo_da_secao_cards'); ?>  <?php echo get_field('secao_flutuante'); ?>">
        <div class="container">
            <div class="row justify-content-center gutter-vr-30px">
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="feature feature-alt feature-s3 shadow-alt">
                        <div class="feature-icon">
                            <em class="ti-rocket"></em>
                        </div>
                        <div class="feature-content">
                            <h3>Alta velocidade</h3>
                            <p>Navegue sem travamentos ou quedas na internet, com uma tecnologia de 100% fibra óptica</p>
                            <!-- <a href="florida-service-single.html" class="btn btn-arrow">Read More</a> -->
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="feature feature-alt feature-s3 shadow-alt">
                        <div class="feature-icon">
                            <em class="ti-signal"></em>
                        </div>
                        <div class="feature-content">
                            <h3>Mais alcance</h3>
                            <p>Maior cobertura de wifi para você e sua família, alcansando toda sua casa ou escritório de
                                trabalho</p>
                            <!-- <a href="florida-service-single.html" class="btn btn-arrow">Read More</a> -->
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-6 col-lg-4 text-center">
                    <div class="feature feature-alt  feature-s3 shadow-alt">
                        <div class="feature-icon">
                            <em class="ti-ruler-alt-2"></em>
                        </div>
                        <div class="feature-content">
                            <h3>Estabilidade</h3>
                            <p>Assista suas séries ou jogos sem travamento, com a internet mais rápida de região</p>
                            <!-- <a href="florida-service-single.html" class="btn btn-arrow">Read More</a> -->
                        </div>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section>
    <!-- .section -->

<?php endif; ?>

<?php if( have_rows('cards_intercalados') ): ?>
    <!-- section -->
    <section data-id="cards2" class="section section-x pt-0">
        <div class="container">
            <?php $ci=0; while( have_rows('cards_intercalados') ) : the_row(); ?>
                <div class="row gutter-vr-30px">
                    <div class="col-md-6 <?php echo ($ci % 2 == 0) ? 'order-md-last' : ''; ?>">
                        <div class="bg-img">
                            <div class="bg-image">
                                <img src="<?php $img_card = get_sub_field('imagem_do_card'); echo ($img_card) ? $img_card['url'] : image('familia.jpg'); ?>" alt="">
                            </div>
                        </div>
                    </div><!-- .col -->
                    <div class="col-md-6">
                        <div class="text-block fw-3 <?php echo ($ci % 2 == 0) ? 'tc-light bg-primary' : 'bg-secondary'; ?> block-pad-xl">
                            <?php echo (get_sub_field('sobre_titulo')) ? '<h5 class="heading-xs '.(($ci % 2 == 0) ? '' : 'no-line tc-alt').'">'.get_sub_field('sobre_titulo').'</h5>' : ''; ?>
                            <?php echo (get_sub_field('titulo')) ? '<h2>'.get_sub_field('titulo').'</h2>' : ''; ?>
                            <?php echo (get_sub_field('texto_do_card')) ? '<p class="'.(($ci % 2 == 0) ? '' : 'tc-grey').'">'.get_sub_field('texto_do_card').'</p>' : ''; ?>
                            <?php $bt_card = get_sub_field('botao_do_card'); echo ($bt_card) ? '<a href="'.$bt_card['url'].'" class="btn '.(($ci % 2 == 0) ? 'btn-outline' : '').'" target="'.$bt_card['target'].'">'.$bt_card['title'].'</a>' : ''; ?>
                        </div>
                    </div><!-- .col -->
                </div><!-- .row -->
                <div class="gap"></div>
            <?php $ci++; endwhile; ?>
        </div>
    </section>
    <!-- .section -->

<?php else : ?>
    <!-- section -->
    <section data-id="cards2" class="section section-x pt-0">
        <div class="container">
            <div class="row gutter-vr-30px">
                <div class="col-md-6 order-md-last">
                    <div class="bg-img">
                        <div class="bg-image">
                            <img src="<?php echo image('familia.jpg'); ?>" alt="">
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-6">
                    <div class="text-block fw-3 tc-light bg-primary block-pad-xl">
                        <h5 class="heading-xs">Particular</h5>
                        <h2>Planos Residenciais</h2>
                        <p>Venha desfrutar da melhor conexão de Internet Residencial para sua casa! Nossa solução oferece
                            velocidades ultra-rápidas, conectividade confiável e segurança de rede robusta. </p>
                        <a href="#" class="btn btn-outline">Eu quero!</a>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
            <div class="gap"></div>
            <div class="row gutter-vr-30px">
                <div class="col-md-6">
                    <div class="bg-img">
                        <div class="bg-image">
                            <img src="<?php echo image('empresa.jpg'); ?>" alt="">
                        </div>
                    </div>
                </div><!-- .col -->
                <div class="col-md-6">
                    <div class="text-block fw-3 bg-secondary block-pad-xl">
                        <h5 class="heading-xs no-line tc-alt">Profissional</h5>
                        <h2>Planos Empresariais</h2>
                        <p class="tc-grey">A internet é essencial para o sucesso de qualquer negócio. Na vida digital,
                            oferecemos planos de internet empresarial para atender às necessidades de pequenas, médias e
                            grandes empresas.</p>
                        <a href="#" class="btn">Minha empresa quer!</a>
                    </div>
                </div>
            </div><!-- .row -->
        </div>
    </section>
    <!-- .section -->
<?php endif; ?>


<?php 
$images = get_field('galeria_de_imagens');
if( $images ) { ?>

    <!-- section -->
    <section data-id="galeria" class="section section-x bg-secondary section-project pb-0" id="solidariedade">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-7 text-center">
                    <div class="section-head">
                        <?php echo (get_field('sobre_titulo_de_galeria')) ? '<h5 class="heading-xs">' . get_field('sobre_titulo_de_galeria') . '' : '</h5>'; ?>
                        <?php echo (get_field('titulo_de_galeria')) ? '<h2>' . get_field('titulo_de_galeria') . '' : '</h2>'; ?>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- project filter -->
                    <ul class="project-filter project-md">
                        <li class="active" data-filter="all">Toda galeria</li>
                        <?php
                        if( have_rows('categoria_de_imagem') ) {
                            $cat=1;
                            while( have_rows('categoria_de_imagem') ) : the_row();

                                $sub_value = get_sub_field('texto_para_categoria');
                                echo '<li data-filter="'.$cat.'">'.$sub_value.'</li>';
                            
                            $cat++;
                            endwhile;

                        } else { ?>

                            <li data-filter="1"><?php echo $nome; ?></li>
                            <li data-filter="2">Dia das Crianças</li>
                            <li data-filter="3">Natal</li>
                            <li data-filter="4">Ano Novo</li> 

                        <?php } ?>
                    </ul>
                    <!-- .project-filter -->
                </div>
            </div>
        </div><!-- .container -->

        <div class="project-area">
            <div class="row project project-v5 no-gutters" id="project1">
                <?php foreach( $images as $image ): ?>

                    <div class="col-sm-6 col-lg-3 filtr-item" data-category="<?php echo ($image['description']) ? $image['description'] : '1'; ?>">
                        <span>
                            <div class="project-item">
                                <div class="project-image">
                                    <img src="<?php echo ($image) ? $image['url'] : image('project-a.jpg'); ?>" alt="<?php echo ($image) ? $image['alt'] : get_the_title(); ?>">
                                </div>
                                <div class="project-over">
                                    <div class="project-content">
                                        <h4><?php echo esc_html($image['alt']); ?></h4>
                                        <p><?php echo esc_html($image['caption']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </span>
                    </div><!-- .col -->
                    
                <?php endforeach; ?>
            </div>
            <!-- project -->
        </div>

<?php } else { ?>

    <!-- section -->
    <section data-id="galeria" class="section section-x bg-secondary section-project pb-0" id="solidariedade">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-7 text-center">
                    <div class="section-head">
                        <h5 class="heading-xs">A solidariedade nos fortalece</h5>
                        <h2>Que o nosso bem, faça bem <br>ao outro também!</h2>
                    </div>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <!-- project filter -->
                    <ul class="project-filter project-md">
                        <li class="active" data-filter="all">Todas as ações</li>
                        <li data-filter="1"><?php echo $nome; ?></li>
                        <li data-filter="2">Dia das Crianças</li>
                        <li data-filter="3">Natal</li>
                        <li data-filter="4">Ano Novo</li>
                    </ul>
                    <!-- .project-filter -->
                </div>
            </div>
        </div><!-- .container -->

        <div class="project-area">
            <div class="row project project-v5 no-gutters" id="project1">
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="1">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-a.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="1,2">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-b.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="3,4">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-c.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="1,2,3">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-d.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="2">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-e.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="3,4">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-f.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="1.2">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-g.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
                <div class="col-sm-6 col-lg-3 filtr-item" data-category="2,4">
                    <a href="#">
                        <div class="project-item">
                            <div class="project-image">
                                <img src="<?php echo image('project-h.jpg'); ?>" alt="">
                            </div>
                            <div class="project-over">
                                <div class="project-content">
                                    <h4>Landing Page </h4>
                                    <p>UI/UX Design</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div><!-- .col -->
            </div>
            <!-- project -->
        </div>
    </section>
    <!-- .section -->

<?php } ?>

<!-- section / testimonial -->
<section data-id="testemunhas" class="section section-x">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="section-head">
                    <h5 class="heading-xs"><?php echo (get_field('sobre_titulo_de_testemunhos')) ? get_field('sobre_titulo_de_testemunhos') : 'Testemunhas'; ?></h5>
                    <h2><?php echo (get_field('titulo_de_testemunhos')) ? get_field('titulo_de_testemunhos') : 'O que os clientes falam sobre nós'; ?></h2>
                    <p class="lead"><?php echo (get_field('texto_de_testemunhos')) ? get_field('texto_de_testemunhos') : 'Nós disponibilizamos um espaço para ouvir um pouco sobre a experiência de nossos
                        clientes conosco.'; ?></p>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->

        <div class="tes tes-s3">
            <div class="row has-carousel" data-items="3" data-loop="true" data-auto="true" data-dots="true">
                <div class="tes-block">
                    <div class="tes-content bg-light shadow-alt">
                        <p>A <?php echo $apelido; ?> foi a melhor escolha que eu poderia ter feito! Os serviços são rápidos, confiáveis e a
                            equipe de suporte é incrível. Estou muito satisfeito com a escolha! </p>
                    </div>
                    <div class="tes-author d-flex align-items-center">
                        <div class="author-image">
                            <img src="<?php echo image('cliente-1.jpg'); ?>" alt="Author Image">
                        </div>
                        <div class="author-con">
                            <h6 class="author-name t-u">Antonio Silva</h6>
                            <p>Contador</p>
                        </div>
                    </div>
                </div><!-- .tes-block -->

                <div class="tes-block ">
                    <div class="tes-content bg-light shadow-alt">
                        <p>Eu fui surpreendido com a qualidade do serviço da <?php echo $apelido; ?>. Estou muito satisfeito
                            com a velocidade e a estabilidade do serviço. </p>
                    </div>
                    <div class="tes-author d-flex align-items-center">
                        <div class="author-image">
                            <img src="<?php echo image('cliente-2.jpg'); ?>" alt="Author Image">
                        </div>
                        <div class="author-con">
                            <h6 class="author-name t-u">Maria Costa</h6>
                            <p>Médica</p>
                        </div>
                    </div>
                </div><!-- .tes-block -->


                <div class="tes-block">
                    <div class="tes-content bg-light shadow-alt">
                        <p>É uma grande alegria ter a <?php echo $apelido; ?> como meu provedor de serviços. Os serviços são
                            excelentes e a equipe de suporte é muito atenciosa.</p>
                    </div>
                    <div class="tes-author d-flex align-items-center">
                        <div class="author-image">
                            <img src="<?php echo image('cliente-4.jpg'); ?>" alt="Author Image">
                        </div>
                        <div class="author-con">
                            <h6 class="author-name t-u">Ana Almeida</h6>
                            <p>Advogada</p>
                        </div>
                    </div>
                </div><!-- .tes-block -->

                <div class="tes-block">
                    <div class="tes-content bg-light shadow-alt">
                        <p>Estou muito satisfeito com a escolha de contratar a <?php echo $apelido; ?> como meu provedor. A
                            velocidade é incrível e a equipe de suporte muito prestativa. </p>
                    </div>
                    <div class="tes-author d-flex align-items-center">
                        <div class="author-image">
                            <img src="<?php echo image('cliente-5.jpg'); ?>" alt="Author Image">
                        </div>
                        <div class="author-con">
                            <h6 class="author-name t-u">Paulo Carvalho</h6>
                            <p>Engenheiro</p>
                        </div>
                    </div>
                </div><!-- .tes-block -->

                <div class="tes-block">
                    <div class="tes-content bg-light shadow-alt">
                        <p>A <?php echo $apelido; ?> é uma ótima opção para quem procura serviços de qualidade. A velocidade
                            é impressionante e a estabilidade dos serviços é excelente.</p>
                    </div>
                    <div class="tes-author d-flex align-items-center">
                        <div class="author-image">
                            <img src="<?php echo image('cliente-6.jpg'); ?>" alt="Author Image">
                        </div>
                        <div class="author-con">
                            <h6 class="author-name t-u">Letícia Pinheiro</h6>
                            <p>Professora</p>
                        </div>
                    </div>
                </div><!-- .tes-block -->
            </div><!-- .row -->
        </div>
    </div><!-- .container -->
</section>
<!-- .section -->

<!-- logo -->
<section data-id="clientes" class="section section-x bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="section-head section-md">
                    <h5 class="heading-xs"><?php echo (get_field('sobre_titulo_para_clientes')) ? get_field('sobre_titulo_para_clientes') : 'Clientes'; ?></h5>
                    <h2><?php echo (get_field('titulo_para_clientes')) ? get_field('titulo_para_clientes') : 'Parceiros que confiam no nosso trabalho'; ?></h2>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->

        <div class="row justify-content-center gutter-vr-40px">
            <?php 
            $galeria_de_clientes = get_field('galeria_de_clientes');
            if( $galeria_de_clientes ) { ?>

                <?php foreach( $galeria_de_clientes as $image_cli ): ?>
                    <div class="col-sm-3 col-5 d-flex align-items-center">
                        <div class="logo-item">
                            <img src="<?php echo ($image_cli) ? $image_cli['url'] : image('cliente-logo-1.png'); ?>" alt="<?php echo ($image_cli['alt']) ? $image_cli['alt'] : get_the_title(); ?>">
                        </div>
                    </div><!-- .col -->
                <?php endforeach; ?>

            <?php } else { ?>
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-1.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-2.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-3.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-4.webp'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-5.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-6.svg'); ?>" alt="">
                    </div>
                </div><!-- .col -->
                <div class="col-sm-3 col-5 d-flex align-items-center">
                    <div class="logo-item">
                        <img src="<?php echo image('cliente-logo-7.png'); ?>" alt="">
                    </div>
                </div><!-- .col -->
            <?php } ?>
        </div><!-- .row -->
    </div><!-- .container -->
</section>
<!-- .logo -->

<!-- section-news -->
<div class="section section-x bg-secondary section-news">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-6 text-center">
                <div class="section-head section-sm">
                    <h5 class="heading-xs">Novidades</h5>
                    <h2>Tudo que você precisa saber sobre arbitragem gaúcha em um só lugar</h2>
                </div>
            </div>
        </div><!-- .row -->
        <div class="row gutter-vr-30px justify-content-sm-center">
            <?php
            $itemArgs = [
                'post_type' => 'post',
                'posts_per_page' => 3
            ];

            $items = new WP_Query($itemArgs);

            if( $items->have_posts() ) :
                while( $items->have_posts() ) :                        
                    $items->the_post(); ?>
                    <div class="col-sm-8 col-md-4 text-center">
                        <div class="post post-alt">
                            <div class="post-thumb cover">
                                <a href="<?php echo get_the_permalink($post->ID); ?>">
                                    <img src="<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_url($post->ID) : image('post-thumb-b.jpg'); ?>" alt="<?php echo (has_post_thumbnail($post->ID)) ? get_the_post_thumbnail_caption($post->ID) : get_the_title($post->ID); ?>" />
                                </a>
                            </div>
                            <div class="post-content">
                                <p class="post-tag"><?php echo get_the_date('d/m/Y'); ?></p>
                                <h4>
                                    <a href="<?php echo get_the_permalink($post->ID); ?>">
                                        <?php echo get_the_title($post->ID); ?>
                                    </a>
                                </h4>
                                <a href="<?php echo get_the_permalink($post->ID); ?>" class="btn btn-arrow">Ler Mais</a>
                            </div>
                        </div><!-- .post -->
                    </div><!-- .col -->

                <?php endwhile;
            else : ?>
                    <p><?php esc_html_e( 'Desculpe, não foi possível trazer posts.' ); ?></p>
            <?php 
            endif; 
            ?>
        </div><!-- .row -->
        <div class="row">
            <div class="col-12 text-center">
                    <div class="button-area button-area-sm">
                            <a href="florida-news.html" class="btn">Ver todas</a>
                    </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</div>
<!-- .section-news -->

<!-- section -->
<section data-id="numeros" class="section tc-light section-x section-counter">
    <div class="container">
        <div class="row align-items-center gutter-vr-30px justify-content-center">
            <div class="col-md-3 col-sm-6 col-6">
                <div class="tc-light counter">
                    <div class="counter-icon color-light">
                        <em class="ti-dropbox"></em>
                    </div>
                    <div class="counter-content">
                        <h2 class="mb-7 count" data-count="800">+800</h2>
                        <p>KM de cobertura</p>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-md-3 col-sm-6 col-6">
                <div class="tc-light counter">
                    <div class="counter-icon color-light">
                        <em class="ti-basketball"></em>
                    </div>
                    <div class="counter-content">
                        <h2 class="mb-7 count" data-count="15">+15</h2>
                        <p>Anos no mercado</p>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-md-3 col-sm-6 col-6">
                <div class="tc-light counter">
                    <div class="counter-icon color-light">
                        <em class="ti-pencil-alt"></em>
                    </div>
                    <div class="counter-content">
                        <h2 class="mb-7 count" data-count="1000">+1000</h2>
                        <p>Clientes ativos</p>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-md-3 col-sm-6 col-6">
                <div class="tc-light counter">
                    <div class="counter-icon color-light">
                        <em class="ti-user"></em>
                    </div>
                    <div class="counter-content">
                        <h2 class="mb-7 count" data-count="20">+20</h2>
                        <p>Projetos sociais</p>
                    </div>
                </div>
            </div><!-- .col -->
        </div>
    </div>
    <!-- bg-->
    <div class="bg-image bg-fixed">
        <img src="<?php echo image('telecom-noite.jpg'); ?>" alt="">
    </div>
    <!-- end bg-->
</section>
<!-- .section -->

<!-- section -->
<section data-id="planos" class="section section-x section-x bg-secondary" id="planos">
    <div class="container container-lg-custom">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="section-head section-md">
                    <h5 class="heading-xs">Planos</h5>
                    <h2>O poder da conexão com a melhor internet de <?php echo $nome; ?></h2>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->

        <div class="row justify-content-center gutter-vr-30px text-center">
            <div class="col-lg-4 col-sm-12">
                <div class="pricing-boxed pricing-boxed-sm-bg">
                    <div class="pricing-price">
                        <h3><span class="price-unit price-unit-lg">R$</span>99<span class="price-for">Mensal</span>
                        </h3>
                    </div>
                    <div class="pricing-feature">
                        <ul>
                            <li>340MB de download</li>
                            <li>340MB de upload</li>
                            <li>Fibra Óptica</li>
                            <li>Modem em comodato</li>
                            <li>Suporte 24 horas</li>
                        </ul>
                    </div>
                    <div class="pricing-cta pricing-cta-lg">
                        <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="btn btn-lg-s2 btn-capitalize"><?php echo $botaoTitle; ?></a>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-lg-4 col-sm-12">
                <div class="pricing-boxed pricing-boxed-sm-bg">
                    <div class="pricing-price">
                        <h3><span class="price-unit price-unit-lg">R$</span>109<span class="price-for">Mensal</span>
                        </h3>
                    </div>
                    <div class="pricing-feature">
                        <ul>
                            <li>340MB de download</li>
                            <li>340MB de upload</li>
                            <li>Fibra Óptica</li>
                            <li>Modem em comodato</li>
                            <li>Suporte 24 horas</li>
                        </ul>
                    </div>
                    <div class="pricing-cta pricing-cta-lg">
                        <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="btn btn-lg-s2 btn-capitalize"><?php echo $botaoTitle; ?></a>
                    </div>
                </div>
            </div><!-- .col -->
            <div class="col-lg-4 col-sm-12">
                <div class="pricing-boxed pricing-boxed-sm-bg">
                    <div class="pricing-price">
                        <h3><span class="price-unit price-unit-lg">R$</span>129<span class="price-for">Mensal</span></h3>
                    </div>
                    <div class="pricing-feature">
                        <ul>
                            <li>340MB de download</li>
                            <li>340MB de upload</li>
                            <li>Fibra Óptica</li>
                            <li>Modem em comodato</li>
                            <li>Suporte 24 horas</li>
                        </ul>
                    </div>
                    <div class="pricing-cta pricing-cta-lg">
                        <a href="<?php echo $botao['url']; ?>" target="<?php echo $botao['target']; ?>" class="btn btn-lg-s2 btn-capitalize"><?php echo $botaoTitle; ?></a>
                    </div>
                </div>
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->
</section>
<!-- .section -->

<!-- section -->
<section data-id="form" class="section section-x bg-light contact-bg-map" id="contato">
    <div class="container container-lg-custom">
        <div class="row gutter-vr-40px justify-content-between align-items-center">
            <div class="col-lg-7 col-md-6 order-last pl-xl-5">
                <div class="row gutter-vr-30px">
                    <div class="col-sm-6 col-md-12 col-lg-6">
                        <div class="contact-text contact-text-s3 bg-light box-pad box-pad-md">
                            <div class="text-box">
                                <h4><?php echo $nome; ?></h4>
                                <p><?php echo $endereco; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-6 col-md-12 col-lg-6 order-lg-last order-first">
                        <div class="contact-text contact-text-s3 bg-light box-pad mt-top box-pad-md">
                            <div class="text-box">
                                <h4>Jump Telecom</h4>
                                <p>R. Mariz e Barros, 1374 - São Lourenço do Sul, RS, 96170-000</p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <!-- .col -->
            <div class="col-lg-5 col-md-6">
                <div class="section-head section-md">
                    <h5 class="heading-xs">Contato</h5>
                    <h2>Fale conosco, estamos ansiosos pelo seu contato</h2>
                </div>
                <form class="genox-form genox-form-s2" action="#" method="POST">
                    <div class="form-results"></div>
                    <div class="row">
                        <div class="form-field col-12">
                            <input name="cf_name" type="text" placeholder="Seu Nome"
                                class="input bdr-b bdr-b-light required pt-0">
                        </div>
                        <div class="form-field col-12">
                            <input name="cf_name" type="text" placeholder="Seu Telefone"
                                class="input bdr-b bdr-b-light required pt-0">
                        </div>
                        <div class="form-field col-12">
                            <input name="cf_email" type="email" placeholder="Seu E-mail"
                                class="input bdr-b bdr-b-light required">
                        </div>
                        <div class="form-field col-12">
                            <textarea name="cf_msg" placeholder="Seu Endereço"
                                class="input input-msg bdr-b bdr-b-light required"></textarea>
                            <input type="text" class="d-none" name="form-anti-honeypot" value="">
                        </div>
                        <div class="form-btn col-12">
                            <button type="submit" class="btn btn-lg-s2 round-sm btn-capitalize">Enviar</button>
                        </div>
                    </div>
                </form>
            </div><!-- .col -->
        </div>
    </div><!-- .container -->
    <div class="bg-image">
        <img src="<?php echo image('contact-bg.png'); ?>" alt="banner">
    </div>
</section>
<!-- .section -->

<!-- section -->
<section data-id="card3" class="section section-cta section-cta-alt tc-light section-x">
    <video autoplay loop muted poster="<?php echo image('piscina.jpg'); ?>" class="bg_video">
        <source src="<?php echo image('copa-safergs-2021.mp4'); ?>" type="video/webm">
        <source src="<?php echo image('copa-safergs-2021.mp4'); ?>" type="video/mp4">
    </video>
    <div class="container">
        <div class="row gutter-vr-30px align-items-center justify-content-between">
            <div class="col-lg-8 text-center text-lg-left">
                <div class="cta-text cta-text-s3">
                    <h2><strong>Novos vídeos toda semana!</strong> Assista aos melhores vídeos no nosso canal do YouTube.
                    </h2>
                </div>
            </div>
            <div class="col-lg-3 text-lg-right text-center">
                <div class="cta-btn cta-btn-s3">
                    <a href="#" class="btn btn-outline">Ver Canal</a>
                </div>
            </div>
        </div>
    </div><!-- .container -->

    <!-- bg -->
    <div class="bg-image bg-fixed overlay-theme-dark overlay-opacity-0">
        <img src="<?php echo image('piscina.jpg'); ?>" alt="">
    </div>
    <!-- .bg -->
</section>
<!-- .section -->

<!-- footer -->
<footer class="section footer">
    <div class="container">
        <div class="row gutter-vr-40px">
            <div class="col-lg-3 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <div class="wgs-logo">
                            <a href="#">
                                <img src="<?php echo $logo; ?>"  <?php echo ($tm) ? 'width="'.$tm.'"' : ''; ?>
                                    srcset="<?php echo $logo; ?>" alt="logo">
                            </a>
                        </div>
                        <p>&copy; 2023. Todos os direitos reservados.<br> Desenvolvido por <a href="#">Cyberads</a></p>
                    </div>
                </div><!-- .wgs -->
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <h3 class="wgs-title t-u">Empresa</h3>
                        <ul class="wgs-menu">
                            <li><a href="#">Sobre nós</a></li>
                            <li><a href="#">Serviços</a></li>
                            <li><a href="#">Clientes</a></li>
                            <li><a href="#">Contato</a></li>
                        </ul>
                    </div>
                </div><!-- .wgs -->
            </div><!-- .col -->
            <div class="col-lg-3 col-sm-6">
                <div class="wgs">
                    <div class="wgs-content">
                        <h3 class="wgs-title t-u">Privacidade</h3>
                        <ul class="wgs-menu">
                            <li><a href="#">Contato</a></li>
                            <li><a href="#">Politica de Privacidade</a></li>
                            <li><a href="#">Termos de Uso</a></li>
                            <li><a href="#">Termos de Cancelamento</a></li>
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

<!-- preloader -->
<div class="preloader preloader-light preloader-florida no-split"><span class="spinner spinner-alt"><img
            class="spinner-brand" src="<?php echo $logo_i; ?>" alt=""></span></div>

<?php get_footer(); ?>