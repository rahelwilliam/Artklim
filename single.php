<?php get_header(); ?>

<?php $titulo = get_the_title(); ?>
<?php $banner = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : image('banner-a.jpg'); ?>

<main class="main-container homepage">

	<div class="banner banner-inner banner-inner-s4 tc-light">
		<div class="banner-block">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-12 col-sm-9">
						<div class="banner-content">
							<h1 class="banner-heading t-u"><?php echo $titulo; ?></h1>
							<ul class="banner-menu">
								<li><a href="<?php echo home_url(); ?>">Home</a></li>
								<li><a><?php echo $titulo; ?></a> </li>
							</ul>
						</div>
					</div><!-- .col -->
				</div><!-- .row -->
			</div><!-- .container -->
			<!-- bg -->
			<div class="bg-image overlay-theme-dark overlay-opacity-60">
				<img src="<?php echo $banner; ?>" alt="<?php echo $titulo; ?>">
			</div>
			<!-- end bg -->
		</div>
	</div>
	<!-- .banner -->

	<!-- section/blog -->
	<section class="section blog section-x">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="post post-full post-details post-v3">
						<div class="post-thumb">
							<img src="<?php echo $banner; ?>" alt="<?php echo $titulo; ?>">
						</div>
						<div class="post-entry d-block align-items-start bdr bdr-b">
							<div class="post-content m-0">
								<div class="post-meta d-flex align-items-center">
									<div class="post-author d-flex align-items-center mb-0 mr-20">
										<div class="author-thumb">
											<?php $author_id = get_post_field( 'post_author' ); ?>
											<?php echo get_avatar( $author_id, 45 ); ?>
										</div>
										<div class="author-name">
            								<?php $name_author = get_user_meta( $author_id, 'first_name', true ) . ' ' . get_user_meta( $author_id, 'last_name', true ); ?>
											<p class="post-tag">Por <?php echo $name_author; ?></p>
										</div>
									</div>
									<div class="post-tag">
										<p class="post-tag"><?php echo get_the_date('j \d\e F \d\e Y'); ?></p>
									</div>
								</div>
								<h3><?php echo $titulo; ?></h3>

								<div class="content">
									<?php 
										if ( have_posts() ) :
											while ( have_posts() ) : the_post();
												the_content();
											endwhile;
										endif;
									?>
								</div>
							</div>
						</div>
					</div><!-- .post -->
					
				</div><!-- .col -->
				
			</div><!-- .row -->
		</div><!-- .container -->
	</section>
	<!-- end section/blog -->

	<?php partial('blocks/posts'); ?>

</main>

<?php get_footer(); ?>