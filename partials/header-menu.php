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
            // if( have_rows('menus', 'option') ) {

            //     while ( have_rows('menus', 'option') ) : the_row(); $link = get_sub_field('item_do_menu'); ?>
                    <!-- <li class="menu-item">
                        <a class="menu-link nav-link active" target="<?php echo $link['target']; ?>" href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
                    </li>   -->

                <?php 
            //     endwhile;

            // } ?>

            <li class="menu-item">
                <a class="menu-link nav-link active" href="<?php echo home_url('/#empresa'); ?>">Empresa</a>
            </li>
            <li class="menu-item">
                <a class="menu-link nav-link active" href="<?php echo home_url('/#esquadrias'); ?>">Produtos</a>
            </li>
            <li class="menu-item">
                <a class="menu-link nav-link active" href="<?php echo home_url('/#projetos'); ?>">Projetos</a>
            </li>
            <li class="menu-item">
                <a class="menu-link nav-link active" href="<?php echo home_url('/#clientes'); ?>">Clientes</a>
            </li>
            <li class="menu-item">
                <a class="menu-link nav-link active" href="<?php echo home_url('/#contato'); ?>">Contato</a>
            </li>            
        </ul>
        <?php $menu_destaque = get_field('menu_destacado', 'option'); ?>
        <ul class="menu-btns">
            <!-- <li><a href="" class="btn search search-trigger"><i class="icon ti-search "></i></a></li> -->
            <li><a href="<?php echo $menu_destaque['url']; ?>" target="<?php echo $menu_destaque['target']; ?>" class="btn btn-sm"><?php echo $menu_destaque['title']; ?></a></li>
        </ul>
    </nav>
</div>
<!-- .header-navbar -->