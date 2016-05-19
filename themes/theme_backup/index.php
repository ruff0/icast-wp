<?php get_header() ?>


<!-- <section class="text-center" data-background="<?php //echo get_template_directory_uri() ?>/assets/logo.WebM">
	    <img src="<?php //echo get_template_directory_uri() ?>/assets/logo1.png" id="logo">
</section> -->
<section id="logo_info3" data-background-video-loop="loop" data-background-video-play="play" data-background-video-autoplay="true" data-background-video="<?php echo get_template_directory_uri() ?>/assets/logo_converted.WebM" >

	<!-- <video autoplay loop muted data-background-video-loop="loop" height="120%" width="120%">
	    <source src="<?php //echo get_template_directory_uri() ?>/assets/logo.WebM" type="video/webm">
	</video> -->
</section>

<section class="redes">
	<div class="w50 float-left">
		<br>
		<br>
		<h3 style="font-size: 3em;">
		<img class="animated tada " src="<?php echo get_template_directory_uri() ?>/assets/icono_w.png" id="icono_w">
		<div style="display: inline-block; "><br>SMS y Whatsapp<br><strong style="font-size: 1.4em;">2964 618474</strong></div></h3>
	</div>
	<div class="w50 float-right text-center">
		<br>
		<h3><img class="animated tada " src="<?php echo get_template_directory_uri() ?>/assets/icono_f.png" > INFO3Noticias</h3><br>
		<h3><img class="animated tada " src="<?php echo get_template_directory_uri() ?>/assets/icono_t.png" > INFO3Noticias</h3><br>
		<h3><img class="animated tada " src="<?php echo get_template_directory_uri() ?>/assets/icono_y.png" > TVFUEGOTDF</h3>
	</div>
	<div class="clear"></div>
	<br>
	<br>
	<br>
	<p class="footer" >info3noticias@tvfuego.com.ar<br>www.tierradelfuego.info</p>
</section>
<section class="clima" data-background-video-loop="loop" data-background-video="<?php echo get_template_directory_uri() ?>/assets/bg.WebM" >
	<h1>Clima en Río Grande</h1>
	<br>
	<p>
		<figure class="icons">
	        <canvas id="<?php the_field('clima_icono_rg', 'option'); ?>" width="500" height="400">
	        </canvas>
	    </figure>
		<div class="clima-temp"  style="font-size: 105.077px!important;">Máxima <strong ><?php the_field('clima_maxima_rg', 'option'); ?></strong>º <br>Mínima <strong><?php the_field('clima_minima_rg', 'option'); ?></strong>º</div >
		
		<h3>Humedad <strong><?php the_field('clima_humedad_rg', 'option'); ?></strong>% <br>Viento <strong><?php the_field('clima_viento_rg', 'option'); ?></strong> <sup>km/h</sup></h3>

	</p>
	<br>
	<p class="footer"><?php the_field('clima_texto_rg', 'option'); ?></p>
</section>

<section class="clima" data-background-video-loop="loop" data-background-video="<?php echo get_template_directory_uri() ?>/assets/bg.WebM" 
	<h1>Clima en Ushuaia</h1>
	<br>
	<p>
		<figure class="icons">
	        <canvas id="<?php the_field('clima_icono_ush', 'option'); ?>" width="400" height="400">
	        </canvas>
	    </figure>
		<div class="clima-temp" style="font-size: 105.077px!important;">Máxima <strong><?php the_field('clima_maxima_ush', 'option'); ?></strong>º <br>Mínima <strong><?php the_field('clima_minima_ush', 'option'); ?></strong>º</div >
		
		<h3>Humedad <strong><?php the_field('clima_humedad_ush', 'option'); ?></strong>% <br>Viento <strong><?php the_field('clima_viento_ush', 'option'); ?></strong> <sup>km/h</sup></h3>
	</p>
	<br>
	<p class="footer"><?php the_field('clima_texto_ush', 'option'); ?></p>

</section>

