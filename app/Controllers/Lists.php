<?php

namespace App\Controllers;

use App\Controllers\BaseController;
helper('url');
class Lists extends BaseController
{

	public function index()
	{
		
		
		
			$listModel = new \App\Models\ListModel();

			$user_id = \Config\Services::session()->get('user_id');

			$data['lists'] = $listModel->where('list_user_id',$user_id)->orderBy('create_date', 'asc')->findAll();

			$data['main_content'] = 'lists/index';
            return view('layouts/main',$data);
		

	}
	public function show($id)
	{
          $listModel = new \App\Models\ListModel();
		  $data['list'] = $listModel->find($id);
          $db = \Config\Database::connect();
		  $query = $db->query('select t.task_name,t.task_body,t.id as task_id,l.list_name,l.list_body from tasks t join lists l on t.list_id=l.id where t.list_id='.$id.' and t.is_complete=1');
		  if($row = $query->getNumRows()<1)
		  {
			  $data['completed_tasks'] = FALSE;
		  }
		  else
		  {
			$data['completed_tasks'] = $query->getResult('array');
			

		  }
		  $query = $db->query('select t.task_name,t.task_body,t.id as task_id,l.list_name,l.list_body from tasks t join lists l on t.list_id=l.id where t.list_id='.$id.' and t.is_complete=0');
		  if($row = $query->getNumRows()<1)
		  {
			  $data['uncompleted_tasks'] = FALSE;
		  }
		  else
		  {
			$data['uncompleted_tasks'] = $query->getResult('array');
			
		  }
		  $data['main_content'] = 'lists/show';
          return view('layouts/main',$data);
	}


	public function add()
	{
		$validation =  \Config\Services::validation();
        if($_POST)
        {
         $inputs = $this->validate([
            
             'list_name'=>'trim|required',
             'list_body'=>'trim'
         ]);
         }
         if(!$inputs)
         {
           //Load view and layout
		   $data['main_content'] = 'lists/add_list';
		   return view('layouts/main',$data);
         }
		 else
		 {
            $listModel = new \App\Models\ListModel();
			$session = \Config\Services::session();
               $data = array('list_name' => $this->request->getVar('list_name'),
                          'list_body'    => $this->request->getVar('list_body'),
						  'list_user_id' => $session->get('user_id'));
		        
				if($listModel->insert($data))
				{
					$session->setFlashdata('list_created','Your task list has been created');
					//Redirect to index page with error above
					return redirect()->to('http://localhost:8080/lists');
				}

			
		 }

	}
	public function edit($list_id){
		$validation =  \Config\Services::validation();
        if($_POST)
        {
         $inputs = $this->validate([
            
             'list_name'=>'trim|required',
             'list_body'=>'trim'
         ]);
         }
		 $listModel = new \App\Models\ListModel();
        if(!$inputs){
            //Get the current list info
			
            $data['this_list'] = $listModel->find($list_id);
			
            //Load view and layout
            $data['main_content'] = 'lists/edit_list';
            return view('layouts/main',$data);  
        } else {

			
			   $session = \Config\Services::session();
               $data = array('list_name' => $this->request->getVar('list_name'),
                          'list_body'    => $this->request->getVar('list_body'),
						  'list_user_id' => $session->get('user_id'));

						  if($listModel->update($list_id,$data))
						  {
							  $session->setFlashdata('list_updated','Your task list has been updated');
							  return redirect()->to('http://localhost:8080/lists');
						  }
            
        }
    }
	public function delete($list_id)
	{
		$listModel = new \App\Models\ListModel();
		$listModel->delete($list_id);
		$listModel->query("DELETE from tasks where list_id=".$list_id);
		$session = \Config\Services::session();
		$session->setFlashdata('list_deleted','Your list has been deleted');
		return redirect()->to('http://localhost:8080/lists');
		
	}
}
