 <!doctype html>
	<!--[if !IE]>
	<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 7 ]>
	<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 8 ]>
	<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
	<!--[if IE 9 ]>
	<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
	<!--[if gt IE 9]><!-->
<html> <!--<![endif]-->
	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		
		<title><?php bloginfo( 'name' ); ?><?php wp_title( '—', true, 'left' ); ?></title>

		<link rel="profile" href="http://gmpg.org/xfn/11"/>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
		<link rel="shortcut icon" href="<?php echo home_url( '/favicon.ico' ); ?>">


		<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>'/assets/css/style.css' ); ?>" type="text/css">	
		<?php wp_head(); ?>
	
	</head>

	<body <?php body_class(); ?>>
		<header class="container d-flex flex-row">
			<div id="logo" class="d-2-twelfth">
				<a href="<?= home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<img src="<?= get_stylesheet_directory_uri() ?>/assets/img/LMS_logo.svg" alt="Luca Molinari Studio" />
				</a>
			</div>

			<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
		</header>
