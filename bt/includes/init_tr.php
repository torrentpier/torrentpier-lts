<?php

if (!defined('IN_TRACKER')) die(basename(__FILE__));

// Exit if tracker is disabled
if ($tr_cfg['off']) msg_die($tr_cfg['off_reason']);

//
// Functions
//
function tracker_exit ()
{
	global $DBS;

	if (DBG_LOG_TRACKER)
	{
		if ($gen_time = utime() - TIMESTART)
		{
			$sql_init_perc  = round($DBS->sql_inittime*100/$gen_time);
			$sql_total_perc = round($DBS->sql_timetotal*100/$gen_time);

			$str = array();
			$str[] = substr(TIMENOW, -4, 4);
			$str[] = sprintf('%.4f', $gen_time);
			$str[] = sprintf('%.4f'. LOG_SEPR .'%02d%%', $DBS->sql_inittime, $sql_init_perc);
			$str[] = sprintf('%.4f'. LOG_SEPR .'%02d%%', $DBS->sql_timetotal, $sql_total_perc);
			$str[] = $DBS->num_queries;
			$str[] = sprintf('%.1f', sys('la'));
			$str = join(LOG_SEPR, $str) . LOG_LF;
			dbg_log($str, '!!gentime');
		}
	}
	exit;
}

function silent_exit ()
{
	while (@ob_end_clean());

	tracker_exit();
}

function error_exit ($msg = '')
{
	if (DBG_LOG_TRACKER) dbg_log($msg, '!err-' . $msg . '_' . time());

	silent_exit();

	echo bencode(array('failure reason' => str_compact($msg)));

	tracker_exit();
}

// Database
class sql_db
{
	var $cfg           = array();
	var $cfg_keys      = array('dbhost', 'dbname', 'dbuser', 'dbpasswd', 'charset', 'persist');
	var $link          = null;
	var $result        = null;
	var $db_server     = '';
	var $selected_db   = null;

	var $locked        = false;

	var $num_queries   = 0;
	var $sql_starttime = 0;
	var $sql_inittime  = 0;
	var $sql_timetotal = 0;
	var $sql_last_time = 0;
	var $slow_time     = 0;

	var $cur_query     = null;

	var $DBS           = array();

	var $engine        = 'MySQL';

	/**
	* Constructor
	*/
	function sql_db ($cfg_values)
	{
		global $DBS;

		$this->cfg         = array_combine($this->cfg_keys, $cfg_values);
		$this->slow_time   = SQL_SLOW_QUERY_TIME;

		$this->DBS['num_queries']   =& $DBS->num_queries;
		$this->DBS['sql_inittime']  =& $DBS->sql_inittime;
		$this->DBS['sql_timetotal'] =& $DBS->sql_timetotal;
	}

	/**
	* Initialize connection
	*/
	function init ()
	{
		// Connect to server
		$this->link = $this->connect();

		// Select database
		$this->selected_db = $this->select_db();

		// Set charset
		if ($this->cfg['charset'] && !@mysql_set_charset($this->cfg['charset'], $this->link))
		{
			if (!$this->sql_query("SET NAMES {$this->cfg['charset']}"))
			{
				$this->log_error();
				error_exit("Could not set charset '{$this->cfg['charset']}'");
			}
		}

		$this->num_queries = 0;
		$this->sql_inittime = $this->sql_timetotal;
		$this->DBS['sql_inittime'] += $this->sql_inittime;
	}

	/**
	* Open connection
	*/
	function connect ()
	{
		$this->cur_query = 'connect';
		$this->debug('start');

		$connect_type = ($this->cfg['persist']) ? 'mysql_pconnect' : 'mysql_connect';

		if (!$link = @$connect_type($this->cfg['dbhost'], $this->cfg['dbuser'], $this->cfg['dbpasswd']))
		{
			$this->log_error();
			if (DBG_LOG_TRACKER)
			{
				dbg_log("Could not connect to {$this->engine} server '{$this->cfg['dbhost']}'", "{$this->cfg['dbhost']}-DB-connect-FAIL_" . time());
			}
		}

		register_shutdown_function(array(&$this, 'close'));

		$this->debug('end');
		$this->cur_query = null;

		if (!$link)
		{
			if (function_exists('dummy_exit'))
			{
				dummy_exit(mt_rand(1200, 2400));
			}
			else
			{
				die;
			}
		}

		return $link;
	}

