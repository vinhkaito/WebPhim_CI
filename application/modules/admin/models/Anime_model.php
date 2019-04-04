<?php
/**
* 
*/
class Anime_model extends MY_Model
{
	
	function __construct()
	{
		# code...
	}
	public function deleteEpisode($id)
	{
		return $this->db->delete('episode', array('id' => $id));
	}
	public function deleteSeries($id)
	{
		return $this->db->delete('series', array('id' => $id));
	}
}