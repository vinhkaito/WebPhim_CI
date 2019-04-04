<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
* Library to counter viewer
*/
class view_counter
{
	protected $viewsData; // views counter data
	
	public function getData($series_id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$result = $CI->db->query("SELECT total_views, unique_views, today_views FROM series WHERE id='$series_id'");
		if($result->num_rows()) {
			$rows = $result->result();
			$data = new stdClass(); 
			$data->total  = $rows[0]->total_views;
			$data->unique = $rows[0]->unique_views;
			$data->today  = $rows[0]->today_views;
			return $data;
		}
	}
	public function visit($series_id)
	{
		$CI =& get_instance();
		$CI->load->database();
		$CI->db->set('total_views', 'total_views+1', FALSE);
		$CI->db->set('today_views', 'today_views+1', FALSE);
		if(!isset($_SESSION['visited']) || $_SESSION['visited'] != true){
			$CI->db->set('unique_views', 'unique_views+1', FALSE);
			$_SESSION['visited'] = true;
		}
		return $CI->db->where('id', $series_id)
					->update('series');
	}
	public function getTotalViews($value='')
	{
		return $this->viewsData->total;
	}
	public function getUniqueViews($value='')
	{
		return $this->viewsData->unique;
	}
	public function getTodayViews($value='')
	{
		return $this->viewsData->today;
	}
	public function isNewVisitor()
	{
		return $_SESSION['visited'] == true;
	}
}