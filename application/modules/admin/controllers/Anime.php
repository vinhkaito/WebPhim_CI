<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Anime extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('Form_builder');
		$this->load->model('admin_model');
		$this->push_breadcrumb('Series');
		$this->mViewData['genres'] = $this->admin_model->getGenres();
	}
	public function index()
	{
		$this->add_stylesheet('assets/plugins/datatables/dataTables.bootstrap.css');
		$this->add_script('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->add_script('assets/plugins/datatables/dataTables.bootstrap.min.js');
		//$this->add_script('assets/plugins/datatables/dataTables.bootstrap.min.js');

		$this->mViewData['series'] = $this->admin_model->getSeries();
		$this->render('series/series');
	}
	public function add($id='')
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		if($this->form_validation->run())
		{
			$array = array(
				'series' => array(
					'myl_id' => $this->input->post('myl_id'),
					'name' => $this->input->post('name'),
					'thumbnail' => $this->input->post('thumbnail'),
					'type' => $this->input->post('type'),
					'total_episodes' => $this->input->post('total_ep'),
					'descriptions' => $this->input->post('descriptions'),
					'airedTime' => $this->input->post('airedTime'),
					'season' => $this->input->post('season'),
					'studios' => $this->input->post('studios'),
					'duration' => $this->input->post('duration'),
					'bluray' => ($this->input->post('bluray')) ? true : false,
					'genres' => implode(',', $this->input->post('genres')),
					'lastmod' => time(),
					'poster' => $this->input->post('poster'),
				),
			);
			$this->admin_model->saveSeries($array);
		}
		$this->render('series/add');
	   
	}
	public function edit($id='')
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		if($this->form_validation->run())
		{
			$array = array(
					'series' => array(
					'myl_id' => $this->input->post('myl_id'),
					'name' => $this->input->post('name'),
					'thumbnail' => $this->input->post('thumbnail'),
					'type' => $this->input->post('type'),
					'total_episodes' => $this->input->post('total_ep'),
					'descriptions' => $this->input->post('descriptions'),
					'airedTime' => $this->input->post('airedTime'),
					'season' => $this->input->post('season'),
					'studios' => $this->input->post('studios'),
					'duration' => $this->input->post('duration'),
					'bluray' => $this->input->post('bluray'),
					'genres' => implode(',', $this->input->post('genres')),
					'lastmod' => time(),
					'poster' => $this->input->post('poster'),
				),
			);
			$this->admin_model->saveSeries($array, $id);
		}
		$this->mViewData['id']     = $id;
		
		$this->mViewData['series'] = $this->admin_model->getSeries($id);
		$this->render('series/edit');
	}
	public function eps($id)
	{
		$series = $this->admin_model->getSeries($id);
		$this->mViewData['series'] = $series;

		$this->mViewData['form'] = $this->form_builder->create_form();
		$this->form_validation->set_rules('ep', 'Episode', 'required');
		$this->form_validation->set_rules('link', 'Link', 'required');
		$this->form_validation->set_rules('fansub', 'Fansub', 'required');
		if($this->form_validation->run())
		{
			//if($this->input->post('ep')) $array[0]['ep'] = $this->input->post('ep');
			$ep = $this->input->post('ep');
			foreach(explode("\n", $this->input->post('link')) as $link){
				//$link = str_replace("\r", '', $link);
				$array[] = array(
					'ep' 		=> $ep,
					'link'      => $link,
					'fansub_id' => $this->input->post('fansub'),
					'series_id' => $id,
				);
				$ep++;
			}
			if($this->db->insert_batch('episode', $array)){
				$lastmod = time();
				$this->db->query("UPDATE series SET lastmod='$lastmod' WHERE id=$id");
				$this->mViewData['alert'] = '<div class="alert alert-success">Insert success '.count($array).' ep(s)</div>';
			} else {
				$this->mViewData['alert'] = '<div class="alert alert-warning">Có gì đó không ổn :v</div>';
			}
		}
		$this->mViewData['fansub'] = $this->admin_model->getFansub();
		$this->mViewData['data'] = $this->admin_model->getSeriesEP($id);
		$this->render('series/eps');
	}
	public function save($table)
	{
		$this->form_validation->set_rules('pk', 'Primary key', 'required');
		if($this->form_validation->run())
		{
			$postData = array(
				$this->input->post('name') => $this->input->post('value')
			);
			$id = $this->input->post('pk');
			if($table == 'episode'){
				$this->admin_model->save('episode', $postData, $id);
			}		
		}
	}
	public function delete($table)
	{
		$this->load->model('anime_model');
		if(!$id = $this->input->post('id')) show_404();
		if($table == 'episode')
			$result = $this->anime_model->deleteEpisode($id);
		elseif($table == 'anime')
			$result = $this->anime_model->deleteSeries($id);
		else $result = false;
		echo json_encode(array('success' => $result));

		/*if($result) echo '<div class="alert alert-success">Delete success ID '.$id.' ep(s)</div>';
		else echo '<div class="alert alert-warning">Có gì đó không ổn :v</div>';*/
	}
}