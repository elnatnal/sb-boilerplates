<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>

	<meta charset="<?php bloginfo('charset'); ?>;" />
	
	<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<?php if (is_search()) { ?>
  <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>

	<meta name="description" content="<?php bloginfo('description'); ?>">

	<meta name="google-site-verification" content="">
	
	<meta name="author" content="Brian Fischer, Nate Hunzaker, Smashing Boxes">
	<meta name="Copyright" content="Copyright Smashing Boxes 2012. All Rights Reserved.">

	<meta name="DC.title" content="Smashing Boxes Website">
	<meta name="DC.subject" content="Smashing Boxes is an web and mobile development agency located Durham, NC.">
	<meta name="DC.creator" content="Nate Hunzaker, Smashing Boxes">
	
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico">
	
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

	<link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/apple-touch-icon.png">

  <!-- Typekit -->
  <script type="text/javascript" src="http://use.typekit.com/iux4ffc.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?v=2.0">

  <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_directory'); ?>/js/utils/compliance.js"></script>
  <!--<![endif]-->
  
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	
	<div id="page-wrap">

		<header id="header">
        <h1 class="logo"><a href="<?php echo get_option('home'); ?>/">SmashingBoxes</a></h1>
        <?php wp_nav_menu( array('menu' => 'Primary Nav') ); ?>
		</header>

