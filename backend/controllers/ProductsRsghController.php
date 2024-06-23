<?php

namespace backend\controllers;

use \yii\web\Response;
use common\models\v1\Products;
use common\models\v1\ProductsRsgh;
use common\models\v1\search\ProductsRsghSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductsRsghController implements the CRUD actions for ProductsRsgh model.
 */
class ProductsRsghController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulkdelete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductsRsgh models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProductsRsghSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $model = new ProductsRsgh();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $filePath = 'uploads/' . $model->file->baseName . '.' . $model->file->extension;
                if ($model->file->saveAs($filePath)) {
                    // Convert and Import
                    $csvFilePath = $this->convertXlsxToCsv($filePath);
                    if ($this->importCsvToDb($csvFilePath)) {
                        // Unlink (delete) the files after successful import
                        @unlink($filePath);
                        @unlink($csvFilePath);
                        
                        Yii::$app->session->setFlash('success', 'File has been uploaded, imported, and deleted.');
                        return $this->refresh();
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to import CSV to database.');
                    }
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single ProductsRsgh model.
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
                'title' => "ProductsRsgh #".$id,
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
     * Creates a new ProductsRsgh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new ProductsRsgh();  

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New')." ProductsRsgh",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::button(Yii::t('yii2-ajaxcrud', 'Create'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];
            }
            else if($model->load($request->post()) && $model->save())
            {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New')." ProductsRsgh",
                    'content' => '<span class="text-success">'.Yii::t('yii2-ajaxcrud', 'Create').' ProductsRsgh '.Yii::t('yii2-ajaxcrud', 'Success').'</span>',
                    'footer' =>  Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::a(Yii::t('yii2-ajaxcrud', 'Create More'), ['create'], ['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            }
            else
            {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Create New')." ProductsRsgh",
                    'content' => $this->renderAjax('create', [
                        'model' => $model,
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
            if ($model->load($request->post()) && $model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
       
    }

    /**
     * Updates an existing ProductsRsgh model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);       

        if($request->isAjax)
        {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet)
            {
                return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Update')." ProductsRsgh #".$id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::button(Yii::t('yii2-ajaxcrud', 'Save'), ['class' => 'btn btn-primary', 'type' => 'submit'])
                ];   
            }
            else if($model->load($request->post()) && $model->save())
            {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "ProductsRsgh #".$id,
                    'content' => $this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button(Yii::t('yii2-ajaxcrud', 'Close'), ['class' => 'btn btn-default pull-left', 'data-dismiss' => 'modal']).
                        Html::a(Yii::t('yii2-ajaxcrud', 'Update'), ['update', 'id' => $id],['class' => 'btn btn-primary', 'role' => 'modal-remote'])
                ];
            }
            else
            {
                 return [
                    'title' => Yii::t('yii2-ajaxcrud', 'Update')." ProductsRsgh #".$id,
                    'content' => $this->renderAjax('update', [
                        'model' => $model,
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
            if ($model->load($request->post()) && $model->save())
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Delete an existing ProductsRsgh model.
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
     * Delete multiple existing ProductsRsgh model.
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
     * Finds the ProductsRsgh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductsRsgh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductsRsgh::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function convertXlsxToCsv($filePath)
    {
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($filePath);
        $csvFilePath = 'uploads/' . pathinfo($filePath, PATHINFO_FILENAME) . '.csv';
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Csv');
        $writer->save($csvFilePath);
        return $csvFilePath;
    }

    private function importCsvToDb($csvFilePath)
    {
        $connection = Yii::$app->db;
        $mainTableName = '{{%products_rsgh}}'; // Replace with your table name

        $transaction = $connection->beginTransaction();
        try {
            // Step 1: Load data into the main table with NOW() for created_at and updated_at
            $sql = "LOAD DATA LOCAL INFILE :file INTO TABLE {$mainTableName}
                    FIELDS TERMINATED BY ',' ENCLOSED BY '\"'
                    LINES TERMINATED BY '\n'
                    IGNORE 1 LINES (MST_PRODUK_MPRO_KODE, NAMA_PRODUK, MPRO_PARENT, NAMA_PARENT, MPRO_ISGENERAL, REF_KATEGORI_PLY_RKPL_KODE, RKPL_NAMA, MPRO_ISGROUP, TIPE_TINDAKAN, REF_FRM_TND_RFTIND_KD, RFTIND_NAMA, MPRO_ISAKTIF, MPRO_IS_ADJUST_JSRS, MPRO_IS_ADJUST_JSBHP, MPRO_IS_ADJUST_JSALAT, MPRO_IS_ADJUST_JPOPERATOR, MPRO_IS_ADJUST_JPANESTHESI, MPRO_IS_ADJUST_JPPARAMEDIK, REF_JNS_TENAGAKERJA_KD, RJKTK_NAMA, REF_WAKTU_TIND_RWTIND_KODE, RWTIND_WAKTU_MULAI, RWTIND_WAKTU_SELESAI, REF_KOMP_TRF_INA_RKTINA_KODE, KOMPONEN_TARIF, MPRO_NAMA_EN, REF_KELAS_RLKS_KODE, RKLS_NAMA, MT_TGL_AWAL, MT_TGL_AKHIR, MT_JSRS, MT_JSBHP, MT_JSALAT, MT_JPOPERATOR, MT_JPANESTHESI, MT_JPPARAMEDIK, TOTAL_TARIF, MT_CATATAN)
                    SET created_at = NOW(), updated_at = NOW()";
            $command = $connection->createCommand($sql);
            $command->bindValue(':file', $csvFilePath);
            $command->execute();

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            Yii::error("Error importing CSV: " . $e->getMessage());
            return false;
        }
    }

    public function actionGetProductDetail($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $product = $this->findModel($id);

        if ($product) {
            return [
                'NAMA_PRODUK' => $product->NAMA_PRODUK,
                'TOTAL_TARIF' => $product->TOTAL_TARIF
            ];
        }

        return [
            'NAMA_PRODUK' => '',
            'TOTAL_TARIF' => 0
        ];
    }
}
