<?php

class app
{
	public function start()
	{
		$url = $_SERVER['REQUEST_URI'];
		if (HTDOCS) {
			$url = str_replace(HTDOCS, '', $url);
		}
		$url = explode('/', $url);
	
		if (!$url[1]) {
			$class = DEFAULT_CLASS;
		} else {
			$seo = explode('-', $url['1']);
			if(count($seo) > 1) {
				$class = 'cms';
				$method = 'seo';
				$var = $url['1'];
				$this->load_class($class, $method, $var);
			} else {
				$class = $url[1];
			}
		}
		if(empty($var)){
			if (empty($url[2])) 
			{
				$method = DEFAULT_METHOD;
			} else {
				$method = $url[2];
			}

			$nmethod = strstr($method, '?', true); 
			if($nmethod) {
				$method = $nmethod;
			}
			$this->load_class($class, $method);
		}


	}

	public function load_class($class, $method, $seo = null)
	{


		require 'mail.php';
		require 'base.php';
		require 'format.php';
		require 'db.php';
		require 'bootstrap.php';
		require 'form.php';
		require 'validator.php';
		require 'auth.php';
		require 'checks.php';
		require 'relat.php';
		require 'lernfe.php';
		require 'voeava.php';



		require './class/' . $class . '.php';
		$c = new $class();
		if(!empty($seo)) {
			$c->$method($seo);
		} else {
			$c->$method();
		}

	}



}
