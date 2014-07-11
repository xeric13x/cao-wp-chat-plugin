<?php
// Add CAO! options groupo upon activation of plugin
function activate_cao() {
	add_option( 'cao_merchant_id', '00000' );
	add_option( 'cao_provider_id', '0' );
	add_option( 'cao_display_icon', 0 );
	add_option( 'cao_placement_id', '0' );
	add_option( 'cao_has_dropin', 0 );
	add_option( 'cao_has_mtc', 0 );
	add_option( 'cao_has_social_media_bar', 0 );
}

// Delete CAO! options groupo upon activation of plugin
function deactivate_cao() {
	delete_option( 'cao_merchant_id' );
	delete_option( 'cao_provider_id' );
	delete_option( 'cao_display_icon' );
	delete_option( 'cao_placement_id' );
	delete_option( 'cao_has_dropin' );
	delete_option( 'cao_has_mtc' );
	delete_option( 'cao_has_social_media_bar' );
}

// Register options
function cao_admin_init() {
	register_setting( 'cao_settings', 'cao_merchant_id' );
	register_setting( 'cao_settings', 'cao_provider_id' );
	register_setting( 'cao_settings', 'cao_display_icon' );
	register_setting( 'cao_settings', 'cao_placement_id' );
	register_setting( 'cao_settings', 'cao_has_dropin' );
	register_setting( 'cao_settings', 'cao_has_mtc' );
	register_setting( 'cao_settings', 'cao_has_social_media_bar' );
}

// Add settings page
function cao_menu_settings() {
	add_options_page( WTH_COMPANY_NAME . ' Chat Settings', WTH_COMPANY_NAME, 'manage_options', 'cao-chat', 'cao_chat_settings');
}

// Call settings page
function cao_chat_settings() {
	include( plugin_dir_path( __FILE__ ) . 'settings-page.php' );
}

function admin_cao_scripts_n_styles() {
	wp_enqueue_script( 'cao-chat-admin', plugins_url( '/assets/js/cao-admin.js', dirname( __FILE__ ) ) );
}

function cao_scripts_n_styles() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'cao-chat', plugins_url( '/assets/css/cao-chat.css', dirname( __FILE__ ) ) );
	wp_enqueue_script( 'cao-chat-bowser', plugins_url( '/assets/js/bowser.min.js', dirname( __FILE__ ) ), array(), false, false );
}

// Creat chat code
function display_cao() {
	$cao_merchant_id = get_option( 'cao_merchant_id' );
	$cao_provider_id = get_option( 'cao_provider_id' );
	$cao_display_icon = get_option( 'cao_display_icon' );
	$cao_placement_id = get_option( 'cao_placement_id' );
	$cao_has_dropin = get_option( 'cao_has_dropin' );
	$cao_has_mtc = get_option( 'cao_has_mtc' );
	$cao_has_social_media_bar = get_option( 'cao_has_social_media_bar' );
	// Check for Merchant ID && Provider ID before placing code
	if ( $cao_merchant_id != '00000' && $cao_provider_id != '0') {
		// Check for placement code for chat icon
		if ( $cao_placement_id != '0' && $cao_display_icon) {
			echo '<div class="cao-chat-icon"><a onclick="javascript:window.open(\'//dm5.contactatonce.com/CaoClientContainer.aspx?MerchantId='. $cao_merchant_id . '&amp;Providerid=' . $cao_provider_id . '&amp;PlacementId=' . $cao_placement_id . '&amp;OriginationUrl=\'+encodeURIComponent(location.href),\'\',\'resizable=yes,toolbar=no,menubar=no,location=no,scrollbars=no,status=no,height=400,width=600\');return false;" href="#"><img onerror="this.height=0;this.width=0" src="//dm5.contactatonce.com/getagentstatusimage.aspx?MerchantId=' . $cao_merchant_id . '&amp;ProviderId=' . $cao_provider_id .'&amp;PlacementId=' . $cao_placement_id . '" border="0" /></a></div>' . PHP_EOL;
		}

		// Check for dropin
		if ( $cao_has_dropin ) {
			echo	'<script language="JavaScript" src="//dm5.contactatonce.com/scripts/PopIn.js" type="text/javascript"></script>' . PHP_EOL .
					'<script language="JavaScript" src="//dm5.contactatonce.com/PopInGenerator.aspx?MerchantId=' . $cao_merchant_id . '&amp;ProviderId=' . $cao_provider_id . '&amp;PlacementId=0" type="text/javascript"></script>' . PHP_EOL;
			echo <<<JS
				<script language="JavaScript">
					if (!bowser.mobile) {
						function WrappedPopin() {
							try {
								popIn();
							} catch(Exception) {}
						}
						WrappedPopin();
					}
				</script>
JS;
		}

		// Check for MTC
		if ( $cao_has_mtc ) {
			echo '<div class="cao-mtc-icon"><a onclick="javascript:window.open(\'//mtc.contactatonce.com/MobileTextConnectConversationInitiater.aspx?MerchantId=' . $cao_merchant_id . '&ProviderId=' . $cao_provider_id . '&PlacementId=34\',\'\',\'resizable=yes,toolbar=no,menubar=no,location=no,scrollbars=no,status=no,height=350,width=410\');return false;" href="#"><img src="//cdn.contactatonce.com/mobile/WPMTCIcon_06.png" border="0" /></a></div>' . PHP_EOL;
			echo <<<JS
				<script type="text/javascript">
					var wth = jQuery.noConflict();

					wth(function() {
						var	chatIcon = wth('.cao-chat-icon'),
							mtcIcon = wth('.cao-mtc-icon'),
							mtcTop = '';
						if (chatIcon.length > 0) {
							var ost = chatIcon.offset().top;
							mtcTop = ost + chatIcon.height() + 20;
						} else {
							mtcTop = '10%';
						}
						mtcIcon.css('top', mtcTop);
					});
				</script>
JS;
		}

		// Check for social media bar
		if ( $cao_has_social_media_bar ) {
			echo '<script type="text/javascript" src="//toolbar.contactatonce.com/ToolbarGenerator.aspx?MerchantId=' . $cao_merchant_id . '&amp;ProviderId=' . $cao_provider_id . '"></script>' . PHP_EOL;
		}
	}
}