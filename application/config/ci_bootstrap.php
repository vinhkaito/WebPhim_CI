<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| CI Bootstrap 3 Configuration
| -------------------------------------------------------------------------
| This file lets you define default values to be passed into views 
| when calling MY_Controller's render() function. 
| 
| See example and detailed explanation from:
| 	/application/config/ci_bootstrap_example.php
*/

$config['ci_bootstrap'] = array(

	// Site name
	'site_name' => 'Anime Vietsub Online',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => 'Anime Vietsub Online',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> 'localhost',
		'description'	=> 'Xem VietSub Online sớm nhất tại localhost với nhiều nội dung phong phú và hấp dẫn. Các Anime HOT luôn được cập nhật sớm nhất. Đón xem One Piece, Dragon Ball Super sớm nhất và nhiều Anime hấp dẫn khác tại đây.',
		'keywords'		=> 'anime vietsub, xem anime, vui ghe, naruto, vua hai tac, one piece, hoi phap su, fairy tail, bleach, dragon ball, dao hai tac'
	),

	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
		),
		'foot'	=> array(
			'assets/dist/frontend/lib.min.js',
			'assets/dist/frontend/app.min.js',
			'assets/dist/frontend/custom.js'
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/dist/frontend/lib.min.css',
			'assets/dist/frontend/app.min.css',
			//'assets/dist/frontend/bootstrap.min.css',
			'assets/dist/bootflat/css/bootflat.min.css',
			'assets/dist/frontend/custom.css',
			'https://fonts.googleapis.com/css?family=Open+Sans'
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	/*'languages' => array(
		'default'		=> 'en',
		'autoload'		=> array('general'),
		'available'		=> array(
			'en' => array(
				'label'	=> 'English',
				'value'	=> 'english'
			),
			'zh' => array(
				'label'	=> '繁體中文',
				'value'	=> 'traditional-chinese'
			),
			'cn' => array(
				'label'	=> '简体中文',
				'value'	=> 'simplified-chinese'
			),
			'es' => array(
				'label'	=> 'Español',
				'value' => 'spanish'
			)
		)
	),*/

	// Google Analytics User ID
	'ga_id' => '',

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'glyphicon glyphicon-home',
		),
		'genres' => array(
			'name' => 'Thể Loại',
			'url'  => '',
			'icon' => 'glyphicon glyphicon-list',
		),
		'top' => array(
			'name' => 'Top Anime',
			'url' => 'top',
			'icon' => 'glyphicon glyphicon-triangle-top'
		),
		'search' => array(
			'name' => 'Tìm kiếm',
			'url'  => 'search',
			'icon' => 'glyphicon glyphicon-search',
		)
	),

	// Login page
	'login_url' => '',

	// Restricted pages
	'page_auth' => array(
	),

	// Debug tools
	'debug' => array(
		'view_data'	=> FALSE,
		'profiler'	=> FALSE
	),
);

/*
| -------------------------------------------------------------------------
| Override values from /application/config/config.php
| -------------------------------------------------------------------------
*/
$config['sess_cookie_name'] = 'ci_session_frontend';