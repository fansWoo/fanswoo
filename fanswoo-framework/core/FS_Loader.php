<?php

class FS_Loader extends CI_Loader
{
	protected $_ci_sdk_model_paths = array();

	public function __construct()
	{
		$this->_ci_ob_level  = ob_get_level();
		$this->_ci_library_paths = array(APPPATH, BASEPATH, FSPATH);
		$this->_ci_helper_paths = array(APPPATH, BASEPATH, FSPATH);
		$this->_ci_sdk_model_paths = array(FSPATH);
		$this->_ci_model_paths = array(APPPATH);
		$this->_ci_view_paths = array(APPPATH.'views/'	=> TRUE);

		log_message('debug', "Loader Class Initialized");
	}

	public function view($arg, $vars_Arr = array(), $return_Bln = FALSE)
	{
		if( is_array($arg) )
		{
			$view_Str = $arg['view_Str'];
			$vars_Arr = $arg['vars_Arr'];
			$return_Bln = $arg['return_Bln'];
		}
		else
		{
			$view_Str = $arg;
		}

		$CI =& get_instance();
		$CI->load->library('i18n');

		if(
			file_exists( APPPATH.'views/'.$CI->i18n->get_current_locale().'/'.$view_Str.'.php' )
		)
		{
			$view_Str = $CI->i18n->get_current_locale().'/'.$view_Str;
		}

        return parent::view($view_Str, $vars_Arr, $return_Bln);
	}

	public function model($model, $name = '', $db_conn = FALSE)
	{
		if (empty($model))
		{
			return $this;
		}
		elseif (is_array($model))
		{
			foreach ($model as $key => $value)
			{
				is_int($key) ? $this->model($value, '', $db_conn) : $this->model($key, $value, $db_conn);
			}

			return $this;
		}

		$path = '';

		// Is the model in a sub-folder? If so, parse out the filename and path.
		if (($last_slash = strrpos($model, '/')) !== FALSE)
		{
			// The path is in front of the last slash
			$path = substr($model, 0, ++$last_slash);

			// And the model name behind it
			$model = substr($model, $last_slash);
		}

		if (empty($name))
		{
			$name = $model;
		}

		if (in_array($name, $this->_ci_models, TRUE))
		{
			return $this;
		}

		$CI =& get_instance();
		if (isset($CI->$name))
		{
			show_error('The model name you are loading is the name of a resource that is already being used: '.$name);
		}

		if ($db_conn !== FALSE && ! class_exists('CI_DB', FALSE))
		{
			if ($db_conn === TRUE)
			{
				$db_conn = '';
			}

			$this->database($db_conn, FALSE, TRUE);
		}

		if ( ! class_exists('CI_Model', FALSE))
		{
			load_class('Model', 'core');
		}

		// $model = ucfirst(strtolower($model));
		
		foreach ($this->_ci_sdk_model_paths as $mod_path)
		{
			if ( ! file_exists($mod_path.'models/'.$path.$model.'.php'))
			{
				continue;
			}

			if ($db_conn !== FALSE AND ! class_exists('CI_DB'))
			{
				if ($db_conn === TRUE)
				{
					$db_conn = '';
				}

				$CI->load->database($db_conn, FALSE, TRUE);
			}

			if ( ! class_exists('CI_Model'))
			{
				load_class('Model', 'core');
			}

			require_once($mod_path.'models/'.$path.$model.'.php');

			$model = ucfirst($model);

			$CI->$name = new $model();

			$this->_ci_models[] = $name;
			return $CI->$name;
		}

		foreach ($this->_ci_model_paths as $mod_path)
		{
			if ( ! file_exists($mod_path.'models/'.$path.$model.'.php'))
			{
				continue;
			}

			require_once($mod_path.'models/'.$path.$model.'.php');

			$this->_ci_models[] = $name;
			$CI->$name = new $model();
			return $this;
		}

		// couldn't find the model
		show_error('Unable to locate the model you have specified: '.$model);
	}

}