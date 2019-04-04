<?php
/**
* 
*/
class Report extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('report_model');
	}
	public function index()
	{
		$this->add_stylesheet('assets/plugins/datatables/dataTables.bootstrap.css');
		$this->add_script('assets/plugins/datatables/jquery.dataTables.min.js');
		$this->add_script('assets/plugins/datatables/dataTables.bootstrap.min.js');
		$data = $this->report_model->getData();
		$this->mViewData['data'] = $data;
		$this->render('report');
	}
	public function info($id){
		header("Content-type: application/json");
		$data = $this->report_model->getEpisodeInfo($id);
		echo json_encode($data);
	}
	public function fixed()
	{
		$id = $this->input->post('id');
		if(!$id) show_404();
		$this->report_model->fixed($id);
	}
}