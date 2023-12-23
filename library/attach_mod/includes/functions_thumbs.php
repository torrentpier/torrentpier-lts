<?php

if (!defined('IN_FORUM')) die("Hacking attempt");

$imagick = '';

/**
* Calculate the needed size for Thumbnail
*/
function get_img_size_format($width, $height, $target_width, $target_height = null)
{
	if ($target_height == null)
	{
		// get width to height ratio
		$ratio = $width / $height;

		// if is portrait
		// use ratio to scale height to fit in square
		if ($width > $height)
		{
			return array(
				$target_width, // is target width
				floor($target_width / $ratio) // is target height
			);
		}
		// if is landscape
		// use ratio to scale width to fit in square
		else
		{
			return array(
				floor($target_width * $ratio), // is target width
				$target_width // is target height
			);
		}
	}

	return array(
		$target_width,
		$target_height
	);
}

/**
* Check if imagick is present
*/
function is_imagick()
{
	global $imagick, $attach_config;

	if ($attach_config['img_imagick'] != '')
	{
		$imagick = $attach_config['img_imagick'];
		return true;
	}
	else
	{
		return false;
	}
}

/**
* Get supported image types
*/
function get_supported_image_types($type)
{
	if (@extension_loaded('gd'))
	{
		$format = imagetypes();
		$new_type = 0;

		switch ($type)
		{
			case IMAGETYPE_GIF:
				$new_type = ($format & IMG_GIF) ? IMG_GIF : 0;
				break;
			case IMAGETYPE_JPEG:
				$new_type = ($format & IMG_JPG) ? IMG_JPG : 0;
				break;
			case IMAGETYPE_PNG:
				$new_type = ($format & IMG_PNG) ? IMG_PNG : 0;
				break;
		}

		return array(
			'gd'		=> ($new_type) ? true : false,
			'format'	=> $new_type,
			'version'	=> (function_exists('imagecreatetruecolor')) ? 2 : 1
		);
	}

	return array('gd' => false);
}

/**
* Create thumbnail
*/
function create_thumbnail($source, $new_file, $mimetype)
{
	global $attach_config, $imagick;

	$source = amod_realpath($source);
	$min_filesize = (int) $attach_config['img_min_thumb_filesize'];
	$img_filesize = (@file_exists($source)) ? @filesize($source) : false;

	if (!$img_filesize || $img_filesize <= $min_filesize)
	{
		return false;
	}

	list($width, $height, $type, ) = getimagesize($source);

	if (!$width || !$height)
	{
		return false;
	}

	// Thumbnail sizes
	$target_width = 170;
	$target_height = null;

	list($new_width, $new_height) = get_img_size_format($width, $height, $target_width, $target_height);

	$tmp_path = $old_file = '';

	$used_imagick = false;

	if (is_imagick())
	{
		passthru($imagick . ' -quality 85 -antialias -sample ' . $new_width . 'x' . $new_height . ' "' . str_replace('\\', '/', $source) . '" +profile "*" "' . str_replace('\\', '/', $new_file) . '"');
		if (@file_exists($new_file))
		{
			$used_imagick = true;
		}
	}

	if (!$used_imagick)
	{
		$type = get_supported_image_types($type);

		if ($type['gd'])
		{
			$image = '';

			switch ($type['format'])
			{
				case IMG_GIF:
					$image = imagecreatefromgif($source);
					break;
				case IMG_JPG:
					$image = imagecreatefromjpeg($source);
					break;
				case IMG_PNG:
					$image = imagecreatefrompng($source);
					break;
			}

			if ($type['version'] == 1 || !$attach_config['use_gd2'])
			{
				$new_image = imagecreate($new_width, $new_height);
				imagecopyresized($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			}
			else
			{
				$new_image = imagecreatetruecolor($new_width, $new_height);

				// set transparency options for GIFs and PNGs
				if ($type['format'] == IMG_GIF || $type['format'] == IMG_PNG)
				{
					// make image transparent
					imagecolortransparent($new_image, imagecolorallocate($new_image, 0, 0, 0));

					// additional settings for PNGs
					if ($type['format'] == IMG_PNG)
					{
						imagealphablending($new_image, false);
						imagesavealpha($new_image, true);
					}
				}

				imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			}

			// Устанавливаем тип содержимого в заголовок
			header('Content-Type: ' . $mimetype);

			switch ($type['format'])
			{
				case IMG_GIF:
					imagegif($new_image, $new_file);
					break;
				case IMG_JPG:
					imagejpeg($new_image, $new_file, 90);
					break;
				case IMG_PNG:
					imagepng($new_image, $new_file);
					break;
			}

			imagedestroy($new_image);
		}
	}

	if (!@file_exists($new_file))
	{
		return false;
	}

	@chmod($new_file, 0664);

	return true;
}
