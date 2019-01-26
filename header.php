<!doctype html>
<?php 
/*
* пока не понятно зачем нужен

*	<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
*	<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
*	<!--[if IE 8]>    <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
*	<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

*/
?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	<?php 
	/*	started funciton:
	* 	add_action('wp_head', 'ale_customcss'); etc/front 72
	* 	add_action('wp_head', 'ale_head'); etc/front 132
	* 	add_action('wp_head', 'ale_og_meta'); etc/front 363
	* 	add_action( 'wp_head', 'fb_change_toolbar_css' ); etc/system 214	
	* 	add_action( 'wp_head', 'wp_admin_bar_render', 1000 ); functions/tgm.php 224
	* 	ale_map_css - shortcodes/shortcodes 490
	*	add_action( 'wp_enqueue_scripts', 'ale_enqueue_scripts'); front 115
	*	add_action( 'wp_enqueue_scripts', 'aletheme_enqueue_comment_reply' ); functin/general 1221
	*	add_action( 'wp_enqueue_scripts', 'ale_map_load_scripts' ); shortcod 428
	*/
	wp_head(); 
	?>
</head>


<body <?php body_class(); ?> >
<header>

<!-- ---------------------------------------------------------------------
					HEADER			
-------------------------------------------------------------------------->
<section class = "top_header">
	<section class = "left_logo">
		<h1>
		ПРОЕКТИРОВАНИЕ СТРОИТЕЛЬСТВО СКЕЙТ-ПАРКОВ Лидеры индустрии, передовые технологии
		</h1>
	</section>
	<section class = "center_logo">
		<?php if(ale_get_option('sitelogo')){
			echo "<img src='".ale_get_option('sitelogo')."' class = 'logo'/>";
		} ?>
	</section>
	<section class = "right_logo">
		<h1>
		info@xsaramps.com 8(800)500-90-46 8(918)211-82-20
		</h1>
	</section>
</section>
<section class = "bottom_header">

	<nav class="top_navigation">
			<div class="">
				<?php
						if ( has_nav_menu( 'header_menu' ) ) {
							wp_nav_menu(array(
								'theme_location'=> 'header_menu',
								'menu'			=> 'Header Menu',
								'menu_class'	=> 'ali_headermenu cf',
								'walker'		=> new Aletheme_Nav_Walker(),
								'container'		=> '',
							));
						}
						?>
				
			</div>
		</nav>
		<section class = "bread_crumbs">
		<?php echo get_breadcrumbs(); ?>
		</section>

</section>
<?php 
/*

*	Пример слайдера.
<section class="slider-example">
	<div class="newhomeslider wrapper">
		<ul class="slides">
			<?php $slider = ale_sliders_get_slider('test-slider');  ?>
			<?php if($slider):?>
				<?php foreach ($slider['slides'] as $slide) : ?>
					<li>
						<figure>
							<img src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title']; ?>" />
							<figcaption>
								<div class="sliderdata">
									<?php if($slide['title']){ ?>
										<div class="titleslide headerfont">
											<?php if($slide['url']){
												echo "<a href='".$slide['url']."'>";
											} ?>

											<?php echo $slide['title']; ?>

											<?php if($slide['url']){
												echo "</a>";
											} ?>
										</div>
									<?php } ?>
									<?php if($slide['description']){ ?>
										<div class="descriptionslide">
											<?php echo $slide['description']; ?>
										</div>
									<?php } ?>
									<?php if($slide['html']){ ?>
										<div class="descriptionslide">
											<?php echo $slide['html']; ?>
										</div>
									<?php } ?>
								</div>
							</figcaption>
						</figure>
					</li>
				<?php endforeach; ?>
			<?php endif;?>
		</ul>
	</div>
</section>

*/

?>





<!-- ---------------------------------------------------------------------
					END HEADER			
-------------------------------------------------------------------------->
</header>