	/**
	* Select database
	*/
	function select_db ()
	{
		$this->cur_query = "select db: '{$this->cfg['dbname']}'";
		$this->debug('start');

		if (!@mysql_select_db($this->cfg['dbname'], $this->link))
		{
			$this->log_error();
			error_exit("Could not select database '{$this->cfg['dbname']}'");
		}

		$this->debug('end');
		$this->cur_query = null;

		return $this->cfg['dbname'];
	}

	/**
	* Base query method
	*/
	function sql_query ($query)
	{
		if (!is_resource($this->link))
		{
			$this->init();
		}
		$query = '/* '. $this->debug_find_source() .' */ '. $query;
		$this->cur_query = $query;
		$this->debug('start');

		if (!$this->result = mysql_query($query, $this->link))
		{
			$this->log_error();
		}

		$this->debug('end');
		$this->cur_query = null;

		$this->num_queries++;
		$this->DBS['num_queries']++;

		return $this->result;
	}

	/**
	* Execute query WRAPPER (with error handling)
	*/
	function query ($query)
	{
		if (!$result = $this->sql_query($query))
		{
			$this->trigger_error();
		}

		return $result;
	}

	/**
	* Return number of rows
	*/
	function num_rows ($result = false)
	{
		$num_rows = false;

		if ($result OR $result = $this->result)
		{
			$num_rows = is_resource($result) ? mysql_num_rows($result) : false;
		}

		return $num_rows;
	}

	/**
	* Return number of affected rows
	*/
	function affected_rows ()
	{
		return is_resource($this->link) ? mysql_affected_rows($this->link) : -1;
	}

	/**
	* Fetch current row
	*/
	function sql_fetchrow ($result, $field_name = '')
	{
		$row = mysql_fetch_assoc($result);

		if ($field_name)
		{
			return isset($row[$field_name]) ? $row[$field_name] : false;
		}
		else
		{
			return $row;
		}
	}

	/**
	* Alias of sql_fetchrow()
	*/
	function fetch_next ($result)
	{
		return $this->sql_fetchrow($result);
	}

	/**
	* Fetch row WRAPPER (with error handling)
	*/
	function fetch_row ($query, $field_name = '')
	{
		if (!$result = $this->sql_query($query))
		{
			$this->trigger_error();
		}

		return $this->sql_fetchrow($result, $field_name);
	}

	/**
	* Fetch all rows
	*/
	function sql_fetchrowset ($result, $field_name = '')
	{
		$rowset = array();

		while ($row = mysql_fetch_assoc($result))
		{
			$rowset[] = ($field_name) ? $row[$field_name] : $row;
		}

		return $rowset;
	}

	/**
	* Fetch all rows WRAPPER (with error handling)
	*/
	function fetch_rowset ($query, $field_name = '')
	{
		if (!$result = $this->sql_query($query))
		{
			$this->trigger_error();
		}

		return $this->sql_fetchrowset($result, $field_name);
	}

	/**
	* Escape data used in sql query
	*/
	function escape ($v, $check_type = false, $dont_escape = false)
	{
		if ($dont_escape) return $v;
		if (!$check_type) return $this->escape_string($v);

		switch (true)
		{
			case is_string ($v): return "'". $this->escape_string($v) ."'";
			case is_int    ($v): return "$v";
			case is_bool   ($v): return ($v) ? '1' : '0';
			case is_float  ($v): return "'$v'";
			case is_null   ($v): return 'NULL';
		}
		// if $v has unsuitable type
		$this->trigger_error(__FUNCTION__ .' - wrong params');
	}

	/**
	* Escape string
	*/
	function escape_string ($str)
	{
		if (!is_resource($this->link))
		{
			$this->init();
		}

		return mysql_real_escape_string($str, $this->link);
	}

	/**
	* Return sql error array
	*/
	function sql_error ()
	{
		if (is_resource($this->link))
		{
			return array('code' => mysql_errno($this->link), 'message' => mysql_error($this->link));
		}
		else
		{
			return array('code' => '', 'message' => 'not connected');
		}
	}

	/**
	* Close sql connection
	*/
	function close ()
	{
		if (is_resource($this->link))
		{
			mysql_close($this->link);
		}

		$this->link = $this->selected_db = null;

		if (DBG_LOG_TRACKER) dbg_log(str_repeat(' ', $this->num_queries), 'DB-num_queries-'. php_sapi_name());
	}

