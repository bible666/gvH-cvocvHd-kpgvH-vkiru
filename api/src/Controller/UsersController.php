<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

// src/Controller/UsersController.php
class UsersController extends O001Controller
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
    //Function Name : checkUserPermission
    //Desction : ตรวจสอบสิทธิการใช้งานของ User ว่าสามารถเข้าใช้งาน
    //           หน้า Page นั้น ๆ ได้หรือเปล่า
    //-------------------------------------------------------
    // Input
    // - token : for check user [ send by http header ]
    // - menu_id : selected menu [ send by JSON ]
    //-------------------------------------------------------
    // Ouptput
    // - checkStatus : return true if ok and false if NG
    //-------------------------------------------------------
    public function checkUserPermission(){
        //Declare Valiable

        //Check Input Method
        if (!$this->request->is('post'))
        {
            return $this->response->withStatus(405);
        }

        //Import Table
        $menuControlsTable = TableRegistry::get('menuControls');

        //Get Token From Header
        $token = $this->request->header('X-CSRF-Token');

        //Check Token from DB
        $userData = $this->checkToken($token);
        
        if (!$userData){
            //Token Error
            return $this->response->withStatus(401);
        }

        //Get JSON Data
        $jsonData = $this->request->input('json_decode');
        //$userData->user_group_id
        //debug($userData);
        //$Data = $jsonData->menu_id;
        //return data

        $MenuPermisstion = $menuControlsTable->find()
                ->where(['company_id' => $userData->company_id,'user_group_id' => $userData->user_group_id,'menu_id'=>$jsonData->menu_id])
                ->first();

        if (!isset($MenuPermisstion)){
            return $this->response->withStatus(401);
        }

        //CheckStatus
        $this->set(compact('MenuPermisstion'));
        $this->set('_serialize', ['MenuPermisstion']);
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
        //Declare Valiable
        $user_group_id = -1;

        if (!$this->request->is('post'))
        {
            return $this->response->withStatus(405);
        }

        //Import table
        $menuesTable = TableRegistry::get('menues');
        $menuControlsTable = TableRegistry::get('menuControls');

        //Get Token From Header
        $token = $this->request->header('X-CSRF-Token');
        
        //Check Token from DB
        $userData = $this->checkToken($token);
        
        if (!$userData){
            return $this->response->withStatus(401);
        }else{
            $user_group_id = $userData->user_group_id;
        }

        //Pass Check Token
        //Get Menu Data
        $menuData = $menuControlsTable->find()
                    ->where(['user_group_id' => $user_group_id])
                    ->contain('Menues');
        
        $this->set(compact('menuData'));
        $this->set('_serialize', ['menuData']);
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