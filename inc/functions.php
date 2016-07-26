<?php


if (!function_exists('farost_subscribe_get_url')) {

	/**
	 * @param  string $path
	 * @return string
	 */
    function farost_subscribe_get_url( $path = '' )
    {
        return plugins_url( ltrim( $path, '/' ), dirname(__FILE__) );
    }
}

if (!function_exists('farost_subscribe_option')) {

	/**
	 * @param  string $key
	 * @param  string $default
	 * @return string||array
	 */
    function farost_subscribe_option($key = '', $default = '')
    {
        global $farost_subscribe_options;
        if ( empty($farost_subscribe_options) ) {
            return $default;
        }
        if ($key) {
            if ( empty($farost_subscribe_options[$key]) ) {
                return $default;
            }
            return $farost_subscribe_options[$key];
        } else {
            return $farost_subscribe_options;
        }
    }
}

if (!function_exists('farost_subscribe_ajax')) {

	/**
	 * @return json
	 */
	function farost_subscribe_ajax()
	{
		$name 	= stripslashes(trim($_REQUEST['name']));
	    $email 	= stripslashes(trim($_REQUEST['email']));

	    $error 		= 0;
	    $message 	= '';

	    if ( empty($email) ) {
	        $error = 1;
	        $message = __('The email is a required field.','farost_subscribe');
	    }elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
	        $error = 1;
	        $message = __('The email address isn’t correct.','farost_subscribe');
	    }

	    if (!$error) {
	    	$api_key = farost_subscribe_option('mc_api_key');
	    	$list_id = farost_subscribe_option('mc_list_id');
	    	$mc = new FSMC($api_key);
	    	$data = array(
	    		'email' => $email,
	    		'merge_fields' => array(
	    			'NAME'  => $name,
	    			'FNAME' => '',
	    			'LNAME' => ''
				)
			);
	    	$res = $mc->list_member_add($data, $list_id);
	    	$ares = json_decode($res,true);
	    	if($ares['status'] == 'subscribed'){
	    		if($ares['timestamp_opt'] == $ares['last_changed']){
			        $message = __('You have successfully registered.Thank you!!!.','farost_subscribe');
	    		}else{
			        $message = __('You have registered.Thank you!!!','farost_subscribe');
	    		}
	    	}else{
	    		$error = 1;
		        $message = __('Fail!!!.','farost_subscribe');
	    	}
	    }
	    header('Content-Type: application/json');
	    echo json_encode(array(
	    	'error' => $error,
	    	'message' => $message
	    ));
	    exit;
	}
	add_action('wp_ajax_nopriv_farost_subscribe_ajax', 'farost_subscribe_ajax');
	add_action('wp_ajax_farost_subscribe_ajax', 'farost_subscribe_ajax');
}

if (!function_exists('farost_subscribe_form')) {

	/**
	 * @param  array  $agrs [description]
	 * @return string
	 */
	function farost_subscribe_form($agrs = array())
	{
		wp_register_script('farost-subscribe-js', farost_subscribe_get_url('assets/script.js'), array('jquery'), '1.0.0');
        wp_enqueue_script('farost-subscribe-js');
		$defaults = array(
			'class' 		=> '',
			'text_submit' 	=> 'Subscribe',
			'input_submit_class' 	=> '',
		);
		$agrs = array_merge($defaults, $agrs);
		extract($agrs);

		if( !empty($class) ){
			echo '<div class="'. esc_attr( $class ) .'">';
		}
		?>
				<form data-url="<?php echo admin_url( 'admin-ajax.php?t='. time() ); ?>" class="frm_subscribe frm_mailchimp" method="POST" >
					<input class="input_text name" name="name" type="text" placeholder="<?php _e('Your name', 'farost_subscribe');?>" />
					<input class="input_text required email" name="email" value="" type="text" placeholder="<?php _e('Your mail', 'farost_subscribe');?>" />
					<input name="subscribe" value="<?php echo esc_attr( $text_submit ); ?>" class="input_submit <?php echo $input_submit_class; ?>" type="submit" />
					<div class="farost_subscribe_status"></div>
				</form>

		<?php
		if( !empty( $class ) ){
			echo '</div>';
		}
	}
}

if (!function_exists('farost_subscribe_shortcode')) {

	/**
	 * @param array $atts
	 * @param string $content
	 * @return string
	 */
	function farost_subscribe_shortcode($atts, $content)
	{
		farost_subscribe_form($atts);
	}
	add_shortcode('farost_subscribe', 'farost_subscribe_shortcode');
}