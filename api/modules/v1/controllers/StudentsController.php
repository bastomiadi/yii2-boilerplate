<?php

namespace api\modules\v1\controllers;

use bizley\jwt\JwtHttpBearerAuth;
use common\models\User;
use common\models\v1\search\StudentsSearch;
use common\models\v1\Students;
use Yii;
use yii\db\StaleObjectException;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `v1` module
 */
class StudentsController extends Controller
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
            'delete' => ['DELETE'],
            'data' => ['POST'],
            'restore' => ['POST'],
        ];
    }

    //fungsi untuk login api
    public function actionIndex(){
        $searchModel = new StudentsSearch();
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

    public function actionCreate()
    {
        $model = new Students();
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
        $transaction = $model->getDb()->beginTransaction();
        try {
            $model->delete();
            $transaction->commit();
            return ['message' => 'deleted successfully.', 'data' => $this->findModel($id)];   
        } catch (\Throwable $e) { // PHP >= 7.0
            $transaction->rollBack();
            throw $e;
        }
    }

    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $transaction = $model->getDb()->beginTransaction();
        try {
            $model->restore();
            $transaction->commit();
            return ['message' => 'restore successfully.', 'data' => $this->findModel($id)];   
        } catch (\Throwable $e) { // PHP >= 7.0
            $transaction->rollBack();
            throw $e;
        }
    }

    protected function findModel($id)
    {
        if (($model = Students::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}