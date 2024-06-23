<?php

namespace backend\controllers;

use common\models\v1\Packet;
use common\models\v1\PacketsDetail;
use common\models\v1\search\PacketSearch;
use Exception;
use kartik\form\ActiveForm;
use Yii2\Extensions\DynamicForm\Models\Model; //Very important. Do not mix this with yii\base\Model
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * PacketController implements the CRUD actions for Packet model.
 */
class PacketController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Packet models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PacketSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Packet model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Packet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        // $model = new Packet();

        // if ($this->request->isPost) {
        //     if ($model->load($this->request->post()) && $model->save()) {
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        // } else {
        //     $model->loadDefaultValues();
        // }

        // return $this->render('create', [
        //     'model' => $model,
        // ]);

        $modelPacket = new Packet;
        $modelsDetailPacket = [new PacketsDetail];

        if ($modelPacket->load(Yii::$app->request->post())) {

            $modelsDetailPacket = Model::createMultiple(PacketsDetail::classname());
            Model::loadMultiple($modelsDetailPacket, Yii::$app->request->post());

            // validate all models
            $valid = $modelPacket->validate();

            // echo '<pre>';
            // print_r($valid);
            // echo '</pre>';
            // die;
            
            $valid = Model::validateMultiple($modelsDetailPacket) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();

                try {
                    if ($flag = $modelPacket->save(false)) {
                        foreach ($modelsDetailPacket as $modelAddress) {
                            $modelAddress->packet = $modelPacket->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPacket->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'modelPacket' => $modelPacket,
            'modelsDetailPacket' => (empty($modelsDetailPacket)) ? [new PacketsDetail] : $modelsDetailPacket
        ]);
    }

    /**
     * Updates an existing Packet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);

        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // }

        // return $this->render('update', [
        //     'model' => $model,
        // ]);

        $modelPacket = $this->findModel($id);
        $modelsPacketDetail = $modelPacket->packetsDetails;

        if ($modelPacket->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPacketDetail, 'id', 'id');
            $modelsPacketDetail = Model::createMultiple(PacketsDetail::classname(), $modelsPacketDetail);
            Model::loadMultiple($modelsPacketDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPacketDetail, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsPacketDetail),
                    ActiveForm::validate($modelPacket)
                );
            }

            // validate all models
            $valid = $modelPacket->validate();
            $valid = Model::validateMultiple($modelsPacketDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPacket->save(false)) {
                        if (! empty($deletedIDs)) {
                            Packet::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPacketDetail as $modelAddress) {
                            $modelAddress->packet = $modelPacket->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPacket->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelPacket' => $modelPacket,
            'modelsPacketDetail' => (empty($modelsPacketDetail)) ? [new PacketsDetail()] : $modelsPacketDetail
        ]);
    }

    /**
     * Deletes an existing Packet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Packet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Packet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Packet::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionOffer($id)
    {
        $modelPacket = $this->findModel($id);
        $modelsPacketDetail = $modelPacket->packetsDetails;

        echo '<pre>';
        print_r($modelsPacketDetail);
        echo '</pre>';
        die;

        if ($modelPacket->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPacketDetail, 'id', 'id');
            $modelsPacketDetail = Model::createMultiple(PacketsDetail::classname(), $modelsPacketDetail);
            Model::loadMultiple($modelsPacketDetail, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPacketDetail, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsPacketDetail),
                    ActiveForm::validate($modelPacket)
                );
            }

            // validate all models
            $valid = $modelPacket->validate();
            $valid = Model::validateMultiple($modelsPacketDetail) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelPacket->save(false)) {
                        if (! empty($deletedIDs)) {
                            Packet::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPacketDetail as $modelAddress) {
                            $modelAddress->packet = $modelPacket->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelPacket->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('offer', [
            'modelPacket' => $modelPacket,
            'modelsPacketDetail' => (empty($modelsPacketDetail)) ? [new PacketsDetail()] : $modelsPacketDetail
        ]);
    }
}
