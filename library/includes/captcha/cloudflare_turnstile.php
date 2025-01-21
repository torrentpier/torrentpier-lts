<?php

function cloudflare_turnstile_get($settings)
{
	return "
		<script src='https://challenges.cloudflare.com/turnstile/v0/api.js' async defer></script>
		<div class='cf-turnstile' data-sitekey='{$settings['site_key']}' data-theme='light'></div>";
}

function cloudflare_turnstile_check($settings)
{
	$turnstile_response = $_POST['cf-turnstile-response'];
	$url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";
	$post_fields = "secret={$settings['secret_key']}&response=$turnstile_response";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
	$response = curl_exec($ch);
	curl_close($ch);

	$response_data = json_decode($response);
	if ($response_data->success == 1) {
		return true;
	} else {
		return false;
	}
}

