<?php
/**
* 
*/
class Save extends Admin_Controller
{
	
	function __construct()
	{
		# code...
	}
	public function index()
	{
		
		$this->form_validation->set_rules('pk', 'Primary key', 'required');
		if($this->form_validation->run())
		{
			$postData = array(
				$this->input->post('name') => $this->input->post('value')
			);
			$id = $this->input->post('pk');
			if($this->bot_model->save($table, $postData, $id)){
				$this->mViewData['alert'] = '<div class="alert alert-success">Save success</div>';
			} else {
				$this->mViewData['alert'] = '<div class="alert alert-waring">Có gì đó không ổn :v</div>';
			}
		}
	}
}