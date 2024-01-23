<?php

namespace api\modules\v1\controllers;

use bizley\jwt\JwtHttpBearerAuth;
use common\models\LoginForm;
use common\models\v1\Profiles;
use common\models\v1\User;
use Yii;
use yii\rest\Controller;

/**
 * Default controller for the `v1` module
 */
class AuthController extends Controller
{
    //public $modelClass = 'common\models\User';
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
            ],
        ];

        return $behaviors;
    }

    // untuk verbs yg diperlukan misal get/put/patch/dsb
    protected function verbs()
    {
        return [
            'login' => ['POST'],
            'data' => ['POST'],
            'update-profile' => ['PUT'],
            'get-profile' => ['GET']
        ];
    }

    //fungsi untuk login api
    public function actionLogin(){
        $model = new LoginForm();

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            $response = [
                'isSuccess' => 200,
                'message' => 'login berhasil!',
                'id' => Yii::$app->user->identity->id,
                'username' => Yii::$app->user->identity->username,
                'email' => (!empty(Yii::$app->user->identity->email)) ? Yii::$app->user->identity->email : '',
                'token' => User::generateToken(Yii::$app->user->identity->id),
            ];
            return $response;
        } else {
            $model->validate();
            return $model;
        }
    }

    //update profile
    public function actionUpdateProfile($id){

        $profile = Profiles::find()->where(['user'=>$id])->one();

        if ($profile->load(Yii::$app->getRequest()->getBodyParams(), '') && $profile->save()) {
            $response = [
                'isSuccess' => 200,
                'message' => 'Sukses',
                'data' => $profile,
            ];
            return $response;
        } else {
            $profile->validate();
            return $profile;
        }
        
    }

    //get profile
    public function actionGetProfile(){

        $user = User::findOne(Yii::$app->user->identity->id);

        $response = [
            'isSuccess' => 200,
            'message' => 'Sukses',
            'data' => $user,
        ];
        return $response;
    }

    //hanya untuk tes token
    public function actionData()
    {

        // $token = Yii::$app->jwt->parse((string) 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vZXhhbXBsZS5jb20iLCJhdWQiOiJodHRwOi8vZXhhbXBsZS5vcmciLCJqdGkiOiI0ZjFnMjNhMTJhYSIsImlhdCI6MTcwNTI5NDgzNi43NjUwNjcsImV4cCI6MTcwNTI5ODQzNi43NjUwNjcsInVpZCI6MX0.NzxqM0kEGotdvI7RqTOwcHVKv6Mnk1bforCqtB2GX6g');

        // $result = Yii::$app->jwt->validate($token);

        // print_r($result);
        // die;

        return $this->asJson([
            'data' => User::find()->all(),
            'success' => true,
        ]);
    }
}