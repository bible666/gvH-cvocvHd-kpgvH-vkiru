<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;

// src/Controller/UsersController.php
class UsersController extends AppController
{
    
    public function index()
    {
        $users = $this->request->header('X-CSRF-Token');
 
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        //return $this->response->withStatus(401);
        //return $this->response->stastusCode(401);
    }

    public function login()
    {
        if (!$this->request->is('post'))
        {
            return $this->response->withStatus(405);
        }
        $jsonData = $this->request->input('json_decode');
        //debug($jsonData);
        //$login = $this->request->getParam('login');
        //$password = $this->request->getParam('password');
        if (!(isset($jsonData->login) && isset($jsonData->password)) ){
            return $this->response->withStatus(400);
        }

        $users = $this->request->header('X-CSRF-Token');

        $usersTable = TableRegistry::get('users');
        $usersData = $usersTable->find()
                    ->where(['user_login' => $jsonData->login,'user_pass' => $jsonData->password])
                    ->first();
        if (!isset($usersData)){
            return $this->response->withStatus(401);
        }
        //debug($usersData);
        //$users = $jsonData->login;
 
        $this->set(compact('usersData'));
        $this->set(compact('users'));
        $this->set('_serialize', ['usersData','users']);
    }

   
}
?>