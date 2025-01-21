<?php

$secret = $settings['secret_key'];
$public = $settings['public_key'];
$theme = isset($settings['theme']) ? $settings['theme'] : 'light';

function recaptcha_v2_get()
{
	global $public, $theme;

	return "
		<script type=\"text/javascript\">
			var onloadCallback = function() {
				grecaptcha.render('tp-captcha', {
					'sitekey'  : '" . $public . "',
					'theme'    : '" . $theme . "'
				});
			};
		</script>
		<div id=\"tp-captcha\"></div>
		<script src=\"https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit\" async defer></script>";
}

function recaptcha_v2_check()
{
	global $secret;

	$resp = null;

	require_once(CLASS_DIR . 'recaptcha.php');
	$reCaptcha = new ReCaptcha($secret);

	$g_resp = request_var('g-recaptcha-response', '');
	if ($g_resp) {
		$resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $g_resp);
	}
	if ($resp != null && $resp->success) {
		return true;
	} else {
		return false;
	}
}
