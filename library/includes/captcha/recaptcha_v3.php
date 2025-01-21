<?php

function recaptcha_v3_get($settings)
{
	return "
	<script src='https://www.google.com/recaptcha/api.js?render={$settings['site_key']}'></script>
	<script>
		grecaptcha.ready(function() {
			grecaptcha.execute('{$settings['site_key']}', { action:'validate_captcha' }).then(function(token) {
				document.getElementById('g-recaptcha-response').value = token;
			});
    	});
	</script>
	<input type='hidden' id='g-recaptcha-response' name='g-recaptcha-response'>";
}

function recaptcha_v3_check($settings)
{
	$captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;
	if (!$captcha) {
		return false;
	}

	$postdata = http_build_query(
		array(
			'secret' => $settings['secret_key'],
			'response' => $captcha,
			'remoteip' => $_SERVER["REMOTE_ADDR"]
		)
	);
	$opts = array(
		'http' =>
			array(
				'method' => 'POST',
				'header' => 'Content-Type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
	);
	$context = stream_context_create($opts);

	$googleApiResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
	if ($googleApiResponse === false) {
		return false;
	}

	$googleApiResponseObject = json_decode($googleApiResponse);
	return $googleApiResponseObject->success;
}
