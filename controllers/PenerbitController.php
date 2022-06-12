<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use app\models\User;

class PenerbitController extends ActiveController{

    public $modelClass = 'app\models\Penerbit';
    
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {
                $user = User::findByUsername($username);
                if(!is_null($user)){
                    if ($user->validatePassword($password)) {
                        return $user;
                    }
                }
                return null;
            },
        ];
        return $behaviors;
    }
}