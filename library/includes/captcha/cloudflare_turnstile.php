<?php

function cloudflare_turnstile_get($settings)
{
	return "
		<script src='https://challenges.cloudflare.com/turnstile/v0/api.js' async defer></script>
		<div class='cf-turnstile' data-sitekey='{$settings['site_key']}' data-theme='light'></div>";
}

function cloudflare_turnstile_check($settings)
{

}

