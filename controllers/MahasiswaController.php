<?php

namespace app\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;
use app\Models\User;

class MahasiswaController extends ActiveController{

    public $modelClass = 'app\models\Mahasiswa';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            //definisikan fungsi yg akan dipakai untuk otentikasi
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