<?php
	// Output function for tab
	function html_tab_settings() {
		?>
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
					
						<h3><span><?php _e('Bitcoin Payments Settings', 'bitcoin-payments'); ?></span></h3>
						<div class="inside">
							<form method="post" action="options.php">
							<?php settings_fields('btcp_plugin_options'); ?>
							<?php $options = get_option('btcp_options'); ?>
							
							<table class="form-table">
								<tr valign="top"><th scope="row"><?php _e('Bitcoin Address', 'bitcoin-payments'); ?></th>
									<td><input class="regular-text" type="text" name="btcp_options[address]" value="<?php echo $options['address']; ?>" />
									<p class="description"><?php _e('This field is required.  Place your Bitcoin Address in here and it will be the default.  You can override it on a per Widget or Shortcode basis.', 'bitcoin-payments'); ?></p>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e('Use Hyperlink Around Address', 'bitcoin-payments'); ?></th>
									<?php $show_address_href_checked = ( isset( $options['show_address_href'] ) ) ? 'checked' : ''; ?>
									<td><input class="" type="checkbox" name="btcp_options[show_address_href]" id="btcp_options[show_address_href]" value="<?php echo $options['show_address_href']; ?>" <?php echo $show_address_href_checked; ?> />
									<p class="description"><?php _e('This field is optional / advanced.  It will place a href / hyperlink around the address, and if you do that, you will want to take advantage of the prefix and postfix settings below.', 'bitcoin-payments'); ?></p>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e('Bitcoin Address Prefix', 'bitcoin-payments'); ?></th>
									<td><input class="regular-text" type="text" name="btcp_options[address_prefix]" id="btcp_options[address_prefix]" value="<?php echo $options['address_prefix']; ?>" />
									<p class="description"><?php _e('This field is optional / advanced.  You can add something like "bitcoin:" or "litecoin:".  Learn more why this feature is here <a href="https://github.com/bitcoin/bips/blob/master/bip-0021.mediawiki" target="_blank">BIP21</a>.', 'bitcoin-payments'); ?></p>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e('Bitcoin Address Postfix', 'bitcoin-payments'); ?></th>
									<td><input class="regular-text" type="text" name="btcp_options[address_postfix]" id="btcp_options[address_postfix]" value="<?php echo $options['address_postfix']; ?>" />
									<p class="description"><?php _e('This field is optional / advanced.  You can add something to the end of the address like "?amount=1.23".  Learn more why this feature is here <a href="https://github.com/bitcoin/bips/blob/master/bip-0021.mediawiki" target="_blank">BIP21</a>.', 'bitcoin-payments'); ?></p>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e('QRCode Height', 'bitcoin-payments'); ?></th>
									<td><input type="text" name="btcp_options[height]" value="<?php echo $options['height']; ?>" />
									<p class="description"><?php _e('This field is optional.  The default value if it is left empty is ' . BTCP_QRCODE_HEIGHT . '.', 'bitcoin-payments'); ?></p>
									</td>
								</tr>
								<tr valign="top"><th scope="row"><?php _e('QRCode Width', 'bitcoin-payments'); ?></th>
									<td><input type="text" name="btcp_options[width]" value="<?php echo $options['width']; ?>" />
									<p class="description"><?php _e('This field is optional.  The default value if it is left empty is ' . BTCP_QRCODE_WIDTH . '.', 'bitcoin-payments'); ?></p>
									</td>
								</tr>
							</table>
							
							<p class="submit">
								<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
							</p>
							</form>
							
						</div> <!-- .inside -->
					
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
	<?php
	} // END function html_tab_settings()
	
	// Output function for tab
	function html_tab_help() {
?>
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
					
						<h3><span><?php _e('How To Use Bitcoin Payments', 'bitcoin-payments'); ?></span></h3>
						<div class="inside">
							<h2><span><?php _e('Shortcode', 'bitcoin-payments'); ?></span></h2>
							<p class="description"><?php _e('Shortcodes can be entered into Pages and Posts and it is a very handy way to insert custom features.', 'bitcoin-payments'); ?></p>
							
							<strong><?php _e('Required', 'bitcoin-payments'); ?></strong><br/>
							[btcpayments]<br/>
							<br/>
							<strong><?php _e('Optional', 'bitcoin-payments'); ?></strong><br/>
							address<br/>
							Default value: "" or default from Settings page<br/>
							Insert your own custom address to be used on this instance or it will use the default from the settings.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments address="<?php echo(BTCP_ADDRESS); ?>"]</p>
							<br/>
							address_display<br/>
							Default value: true | false<br/>
							By default the address will be displayed, but if you enter false, then it will be hidden, useful if you only want the QRCode.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments address="<?php echo(BTCP_ADDRESS); ?>" address_display="false"]</p>
							<br/>
							show_address_href<br/>
							Default value: "" or true | false<br/>
							By default the hyperlink will default to the main Setting, if you enter true, it will force the hyperlink around the address.  If you enter false, then it will force it to be removed.<br/>
							If you select this to be true, then we highly recommend you at least set a prefix as well.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments address="<?php echo(BTCP_ADDRESS); ?>" show_address_href="true"]</p>
							<br/>
							prefix<br/>
							Default value: "" or default from Settings page<br/>
							This is a little more advanced, but this feature is here so you can take advantage of extra functionality offered by <a href="https://github.com/bitcoin/bips/blob/master/bip-0021.mediawiki" target="_blank">BIP21</a>.<br/>
							So if you wanted to specify that your address should be opened handled by a bitcoin or litecoin client, you could use "bitcoin:" or "litecoin:".<br/>
							<strong>Note:</strong><br/>
							This information will be embedded in the QRCode, good Bitcoin client software will handle it seamlessly.  Standard QRCode scanners may show this extra information.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments show_address_href="true" prefix="bitcoin:"]</p>
							<br/>
							postfix<br/>
							Default value: "" or default from Settings page<br/>
							This is a little more advanced, but this feature is here so you can take advantage of extra functionality offered by <a href="https://github.com/bitcoin/bips/blob/master/bip-0021.mediawiki" target="_blank">BIP21</a>.<br/>
							So if you wanted to specify an amount that the client would automatically enter, you could use "?amount=1.23" or "?amount=1.23&message=Donation".<br/>
							<strong>Note:</strong><br/>
							This information will be embedded in the QRCode, good Bitcoin client software will handle it seamlessly.  Standard QRCode scanners may show this extra information.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments show_address_href="true" postfix="?amount=1.23&message=Donation"]</p>
							<br/>
							qrcode<br/>
							Default value: true | flase<br/>
							By default a QRCode will be displayed, if you enter false, it will be hidden.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments qrcode="false"]</p>
							<br/>
							height | width<br/>
							Default value: <?php echo(BTCP_QRCODE_WIDTH); ?><br/>
							By default a QRCode will be displayed at <?php echo(BTCP_QRCODE_HEIGHT); ?> x <?php echo(BTCP_QRCODE_WIDTH); ?> pixels, you can make it any size you please.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments height="200" width="200"]</p>
							<br/>
							div_id<br/>
							Default value: random number between 100 and 999<br/>
							You may want to specify a div ID to stop potential conflicts if you have multiple QRCodes on a page, you can use names or numbers of any length.<br/>
							<strong>Example:</strong>
							<p class="description">[btcpayments div_id="code1234"]</p>
							
							<h2><span><?php _e('Widget', 'bitcoin-payments'); ?></span></h2>
							<p class="description">
								You can add the Widget in the Appearance > Widget menu.<br/>
								There are a number of custom settings you can choose.  They will override the defaults if you enter values.
							</p>
								
							
							<h2><span><?php _e('CSS', 'bitcoin-payments'); ?></span></h2>
							<p class="description">The style sheet in the plugin will be overwritten each update, so it is best to put the styles in your custom theme style sheet.</p>
							<strong>Shortcode Address</strong><br/>
							Class: btcpScWrapper<br/>
							Class: btcpScQrcode<br/>
							Class: btcpScAddress<br/>
							ID: btcpSc[div_id]<br/>
							<p class="description">The div_id is a random number unless you define it.  It needs to be unique for each use or the plugin will do strange things.</p>
							
							<br/><strong>Shortcode QRCode</strong><br/>
							Class: btcpWWrapper<br/>
							Class: btcpWQrcode<br/>
							Class: btcpWAddress<br/>
							Class: btcpWDescription<br/>
							ID: btcpW[div_id]<br/>
							<p class="description">The div_id is a random number unless you define it.  It needs to be unique for each use or the plugin will do strange things.</p>
						
							<h2><span><?php _e('Bitcoin Wiki', 'bitcoin-payments'); ?></span></h2>
							This is a good technical resource if you would like to learn more <a href="https://bitcoin.it/" target="_blank">https://bitcoin.it/</a>
						</div> <!-- .inside -->
					
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
<?php
	} // END function html_tab_help()
	
	// Output function for tab
	function html_tab_learn() {
?>
				<div class="meta-box-sortables ui-sortable">
					
					<div class="postbox">
					
						<h3><span><?php _e('Learn About Bitcoin', 'bitcoin-payments'); ?></span></h3>
						<div class="inside">
							<p class="description"><?php _e('If you have downloaded this plugin with the hope to collect Bitcoin but have no idea about how to collect it, then we recommend you take a look at the following information.', 'bitcoin-payments'); ?></p>
							
							<p><strong><?php _e('Cryptocurrency', 'bitcoin-payments'); ?></strong><br/>
							<a href="http://en.wikipedia.org/wiki/Cryptocurrency" target="_blank">http://en.wikipedia.org/wiki/Cryptocurrency</a><br/>
							<?php _e('Bitcoin was the first cryptocurrency of it\'s kind and the Bitcoin protocol can be <a href="https://bitcoin.org/en/innovation" target="_blank">used for much more</a> than just currency.<br>
							There are other cryptocurrencies available that use a similar code base like litecoin and dogecoin, <a href="https://en.bitcoin.it/wiki/List_of_alternative_cryptocurrencies" target="_blank">here is a list.'); ?></a>
							</p>
							
							<p><strong><?php _e('General Information', 'bitcoin-payments'); ?></strong><br/>
							<a href="http://bitcoin.org/" target="_blank">www.Bitcoin.org</a><br/>
							<a href="https://www.weusecoins.com/" target="_blank">www.WeUseCoins.com</a><br/>
							</p>
							
							<p><strong><?php _e('Collecting Bitcoin - Addresses & Wallets', 'bitcoin-payments'); ?></strong><br/>
							<span title="To Long, Didn't Read">TLDR;</span> I just want a Wallet and Address, try <a href="https://blockchain.info/wallet/" target="_blank">BlockChain.info</a></p>
							<?php _e('If you are new and would like to get started ASAP, you will need an Address and to have an Address you will need a Wallet.<br/>
							Please look at the following page to understand the options, potential risks and basics of a Wallet. <a href="http://bitcoin.org/en/choose-your-wallet" target="_blank">http://bitcoin.org/en/choose-your-wallet</a>'); ?><br/>
							
							<h2><span><?php _e('WeUseCoins - What is Bitcoin?', 'bitcoin-payments'); ?></span></h2>
							<iframe width="560" height="315" src="//www.youtube.com/embed/Gc2en3nHxA4" frameborder="0" allowfullscreen></iframe>
						</div> <!-- .inside -->
					
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables .ui-sortable -->
<?php
	} // END function html_tab_learn()
?>

<div class="wrap">
	
	<div id="icon-options-general" class="icon32"></div>
	<h2><?php _e('Bitcoin Payments', 'bitcoin-payments'); ?></h2>
	
	<div id="poststuff">
	
		<div id="post-body" class="metabox-holder columns-2">
		
			<div id="post-body-content">
				
				<ul class="tabs">
					<li class="active">
						<a class="" href="#t1"><?php _e('SETTINGS', 'bitcoin-payments'); ?></a>
					</li>
					<li>
						<a class="" href="#t2"><?php _e('HOW TO USE IT', 'bitcoin-payments'); ?></a>
					</li>
					<li>
						<a class="" href="#t3"><?php _e('LEARN ABOUT BITCOIN', 'bitcoin-payments'); ?></a>
					</li>
				</ul>
				<ul class="tabs-content">
					<li id="t1Tab" class="" style="display: none;"><?php html_tab_settings(); ?></li>
					<li id="t2Tab" class="" style="display: none;"><?php html_tab_help(); ?></li>
					<li id="t3Tab" class="" style="display: none;"><?php html_tab_learn(); ?></li>
				</ul>
				
			</div> <!-- post-body-content -->
			
			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">
				
				<div class="meta-box-sortables">
					<div class="postbox">
					<h3><span><?php _e('Appreciation Payment', 'bitcoin-payments'); ?></span></h3>
						<table class="form-table">
							<tr>
								<td>
									<div><?php _e('If you would like to make a contribution for the work that has been done and the future development of this, please use the following addresses', 'bitcoin-payments'); ?><br /></div>
									<br />
									<div class="btcpQrcodeDonationWrapper">
										<p>
											<strong><?php _e('bitcoin address', 'bitcoin-payments'); ?></strong>
										</p>
										<div id="qrcodeDonationBitcoin" title="<?php echo(BTCP_ADDRESS); ?>"></div>
										<div style="word-wrap: break-word;"><a href="bitcoin:<?php echo(BTCP_ADDRESS); ?>" style="word-wrap: break-word;"><?php echo(BTCP_ADDRESS); ?></a><br />
										<span><?php _e('Received: ', 'bitcoin-payments'); ?><span id="btcp-donation-value-bitcoin"></span></span>
										<script>
											jQuery('#qrcodeDonationBitcoin').qrcode({
												render	: "canvas",
												width	: "<?php echo(BTCP_QRCODE_WIDTH); ?>",
												height	: "<?php echo(BTCP_QRCODE_HEIGHT); ?>",
												text	: "bitcoin:<?php echo(BTCP_ADDRESS); ?>"
											});	
											jQuery.ajax({
												url: 'http://btc.blockr.io/api/v1/address/info/<?php echo(BTCP_ADDRESS); ?>',
												dataType: 'jsonp',
												success: function(data){
													document.getElementById('btcp-donation-value-bitcoin').innerHTML = (data.data.totalreceived + 0.0539);
												},
												error: function() {
													document.getElementById('btcp-donation-value-bitcoin').innerHTML = 'Error';
												}
											});
										</script>
										</div>
									</div>
									<br />
									<div class="btcpQrcodeDonationWrapper">
										<p>
											<strong><?php _e('litecoin address', 'bitcoin-payments'); ?></strong>
										</p>
										<div id="qrcodeDonationLitecoin" title="<?php echo(LTCP_ADDRESS); ?>"></div>
										<script>
											
										</script>
										<div style="word-wrap: break-word;"><a href="litecoin:<?php echo(LTCP_ADDRESS); ?>" style="word-wrap: break-word;"><?php echo(LTCP_ADDRESS); ?></a><br />
										<span><?php _e('Received: ', 'bitcoin-payments'); ?><span id="btcp-donation-value-litecoin"></span></span>
										<script>
											jQuery('#qrcodeDonationLitecoin').qrcode({
												render	: "canvas",
												width	: "<?php echo(BTCP_QRCODE_WIDTH); ?>",
												height	: "<?php echo(BTCP_QRCODE_HEIGHT); ?>",
												text	: "litecoin:<?php echo(LTCP_ADDRESS); ?>"
											});	
											jQuery.ajax({
												url: 'http://ltc.blockr.io/api/v1/address/info/<?php echo(LTCP_ADDRESS); ?>',
												dataType: 'jsonp',
												success: function(data){
													document.getElementById('btcp-donation-value-litecoin').innerHTML = data.data.totalreceived;
												},
												error: function() {
													document.getElementById('btcp-donation-value-litecoin').innerHTML = 'Error';
												}
											});
										</script>
										</div>
									</div>
									<br />
									<div class="btcpQrcodeDonationWrapper">
										<p>
											<strong><?php _e('dogecoin address', 'bitcoin-payments'); ?></strong>
										</p>
										<div id="qrcodeDonationDogecoin" title="<?php echo(DTCP_ADDRESS); ?>"></div>
										<div style="word-wrap: break-word;"><a href="dogecoin:<?php echo(DTCP_ADDRESS); ?>" style="word-wrap: break-word;"><?php echo(DTCP_ADDRESS); ?></a><br />
										<span><?php _e('Received: ', 'bitcoin-payments'); ?><span id="btcp-donation-value-dogecoin"></span></span>
										<script>
											jQuery('#qrcodeDonationDogecoin').qrcode({
												render	: "canvas",
												width	: "<?php echo(BTCP_QRCODE_WIDTH); ?>",
												height	: "<?php echo(BTCP_QRCODE_HEIGHT); ?>",
												text	: "dogecoin:<?php echo(DTCP_ADDRESS); ?>"
											});	
											//url: 'https://dogechain.info/chain/Dogecoin/q/getreceivedbyaddress/<?php echo(DTCP_ADDRESS); ?>',
											jQuery.ajax({
												url: 'https://chain.so/api/v2/address/<?php echo(DTCP_ADDRESS); ?>',
												dataType: 'jsonp',
												success: function(data){
													document.getElementById('btcp-donation-value-dogecoin').innerHTML = data.data.received_value;
												},
												error: function() {
													document.getElementById('btcp-donation-value-dogecoin').innerHTML = 'Error';
												}
											});
										</script>
										</div>
									</div>
								</td>
							</tr>
						</table>
					</div> <!-- .postbox -->
					
				</div> <!-- .meta-box-sortables -->
				
			</div> <!-- #postbox-container-1 .postbox-container -->
		</div> <!-- #post-body .metabox-holder .columns-2 -->
	<br class="clear">
	</div> <!-- #poststuff -->
	
</div> <!-- .wrap -->