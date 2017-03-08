<?php

namespace app\controllers;

use yii\filters\AccessControl;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class TestPermissionController extends \yii\web\Controller
{  
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    // deny all POST requests
//                    [
//                        'allow' => false,
//                        'verbs' => ['POST']
//                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
    //                    'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public function actionIndex()
    {

       if (Yii::$app->user->can('admin')) {
            echo 'U R Admin';
            die;
        } elseif (Yii::$app->user->can('manager')) {
            echo 'U R Manager';
            die;
        } elseif (Yii::$app->user->can('member')) {
            echo 'U R Member';
            die;
        } else {
            echo 'good bye';
            die;
        }
        return $this->render('index');
    }
    public function actionCreate()
    {
        //echo Yii::$app->user->profile->hoscode;die;
        echo Yii::$app->user->identity->profile->hoscode;die; 
        return $this->render('create');
    }

    public function actionDelete()
    {
       echo Yii::$app->user->identity->profile->hoscode;die; 
        return $this->render('delete');
    }



    public function actionUpdate()
    {
        echo Yii::$app->user->identity->profile->hoscode;die; 
        return $this->render('update');
    }

    public function actionView()
    {
//        if(!Yii::$app->user->isGuest){
//            echo Yii::$app->user->identity->username;die; 
//        }
//        return $this->render('view');
        
        
//use app\models\Country;
$items=  \app\models\AuthItem::find()->where(['type' => 1])->all();

//use yii\helpers\ArrayHelper;
$listData=ArrayHelper::map($items,'name','name');

\yii\helpers\VarDumper::dump($listData,10,true).'<br>';
echo strtotime(date("Y-m-d H:i:s"));die;
//echo $form->field($model, 'name')->dropDownList(
//                $listData, ['prompt' => 'Select...']);
    }

}
