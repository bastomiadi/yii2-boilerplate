<?php

namespace backend\controllers;

use common\models\v1\Offers;
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

        $model_offer = new Offers();
        $model_offer->content = '
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Multi-page PDF</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    .content {
                        width: 70%;
                        margin: 0 auto;
                    }
                    .letter-header, .letter-footer {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .signature {
                        margin-top: 50px;
                    }
                    .page-break {
                        page-break-before: always;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .list {
                        margin-left: 20px;
                    }
                </style>
            </head>
            <body>
                <!-- First Page Content -->
                <div class="content">
                    <div class="letter-header">
                        <p>No : 488/DIR/RSGH/XII/2022</p>
                        <p>Perihal : Penawaran Medical Check Up (MCU)</p>
                        <p>Lamp : 1 Lembar</p>
                    </div>

                    <p>Kepada Yth.<br>
                    Bapak/Ibu Pimpinan Bank BRI Jepara<br>
                    Di – Tempat</p>

                    <p>Dengan Hormat,</p>

                    <p>Terima kasih atas kepercayaannya kepada kami, dengan ini kami sampaikan penawaran Medical Check Up (MCU) sesuai dengan permintaan dari pihak Bank BRI Jepara pada pertemuan Jumat, tanggal 02 Desember 2022 di RS Graha Husada Jepara.</p>

                    <p>Harapan kami bisa diterima dengan baik dan Kerjasama yang sudah terjalin dapat terus meningkat dari waktu ke waktu.</p>

                    <p>Demikian kami sampaikan. Terimakasih atas perhatian yang diberikan.</p>

                    <p>Jepara, 06 Desember 2022</p>

                    <p>RS Graha Husada Jepara</p>

                    <div class="signature">
                        <p>dr. Okty Prahalanitya, Sp.PK. MARS<br>
                        Direktur</p>
                    </div>
                </div>

                <!-- Page Break -->
                <div class="page-break"></div>

                <!-- Second Page Content -->
                <div class="content">
                    <div class="header">
                        <h2>TARIF MEDICAL CHECKUP</h2>
                        <h3>RUMAH SAKIT GRAHA HUSADA JEPARA</h3>
                    </div>

                    <ul class="list">
                        <li>Pemeriksaan Fisik</li>
                        <li>Foto Rontgen Thorax</li>
                        <li>Pemeriksaan EKG</li>
                        <li>Pap Smear (khusus Wanita)</li>
                        <li>USG Abdomen</li>
                        <li>Pemeriksaan Laboratorium :
                            <ol>
                                <li>Hematologi Lengkap + Golongan Darah</li>
                                <li>Urine Lengkap : BJ, pH, Glukosa Albumin, Sedimen, Bilirubin, Urobilinogen, Keton, Nitrit dan Darah Samar</li>
                                <li>Gula Darah Puasa</li>
                                <li>Fungsi Ginjal : Ureum, Kreatinin, dan Asam Urat</li>
                                <li>Fungsi Hati : L.F.T + GT (SGOT, SGPT, Bilirubin Total, Protein Total-Albumin-Globulin, Alkaline Fosfate, dan Gamma GT)</li>
                                <li>Imuno Serologi : HBA Ag + Anti HCV</li>
                                <li>Lemak Darah : Kolesterol Total, Trigliseride, HDL, LDL</li>
                            </ol>
                        </li>
                    </ul>

                    <p><strong>Harga</strong> Rp. 1.300.000,-</p>
                </div>
            </body>
        </html>

        
        ';

        if ($model_offer->load(Yii::$app->request->post()) && $model_offer->save())
        {
            return $this->redirect(['view', 'id' => $modelPacket->id]);
        }

        return $this->render('offer', [
            'model_offer' => $model_offer
            // 'modelPacket' => $modelPacket,
            // 'modelsPacketDetail' => (empty($modelsPacketDetail)) ? [new PacketsDetail()] : $modelsPacketDetail
        ]);
    }
}
