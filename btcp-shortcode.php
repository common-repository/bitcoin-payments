<?php
	// http://codex.wordpress.org/Function_Reference/add_shortcode
	function btcp_shortcode($atts) {
		$options = get_option('btcp_options');
		extract( shortcode_atts( array(
			'address' => $options['address'], 		// The BTC address to be used default will be from the Settings
			'addressdisplay' => null,				// Deprecation
			'address_display' => true,				// true | false : True = show the address False = hide the address
			'show_address_href' => '',				// Default is the Settings page and can be overridden by true | false
			'prefix' => '',							// Content to add before the address in the href
			'postfix' => '',						// Content to add after the address in the href
			'qrcode' => true,						// true | false : True = show the qrcode False = hide the qrcode
			'render' => 'canvas',					// canvas | table : Canvas is an image, Table is HTML
			'width' => $options['width'],			// Size of the qrcode
			'height' => $options['height'],			// Size of the qrcode
			'divid' => null,						// Deprecation
			'div_id' => rand(100, 999)				// Give the div it's own ID so you can access it with CSS
		), $atts ) );
		
		// Deprecation setting check
		if (isset($addressdisplay)) {
			$address_display = $addressdisplay;
		}
		
		if (isset($divid)) {
			$div_id = $divid;
		}
		// END Deprecation setting check
		
		$html = "";
		$html_address_href_prefix = "";
		$html_address_href_postfix = "";
		$html_address = "";
		$html_qrcode_div = "";
		$html_qrcode_js = "";
		
		// this is to override the shortcode if it has address="" with the default
		if ($address == '')
			$address = $options['address'];
		
		if (($prefix == '') && isset($options['address_prefix']))
			$prefix = $options['address_prefix'];
		
		if (($postfix == '') && isset($options['address_postfix']))
			$postfix = $options['address_postfix'];
		
		if ((strcasecmp($show_address_href, 'true') == 0 || isset($options['show_address_href'])) && (strcasecmp($show_address_href, 'false') != 0)) {
			$html_address_href_prefix = "<a href=\"{$prefix}{$address}{$postfix}\">";
			$html_address_href_postfix = '</a>';
		}
		
		if ($height == '') 
			$height = $options['height'];
		if ($height == '') 
			$height = BTCP_QRCODE_HEIGHT;
		
		if ($width == '')
			$width = $options['width'];
		if ($width == '')
			$width = BTCP_QRCODE_WIDTH;
		
		
		if ("{$address}" != '') {
			// Prepare the HTML sections
			if (strcasecmp("{$qrcode}", 'false') != 0) {
				$html_qrcode_div = "<div id=\"btcpSc{$div_id}\" class=\"btcpScQrcode\" title=\"{$address}\"></div>";
				$html_qrcode_js = "<script>
						jQuery('#btcpSc{$div_id}').qrcode({
							render	: \"{$render}\",
							width	: \"{$width}\",
							height	: \"{$height}\",
							text	: \"{$prefix}{$address}{$postfix}\"
						});	
					</script>";
			}
			
			if (strcasecmp("{$address_display}", 'false') != 0) 
				$html_address = "<div class=\"btcpScAddress\">" . $html_address_href_prefix . "{$address}" . $html_address_href_postfix . "</div>";	
				
		} else {
			$html_address = __('The Shortcode needs an address or you need to enter one in the Settings', 'bitcoin-payments');
		}
		
		// Compile the HTML
		$html = '<div class="btcpScWrapper">' . $html_qrcode_div . $html_address . $html_qrcode_js . '</div>';
		
		return $html;
	} // END btcp_shortcode()
	
	add_shortcode('btcpayments', 'btcp_shortcode');
?>