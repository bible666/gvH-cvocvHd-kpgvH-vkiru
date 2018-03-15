<?php
namespace App\Controller;

use Cake\Controller\Controller;

// src/Controller/UsersController.php
class UsersController extends AppController
{
    
    public function index()
    {
        $users = "message";
 
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        return $this->response->withStatus(401);
        //return $this->response->stastusCode(401);
    }

   
}
?>