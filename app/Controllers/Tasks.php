<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tasks extends BaseController
{
	public function show($id)
	{
		
			//Get single task info
			$taskModel = new \App\Models\TaskModel();
			$query = $taskModel->query('select t.due_date, t.create_date, t.task_name, t.id, t.task_body, t.list_id, l.list_name, t.is_complete from tasks t join lists l on t.list_id=l.id where t.id='.$id);
			$data['task']=$query->getResult('array');
			
			//Check if marked complete
			$data['is_complete'] = $data['task'][0]['is_complete'];
		   
			//Load view and layout
			$data['main_content'] = 'tasks/show';
			return view('layouts/main',$data);
		
	}
	public function add($list_id = null){

        if($_POST)
		{
			$validation =  \Config\Services::validation();
			$inputs = $this->validate([
            
				'task_name'=>'trim|required',
				'task_body'=>'trim'
			]);
		}

            
        if(!$inputs){

			$TaskModel = new \App\Models\TaskModel();
            //Get list name for view
            $query= $TaskModel->query('select list_name from lists where id='.$list_id); 
			$data['list_name']=$query->getResult('array');
            //Load view and layout
            $data['main_content'] = 'tasks/add_task';
            return view('layouts/main',$data);  
        } else {
			$taskModel = new \App\Models\TaskModel();
			$session = \Config\Services::session();
               $data = array('task_name' => $this->request->getVar('task_name'),
                          'task_body'    => $this->request->getVar('task_body'),
						  'due_date'     => $this->request->getVar('due_date'),
						  'list_id'      => $list_id); 
				if($taskModel->insert($data))
				{
					$session->setFlashdata('task_created','Your task has been created');
					//Redirect to index page with error above
					return redirect()->to('http://localhost:8080/lists/show/'.$list_id);
				}
        }
    }
	public function edit($task_id){
        
		

		if($_POST)
		{
			$validation =  \Config\Services::validation();
			
			$inputs = $this->validate([
            
				'task_name'=>'trim|required',
				'task_body'=>'trim'
			]);
		}

		$taskModel = new \App\Models\TaskModel();
		$query = $taskModel->query("select list_id from tasks where id=".$task_id);
		$list_id_arr = $query->getResult('array');
        if(!$inputs){

			
            //Get list id
			$data['list_id']=$list_id_arr[0]['list_id'];
			
			//Get list name for view
			$query = $taskModel->query("select list_name from lists where id=".$data['list_id']);
            $data['list_name'] = $query->getResult('array'); 
			//Get the current task info
            $data['this_task'] = $taskModel->find($task_id);
            //Load view and layout
            $data['main_content'] = 'tasks/edit_task';
            return view('layouts/main',$data);          
           
        } 
		else
		{
              $list_id = $list_id_arr[0]['list_id'];
			  $data = array('task_name' => $this->request->getVar('task_name'),
                          'task_body'    => $this->request->getVar('task_body'),
						  'due_date'     => $this->request->getVar('due_date'),
						  'list_id'      => $list_id); 
			 if($taskModel->update($task_id,$data))
			 {
				$session = \Config\Services::session();
				$session->setFlashdata('task_updated','Your task has been updated');
				return redirect()->to('http://localhost:8080/lists/show/'.$list_id);
			 }
		}
    }
	public function mark_complete($task_id){

		$taskModel = new \App\Models\TaskModel();

        if($taskModel->query("update tasks set is_complete=1 where id=".$task_id)){

			$query = $taskModel->query("select list_id from tasks where id=".$task_id);
		    $list_id_arr = $query->getResult('array');
            $list_id = $list_id_arr[0]['list_id'];
            //Create Message
             
			$session = \Config\Services::session();
			$session->setFlashdata('marked_complete', 'Task has been marked complete');
            return redirect()->to('http://localhost:8080/lists/show/'.$list_id.'');
        }
    }
	public function mark_new($task_id){

		$taskModel = new \App\Models\TaskModel();

        if($taskModel->query("update tasks set is_complete=0 where id=".$task_id)){

			$query = $taskModel->query("select list_id from tasks where id=".$task_id);
		    $list_id_arr = $query->getResult('array');
            $list_id = $list_id_arr[0]['list_id'];
            //Create Message
             
			$session = \Config\Services::session();
			$session->setFlashdata('marked_new', 'Task has been marked new');
            return redirect()->to('http://localhost:8080/lists/show/'.$list_id.'');
        }
    }
	public function delete($list_id,$task_id){ 
		$taskModel = new \App\Models\TaskModel();   
		//Delete list
		$taskModel->delete($task_id);
		//Create Message
		$session = \Config\Services::session();
	    $session->setFlashdata('task_deleted', 'Your task has been deleted');      
		//Redirect to list index
		return redirect()->to('http://localhost:8080/lists/show/'.$list_id.'');
 }
}
