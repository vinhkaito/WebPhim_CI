<?php
/**
* 
*/
class Stats_model extends MY_Model
{
	
	function __construct()
	{
		# code...
	}
	public function count_anime()
	{
		$query = $this->db->select('id')->get('series');
		return $query->num_rows();
	}
}