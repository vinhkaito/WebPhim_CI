<?php
/**
* 
*/
class Cache extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
	}
	public function index()
	{
		$this->render('cache');
	}
	public function clean()
	{
		return $this->cache->clean();
	}
}