<?php

class FS_Input extends CI_Input
{
	public function file($arg)
	{
		$index_Num = $arg;
		if (!empty($_FILES))
		{
			return $_FILES[$index_Num];
		}
	}
}