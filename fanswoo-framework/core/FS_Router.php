<?php 

class FS_Router extends CI_Router {

	var $suffix = '_Controller';

    public function set_class($class)
    {
        $this->class = str_replace(array('/', '.'), '', $class). $this->suffix;
    }

	public function controller_name()
	{
		if (strstr( ucfirst($this->class), $this->suffix))
		{
			return str_replace($this->suffix, '', ucfirst($this->class) );
		}
		else
		{
			return ucfirst($this->class);
		}
	}

}