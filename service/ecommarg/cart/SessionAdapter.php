<?php 
	
	namespace ecommarg\cart;
	
	use symfony\component\HttpFoundation\Session\SessionInterface;
	use symfony\component\HttpFoundation\Session\Storage\MetadataBag;
	use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
	
	Class SessionAdapter implements SaveAdapterInterface
	{
		const BAG_NAME = 'ecommarg_cart_session';
		private $session;
		private $bagName = null;
		
		public function __construct(SessionInterface $session, $key = null)
		{
			$bagName = null === $key ? self::BAG_NAME : $key;
			$bag = new AttributeBag($bagName);
			$bag->setName($bagName);
			$this->session=$session;
			$this->session->registerBag($bag);
			$this->bagName = $bagName;
		}
		public function set($key,$value)
		{
			$this->session
			->getBag($this->bagName)
			->set($key, $value);
		}
		public function get($key)
		{
			$this->session
			->getBag($this->bagName)
			->get($key);
		}
		public function getAll()
		{
			$all = $this->session
			->getBag($this->bagName)
			->all();
			foreach ($all as &$item) {
				$item = json_decode(($item));
			}
			return $all;
		}
		/*public function replace($array)
		{
			return $this->session->replace($array);
		}*/
	}