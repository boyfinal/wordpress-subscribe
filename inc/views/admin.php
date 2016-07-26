<div class="wrap">
	<h2>Options Plugin Farost Subscribe</h2>
	<form action="options.php" method="post">
		<?php settings_fields('farost_subscribe_options'); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="farost_subscribe_fbkey"><?php _e("MailChimp API Key", 'farost_subscribe'); ?></label>
					</th>
					<td>
						<input id="farost_subscribe_api_key" name="farost_subscribe[mc_api_key]" type="text" value="<?php echo farost_subscribe_option('mc_api_key'); ?>" class="regular-text ltr" />
						<p class="description">
							<?php _e('Paste following url in <strong>Site URL</strong> settings', 'farost_subscribe'); ?>: 
							<strong style="color: #14ACDF"><?php echo home_url(); ?></strong>
						</p>
					</td>
				</tr>
				<tr>
					<th>
						<label for="farost_subscribe_list_id"><?php _e("MailChimp List ID", 'farost_subscribe'); ?></label>
					</th>
					<td>
						<input id="farost_subscribe_list_id" name="farost_subscribe[mc_list_id]" type="text" value="<?php echo farost_subscribe_option('mc_list_id'); ?>" class="regular-text ltr"/>
						<p class="description">
							<?php _e('Paste following url in <strong>Website</strong> and <strong>Callback URL</strong> settings', 'farost_subscribe'); ?>: 
							<strong style="color: #14ACDF"><?php echo home_url(); ?></strong>
						</p>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="save" class="button button-primary" value="<?php _e("Save Changes", 'farost_subscribe'); ?>" />
		</p>
	</form>
</div>