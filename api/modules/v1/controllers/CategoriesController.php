<?php

namespace api\modules\v1\controllers;

use bizley\jwt\JwtHttpBearerAuth;
use common\models\User;
use common\models\v1\Search\CategoriesSearch;
use Yii;
use yii\filters\AccessControl;
use yii\rest\Controller;

/**
 * Default controller for the `v1` module
 */
class CategoriesController extends Controller
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
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['index', 'logout', 'signup'],
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index'],
                    'roles' => ['admins'],
                ],
                [
                    'allow' => true,
                    'actions' => ['view'],
                    'roles' => ['viewPost'],
                ],
                [
                    'allow' => true,
                    'actions' => ['create'],
                    'roles' => ['createPost'],
                ],
                [
                    'allow' => true,
                    'actions' => ['update'],
                    'roles' => ['updatePost'],
                ],
                [
                    'allow' => true,
                    'actions' => ['delete'],
                    'roles' => ['deletePost'],
                ],
                // [
                //     'allow' => true,
                //     'actions' => ['login', 'signup'],
                //     'roles' => ['?'],
                // ],
                // [
                //     'allow' => true,
                //     'actions' => ['logout'],
                //     'roles' => ['@'],
                // ],
            ],
        ];

        return $behaviors;
    }

    // untuk verbs yg diperlukan misal get/put/patch/dsb
    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'data' => ['POST'],
        ];
    }

    //fungsi untuk login api
    public function actionIndex(){
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->andWhere('id != 1');
        $dataProvider->pagination->pageSize = 5;
        if (!empty($dataProvider->getModels()))
          {
           $result = [
                'isSuccess' => 200,
                'message' => 'sukses',
                'data' => $dataProvider->getModels(),
                'count' => $dataProvider->getCount(),
                'totalCount' => $dataProvider->getTotalCount(),
                'totalPage' => (int) (($dataProvider->getTotalCount() + $dataProvider->pagination->pageSize - 1) / $dataProvider->pagination->pageSize),
            ];
            return $result;
          } else {
            $result = [
                'isSuccess' => 404,
                'message' => 'Tidak Ada Data',
            ];
            return $result;
          }
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