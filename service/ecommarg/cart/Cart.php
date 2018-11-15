<?php 
	namespace ecommarg\cart;
	
	use ecommarg\cart\SaveAdapterInterface as SaveAdapter;
	use ecommarg\cart\ProductInterface as Product;
	use ecommarg\cart\FileAdapter as File;
		
	Class Cart implements CartInterface{
			
		private	$adapter;
		public function __construct (SaveAdapter $adapter){
			$this->adapter=$adapter;
		}
		public function add(Product $producto){
			$id=$producto->getId();

			$this->adapter->set(
				$id,
				json_encode($producto)
			);
		}
		public function get($id){
			return $this->adapter->get($id);
		}
		public function getAll(){
			return $this->adapter->getAll();
		}
		public function replace($array){
			return $this->adapter->replace($array);
		}
	}