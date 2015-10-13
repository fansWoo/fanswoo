<?php

if (defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'development':
            error_reporting(E_ALL ^ E_NOTICE);
            // error_reporting(E_ALL);
        break;
    
        case 'testing':
        case 'production':
            error_reporting(0);
        break;

        default:
            exit('The application environment is not set correctly.');
    }
}


// Insert code before this line,
// require_once BASEPATH.'codeigniter/CodeIgniter'.EXT;
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set("Asia/Taipei");
}


function __autoload($class)
{
    if ( ! class_exists('CI_Model'))
    {
        load_class('Model', 'core');
    }

    if (file_exists(APPPATH."models/".$class.'.php'))
    {
        include_once(APPPATH."models/".$class.'.php');
    }
    else if (file_exists(FSPATH."models/".$class.'.php'))
    {
        include_once(FSPATH."models/".$class.'.php');
    }
    else if (file_exists(APPPATH."controllers/".$class.'.php'))
    {
        include_once(APPPATH."controllers/".$class.'.php');
    }
    else if($class == 'CI_Model') 
    {
        if(file_exists(FSPATH."core/Model.php"))
        {
            include_once(FSPATH."core/Model.php");
        }
    }
}