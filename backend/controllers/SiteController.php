<?php

namespace backend\controllers;

use common\models\LoginForm;
use common\models\v1\Profiles;
use Yii;
use yii\bootstrap4\Html;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \common\components\MathCaptchaAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        $model->scenario = 'web';
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionProfile()
    {
        $request = Yii::$app->request;
        $model = Profiles::find()->where(['user'=>Yii::$app->user->identity->id])->one();

        // print_r(Url::base(true));
        // die;

        if ($model->load($request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file && $model->validate()) { 
                unlink(Yii::getAlias('@image-profile/') . $model->profile_image);
                $filename = $model->file->baseName . '.' . $model->file->extension;
                $save_file_to_path = Yii::getAlias('@image-profile/') . $filename;
                $model->file->saveAs($save_file_to_path);
                $model->profile_image = $filename;
            }
            $model->save();
            return $this->redirect(['profile']);
        }
        else
        {
            return $this->render('profile', [
                'model' => $model,
            ]);
        }
        
    }
}
