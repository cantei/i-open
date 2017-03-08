<?php

namespace app\controllers;

use Yii;
use app\models\Tbvisitdrug;
use app\models\TbvisitdrugSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;
use yii\web\UploadedFile;
use app\models\UploadForm;


/**
 * TbVisitDrugController implements the CRUD actions for Tbvisitdrug model.
 */
class TbVisitDrugController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tbvisitdrug models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TbvisitdrugSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tbvisitdrug model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tbvisitdrug model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new Tbvisitdrug();
//        $x = Tbvisitdrug::find()->count();	
//
//        if ($model->load(Yii::$app->request->post())) {
//            $model->file = UploadedFile::getInstance($model, 'file');
//
//            $uploadExists = 0;
//            if ($model->file) {
//                $filepath = 'uploads/files/';
//                $file_name = Yii::$app->security->generateRandomString();
//                $file_import = $filepath.$file_name. '.' . $model->file->extension;
//              
//                   $uploadExists = 1;
//            }
//            if ($uploadExists) {
//                $model->file->saveAs($file_import);
//                $handle = fopen($file_import, 'r');
//                if ($handle) {
//                    while (($line = fgets($handle)) !== false) {
//                        
//                        $row = explode('|', $line);
//                        $hospcode= $row[0];
//                        $hn=$row[1];
//                        $cid=$row[2];
//                        $seq=$row[3];
//
//                        $date_serv=date('Y-m-d',strtotime($row[4]));
//
//                        $sql = "INSERT IGNORE INTO tbvisitdrug(hospcode,cid,hn,seq,date_serv) VALUES ('$hospcode', '$cid', '$hn','$seq','$date_serv')";
//                        $query = Yii::$app->db->createCommand($sql)->execute();
//                    }
//
//                    if($query) 
//                     {
////                        $y = Tbvisitdrug::find()->count();
////                        echo "data upload successfully".'=='.$y-$x;die;
//                     }
//                } else {
//                    // error opening the file.
//                }
//            }
//     
//        }
//
//             return $this->render('create', [
//                'model' => $model,
//            ]);
//    }

    /**
     * Deletes an existing Tbvisitdrug model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tbvisitdrug model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tbvisitdrug the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tbvisitdrug::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionUpload() {
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->attachment = UploadedFile::getInstance($model, 'attachment');
            
            $filename = pathinfo($model->attachment , PATHINFO_FILENAME);
            $ext = pathinfo($model->attachment , PATHINFO_EXTENSION);

            $newfilename = strtotime(date("Ymd")).$filename.'.'.$ext;
            $path=Yii::getAlias('@webroot').'/uploads/';
            if (!empty($newfilename)) {    
                $model->attachment->saveAs($path.$newfilename);                
                $res = $this->import($newfilename);               
            }
        }
        return $this->render('upload', ['model' => $model]);
    }
        
    public function import($newfilename)            
    {
        if($newfilename){
            $path=Yii::getAlias('@webroot').'/uploads/';
            $filetarget=$path.$newfilename;
//            echo $filetarget;die;
            $handle = fopen($filetarget, 'r');
                if ($handle) {                    
                while (($line = fgets($handle)) !== false) {
                    $row = explode('|', $line);
                    $hospcode = $row[0];
                    $hn = $row[1];
                    $cid = $row[2];
                    $seq = $row[3];
                    $date_serv = date('Y-m-d', strtotime($row[4]));
                    $sql = "INSERT IGNORE INTO tbvisitdrug(hospcode,cid,hn,seq,date_serv) VALUES ('$hospcode', '$cid', '$hn','$seq','$date_serv')";
                    $query = Yii::$app->db->createCommand($sql)->execute();
                }
            }
        }
    }
    

}
