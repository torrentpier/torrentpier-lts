<?php

function yandex_captcha_get($settings)
{
	return "
		<script src='https://smartcaptcha.yandexcloud.net/captcha.js' defer></script>
		<div id='captcha-container' class='smart-captcha' data-sitekey='{$settings['client_key']}' data-hl='ru'></div>";
}

function yandex_captcha_check($settings)
{
	$ch = curl_init("https://smartcaptcha.yandexcloud.net/validate");
	$args = [
		'secret' => $settings['server_key'],
		'token' => $_POST['smart-token'],
		'ip' => $_SERVER["REMOTE_ADDR"],
	];

	curl_setopt($ch, CURLOPT_TIMEOUT, 1);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($args));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

	if ($httpcode !== 200) {
		return true;
	}

	$resp = json_decode($server_output);
	return ($resp->status === 'ok');
}
