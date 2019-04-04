<?php 
/**
* 
*/
class Js extends Admin_Controller
{
	
	function __construct()
	{
		$this->load->model('admin_model');
	}
	public function index()
	{
		$this->mViewData['controller'] = $this->uri->segment(1);
		foreach($this->admin_model->getFansub() as $fansub)
			$this->mViewData['fansub'][] = array('id' => $fansub['id'], 'text' => $fansub['name']);

		$this->load->view('js', $this->mViewData);
	}
	public function myl($id = null)
	{
		if(!$id) show_404();
		//header("Content-type: application/json");
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		/*if($data = $this->cache->get("myl-$id")){
			echo json_encode($data);
			exit();
		}*/
		$url ="http://myanimelist.net/anime/$id";
		$a = file_get_contents($url);
		preg_match("/(https:\\/\\/myanimelist.cdn-dena.com\\/images\\/anime\\/.*)\\\"/U", $a, $matches);
		$g['thumbnail'] = $matches[1];
		
		$g['name'] = explode('</span>',explode('<span itemprop="name">', $a)[1])[0];
		$b = explode('<h2>Information</h2>', $a);
		$c = explode('<h2>Statistics</h2>', $b[1]);
		$d = strip_tags($c[0]);
		$d = str_replace(":\n", ":", $d);
		$d = str_replace("\n", "|", $d);
		$d = str_replace("      ", "", $d);
		$d = str_replace("&#039;", "'", $d);
		//print_r($d);
		$e = explode('|', $d);
		foreach ($e as $v) 
			if(trim($v)) $f[] = trim($v);
		foreach ($f as $v){
			$parts = explode(':', $v);
			$g[$parts[0]] = trim($parts[1]);
		}
		$genres_name = explode(',', $g['Genres']);
		$genres = $this->admin_model->getGenres();
		$genres = array_flip($genres);
		foreach($genres_name as $name)
		$myGenres[] = $genres[trim($name)];

		$data = array(
			'name'      => $g['name'],
			'thumbnail' => $g['thumbnail'],
			'type'      => $g['Type'],
			'episodes'  => $g['Episodes'],
			'studios'   => $g['Studios'],
			'genres'    => $myGenres,
			'duration'  => $g['Duration'],
			'airedTime' => strtotime(explode(' to', $g['Aired'])[0]),
		);
		if(isset($g['Premiered'])) $data['season'] = $g['Premiered'];
		echo json_encode($data);
	}
}