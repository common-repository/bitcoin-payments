<?php
/**
 * Bitcoin Payments Widget
 * Version 1.1
 *
 */
// http://codex.wordpress.org/Widgets_API
class btcp_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'btcp_widget', // Base ID
			'Bitcoin Payments', // Name
			array( 'description' => __( 'Use this widget to display your Bitcoin address', 'bitcoin-payments' ), ) // Args
		);
	} // END public function __construct()

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		$options = get_option('btcp_options');
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$address = $instance['address'];
		$show_address_href = $instance['show_address_href'];
		$address_prefix = $instance['address_prefix'];
		$address_postfix = $instance['address_postfix'];
		$div_id = $instance['div_id'];
		$hide_address = $instance['hide_address'];
		$hide_qrcode = $instance['hide_qrcode'];
		$height = $instance['height'];
		$width = $instance['width'];
		$description_text = $instance['description_text'];
		
		$html_address = "";
		$html_qrcode_div = "";
		$html_qrcode_js = "";
		$html_description = "";

		// if $address_prefix is empty, then we only want to fill it with the default settings if the default option is selected
		if (($address_prefix == '' && strcasecmp($show_address_href, 'true') != 0) && isset($options['address_prefix']))
			$address_prefix = $options['address_prefix'];
		
		if (($address_postfix == '' && strcasecmp($show_address_href, 'true') != 0) && isset($options['address_postfix']))
			$address_postfix = $options['address_postfix'];
			
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		if ( empty( $hide_address ) ) {
			if ((strcasecmp($show_address_href, 'true') == 0 || isset($options['show_address_href'])) && (strcasecmp($show_address_href, 'false') != 0)) {
				$html_address_href_prefix = "<a href=\"{$address_prefix}{$address}{$address_postfix}\">";
				$html_address_href_postfix = "</a>";
			} else {
				$html_address_href_prefix = "";
				$html_address_href_postfix = "";
			}
			$html_address = "<div class=\"btcpWAddress\" title=\"{$address}\">" . $html_address_href_prefix . "{$address}" . $html_address_href_postfix . "</div>";
		}
			
		$html_description = "<div class=\"btcpWDescription\" title=\"{$description_text}\">{$description_text}</div>";
		
		if ( empty( $hide_qrcode ) ) {
			$html_qrcode_div = "<div id=\"btcpW{$div_id}\" class=\"btcpWQrcode\" title=\"{$address}\"></div>";
			
			$html_qrcode_js = "<script>
						jQuery('#btcpW{$div_id}').qrcode({
							render	: \"canvas\",
							width	: \"{$width}\",
							height	: \"{$height}\",
							text	: \"{$address_prefix}{$address}{$address_postfix}\"
						});	
					</script>";
		}
		
		echo ('<div class="btcpWWrapper">' . $html_qrcode_div . $html_address . $html_description .$html_qrcode_js . '</div>');
		
		echo $after_widget;
	} // END public function widget()

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$options = get_option('btcp_options');
		$address = "";
		$address_prefix = "";
		$address_postfix = "";
		
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'Bitcoin Payments', 'bitcoin-payments' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php 
		if ( isset( $instance['address'] ) ) {
			$address = $instance['address'];
		} 
		if (isset($options['address'])) {
			if ($address == "" && $options['address'] != "") {
				$address = $options['address'];
			}
		}
		if ($address == "") {
			$address = __( 'Please Enter a bitcoin Address', 'bitcoin-payments' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'address' ); ?>"><?php _e( 'Bitcoin Address:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_attr( $address ); ?>" />
		</p>
		<?php
		if ( isset( $instance[ 'hide_address' ] ) ) {
			$hide_address = $instance[ 'hide_address' ];
		} else {
			$hide_address = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'hide_address' ); ?>"><?php _e( 'Hide Bitcoin Address:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'hide_address' ); ?>" name="<?php echo $this->get_field_name( 'hide_address' ); ?>" value="<?php echo $this->get_field_name( 'hide_address' ); ?>" type="checkbox" <?php echo esc_attr( $hide_address ); ?> />
		</p>
		<?php
		if ( isset( $instance[ 'show_address_href' ] ) ) {
			$show_address_href = $instance[ 'show_address_href' ];
		} else {
			$show_address_href = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'show_address_href' ); ?>"><?php _e( 'Use Hyperlink Around Address:', 'bitcoin-payments' ); ?></label> 
		<select class="widefat" name="<?php echo $this->get_field_name( 'show_address_href' ); ?>">
			<option value=""><?php _e('Default Setting', 'bitcoin-payments'); ?></option>
			<option value="false" <?php if ($show_address_href == "false") echo "selected"; ?>><?php _e('Remove Hyperlink', 'bitcoin-payments'); ?></option>
			<option value="true" <?php if ($show_address_href == "true") echo "selected"; ?>><?php _e('Use Hyperlink', 'bitcoin-payments'); ?></option>
		</select>
		</p>
		<?php 
		if ( isset( $instance['address_prefix'] ) ) {
			$address_prefix = $instance['address_prefix'];
		} else {
			if (isset($options['address_prefix']))
				$address_prefix = $options['address_prefix'];
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'address_prefix' ); ?>"><?php _e( 'Address Prefix:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'address_prefix' ); ?>" name="<?php echo $this->get_field_name( 'address_prefix' ); ?>" type="text" value="<?php echo esc_attr( $address_prefix ); ?>" />
		</p>
		<?php 
		if ( isset( $instance['address_postfix'] ) ) {
			$address_postfix = $instance['address_postfix'];
		} else {
			if (isset($options['address_postfix']))
				$address_postfix = $options['address_postfix'];
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'address_postfix' ); ?>"><?php _e( 'address_postfix:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'address_postfix' ); ?>" name="<?php echo $this->get_field_name( 'address_postfix' ); ?>" type="text" value="<?php echo esc_attr( $address_postfix ); ?>" />
		</p>
		<?php
		if ( isset( $instance[ 'height' ] ) ) {
			$height = $instance[ 'height' ];
		} else {
			$height = BTCP_QRCODE_HEIGHT;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'height' ); ?>"><?php _e( 'QRCode Height:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
		</p>
		<?php
		if ( isset( $instance[ 'width' ] ) ) {
			$width = $instance[ 'width' ];
		} else {
			$width = BTCP_QRCODE_WIDTH;
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'width' ); ?>"><?php _e( 'QRCode Width:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
		</p>
		<?php
		if ( isset( $instance[ 'hide_qrcode' ] ) ) {
			$hide_qrcode = $instance[ 'hide_qrcode' ];
		} else {
			$hide_qrcode = '';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'hide_qrcode' ); ?>"><?php _e( 'Hide QRCode:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'hide_qrcode' ); ?>" name="<?php echo $this->get_field_name( 'hide_qrcode' ); ?>" value="<?php echo $this->get_field_name( 'hide_qrcode' ); ?>" type="checkbox" <?php echo esc_attr( $hide_qrcode ); ?> />
		</p>
		<?php
		if ( isset( $instance[ 'description_text' ] ) ) {
			$description_text = $instance[ 'description_text' ];
		} else {
			$description_text = "";
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'description_text' ); ?>"><?php _e( 'Description:' ); ?></label> 
		<textarea class="widefat" id="<?php echo $this->get_field_id( 'description_text' ); ?>" name="<?php echo $this->get_field_name( 'description_text' ); ?>" rows="4" cols="10"><?php echo esc_attr( $description_text ); ?></textarea>
		</p>
		<?php
		if ( isset( $instance[ 'div_id' ] ) ) {
			$div_id = $instance[ 'div_id' ];
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_name( 'div_id' ); ?>"><?php _e( 'Unique HTML DIV ID:', 'bitcoin-payments' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'div_id' ); ?>" name="<?php echo $this->get_field_name( 'div_id' ); ?>" type="text" value="<?php echo esc_attr( $div_id ); ?>" />
		<br><small><?php _e( 'If left blank, a random number will be generated on save', 'bitcoin-payments' ); ?></small>
		</p>
		<?php
	} // END public function form()

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['address'] = ( !empty( $new_instance['address'] ) ) ? strip_tags( $new_instance['address'] ) : '';
		$instance['address_prefix'] = ( !empty( $new_instance['address_prefix'] ) ) ? $new_instance['address_prefix'] : '';
		$instance['address_postfix'] = ( !empty( $new_instance['address_postfix'] ) ) ? $new_instance['address_postfix'] : '';
		$instance['hide_address'] = ( !empty( $new_instance['hide_address'] ) ) ? 'checked' : '';
		$instance['show_address_href'] = ( !empty( $new_instance['show_address_href'] ) ) ? $new_instance['show_address_href'] : '';
		$instance['hide_qrcode'] = ( !empty( $new_instance['hide_qrcode'] ) ) ? 'checked' : '';
		$instance['height'] = ( !empty( $new_instance['height'] ) ) ? strip_tags( $new_instance['height'] ) : BTCP_QRCODE_HEIGHT;
		$instance['width'] = ( !empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : BTCP_QRCODE_WIDTH;
		$instance['div_id'] = ( !empty( $new_instance['div_id'] ) ) ? strip_tags( $new_instance['div_id'] ) : rand(100, 999);
		$instance['description_text'] = ( !empty( $new_instance['description_text'] ) ) ? $new_instance['description_text'] : '';

		return $instance;
	} // END public function update()

} // END class btcp_widget extends WP_Widget

//register_sidebar_widget('Bitcoin Payments', 'btcp_widget');
add_action( 'widgets_init', function(){
     register_widget( 'btcp_widget' );
});
?>