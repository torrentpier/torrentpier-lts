<?php

if (!defined('BB_ROOT')) die(basename(__FILE__));

class cache_memcache extends cache_common
{
	var $used      = true;
	var $engine    = 'Memcache';
	var $cfg       = null;
	var $prefix    = null;
	var $memcache  = null;
	var $connected = false;

	function cache_memcache ($cfg, $prefix = null)
	{
		if (!$this->is_installed())
		{
			die("Error: {$this->engine} extension not installed");
		}

		$this->cfg      = $cfg;
		$this->prefix   = $prefix;
		$this->memcache = new Memcache;
		$this->dbg_enabled = sql_dbg_enabled();
	}

	function connect ()
	{
		$connect_type = ($this->cfg['pconnect']) ? 'pconnect' : 'connect';

		$this->cur_query = $connect_type .' '. $this->cfg['host'] .':'. $this->cfg['port'];
		$this->debug('start');

		if (@$this->memcache->$connect_type($this->cfg['host'], $this->cfg['port']))
		{
			$this->connected = true;
		}

		if (!$this->connected && $this->cfg['con_required'])
		{
			$server = (DBG_USER) ? "'" . $this->cfg['host'] . "'" : '';
			header("HTTP/1.0 503 Service Unavailable");
			$con_error = "Could not connect to {$this->engine} server $server";

			if (DBG_LOG)
			{
				dbg_log($con_error, "{$this->engine}-CACHE-connect-FAIL");
			}

			die($con_error);
		}

		$this->debug('stop');
		$this->cur_query = null;
	}

	function get ($name, $get_miss_key_callback = '', $ttl = 0)
	{
		if (!$this->connected) $this->connect();

		$this->cur_query = "cache->get('$name')";
		$this->debug('start');
		$this->debug('stop');
		$this->cur_query = null;
		$this->num_queries++;

		return ($this->connected) ? $this->memcache->get($this->prefix . $name) : false;
	}

	function set ($name, $value, $ttl = 0)
	{
		if (!$this->connected) $this->connect();

		$this->cur_query = "cache->set('$name')";
		$this->debug('start');
		$this->debug('stop');
		$this->cur_query = null;
		$this->num_queries++;

		return ($this->connected) ? $this->memcache->set($this->prefix . $name, $value, false, $ttl) : false;
	}

	function rm ($name = '')
	{
		if (!$this->connected) $this->connect();

		if ($name)
		{
			$this->cur_query = "cache->rm('$name')";
			$this->debug('start');
			$this->debug('stop');
			$this->cur_query = null;
			$this->num_queries++;

			return ($this->connected) ? $this->memcache->delete($this->prefix . $name, 0) : false;
		}
		else
		{
			return ($this->connected) ? $this->memcache->flush() : false;
		}
	}

	function is_installed ()
	{
		return class_exists('Memcache');
	}
}
