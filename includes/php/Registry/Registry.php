<?php


class Registry
{
	private $_datos = array();
	
	public function add($key, $data)
	{
		$this->_datos[$key] = $data;
	}
	public function delete($key)
	{
		unset($this->_datos[$key]);
	}
	public function get($key)
	{
		return $this->_datos[$key];
	}
	public function exists($key)
	{
		if (isset($this->_datos[$key])) {
		return true;
		} else {
			return false;
		}
	}
}