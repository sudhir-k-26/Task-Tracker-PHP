<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
	    
		if(\Config\Services::session()->get('is_login'))
		{
			$listModel     = new \App\Models\ListModel();
			$user_id = \Config\Services::session()->get('is_login');
		    $data['lists'] = $listModel->where('list_user_id',$user_id)->findAll();
			if($data['lists'])
			{
			$query = $listModel->query('select t.id, t.task_name,t.create_date,l.list_name from tasks t join lists l on t.list_id=l.id where l.list_user_id='.$user_id);
            if($row = $query->getNumRows()<1)
		    {
			  $data['tasks'] = FALSE;
		    }
		    else
		    {
			   $data['tasks'] = $query->getResult('array');
			}
		    }
		}
		
		$data['main_content'] = "home";
		return view('layouts/main',$data);
	}

}