<section data-background-video-loop="loop" data-background-video="<?php echo get_template_directory_uri() ?>/assets/bg.WebM" >
	<h1>Farmacias de Turno</h1>

	<div class="w50 float-left text-center">
		<p style="font-size:4.5em;">En Rio Grande</p>
		<h2><strong style="font-size: 100px !important; margin-bottom:20px!important;line-height:120px;"><?php the_field('farmacia_rio_grande', 'option'); ?></strong></h2>
		<h3> <?php the_field('farmacia_direccion_rg', 'option'); ?></h3>
		
		<?php echo (get_field('farmacia_rio_grande_2', 'option'))? '<br><br><br>' : '' ; ?>
		
		<h2><strong style="font-size: 100px !important; margin-bottom:20px!important;line-height:120px;"><?php the_field('farmacia_rio_grande_2', 'option'); ?></strong></h2>
		<h3> <?php the_field('farmacia_direccion_rg_2', 'option'); ?></h3>
	</div>
	<div class="w50 float-right text-center">
		<p style="font-size:4.5em;">En Ushuaia</p>
		<h2><strong style="font-size: 100px !important; margin-bottom:20px!important;line-height:120px;"><?php the_field('farmacia_ushuaia', 'option'); ?></strong></h2>
		<h3> <?php the_field('farmacia_direccion_ush', 'option'); ?></h3>
		<h2><strong style="font-size: 100px !important; margin-bottom:20px!important;line-height:120px;"><?php the_field('farmacia_ushuaia_2', 'option'); ?></strong></h2>
		<h3> <?php the_field('farmacia_direccion_ush_2', 'option'); ?></h3>
	</div>
</section>

<section class="text-center" data-background-video-loop="loop" data-background-video="<?php echo get_template_directory_uri() ?>/assets/bg.WebM" >
	    <img src="<?php echo get_template_directory_uri() ?>/assets/logo_deportes.png" height="170px">
</section>

<!-- <section class="text-center hidden">
	<p>
		<h3><strong>Mili Nicola</strong> se viste en  <br><img src="<?php //echo get_template_directory_uri() ?>/assets/stone.jpg" height="200px"></h3>
		<br>
		<br>
		<h3><strong>Sebastian Bendaña</strong> se viste en  <br><img src="<?php //echo get_template_directory_uri() ?>/assets/raymond.jpg" height="200px"></h3>
		
	</p>
</section> -->


<?php 
$args = array( 'post_type' => 'placa', 'posts_per_page' => 10 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
// while ( have_posts() ) : the_post() ?>
	<section class="placas" data-background-video-loop="loop" data-background-video="<?php echo get_template_directory_uri() ?>/assets/bg.WebM" >
			<?php 
			$image = get_field('placa_foto');
			$foto = ' ';
			if( !empty($image) ): 
				switch (get_field('placa_tamanio_foto')) {
					case 'Chica':
						$tamanio_foto = ' style="width=30%" class="foto-chica"';
					break;
					case 'Normal':
						$tamanio_foto = ' style="width=50%" class="foto-normal"';
					break;
					case 'Grande':
						$tamanio_foto = ' style="width=70%" class="foto-grande"';
					break;
					case 'Muy Grande':
						$tamanio_foto = ' style="width=100%" class="foto-muy-grande"';
					break;
				}
				$foto = '<img '.$tamanio_foto.' src="'.$image.'"/>';
			endif;
				echo (get_field('placa_titulo')) ? '<h1>'.get_field('placa_titulo').'</h1>' : '';  
				switch (get_field('placa_tamanio_texto')) {
					case 'Chico':
						echo '<div style="font-size:2.5em!important;">'.$foto.get_field('placa_texto').'</div>';
						break;
					case 'Mediano':
						echo '<div style="font-size:3em!important;">'.$foto.get_field('placa_texto').'</div>';
						break;
					case 'Grande':
						echo '<div style="font-size:3.5em!important;">'.$foto.get_field('placa_texto').'</div>';
						break;
					case 'Muy Grande':
						echo '<div style="font-size:4em!important;">'.$foto.get_field('placa_texto').'</div>';
						break;
					
					default:
						echo '<p>'.get_field('placa_texto').'</p>';
						break;
				}
			?></p>
	</section>

<?php endwhile ?>
<?php get_footer() ?>