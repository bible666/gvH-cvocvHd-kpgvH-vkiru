<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

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

    //-------------------------------------------------------
    //Function Name : getMenu
    //Desction : get Menu data for user group
    //-------------------------------------------------------
    // Input
    // - not use input it will get user group id by use token
    //-------------------------------------------------------
    // Ouptput
    // - menuData
    //-------------------------------------------------------
    public function getMenu(){
        if (!$this->request->is('post'))
        {
            return $this->response->withStatus(405);
        }

        //Import table
        $usersTable = TableRegistry::get('users');
        $userTokensTable = TableRegistry::get('userTokens');

        $token = $this->request->header('X-CSRF-Token');
        
        //Check Token from DB
        $tokenData = $userTokensTable->find()
                    ->where(['token' => $token,'status' => 1])
                    ->contain('Users')
                    ->first();
        debug($tokenData->user->user_group_id);
        if (!isset($tokenData)){
            return $this->response->withStatus(401);
        }

        $jsonData = $this->request->input('json_decode');
    }

    //-------------------------------------------------------
    //Function Name : login
    //Desction : check user in system or not
    //-------------------------------------------------------
    // Input
    // - login
    // - password
    //-------------------------------------------------------
    // Ouptput
    // - user data
    // - token
    //-------------------------------------------------------
    public function login()
    {
        if (!$this->request->is('post'))
        {
            return $this->response->withStatus(405);
        }
        $jsonData = $this->request->input('json_decode');

        if (!(isset($jsonData->login) && isset($jsonData->password)) ){
            return $this->response->withStatus(400);
        }

        $users = $this->request->header('X-CSRF-Token');
        $token = Text::uuid();

        //Import table
        $usersTable = TableRegistry::get('users');
        $userTokensTable = TableRegistry::get('userTokens');

        $usersData = $usersTable->find()
                    ->where(['user_login' => $jsonData->login,'user_pass' => $jsonData->password])
                    ->first();
        if (!isset($usersData)){
            return $this->response->withStatus(401);
        }
        //debug($usersData->id);
        //Pass check user login. Set Old token to disable and Insert new token Data
        $userTokensData = $userTokensTable->find('all')
                        ->where(['user_id'=>$usersData->id,'status'=>1]);
        
        
        foreach ($userTokensData as $tokenData){
            //debug($tokenData);
            $tokenData->status = 0;
            $userTokensTable->save($tokenData);
        }

        $newToken = $userTokensTable->newEntity();
        $newToken->user_id = $usersData->id;
        $newToken->token = $token;
        $newToken->status = 1;
        $userTokensTable->save($newToken);


        //debug($usersData);
        //$users = $jsonData->login;
 
        $this->set(compact('usersData'));
        $this->set(compact('token'));
        $this->set('_serialize', ['usersData','token']);
    }

   
}
?>