	/**
	* Get info about last query
	*/
	function query_info ()
	{
		$info = array();

		if ($num = $this->num_rows($this->result))
		{
			$info[] = "$num rows";
		}

		if (is_resource($this->link) AND $ext = mysql_info($this->link))
		{
			$info[] = "$ext";
		}
		else if (!$num && ($aff = $this->affected_rows($this->result) AND $aff != -1))
		{
			$info[] = "$aff rows";
		}

		return str_compact(join(', ', $info));
	}

	/**
	* Store debug info
	*/
	function debug ($mode)
	{
		if (!SQL_DEBUG) return;

		if ($mode == 'start')
		{
			if (SQL_CALC_QUERY_TIME || DBG_LOG_TRACKER || SQL_LOG_SLOW_QUERIES)
			{
				$this->sql_starttime = utime();
				$this->sql_last_time = 0;
			}
		}
		elseif ($mode == 'end')
		{
			if (SQL_CALC_QUERY_TIME || DBG_LOG_TRACKER || SQL_LOG_SLOW_QUERIES)
			{
				$this->sql_last_time = utime() - $this->sql_starttime;
				$this->sql_timetotal += $this->sql_last_time;
				$this->DBS['sql_timetotal'] += $this->sql_last_time;

				if (SQL_LOG_SLOW_QUERIES && $this->sql_last_time > $this->slow_time)
				{
					$msg  = date('m-d H:i:s') . LOG_SEPR;
					$msg .= sprintf('%03d', round($this->sql_last_time));
					$msg .= LOG_SEPR . sprintf('%.1f', sys('la'));
					$msg .= LOG_SEPR . str_compact($this->cur_query);
					$msg .= LOG_SEPR .' # '. $this->query_info();
					$msg .= LOG_SEPR . $this->debug_find_source();
					bb_log($msg . LOG_LF, 'sql_slow_tr');
				}
			}
		}
	}

	/**
	* Trigger error
	*/
	function trigger_error ($msg = 'DB Error')
	{
		if (error_reporting())
		{
			if (DBG_LOG_TRACKER === true)
			{
				$err = $this->sql_error();
				$msg .= trim(sprintf(' #%06d %s', $err['code'], $err['message']));
			}
			else
			{
				$msg .= " [". $this->debug_find_source() ."]";
			}

			error_exit($msg);
		}
	}

	/**
	* Find caller source
	*/
	function debug_find_source ($mode = '')
	{
		if (!SQL_PREPEND_SRC_COMM) return 'src disabled';
		foreach (debug_backtrace() as $trace)
		{
			if (!empty($trace['file']) && $trace['file'] !== __FILE__)
			{
				switch ($mode)
				{
					case 'file': return $trace['file'];
					case 'line': return $trace['line'];
					default: return hide_bb_path($trace['file']) .'('. $trace['line'] .')';
				}
			}
		}
		return 'src not found';
	}

	/**
	* Log error
	*/
	function log_error ()
	{
		if (!SQL_LOG_ERRORS) return;

		$msg = array();
		$err = $this->sql_error();
		$msg[] = str_compact(sprintf('#%06d %s', $err['code'], $err['message']));
		$msg[] = '';
		$msg[] = str_compact($this->cur_query);
		$msg[] = '';
		$msg[] = 'Source  : '. $this->debug_find_source() ." :: $this->db_server.$this->selected_db";
		$msg[] = 'IP      : '. @$_SERVER['REMOTE_ADDR'];
		$msg[] = 'Date    : '. date('Y-m-d H:i:s');
		$msg[] = 'Agent   : '. @$_SERVER['HTTP_USER_AGENT'];
		$msg[] = 'Req_URI : '. @$_SERVER['REQUEST_URI'];
		$msg[] = 'Referer : '. @$_SERVER['HTTP_REFERER'];
		$msg[] = 'Method  : '. @$_SERVER['REQUEST_METHOD'];
		$msg[] = 'PID     : '. sprintf('%05d', getmypid());
		$msg[] = 'Request : '. trim(print_r($_REQUEST, true)) . str_repeat('_', 78) . LOG_LF;
		$msg[] = '';
		bb_log($msg, SQL_TR_LOG_NAME);
	}
}
