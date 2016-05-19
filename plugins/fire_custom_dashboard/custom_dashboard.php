<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">

	<h1><?php _e( 'Bienvenido! ' ); ?><?php echo $current_user->display_name;?></h1>
	
	<div class="about-text">
		<?php _e('En el panel izquierdo encontrara las opciones para agregar Placas, Clima, mensajes, farmacias y demas.' ); ?>
		<?php _e('Cualquier duda o inconveniente con el sitio escriba a plizardo@tvfuego.com.ar. Muchas Gracias.' ); ?>
	</div>
	
	<div class="changelog">
		<h3><?php _e( 'Instrucciones' ); ?></h3>
	
		<div class="feature-section images-stagger-right">
			
			<h4><?php _e( 'Para cargar Placas' ); ?></h4>
			<p><?php _e( 'Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra augue. Donec sed odio dui.' ); ?></p>
	
			<h4><?php _e( 'Para cargar Mensajes' ); ?></h4>
			<p><?php _e( 'Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.

Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Etiam porta sem malesuada magna mollis euismod. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam.' ); ?></p>
		</div>
	</div>

</div>
<?php include( ABSPATH . 'wp-admin/admin-footer.php' );