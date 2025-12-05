<?php get_header(); ?>

<?php $tipo = get_field('tipo_de_produto'); ?>
<?php $material = get_field('material_do_produto'); ?>
<?php $t_detalhado = get_field('titulo_para_detalhamento_do_produto'); ?>
<?php $titulo = get_the_title(); ?>
<?php $banner = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : image('banner-a.jpg'); ?>
<?php $imagem_destaque = get_field('imagem_destacada_para_o_produto'); ?>
<?php $destaque = ($imagem_destaque) ? $imagem_destaque['url'] : $banner; ?>

<main class="main-container homepage">
    <div class="banner banner-inner banner-s2 banner-s2-inner tc-light">
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
                            <h1 class="banner-heading"><?php echo $titulo; ?></h1>
                            <p class="lead m-0"><?php echo $tipo . ' : ' . $material; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-image overlay-theme-dark overlay-opacity-60">
                <img src="<?php echo $banner; ?>" alt="banner">
            </div>
        </div>
    </div>
    <!-- .banner -->

    <!-- section -->
	<div class="section section-x tc-grey">
		<div class="container">
			<div class="row gutter-vr-30px">
				<div class="col-md-5 col-lg-4 order-lg-last">
					<div class="fw-3 text-box project-box-pad bg-secondary h-full">
                        <?php echo ($tipo) ? '<p>'.$tipo.'</p>' : ''; ?>
                        <?php echo ($material) ? '<p>'.$material.'</p>' : ''; ?>
					</div>
				</div><!-- .col -->
				<div class="col-md-7 col-lg-8">
					<div class="text-block">
						<h2><?php echo ($t_detalhado) ? $t_detalhado  : $titulo;?></h2>
						<?php echo get_field('texto_de_detalhamento_do_produto');?>
					</div>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container -->
	</div>
	<!-- .section -->

    <!-- section -->
	<div class="sectin p-0">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="image-box">
						<img src="<?php echo $destaque; ?>" class="w-100" alt="<?php echo ($imagem_destaque) ? $imagem_destaque['alt'] : $titulo; ?>">
					</div>
				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .continer -->
	</div>
	<!-- .section -->

    <!-- section -->
	<div class="sectin section-x tc-grey-alt fw-3">
		<div class="container">
			<div class="row gutter-vr-30px">
                <?php 
                $images = get_field('galeria_de_imagens_do_produto');
                if( $images ) { ?>

                    <?php foreach( $images as $image ): ?>
                        <div class="col-md-6">
                            <div class="image-box h-full">
                                <img src="<?php echo ($image) ? $image['url'] : $banner; ?>" alt="<?php echo ($image) ? $image['alt'] : $titulo; ?>">
                            </div>
                        </div>
                    <?php endforeach; ?>

                <?php } ?>
			</div>
		</div><!-- .continer -->
	</div>
	<!-- .section -->

    <?php partial('blocks/cta'); ?>

</main>

<?php get_footer(); ?>