<?php


namespace App\Controllers;

helper(['form','url']);
class Users extends BaseController
{
	public function register()
	{
        
        $validation =  \Config\Services::validation();
		 
        
           if($_POST)
           {
            $inputs = $this->validate([
                'first_name'=>'trim|required|max_length[50]|min_length[2]',
                'last_name'=>'trim|required|max_length[50]|min_length[2]',
                'email'=>'trim|required|max_length[100]|min_length[2]|valid_email',
                'username'=>'trim|required|max_length[20]|min_length[6]',
                'password'=>'trim|required|max_length[20]|min_length[6]',
                'password2'=>'trim|required|max_length[20]|min_length[6]|matches[password]'
    
            ]);
        }
        if(!$inputs)
        {
            $data['main_content'] = "users/register";
            return view("layouts/main",$data,['validation'=>$this->validator]);
        }
        else
        {
            $input_data_array = array(

                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'email' => $this->request->getVar('email'),
                'username' => $this->request->getVar('username'),
                'password' => md5($this->request->getVar('password'))
                );

                
                $userModel = new \App\Models\UserModel();
               /* try {
                    $userModel->insert($input_data_array);
                } catch (\Exception $e) {
                    die($e->getMessage());
                }*/
               if($userModel->insert($input_data_array))
               {
                $session = \Config\Services::session();
                $session->setFlashdata('msg','You are now registered, please login');
                return redirect()->to('http://localhost:8080');
               }   
                
         }
        
    }
    public function login()
    {
        $validation =  \Config\Services::validation();
        if($_POST)
        {
         $inputs = $this->validate([
            
             'username'=>'trim|required|max_length[20]|min_length[6]',
             'password'=>'trim|required|max_length[20]|min_length[6]'
         ]);
         }
         if(!$inputs)
         {
            $session = \Config\Services::session();
            $session->setFlashdata('login_failed','Sorry, the login info that you entered is invalid');
            return redirect()->to('http://localhost:8080');
         }
         else
         {
            $userModel = new \App\Models\UserModel();
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $password = md5($password);
            $session = \Config\Services::session();
            $userdata = $userModel->where('username',$username)->find(1);
            if($userdata['password']!=$password)
            {
                
                $session->setFlashdata('login_failed','Sorry, the login info that you entered is invalid');
                return redirect()->to('http://localhost:8080');
            }
            else
            {
                $userdata = array(
                    'user_id'=>$userdata['id'],
                    'username'=>$userdata['username'],
                    'is_login'=>true
                );
                $session->set($userdata);
                return redirect()->to('http://localhost:8080');

            }

         }

    }
    public function logout(){
        //Unset user data
        $session = \Config\Services::session();
        $session->remove('is_login');
        $session->remove('user_id');
        $session->remove('username');
         //Set message
        $session->setFlashdata('msg', 'You have been logged out');
       // $session->destroy();
        return redirect()->to('http://localhost:8080');
        
        
        
    } 

}
