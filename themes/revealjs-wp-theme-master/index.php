<?php get_header() ?>


<!-- <section class="text-center" data-background="<?php //echo get_template_directory_uri() ?>/assets/logo.WebM">
	    <img src="<?php //echo get_template_directory_uri() ?>/assets/logo1.png" id="logo">
</section> -->
<section id="logo_info3" data-background-video-loop="loop" data-background-video="<?php echo get_template_directory_uri() ?>/assets/logo.WebM" data-background-color="#000">

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

<section class="clima">
	<div class="clima-lugar">Río Grande</div>
    <div class="col-1">
		<figure class="icons">
	        <canvas id="<?php the_field('clima_icono_rg', 'option'); ?>" width="400" height="500">
	        </canvas>
	    </figure>
    </div>
    <div class="col-2">
		<div class="clima-temp">Máxima <strong ><?php the_field('clima_maxima_rg', 'option'); ?></strong>º<br>Mínima <strong><?php the_field('clima_minima_rg', 'option'); ?></strong>º</div>
		
		<div class="clima-humedad">
		Humedad <strong><?php the_field('clima_humedad_rg', 'option'); ?></strong>% 
		<br>
		Viento <strong><?php the_field('clima_viento_rg', 'option'); ?></strong> <sup>km/h</sup>
		</div>

		<div class="clima-detalle"><?php the_field('clima_texto_rg', 'option'); ?></div>
	</div>
</section>

<section class="clima">
	<div class="clima-lugar">Ushuaia</div>
    <div class="col-1">
		<figure class="icons">
	        <canvas id="<?php the_field('clima_icono_ush', 'option'); ?>" width="400" height="500">
	        </canvas>
	    </figure>
    </div>
    <div class="col-2">
		<div class="clima-temp">Máxima <strong ><?php the_field('clima_maxima_ush', 'option'); ?></strong>º<br>Mínima <strong><?php the_field('clima_minima_ush', 'option'); ?></strong>º</div>
		
		<div class="clima-humedad">
		Humedad <strong><?php the_field('clima_humedad_ush', 'option'); ?></strong>% 
		<br>
		Viento <strong><?php the_field('clima_viento_ush', 'option'); ?></strong> <sup>km/h</sup>
		</div>

		<div class="clima-detalle"><?php the_field('clima_texto_ush', 'option'); ?></div>
	</div>
</section>

<section class="farmacia">
	<div class="farmacia-titulo">Farmacias de Turno</div>

	<div class="col-1">
		<div class="farmacia-lugar">Río Grande</div>
		<div class="farmacia-nombre"><?php the_field('farmacia_rio_grande', 'option'); ?></div>
		<div class="farmacia-direccion"><?php the_field('farmacia_direccion_rg', 'option'); ?></div>
		<?php echo (get_field('farmacia_rio_grande_2', 'option'))? '<br><br><br>' : '' ; ?>
		<?php if(get_field('farmacia_rio_grande_2', 'option')) {?>
			<div class="farmacia-nombre"><?php the_field('farmacia_rio_grande_2', 'option'); ?></div> 
		<?php } ?>
		<?php if(get_field('farmacia_direccion_rg_2', 'option')) {?>
			<div class="farmacia-direccion"><?php the_field('farmacia_direccion_rg_2', 'option'); ?></div>
		<?php } ?>
	</div> <!-- fin col-1 -->
	<div class="col-1">
		<div class="farmacia-lugar">Ushuaia</div>
		<div class="farmacia-nombre"><?php the_field('farmacia_ushuaia', 'option'); ?></div>
		<div class="farmacia-direccion"><?php the_field('farmacia_direccion_ush', 'option'); ?></div>
		<?php echo (get_field('farmacia_ushuaia_2', 'option'))? '<br><br><br>' : '' ; ?>
		<?php if(get_field('farmacia_ushuaia_2', 'option')) {?>
			<div class="farmacia-nombre"><?php the_field('farmacia_ushuaia_2', 'option'); ?></div> 
		<?php } ?>
		<?php if(get_field('farmacia_direccion_ush_2', 'option')) {?>
			<div class="farmacia-direccion"><?php the_field('farmacia_direccion_ush_2', 'option'); ?></div>
		<?php } ?>
	</div> <!-- fin col-1 -->
</section>

<section class="text-center">
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
$args = array( 'post_type' => 'placa', 'posts_per_page' => 50 );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
// while ( have_posts() ) : the_post() ?>
	<section class="placas">
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

			if (get_field('placa_titulo') && get_field('placa_tamanio_foto')!='Muy Grande') { 
					echo '<h1 class="'.get_field('placa_tipo_mensaje').'">';
					switch (get_field('placa_tipo_mensaje')) {
						case 'Whatsapp':
							echo '<img src="'.get_template_directory_uri().'/assets/icono_w_blanco.png" height="70px">';
							break;
						case 'Messenger':
							echo '<img src="'.get_template_directory_uri().'/assets/icono_m_blanco.png" height="70px">';
							break;
						case 'Twitter':
							echo '<img src="'.get_template_directory_uri().'/assets/icono_t_blanco.png" height="70px">';
							break;
						case 'SMS':
							echo '<img src="'.get_template_directory_uri().'/assets/icono_s_blanco.png" height="70px">';
							break;
						case 'Mail':
							echo '<img src="'.get_template_directory_uri().'/assets/icono_mail_blanco.png" height="70px">';
							break;
						case '':
							echo '';
							break;
						
						default:
							# code...
							break;
					}
					echo get_field('placa_titulo');
					echo '<small>'.get_field('placa_lugar').'</small>';
					echo '</h1>';
				};  
			
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