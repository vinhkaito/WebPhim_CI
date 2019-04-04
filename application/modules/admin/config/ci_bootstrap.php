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
	'site_name' => 'Admin Panel',

	// Default page title prefix
	'page_title_prefix' => '',

	// Default page title
	'page_title' => 'ADMIN PANEL',

	// Default meta data
	'meta_data'	=> array(
		'author'		=> '',
		'description'	=> '',
		'keywords'		=> ''
	),
	
	// Default scripts to embed at page head or end
	'scripts' => array(
		'head'	=> array(
			'assets/dist/frontend/lib.min.js',
			'assets/dist/admin/adminlte.min.js',
			'assets/dist/admin/lib.min.js',
			'assets/dist/admin/app.min.js',
			'assets/plugins/select2/select2.full.min.js',
			'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
			'https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js',
		),
		'foot'	=> array(

			'assets/plugins/iCheck/icheck.min.js',
			'admin/js',
		),
	),

	// Default stylesheets to embed at page head
	'stylesheets' => array(
		'screen' => array(
			'assets/plugins/iCheck/all.css',
			'assets/plugins/select2/select2.min.css',
			'assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
			//'http://localhost/leuleu2/assets/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css',
			'assets/dist/admin/adminlte.min.css',
			'assets/dist/admin/lib.min.css',
			'assets/dist/admin/app.min.css',
			'https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css',
		)
	),

	// Default CSS class for <body> tag
	'body_class' => '',
	
	// Multilingual settings
	'languages' => array(
	),

	// Menu items
	'menu' => array(
		'home' => array(
			'name'		=> 'Home',
			'url'		=> '',
			'icon'		=> 'fa fa-home',
		),
		'panel' => array(
			'name'		=> 'Webmaster Panel',
			'url'		=> 'panel',
			'icon'		=> 'fa fa-cog',
			'children'  => array(
				'Admin User Manager'			=> 'panel/admin_user',
				'Create Admin User'				=> 'panel/admin_user_create',
				'Delete Admin User'				=> 'panel/admin_user_delete',
				'Admin User Groups'				=> 'panel/admin_user_group',
			)
		),
		'anime' => array(
			'name' => 'Anime',
			'url'  => 'anime',
			'icon' => 'fa fa-film',
			'children' => array(
				'List' => 'anime',
				'Add'  => 'anime/add'
			)
		),
		'fansub' => array(
			'name' => 'Fansub',
			'url'  => 'fansub',
			'icon' => 'fa fa-users'
		),
		'theloai' => array(
			'name' => 'Genres',
			'url'  => 'theloai',
			'icon' => 'fa fa-random'
		),
		'report' => array(
			'name' => 'Report',
			'url'  => 'report',
			'icon' => 'fa fa-warning'
		),
		'cache' => array(
			'name' => 'Cache',
			'url'  => 'cache/clean',
			'icon' => 'fa fa-file'
		),
		'logout' => array(
			'name'		=> 'Sign Out',
			'url'		=> 'panel/logout',
			'icon'		=> 'fa fa-sign-out',
		)
	),

	// Login page
	'login_url' => 'admin/login',

	// Restricted pages
	'page_auth' => array(
		'panel'						=> array('webmaster'),
		'panel/admin_user'			=> array('webmaster'),
		'panel/admin_user_create'	=> array('webmaster'),
		'panel/admin_user_delete'	=> array('webmaster'),
		'panel/admin_user_group'	=> array('webmaster'),
		'fansub'					=> array('webmaster', 'admin'),
		'report'					=> array('webmaster', 'admin'),
	),

	// AdminLTE settings
	'adminlte' => array(
		'body_class' => array(
			'webmaster'	=> 'skin-red',
			'admin'		=> 'skin-purple',
			'manager'	=> 'skin-black',
			'uploader'		=> 'skin-blue',
		)
	),

	// Useful links to display at bottom of sidemenu
	'useful_links' => array(
		array(
			'auth'		=> array('webmaster', 'admin', 'manager', 'uploader'),
			'name'		=> 'Frontend Website',
			'url'		=> '',
			'target'	=> '_blank',
			'color'		=> 'text-aqua'
		),
		array(
			'auth'		=> array('webmaster'),
			'name'		=> 'Grocerycrud Options',
			'url'		=> 'https://www.grocerycrud.com/documentation/options_functions',
			'target'	=> '_blank',
			'color'		=> 'text-orange'
		),
		/*array(
			'auth'		=> array('webmaster'),
			'name'		=> 'Github Repo',
			'url'		=> CI_BOOTSTRAP_REPO,
			'target'	=> '_blank',
			'color'		=> 'text-green'
		),*/
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
$config['sess_cookie_name'] = 'ci_session_admin';