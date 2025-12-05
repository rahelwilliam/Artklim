<?php $bg_color = get_field('cor_do_bloco'); ?>
<?php $id = get_field('identificacao_do_bloco'); ?>
<?php $banner = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : image('banner-a.jpg'); ?>

<div <?php echo ($id) ? 'id="'.slugify($id).'"' : ''; ?> class="banner banner-inner banner-s2 banner-s2-inner tc-light <?php echo $bg_color; ?>">
    <div class="banner-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7 col-sm-9">
                    <div class="banner-content">
                        <div class="line-animate">
                            <span class="line line-top"></span>
                            <span class="line line-right"></span>
                            <span class="line line-bottom"></span>
                            <span class="line line-left"></span>
                        </div>
                        <h1 class="banner-heading"><?php echo get_the_title(); ?></h1>
                        <!-- <p class="lead m-0">Qualidade e excelência!</p> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-image">
            <img src="<?php echo $banner; ?>" alt="banner">
        </div>
    </div>
</div>
<!-- .banner -->