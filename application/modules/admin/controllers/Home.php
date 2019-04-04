<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()
	{
		$this->load->model('user_model', 'users');
		$this->load->model('stats_model', 'stats');
		$this->mViewData['count'] = array(
			'users' => $this->users->count_all(),
			'anime' => $this->stats->count_anime()
		);
		$this->render('home');
	}
}
