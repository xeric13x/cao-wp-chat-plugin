<?php
function cao_create_option() {
	$opt_names = unserialize( CAO_CHAT_OPTION_NAMES );
	$opt_arr = array();

	if ( get_option( 'cao_merchant_id' ) != null ) {
		foreach ($opt_names as $k => $v) {
			$opt_arr[$k] = get_option( $opt_names[$k] );
			delete_option( $opt_names[$k] );
		}
	} else {
		$opt_arr['mid'] = '00000';
		$opt_arr['pid'] = '00000';
		$opt_arr['display_icon'] = 0;
		$opt_arr['placement_id'] = 0;
		$opt_arr['has_dropin'] = '0';
		$opt_arr['has_mtc'] = 0;
		$opt_arr['has_social_media_bar'] = 0;
	}

	$opt_arr['mtc_icon'] = 'MultiFamilyIcon_MTC_LightGray.png';

	add_option( CAO_CHAT_OPTION_NAME, $opt_arr );
}

// Add CAO! options groupo upon activation of plugin
function activate_cao() {
	cao_create_option();
}

// Delete CAO! options groupo upon deactivation of plugin
function deactivate_cao() {
	// delete_option( CAO_CHAT_OPTION_NAME );
}

// Register options
function cao_admin_init() {
	register_setting( 'cao_chat_settings', CAO_CHAT_OPTION_NAME );
}

// Add settings page
function cao_menu_settings() {
	add_options_page( CAO_CHAT_COMPANY_NAME . ' Chat Settings', CAO_CHAT_COMPANY_NAME, 'manage_options', 'cao-chat', 'cao_chat_settings');
}

// Call settings page
function cao_chat_settings() {
	include( plugin_dir_path( __FILE__ ) . 'settings-page.php' );
}

function admin_cao_scripts_n_styles() {
	wp_enqueue_style( 'cao-admin', plugins_url( '/assets/css/cao-admin.css', dirname( __FILE__ ) ) );
	wp_enqueue_script( 'cao-chat-admin', plugins_url( '/assets/js/cao-admin.js', dirname( __FILE__ ) ), array( 'jquery-cao-radio-selector' ) );
	wp_enqueue_script( 'jquery-cao-radio-selector', plugins_url( '/assets/js/jquery.cao-radioSelector.js', dirname( __FILE__ ) ), array( 'jquery' ) );
}

function cao_scripts_n_styles() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_style( 'cao-chat', plugins_url( '/assets/css/cao-chat.css', dirname( __FILE__ ) ) );
	wp_enqueue_script( 'cao-chat-bowser', plugins_url( '/assets/js/bowser.min.js', dirname( __FILE__ ) ), array(), false, false );
}

// Creat chat code
function display_cao() {
	$opt_names = get_option( CAO_CHAT_OPTION_NAME );

	$mid = $opt_names['mid'];
	$pid = $opt_names['pid'];
	$display_icon = $opt_names['display_icon'];
	$placement_id = $opt_names['placement_id'];
	$has_dropin = $opt_names['has_dropin'];
	$has_mtc = $opt_names['has_mtc'];
	$mtc_icon = $opt_names['mtc_icon'];
	$has_social_media_bar = $opt_names['has_social_media_bar'];
	// Check for Merchant ID && Provider ID before placing code
	if ( $mid != '00000' && $pid != '0') {
		// Check for placement code for chat icon
		if ( $placement_id != '0' && $display_icon) {
			echo '<div class="cao-chat-icon"><a onclick="javascript:window.open(\'//dm5.contactatonce.com/CaoClientContainer.aspx?MerchantId='. $mid . '&amp;Providerid=' . $pid . '&amp;PlacementId=' . $placement_id . '&amp;OriginationUrl=\'+encodeURIComponent(location.href),\'\',\'resizable=yes,toolbar=no,menubar=no,location=no,scrollbars=no,status=no,height=400,width=600\');return false;" href="#"><img onerror="this.height=0;this.width=0" src="//dm5.contactatonce.com/getagentstatusimage.aspx?MerchantId=' . $mid . '&amp;ProviderId=' . $pid .'&amp;PlacementId=' . $placement_id . '" border="0" /></a></div>' . PHP_EOL;
		}

		// Check for dropin
		if ( $has_dropin ) {
			echo	'<script language="JavaScript" src="//dm5.contactatonce.com/scripts/PopIn.js" type="text/javascript"></script>' . PHP_EOL .
					'<script language="JavaScript" src="//dm5.contactatonce.com/PopInGenerator.aspx?MerchantId=' . $mid . '&amp;ProviderId=' . $pid . '&amp;PlacementId=0" type="text/javascript"></script>' . PHP_EOL;
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
		if ( $has_mtc ) {
			echo '<div class="cao-mtc-icon"><a onclick="javascript:window.open(\'//mtc.contactatonce.com/MobileTextConnectConversationInitiater.aspx?MerchantId=' . $mid . '&ProviderId=' . $pid . '&PlacementId=31\',\'\',\'resizable=yes,toolbar=no,menubar=no,location=no,scrollbars=no,status=no,height=350,width=410\');return false;" href="#"><img src="http://cdn.contactatonce.com/mobile/' . $mtc_icon . '" border="0" /></a></div>' . PHP_EOL;
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
		if ( $has_social_media_bar ) {
			echo '<script type="text/javascript" src="//toolbar.contactatonce.com/ToolbarGenerator.aspx?MerchantId=' . $mid . '&amp;ProviderId=' . $pid . '"></script>' . PHP_EOL;
		}
	}
}