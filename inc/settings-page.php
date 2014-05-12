<div class="wrap">
	<h2>Contact At Once Settings</h2>

	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
	<?php settings_fields('cao_settings'); ?>

		<table class="form-table">
			<tr valign="top">
				<th scope="row">Merchant ID</th>
				<td><input type="text" name="cao_merchant_id" value="<?php echo get_option('cao_merchant_id'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Provider ID</th>
				<td><input type="text" name="cao_provider_id" value="<?php echo get_option('cao_provider_id'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Placement ID</th>
				<td><input type="text" name="cao_placement_id" value="<?php echo get_option('cao_placement_id'); ?>" /></td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you have the chat drop-in?</th>
				<td><input type="checkbox" name="cao_has_dropin" value="1" <?php echo checked( get_option('cao_has_dropin') ); ?> /> <label>Yes</label></td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you have Mobile Text Connect(MTC)?</th>
				<td><input type="checkbox" name="cao_has_mtc" value="1" <?php echo checked( get_option('cao_has_mtc') ); ?> /> <label>Yes</label></td>
			</tr>
			<tr valign="top">
				<th scope="row">Do you have the Social Media Toolbar?</th>
				<td><input type="checkbox" name="cao_has_social_media_bar" value="1" <?php echo checked( get_option('cao_has_social_media_bar') ); ?> /> <label>Yes</label></td>
			</tr>
		</table>
		<input type="hidden" name="action" value="update" />
		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
		</p>
	</form>
</div>
