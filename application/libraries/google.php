<?php

/*

Copyright (c) 2009 Dimas Begunoff, http://www.farinspace.com/

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

*/
require_once 'Google/Google_Client.php';
require_once 'Google/contrib/Google_Oauth2Service.php';

class Google
{
	var $CI;
	var $config;
	/**
	 *
	 * @var Google_Client::
	 */
	var $client ;
	function __construct()
	{
		$this->CI =& get_instance();
		$this->config = $this->CI->config->item('googleAuthInfo');
		$this->client = new Google_Client();
		$this->client->setClientId($this->config["ClientID"]);
		$this->client->setClientSecret($this->config["ClientSecret"]);
		$this->client->setRedirectUri($this->config["RedirectUri"]);
		$this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email',"https://www.googleapis.com/auth/userinfo.profile"));      // Important!
		$this->client->setAccessType("offline");
		$this->client->setApprovalPrompt("");
/*
 * 	"ClientID"
	"ClientSecret"
	"RedirectUri"
 */
	}

	public function get_auth_url($state){
		$this->client->setState($state);
		return $this->client->createAuthUrl();
	}

	public function authenticate(){
		try{
			$oauth2 = new Google_Oauth2Service($this->client);
			$this->client->authenticate();
			$token = $this->client->getAccessToken();
			$this->client->setAccessToken($token);
			$user = $oauth2->userinfo->get();
			return $user;
		}catch(Exception $ex){
			return null;
		}

	}
}