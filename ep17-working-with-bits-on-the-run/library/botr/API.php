<?php
	#
	# Zend::botr_API
	#
	# Original author: Cal Henderson
    # Modified by: kvdb@kvdb.net for bitsontherun.com
	# Modified again by: jon@lebensold.net for momentfactory.com

class botr_API {

	var $_cfg = array(
			'api_key'       => '',
			'api_secret'    => '',
			'endpoint'      => 'http://manage.bitsontherun.com/services/',
			'auth_endpoint' => 'http://manage.bitsontherun.com/services/auth/?',
			'feed_endpoint'	=> 'http://manage.bitsontherun.com/services/feeds',
			'conn_timeout'	=> 5,
			'io_timeout'	=> 5,
		);

	var $_err_code = 0;
	var $_err_msg = '';
	var $tree;

	function botr_API($params = array()){
		#
		# create the http request
		#
		$this->client = new Zend_Http_Client();


		foreach($params as $k => $v){
			$this->_cfg[$k] = $v;
		}
	}

	function callMethod($method, $params = array()){

		return $this->call($method, $params, $this->_cfg['endpoint']);
	}

	function callFeedMethod($method, $params = array()){
		$ep = $this->_cfg['feed_endpoint'];
		$ep .= $params['format'] . $method .'?';
		
		# Ignore the result of this call. It won't conform to
		# the rsp=... XML, it's the feed.
		$this->call("", $params, $ep);

		# Either, return the complete body
		#return $this->_http_body;
		# Or return as XML tree
		$tree =& new XML_Tree();
		$tree->getTreeFromString($this->_http_body);
		$this->tree = $tree;
		return $tree;
	}

	function callAuthMethod($method, $params = array()){
		# Strip off the trailing ?
		$ep = $this->_cfg['auth_endpoint'];
		$ep = substr($ep, 0, strlen($ep)-1);
		$ep .= $method;

		return $this->call("", $params, $ep);
	}

	function call($method, $params = array(), $endpoint)
	{
		$this->_err_code = 0;
		$this->_err_msg = '';

		#
		# create the POST body
		#

		$params['api_key'] = $this->_cfg['api_key'];

		if ($this->_cfg['api_secret']){
			  $params['api_sig'] = $this->signArgs($params);
		}


		$this->client->setUri($endpoint.$method);


		foreach($params as $k => $v){
			# handle file upload fields as special ones
			if ($k == "mediafile" or $k == "preview" or $k == "skin")
			{
				$this->client->setFileUpload($v , $k);
			}
			else
			{
				$this->client->setParameterPost($k, $v);
			}
		}
			
		
		$result = $this->client->request('POST');


		$this->_http_code = $result->getStatus();
		$this->_http_head = $result->getHeaders();
		$this->_http_body = $result->getBody();



		if ($this->_http_code != 200){
			$this->_err_code = 0;

			if ($this->_http_code){
				$this->_err_msg = "Bad response from remote server: HTTP status code $this->_http_code";
			}else{
				$this->_err_msg = "Couldn't connect to remote server";
			}
			return 0;
		}


		#
		# create xml tree
		#
		
		$tree = simplexml_load_string($result->getBody());

		#
		# check we got an <rsp> element at the root
		#

		if ($tree->getName() != 'rsp'){

			$this->_err_code = 0;
			$this->_err_msg = "Bad XML response";

			return 0;
		}


		#
		# stat="fail" ?
		#

		if ($tree['stat'] == 'fail'){

			$n = null;
			foreach($tree->children() as $child){
				if ($child->getName() == 'err'){
					$n = $child->attributes();
				}
			}

			$this->_err_code = $n['code'];
			$this->_err_msg = $n['msg'];

			return 0;
		}


		#
		# weird status
		#

		if ($tree['stat'] != 'ok'){

			$this->_err_code = 0;
			$this->_err_msg = "Unrecognised REST response status";

			return 0;
		}


		#
		# return the tree
		#

		return $tree;
	}


	function getErrorCode(){
		return $this->_err_code;
	}

	function getErrorMessage(){
		return $this->_err_msg;
	}

	function getAuthUrl($perms, $frob=''){

		$args = array(
			'api_key'	=> $this->_cfg['api_key'],
			'perms'		=> $perms,
		);

		if (strlen($frob)){ $args['frob'] = $frob; }

		$args['api_sig'] = $this->signArgs($args);

		#
		# build the url params
		#

		$pairs =  array();
		foreach($args as $k => $v){
			$pairs[] = urlencode($k).'='.urlencode($v);
		}

		return $this->_cfg['auth_endpoint'].implode('&', $pairs);
	}

	function signArgs($args){
		ksort($args);
		$a = '';
		foreach($args as $k => $v){
			$a .= $k . $v;
		}
		return md5($this->_cfg['api_secret'].$a);
	}

}

