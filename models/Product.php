<?php
namespace models;

class Product {

	public $title;
	public $description;
	public $unit_price;
	public $size;

	public function load($attributes)
	{
		foreach($attributes as $key => $value)
		{
			$this->__set($key, $value);
		}
	}
	
	public function __set($key, $value){
		$this->$key = $value;
	}

	public function __get($key){
		return $this->$key;
	}

}