<?php 
add_action( 'widgets_init','hotel_galaxy_service_widget'); 
/*
 * hotel galaxy service widget
 */
function hotel_galaxy_service_widget() 
{ 
	return   register_widget( 'hotel_galaxy_service_widget' );
}

class hotel_galaxy_service_widget extends WP_Widget {

	function __construct() {
		parent::__construct('hotel_galaxy_service_widget', 
			__('Hotel Galaxy : Service Widget', 'hotel-galaxy'),
			array( 
				'description' => __( 'Hotel Galaxy Service Widget', 'hotel-galaxy' ),
				) );
	}

	public function widget( $args , $instance ) {
		
		$instance['icon'] = ( isset($instance['icon'] ) ? $instance['icon'] : '' );
		$instance['icon_color'] = ( isset($instance['icon_color'] ) ? $instance['icon_color'] : '' );
		$instance['title'] = ( isset($instance['title'] ) ? $instance['title'] : '' );
		$instance['title_url'] = ( isset($instance['title_url'] ) ? $instance['title_url'] : '' );
		$instance['desc'] = ( isset($instance['desc'] ) ? $instance['desc'] : '' );
		$charcount = intval($instance['charcount']);
		$instance['btn_target'] = ( isset($instance['btn_target'] ) && $instance['btn_target'] == 1 ? 1 : 0 );
		
		echo $args['before_widget'];		
		?>

		<div class="">
			<div class="feature-col service-item">
				<?php 
				if( $instance['icon']!=''){
					?>
					<a class="sr-icon" href="<?php echo esc_url( $instance['title_url'] ); ?>"><i class="<?php echo esc_attr( $instance['icon'] ); ?>" style="color:<?php echo esc_attr($instance['icon_color']!='') ? $instance['icon_color'] : '#a29060' ?>"></i></a>
					<?php
				}
				?>
				
				<h3>
					<?php 
					if($instance['title']!=''){
						?>
						<a href="<?php echo esc_url( $instance['title_url'] ); ?>">
							<?php echo esc_html( $instance['title'] ); ?>
						</a>
						<?php
					}
					?>

				</h3>
				<?php 
				if($instance['desc']!=''){
					?>
					<p><?php echo substr( $instance['desc'], 0, $charcount ); ?></p>
					<?php
				} 
				?>	

					

			</div>
		</div><!-- .services-item -->
		<?php
		
		echo $args['after_widget']; 	
	}

	public function form( $instance ) {
		
		$instance['icon'] = ( isset($instance['icon'] ) ? $instance['icon'] : '' );
		$instance['icon_color'] = ( isset($instance['icon_color'] ) ? $instance['icon_color'] : '' );
		$instance['title'] = ( isset($instance['title'] ) ? $instance['title'] : '' );
		$instance['title_url'] = ( isset($instance['title_url'] ) ? $instance['title_url'] : '' );
		$instance['desc'] = ( isset($instance['desc'] ) ? $instance['desc'] : '' );
		$charcount = !empty($instance['charcount']) && intval($instance['charcount']) > 0 ? intval($instance['charcount']) : 100;
		$instance['btn_target'] = ( isset($instance['btn_target'] ) && $instance['btn_target'] == 1 ? 1 : 0 );
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Service Icon: { like: fa-cloud } ','hotel-galaxy' ); ?><a href="https://fontawesome.com/icons?d=gallery" target="_blank" ><?php _e('Click Here!','hotel-galaxy'); ?></a></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>" name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text" value="<?php echo esc_attr( $instance['icon'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'icon_color' ); ?>"><?php _e( 'Icon Color Code: {  like: #dbb26b  }','hotel-galaxy' ); ?><a href="<?php echo esc_url('htmlcolorcodes.com'); ?>" target="_blank" ><?php _e('Click Here!','hotel-galaxy'); ?></a></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'icon_color' ); ?>" name="<?php echo $this->get_field_name( 'icon_color' ); ?>" type="text" value="<?php echo esc_attr( $instance['icon_color'] ); ?>"  placeholder="#dbb26b" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Service Title:','hotel-galaxy' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'title_url' ); ?>"><?php _e( 'Service Title Link:','hotel-galaxy' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title_url' ); ?>" name="<?php echo $this->get_field_name( 'title_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['title_url'] ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'btn_target' ); ?>"><?php _e( 'Open in new tab:','hotel-galaxy' ); ?></label> 
			<input type="checkbox" id="<?php echo $this->get_field_id( 'btn_target' ); ?>" name="<?php echo $this->get_field_name( 'btn_target' ); ?>" value="1" <?php if( $instance['btn_target'] == true ){ echo 'checked'; } ?> />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Service Description:','hotel-galaxy' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" ><?php echo esc_attr( $instance['desc'] ); ?></textarea>
		</p>

		<p>
            <label for="<?php echo $this->get_field_id('charcount'); ?>">Maximum chars:</label>
            <input type="number" id="<?php echo $this->get_field_id('col'); ?>" class="widefat"
                   name="<?php echo $this->get_field_name('charcount'); ?>" value="<?php echo $charcount; ?>"/>
        </p>


		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = array();
		$instance['icon'] = ( ! empty( $new_instance['icon'] ) ) ? sanitize_text_field( $new_instance['icon'] ) : '';
		$instance['icon_color'] = ( ! empty( $new_instance['icon_color'] ) ) ? sanitize_text_field( $new_instance['icon_color'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['title_url'] = ( ! empty( $new_instance['title_url'] ) ) ? esc_url_raw( $new_instance['title_url'] ) : '';
		$instance['desc'] = ( ! empty( $new_instance['desc'] ) ) ? sanitize_text_field( $new_instance['desc'] ) : '';
		$instance['charcount'] = intval($new_instance['charcount']) > 0 ? intval($new_instance['charcount']) : 200;
		$instance['btn_target'] = isset( $new_instance['btn_target'] ) && $new_instance['btn_target'] == 1  ? 1 : 0 ;
		
		return $instance;
	}

} // class