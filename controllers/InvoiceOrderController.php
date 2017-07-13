<?php

namespace app\controllers;

use Yii;
use app\models\InvoiceOrder;
use app\models\InvoiceOrderSearch;
use app\models\Settings;
use app\models\TaxSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\components\General;

/**
 * InvoiceOrderController implements the CRUD actions for InvoiceOrder model.
 */
class InvoiceOrderController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'pdf', 'save-as-new', 'add-invoice-order-item','print'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => false
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all InvoiceOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvoiceOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InvoiceOrder model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $providerInvoiceOrderItem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoiceOrderItems,
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'providerInvoiceOrderItem' => $providerInvoiceOrderItem,
        ]);
    }

    /**
     * Creates a new InvoiceOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InvoiceOrder();
        $postarray = Yii::$app->request->post('InvoiceOrder');
        // print_r($postarray);
        if($post = Yii::$app->request->post()){
            $post['InvoiceOrder']['gst_invoice_date'] = strtotime($postarray['gst_invoice_date']);
            $post['InvoiceOrder']['challan_date'] = strtotime($postarray['challan_date']);
            $post['InvoiceOrder']['po_date'] = strtotime($postarray['po_date']);
            $post['InvoiceOrder']['btp_address'] = nl2br($postarray['btp_address']);
            // echo '<br><br>';
            // print_r($post);
            // exit;
        }
        if ($model->loadAll($post) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $pan = Settings::find()
            ->where(['meta_key' => 'pan'])
            ->one();
            $all_settings = Settings::find()->asArray()->indexBy('meta_key')->all();
            $model->cgst = 0;
            $model->sgst = 0;
            $model->igst = 0;
            $model->PAN = $all_settings['pan']['meta_value'];
            $model->gst_in = $all_settings['gst_in']['meta_value'];
            $autoincrement_id = $model->find()->max('id');
            $autoincrement_id = is_numeric($autoincrement_id) ? $autoincrement_id + 1:1;
            $model->gst_invoice_no = $autoincrement_id;
            $model->challan_no = $autoincrement_id;
            $all_gst = TaxSettings::find()->asArray()->indexBy('tax_key')->all();
            return $this->render('create', [
                'model' => $model,
                'cgst_percent' => $all_gst['cgst']['tax_percent'],
                'sgst_percent' => $all_gst['sgst']['tax_percent'],
                'igst_percent' => $all_gst['igst']['tax_percent'],
            ]);
        }
    }

    /**
     * Updates an existing InvoiceOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->request->post('_asnew') == '1') {
            $model = new InvoiceOrder();
        }else{
            $model = $this->findModel($id);
        }
       // print_r(Yii::$app->request->post('InvoiceOrder'));
        $postarray = Yii::$app->request->post('InvoiceOrder');
        // print_r($postarray);
        if($post = Yii::$app->request->post()){
            $post['InvoiceOrder']['gst_invoice_date'] = strtotime($postarray['gst_invoice_date']);
            $post['InvoiceOrder']['challan_date'] = strtotime($postarray['challan_date']);
            $post['InvoiceOrder']['po_date'] = strtotime($postarray['po_date']);
            $post['InvoiceOrder']['btp_address'] = nl2br($postarray['btp_address']);
            // echo '<br><br>';
            // print_r($post);
            // exit;
        }
        if ($model->loadAll($post) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $model->gst_invoice_date = date('d-m-Y',$model->gst_invoice_date);
            $model->challan_date = date('d-m-Y',$model->challan_date);
            $model->po_date = date('d-m-Y',$model->po_date);
            $model->btp_address = General::br2nl($model->btp_address);
            $all_gst = TaxSettings::find()->asArray()->indexBy('tax_key')->all();
            return $this->render('create', [
                'model' => $model,
                'cgst_percent' => $all_gst['cgst']['tax_percent'],
                'sgst_percent' => $all_gst['sgst']['tax_percent'],
                'igst_percent' => $all_gst['igst']['tax_percent'],
            ]);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing InvoiceOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * 
     * Export InvoiceOrder information into PDF format.
     * @param integer $id
     * @return mixed
     */
    public function actionPdf($id) {
        $model = $this->findModel($id);
        $providerInvoiceOrderItem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoiceOrderItems,
        ]);

        $content = $this->renderAjax('_pdf', [
            'model' => $model,
            'providerInvoiceOrderItem' => $providerInvoiceOrderItem,
        ]);

        $pdf = new \kartik\mpdf\Pdf([
            'mode' => \kartik\mpdf\Pdf::MODE_CORE,
            'format' => \kartik\mpdf\Pdf::FORMAT_A4,
            'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
            'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
            'content' => $content,
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            'cssInline' => '.kv-heading-1{font-size:18px}',
            'options' => ['title' => \Yii::$app->name],
            'methods' => [
                'SetHeader' => [\Yii::$app->name],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        return $pdf->render();
    }

    /**
    * Creates a new InvoiceOrder model by another data,
    * so user don't need to input all field from scratch.
    * If creation is successful, the browser will be redirected to the 'view' page.
    *
    * @param mixed $id
    * @return mixed
    */
    public function actionSaveAsNew($id) {
        $model = new InvoiceOrder();

        if (Yii::$app->request->post('_asnew') != '1') {
            $model = $this->findModel($id);
        }
    
        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('saveAsNew', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Finds the InvoiceOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvoiceOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvoiceOrder::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
    * Action to load a tabular form grid
    * for InvoiceOrderItem
    * @author Yohanes Candrajaya <moo.tensai@gmail.com>
    * @author Jiwantoro Ndaru <jiwanndaru@gmail.com>
    *
    * @return mixed
    */
    public function actionAddInvoiceOrderItem()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('InvoiceOrderItem');
            if((Yii::$app->request->post('isNewRecord') && Yii::$app->request->post('_action') == 'load' && empty($row)) || Yii::$app->request->post('_action') == 'add')
                $row[] = [];
            return $this->renderAjax('_formInvoiceOrderItem', ['row' => $row]);
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single InvoiceOrder model.
     * @param integer $id
     * @return mixed
     */
    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        $providerInvoiceOrderItem = new \yii\data\ArrayDataProvider([
            'allModels' => $model->invoiceOrderItems,
        ]);
        // return $this->renderAjax('print', [
        //     'model' => $this->findModel($id),
        //     'providerInvoiceOrderItem' => $providerInvoiceOrderItem,
        // ]);
        $all_gst = TaxSettings::find()->asArray()->indexBy('tax_key')->all();
        return $this->renderAjax('print', [
            'model' => $this->findModel($id),
            'cgst_percent' => $all_gst['cgst']['tax_percent'],
            'sgst_percent' => $all_gst['sgst']['tax_percent'],
            'igst_percent' => $all_gst['igst']['tax_percent'],
        ]);
    }
}
