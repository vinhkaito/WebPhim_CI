<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends MY_model
{
	public $xTable;
	public function __construct()
	{
		parent::__construct();		
	}
	public function getDashboard()
	{
		$info['series'] = $this->db->query("SELECT id FROM series")->num_rows();
		$info['episodes'] = $this->db->query("SELECT id FROM episode")->num_rows();
		return $info;
	}

	public function getSeries($id = '')
	{		
		if($id) $this->db->where('id', $id);
		$this->db->order_by('id', 'DESC');
		$query = $this->db->get('series');
		if(!$query->num_rows()) return array();
		$series = $query->result_array();
		$genres = $this->getGenres();
		foreach ($series as $key => $seri) {
			foreach(explode(',', $seri['genres']) as $genreID)
				$arrGenres[] = array('id' => $genreID, 'name' => $genres[$genreID]);
			$series[$key]['genres'] = $arrGenres;
			$series[$key]['episodes'] = $this->getSeriesEP($seri['id']);
		}
		if($id) return $series[0];
		return $series;
		//$this->getSeriesEP($series['ep'])
	}	
	public function getGenres()
	{
		$a = $this->db->get('genres')->result_array();
		foreach ($a as $key => $value) {
			$genres[$value['id']] = $value['name'];
		}
		return $genres;
	}
	public function saveGenres($data)
	{
		if(isset($data['id'])){
			$this->db->where('id', $data['id']);
			return $this->db->update('genres', $data);
		}
		return $this->db->insert('genres', $data);
	}
	public function getSeriesGenres($id){
		$c = array();
		$a = $this->db->get_where('series_genres', array('series_id' => $id))->result_array();
		$genres = $this->getGenres();
		foreach ($a as $b) $c[] = array('id' => $b['genres_id'], 'name' => $genres[$b['genres_id']]);		
		return $c;
		$this->db->select('genres');
		$this->db->where('id', $id);
		$a = $this->db->get('series');
		$a = $a->row_array();				
		$b = $this->getGenres();		
		$seriesGenres = explode(',', $a['genres']);
		$seriesGenres = array_flip($seriesGenres);		
		foreach ($seriesGenres as $key => $value) {
			if(isset($b[$key])) $genres[$key] = $b[$key];
		}
		//print_r($genres);
		return $genres;
	}
	public function getSeriesEP($id){
		$episodes = array();
		$test = array();
		//$this->db->select(array('id', 'ep', 'fansub_id'));
		$this->db->where('series_id', $id);
		$query = $this->db->get('episode');
		$data = $query->result_array();
		$fansub = $this->db->query("SELECT * FROM fansub")->result_array();
		//$fansub[0] = "Unknown";
		foreach($fansub as $v)
			$fansubs[$v['id']] = $v;
		$fansubs[0] = array('id' => 0, 'name' => 'Unknown');
		foreach($data as $k => $v)
			//$test[$fansubs[$v['fansub_id']]['name']][sprintf('%02d',$v['ep'])] = $v;
			$test[$fansubs[$v['fansub_id']]['name']][] = $v;
		return $test;
	}
	public function saveSeries($data, $id = "")
	{
		if($id){
			$this->db->set($data['series']);
			$this->db->where('id', $id);
			$this->db->update('series');
		} else {
			$this->db->insert('series', $data['series']);
			$id = $this->db->insert_id();
		}
		//print_r($this->db->query("SELECT * FROM series_genres WHERE series_id='$id'")->result_array());
		/*if($data['genres']){
			$this->db->delete('series_genres', array('series_id' => $id));
			foreach ($data['genres'] as $key => $value)
				$this->db->insert('series_genres', array('series_id' => $id,
														 'genres_id' => $value));
		}*/
		return true;
	}

	public function getEpisodes($sid){
		$this->db->where('series_id', $sid);
		return $this->db->get('episode')->result_array();
	}
	public function getEP($id)
	{
		$this->db->where('id', $id);
		$c = $this->db->get('episode')->row_array();
		$series = $this->getSeries($c['series']);
        foreach ($series['episodes'] as $ep => $ep_id) {
            if($c['ep']+1 == $ep) $series['next_ep'] = $ep_id;
        }
        $z = array(
            'error' => 0, 
            'name' => $series['name'].' - T廕計 '.$c['ep'], 
            'episode' => $c['ep'],
            'series' => $series,
        );
        return $z;

	}
	public function getFansub()
	{
		$fansub = $this->db->get('fansub')->result_array();
		foreach($fansub as $v)
			$data[$v['id']] = $v;
		/*$data[0] = array('id' => '0', 'name'=> 'Nothing here', 'homepage' => null);
		sort($data);*/
		return $data;
	}
	public function saveFansub($data)
	{
		if(isset($data['id'])){
			$this->db->where('id', $data['id']);
			return $this->db->update('fansub', $data);
		}
		return $this->db->insert('fansub', $data);
	}
	public function delFansub($id)
	{
		
		$this->db->where('id', $id);
		$this->db->delete('fansub');

	}
	public function insertEpisode($data)
	{
		return $this->db->insert('episode', $data);
	}
	public function save($table, $data, $id)
	{
		$this->db->where('id', $id);
		return $this->db->update($table, $data);
	}
}