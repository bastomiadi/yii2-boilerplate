<?php

namespace backend\controllers;

use \yii\web\Response;
use common\models\v1\AuthAssignment;
use common\models\v1\AuthItem;
use common\models\v1\Profiles;
use common\models\v1\Search\UserSearch;
use common\models\v1\User;
use frontend\models\SignupForm;
use Yii;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax)
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title' => "User #".$id,
                'content' =>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                    Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
            ];
        }
        else
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new User model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new User();
        $profiles = new Profiles();
        $model->scenario = User::SCENARIO_CREATE;
        $auth_assignment = new AuthAssignment();

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New')." User",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'profiles' => $profiles,
                        'auth_assignment' => $auth_assignment
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
            else if($model->load($request->post()) && $auth_assignment->load($request->post()) && $profiles->load($request->post()) && Model::validateMultiple([$model, $auth_assignment, $profiles]))
            {
                if ($model->save()) {
                    $auth_assignment->user_id = $model->id;
                    $auth_assignment->save();
                    $profiles->user = $model->id;
                    $profiles->save();
                    return [
                        'forceReload' => '#crud-datatable-pjax',
                        'title' => Yii::t('yii2-ajaxcrud', 'Create New')." User",
                        'content' => '<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' User '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                        'footer' =>  Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                            Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                    ];
                }
            }
            else
            {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New')." User",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                        'profiles' => $profiles,
                        'auth_assignment' => $auth_assignment
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            if($model->load($request->post()) && $auth_assignment->load($request->post()) && $profiles->load($request->post()) && Model::validateMultiple([$model, $auth_assignment, $profiles]))
            {
                if ($model->save()) {
                    $auth_assignment->user_id = $model->id;
                    $auth_assignment->save();
                    $profiles->user = $model->id;
                    $profiles->save();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                    'profiles' => $profiles,
                    'auth_assignment' => $auth_assignment
                ]);
            }
        }
       
    }

    /**
     * Updates an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);      
        $profiles = Profiles::find()->where(['user'=>$model->id])->one();
        $auth_assignment = AuthAssignment::find()->where(['user_id'=>$model->id])->one();
        $model->scenario = User::SCENARIO_UPDATE;

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Update')." User #".$id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'profiles' => $profiles,
                        'auth_assignment' => $auth_assignment
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];   
            }
            else if($model->load($request->post()) && $auth_assignment->load($request->post()) && $profiles->load($request->post()) && Model::validateMultiple([$model, $auth_assignment, $profiles]))
            {
                $model->save();
                $profiles->save();
                $auth_assignment->save();
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "User #".$id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                        'profiles' => $profiles,
                        'auth_assignment' => $auth_assignment
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id],['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            }
            else
            {
                 return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Update')." User #".$id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                        'profiles' => $profiles,
                        'auth_assignment' => $auth_assignment
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            if($model->load($request->post()) && $auth_assignment->load($request->post()) && $profiles->load($request->post()) && Model::validateMultiple([$model, $auth_assignment, $profiles]))
            {
                $model->save();
                $profiles->save();
                $auth_assignment->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                    'profiles' => $profiles,
                    'auth_assignment' => $auth_assignment
                ]);
            }
        }
    }

    /**
     * Delete an existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

     /**
     * Delete multiple existing User model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkdelete()
    {        
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk )
        {
            $model = $this->findModel($pk);
            $model->delete();
        }

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }
        else
        {
            /*
            *   Process for non-ajax request
            */
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
