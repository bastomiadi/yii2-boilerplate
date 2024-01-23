<?php

namespace api\modules\v1\controllers;

use bizley\jwt\JwtHttpBearerAuth;
use common\models\v1\Categories;
use common\models\v1\Search\CategoriesSearch;
use Yii;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

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
                //'login',
            ],
        ];
        $behaviors['access'] = [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
            
            ]
        ];

        return $behaviors;
    }

    // untuk verbs yg diperlukan misal get/put/patch/dsb
    protected function verbs()
    {
        return [
            'index' => ['GET'],
            'create' => ['POST'],
            'update' => ['PUT','PATCH'],
            'delete' => ['delete']
        ];
    }

    //menampilkan list dan filter
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

    public function actionCreate()
    {
        $model = new Categories();
        //$model->scenario = 'create';
        //$u_id = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            $model->save();
        } else {
            $model->validate();
        }

        return $model;
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$model->scenario = 'update';

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            $model->save();
        } else {
            $model->validate();
        }

        return $model;
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        // print_r($model);
        // die;
        //$model->scenario = 'delete';

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            $model->delete();
        } else {
            $model->validate();
        }

        return $model;
    }

    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}