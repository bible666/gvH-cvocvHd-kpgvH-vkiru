<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;

// src/Controller/UsersController.php
class O001Controller extends AppController
{
    
    //-------------------------------------------------------
    //Function Name : checkToken
    //Desction : check token is ok or not.
    //-------------------------------------------------------
    // Input
    // - token : token string
    //-------------------------------------------------------
    // Ouptput
    // - user data if ok. return false if NG.
    //-------------------------------------------------------
    public function checkToken($token)
    {
        //Import Table
        $userTokensTable = TableRegistry::get('userTokens');

        $tokenData = $userTokensTable->find()
                    ->where(['token' => $token,'status' => 1])
                    ->contain('Users')
                    ->first();
        //debug($tokenData->user->user_group_id);
        if (!isset($tokenData)){
            return false;
        }else{
            return $tokenData->user;
        }
    }

    

   
}
?>