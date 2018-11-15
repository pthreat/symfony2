<?php

	namespace ecommarg\cart;
	use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
	

	/**
	* 
	*/
	class FileAdapter implements SaveAdapter 
	{	
		CONST FILE ='ecommarg_cart_tmp.txt';
		private $file = null;
		function __construct($path, $file=null)
		{
			$this->file = sprintf('%s/%s',$path,
			null===$file ? self::FILE : $file);
		}
		public function set($key,$value)
		{
			file_put_contents($this->file, "$key=$value\n", \FILE_APPEND);
		}
		public function get($id)
		{
			return file_get_contents($this->file);
		}
		public function getAll()
		{
			return $this->get("");
		}
	}