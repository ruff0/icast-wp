<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title><?php wp_title( '', true, 'right' ) ?></title>

	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic|Raleway:400,100,100italic,200,200italic,300,300italic,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>

	<!-- If the query includes 'print-pdf', include the PDF print sheet -->
	<script>
		if( window.location.search.match( /print-pdf/gi ) ) {
			var link = document.createElement( 'link' );
			link.rel = 'stylesheet';
			link.type = 'text/css';
			link.href = '<?php echo get_template_directory_uri() ?>/css/print/pdf.css';
			document.getElementsByTagName( 'head' )[0].appendChild( link );
		}
	</script>

	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri() ?>/lib/js/html5shiv.js"></script>
	<![endif]-->
</head>
<body>

<video autoplay loop muted id="bgvid">
    <source src="<?php echo get_template_directory_uri() ?>/assets/bg.ogv" type='video/ogg'>
    <source src="<?php echo get_template_directory_uri() ?>/assets/bg.WebM" type="video/webm">
    <source src="<?php echo get_template_directory_uri() ?>/assets/bg.mp4" type="video/mp4">
</video>
<?php do_action( 'reveal_before_body' ) ?>
<div class="reveal">
	<?php do_action( 'reveal_before_slides_wrapper' ) ?>

	<!-- Any section element inside of this container is displayed as a slide -->
	<div class="slides">

		<?php do_action( 'reveal_before_slides' ) ?>
