<?php
class TheLoai extends Admin_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('form_validation');
	}
	
	public function index($act = null)
	{
		$this->mTitle = 'TheLoai';
		$this->form_validation->set_rules('name', 'Name');
		if($this->input->post('name'))
		{
			if($this->input->post('id')) $data['id'] = $this->input->post('id');
			if($this->input->post('name')) $data['name'] = $this->input->post('name');
			if($this->input->post('status')) $data['status'] = $this->input->post('status');
			$this->admin_model->saveGenres($data);
			
		}
		// $this->mViewData['genres'] = $this->admin_model->getGenres(); can
		// dung nhin code toi ma hoc tap vi luc toi viet code nay ga` lam, ko lam mau dc :v
		// :)) lol,nhung ma cong nhan cai nay nhanh that,select cai la xong roi
		// vi the ko biet cu tra docs ma lam cho no de de? do? data len thu xem sao
		$this->mViewData["genres"] = $this->db->get("genres")->result(); // nhu nay co phai nhanh hon ko a` ngon :v k
		$this->render('theloai');
	}

	public function saveTL()
	{
		$this->form_validation->set_rules('pk', 'Primary key', 'required');
		if($this->form_validation->run())
		{
			$postData = array(
				
				"status" => $this->input->post('value')
			);
			$id = $this->input->post('pk');
			if($this->admin_model->save('genres', $postData, $id)){
				$this->mViewData['alert'] = '<div class="alert alert-success">Save success</div>';
			} else {
				$this->mViewData['alert'] = '<div class="alert alert-waring">Save failed</div>';
			}
		}
	}
}