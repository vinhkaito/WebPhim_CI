<?php
error_reporting(0);
class Anime_Controller extends MY_Controller
{

	//protected $viewsData; // views counter data
	public $meta;
	
	function __construct()
	{
		parent::__construct();
		$this->meta = (object) [];
		$this->load->helper('cookie');
		if (get_cookie("skin") == "dark") {
			$this->mBodyClass = "dark";
		}
		
		//$this->myCron();
	}
	protected function render($view_file, $layout = 'with_breadcrumb')
	{
		$this->load->model('genres_model');
		foreach($this->genres_model->getGenres() as $key => $genre){
			$menuGenres[$genre->name] = base_url("genre/$genre->id/".$this->toAscii("$genre->name"));
		}
		$this->mMenu['genres']['children'] = $menuGenres;
		$this->mViewData['meta'] = $this->meta;
		parent::render($view_file, $layout);
	}
	/*private function myCron()
	{
		$tempToday = $this->db->query("SELECT value FROM temp WHERE name='today'")->row();
		$today = date('d', time());
		if($today !== $tempToday->value){
			$this->db->set('value', $today)
					 ->where('name', 'today')
					 ->update('temp');
			$this->db->set('today_views', 0)
					 ->update('series');
		}
	}*/
	protected function toAscii($str, $replace=array(), $delimiter='-') {
	  if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	  }

	  $str = str_replace('ậ', 'a', $str); //For vietnamese

      $clean = iconv('UTF-8', 'ASCII//IGNORE', $str);
	  $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
      $clean = strtolower(trim($clean, '-'));
      $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

      return $clean;
    }

}