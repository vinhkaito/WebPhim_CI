<?php
/**
* 
*/
class Fansub extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->library('form_validation');
	}
	public function index($act = null)
	{
		$this->mTitle = 'Fansub';
		$this->form_validation->set_rules('name', 'Name');
		if($this->input->post('name'))
		{
			if($this->input->post('id')) $data['id'] = $this->input->post('id');
			if($this->input->post('name')) $data['name'] = $this->input->post('name');
			if($this->input->post('homepage')) $data['homepage'] = $this->input->post('homepage');
			/*$data = array(
				'id' => $this->input->post('id'),
				'name' => $this->input->post('name'),
				'homepage' => $this->input->post('homepage'),
			);
			print_r($data);*/
			$this->admin_model->saveFansub($data);
			/*ko cần code vội làm gì, check input xem đầy đủ chưa đã, rồi mới xử lý đc
			Đây, check ở đây sẵn rồi,ồ,nó check xem nếu có input value cho thằng id thì mới gọi thằng kia ra
			thường thì viết như này, nhưng rút gọn lại đc giống nãy, ok chưa,ok đẻ chạy thử
			yup, dạng 1 công đôi việc
			$id cos rồi, giờ code delete nữa là xong :v có bên kia rùi mà :v
			oong code not di :)) ua thi no den day la xong rui ma :v 
			thế không truyền gì vào thì nó lấy gì delete() ồ :)) */
		} elseif ($id = $this->input->post("id")) { 
			$this->admin_model->delFansub($id);
		}
		$this->mViewData['data'] = $this->admin_model->getFansub();
		$this->render('fansub');
	}
	public function save()
	{
		$this->form_validation->set_rules('pk', 'Primary key', 'required');
		if($this->form_validation->run())
		{
			$postData = array(
				$this->input->post('name') => $this->input->post('value')
			);
			$id = $this->input->post('pk');
			if($this->admin_model->save('fansub', $postData, $id)){
				$this->mViewData['alert'] = '<div class="alert alert-success">Save success</div>';
			} else {
				$this->mViewData['alert'] = '<div class="alert alert-waring">Save failed</div>';
			}
		}
	}
}