<?php

namespace MPHB\Widgets;

class TitleRoomsWidget extends BaseWidget {

	private $isShowTitle;
	private $roomTypeIds;

	/**
	 * Register widget with WordPress.
	 */
	function __construct(){

		$baseId	 = 'mphb_title_rooms_widget';
		$name	 = __( 'Title Accommodation Types', 'motopress-hotel-booking' );

		$widgetOptions = array(
			'description' => __( 'Display Title Accommodation Types', 'motopress-hotel-booking' )
		);

		parent::__construct(
			$baseId, $name, $widgetOptions
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see \WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ){
		echo $args['before_widget'];

		$title	 = isset( $instance['title'] ) ? $instance['title'] : '';
		$title	 = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		if ( !empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$roomTypeIds = !empty( $instance['room_type_ids'] ) ? $instance['room_type_ids'] : array();

		if ( !empty( $roomTypeIds ) ) {
			$this->roomTypeIds			 = $roomTypeIds;
			$this->enqueueScriptStyles();
			$this->isShowTitle			 = \MPHB\Utils\ValidateUtils::validateBool( $instance['show_title'] );
			$roomQuery = $this->getMainQuery();

			ob_start();

			if ( $roomQuery->have_posts() ) {

				do_action( 'mphb_widget_title_rooms_before_loop' );

				while ( $roomQuery->have_posts() ) : $roomQuery->the_post();

					do_action( 'mphb_widget_title_rooms_before_item' );

					$this->renderRoom();

					do_action( 'mphb_widget_title_rooms_after_item' );

				endwhile;

				wp_reset_postdata();

				do_action( 'mphb_widget_title_rooms_after_loop' );
			} else {
				mphb_get_template_part( 'widgets/rooms/not-found' );
			}

			$content = ob_get_clean();

			$wrapperClass = apply_filters( 'mphb_widget_title_rooms_wrapper-class', 'mphb_widget_title_rooms-wrapper' );
			echo '<ul class="' . esc_attr( $wrapperClass ) . '">' . $content . '</ul>';
		}

		echo $args['after_widget'];
	}

	private function getMainQuery(){
		$queryAtts = array(
			'post_type'				 => MPHB()->postTypes()->roomType()->getPostType(),
			'post__in'				 => $this->roomTypeIds,
			'ignore_sticky_posts'	 => true,
			'posts_per_page'		 => -1
		);
		return new \WP_Query( $queryAtts );
	}

	private function isValidRoom( $id ){
		return get_post_type( $id ) === MPHB()->postTypes()->roomType()->getPostType() && get_post_status( $id ) === 'publish';
	}

	private function renderRoom(){
		$templateAtts = array(
			'isShowTitle'		 => $this->isShowTitle,
		);

		mphb_get_template_part( 'widgets/rooms/title-room-content', $templateAtts );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see \WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ){

		$instance = wp_parse_args( $instance, array(
			'title'					 => '',
			'room_type_ids'			 => array(),
			'show_title'			 => true
			) );

		extract( $instance );
		if ( $room_type_ids === '' ) {
			$room_type_ids = array();
		}
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'room_type_ids' ) ); ?>"><?php _e( esc_attr( 'Select Accommodation Types:' ) ); ?></label><br/>
			<select id="<?php echo esc_attr( $this->get_field_id( 'room_type_ids' ) ); ?>" multiple="multiple" name="<?php echo esc_attr( $this->get_field_name( 'room_type_ids' ) ); ?>[]" >
				<?php foreach ( MPHB()->getRoomTypePersistence()->getIdTitleList() as $roomTypeId => $roomTypeTitle ) : ?>
					<?php $selected = in_array( $roomTypeId, $room_type_ids ) ? ' selected="selected"' : ''; ?>
					<option value="<?php echo $roomTypeId; ?>" <?php echo $selected; ?>><?php echo $roomTypeTitle; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>" <?php checked( $show_title ); ?> style="margin-top: 0;">
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>"><?php _e( 'Title', 'motopress-hotel-booking' ); ?></label>
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see \WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ){
		$instance = array();

		$instance['title']			 = ( isset( $new_instance['title'] ) && $new_instance['title'] !== '' ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['room_type_ids']	 = ( isset( $new_instance['room_type_ids'] ) && $new_instance['room_type_ids'] !== '' ) ? $this->sanitizeRoomTypeIdsArray( $new_instance['room_type_ids'] ) : '';

		$instance['show_title']			 = ( isset( $new_instance['show_title'] ) && $new_instance['show_title'] !== '' ) ? (bool) $new_instance['show_title'] : '';
	
		return $instance;
	}

	protected function sanitizeRoomTypeIdsArray( $value ){
		$sanitizeValue = array();
		if ( is_array( $value ) ) {
			$sanitizeValue = array_filter( array_map( array( $this, 'sanitizeRoomTypeId' ), $value ) );
		}
		return $sanitizeValue;
	}

	/**
	 *
	 * @param string $value
	 * @return string Empty string for uncorrect value
	 */
	public function sanitizeRoomTypeId( $value ){
		$value = absint( $value );
		return ( $this->isValidRoom( $value ) ) ? (string) $value : '';
	}

	private function enqueueScriptStyles(){
		wp_enqueue_style( 'mphb' );
	}

}
