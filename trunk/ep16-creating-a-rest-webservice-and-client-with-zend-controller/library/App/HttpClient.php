<?php
class  App_HttpClient
{
    const URI = 'http://zc15/api';
	const HTTP_METHOD = 'POST';

	protected $client;

	protected $secretKey;

	protected $appName;

	public function __construct($appName,$secretKey)
	{
		$this->client = new Zend_Http_Client();
		
		$this->appName = $appName;
		$this->secretKey = $secretKey;

	}

	public function call($method, $args)
	{
		$this->client->setUri(self::URI . '/' . $method);

// setup all the arguments
		$this->client->setParameterPost('appName', $this->appName);

		foreach($args as $k=>$v)
			$this->client->setParameterPost($k, $v);

		$this->client->setParameterPost('auth', $this->signArgs($args));

		$result = $this->client->request(self::HTTP_METHOD);

		return Zend_Json_Decoder::decode($result->getBody());

	}
	private function signArgs($args){
		$args['appName'] = $this->appName;
		ksort($args);
		$a = '';
		foreach($args as $k => $v)
		{
			$a .= $k . $v;
		}
		return md5($this->secretKey.$a);
	}
}

?>