<?php $opt_names = get_option( CAO_CHAT_OPTION_NAME ) ?>
<div class="wrap">
	<h2>Contact At Once Settings</h2>
	<p>Note: In order to use this plugin, you must have an active, eligible Contact At Once! account and know your Merchant ID and Provider ID.</p>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	<?php settings_fields( 'cao_chat_settings' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">Merchant ID</th>
				<td><input type="text" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[mid]" value="<?php echo $opt_names['mid']; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Provider ID</th>
				<td><input type="text" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[pid]" value="<?php echo $opt_names['pid']; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you want a chat icon?</th>
				<td><input type="checkbox" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[display_icon]" value="1" <?php checked( $opt_names['display_icon'] ); ?> /> <label>Yes</label></td>
			</tr>
			<tr valign="top" id="cao-placement-id-wrapper">
				<th scope="row">Placement ID</th>
				<td><input type="text" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[placement_id]" value="<?php echo $opt_names['placement_id']; ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you have the chat drop-in?</th>
				<td><input type="checkbox" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[has_dropin]" value="1" <?php checked( $opt_names['has_dropin'] ); ?> /> <label>Yes</label></td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you have Mobile Text Connect (MTC)?</th>
				<td><input type="checkbox" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[has_mtc]" value="1" <?php checked( $opt_names['has_mtc'] ); ?> /> <label>Yes</label></td>
			</tr>
			<tr valign="top" id="cao-mtc-button">
				<th scope="row">Which MTC icon do you want to use?</th>
				<td>
					<div class="cao-radio-group">
						<span><input type="radio" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[mtc_icon]" value="MultiFamilyIcon_MTC_LightGray.png" id="mtc-lightgray" <?php checked( $opt_names['mtc_icon'] == 'MultiFamilyIcon_MTC_LightGray.png' ); ?> /><label for="mtc-lightgray"><img src="http://cdn.contactatonce.com/mobile/MultiFamilyIcon_MTC_LightGray.png" alt="Gray Icon" /></label></span>
						<span><input type="radio" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[mtc_icon]" value="MultiFamilyIcon_MTC_Purple.png" id="mtc-purple" <?php checked( $opt_names['mtc_icon'] == 'MultiFamilyIcon_MTC_Purple.png' ); ?> /><label for="mtc-purple"><img src="http://cdn.contactatonce.com/mobile/MultiFamilyIcon_MTC_Purple.png" alt="Purple Icon" /></label></span>
						<span><input type="radio" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[mtc_icon]" value="MultiFamilyIcon_MTC_Blue.png" id="mtc-blue" <?php checked( $opt_names['mtc_icon'] == 'MultiFamilyIcon_MTC_Blue.png' ); ?> /><label for="mtc-blue"><img src="http://cdn.contactatonce.com/mobile/MultiFamilyIcon_MTC_Blue.png" alt="Blue Icon" /></label></span>
						<span><input type="radio" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[mtc_icon]" value="MultiFamilyIcon_MTC_Green.png" id="mtc-green" <?php checked( $opt_names['mtc_icon'] == 'MultiFamilyIcon_MTC_Green.png' ); ?> /><label for="mtc-green"><img src="http://cdn.contactatonce.com/mobile/MultiFamilyIcon_MTC_Green.png" alt="Green Icon" /></label></span>
						<span><input type="radio" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[mtc_icon]" value="MultiFamilyIcon_MTC_Orange.png" id="mtc-orange" <?php checked( $opt_names['mtc_icon'] == 'MultiFamilyIcon_MTC_Orange.png' ); ?> /><label for="mtc-orange"><img src="http://cdn.contactatonce.com/mobile/MultiFamilyIcon_MTC_Orange.png" alt="Orange Icon" /></label></span>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you have the Social Media Toolbar?</th>
				<td><input type="checkbox" name="<?php echo CAO_CHAT_OPTION_NAME; ?>[has_social_media_bar]" value="1" <?php echo checked( $opt_names['has_social_media_bar'] ); ?> /> <label>Yes</label></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>

