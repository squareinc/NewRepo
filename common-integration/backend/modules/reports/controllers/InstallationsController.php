<?php

namespace backend\modules\reports\controllers;

use Yii;
use backend\modules\reports\models\JetExtensionDetail;
use backend\modules\reports\models\JetExtensionDetailSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use backend\modules\reports\components\Data;



/**
 * Installations Controller.
 */
class InstallationsController extends BaseController
{


    /**
     * Lists all JetExtensionDetail models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $type = Yii::$app->getRequest()->getQueryParam('type')?:'daily';
        if($type=='daily')
        {
            $sql = 'SELECT DATE(installed_on) as formatted_date,DATE_FORMAT(installed_on,"%y-%m-%d 00:00:00") from_date,DATE_FORMAT(installed_on,"%y-%m-%d 23:59:59") to_date,count(*) as installations FROM '.Data::EXTENSIONS_TABLE.' GROUP BY DATE(`installed_on`) ORDER BY installed_on DESC ';
        }
        elseif($type=='monthly')
        {
            $sql = 'SELECT DATE_FORMAT(installed_on,"%m-%y") as formatted_date,DATE_FORMAT(installed_on,"%m-%y") as install_date1,YEAR(installed_on) as year,MONTH(installed_on) as month,DATE_FORMAT(installed_on,"%y-%m-01 00:00:00") from_date,DATE_FORMAT(installed_on,"%y-%m-31 23:59:59") to_date,count(*) as installations FROM '.Data::EXTENSIONS_TABLE.' GROUP BY `install_date1` ORDER BY installed_on DESC ';
        }
        elseif($type=='yearly')
        {
            $sql = 'SELECT DATE_FORMAT(installed_on,"Year %Y") as formatted_date,YEAR(installed_on) as year,count(*) as installations,DATE_FORMAT(installed_on,"%y-01-31 00:00:00") from_date,DATE_FORMAT(installed_on,"%y-12-31 23:59:59") to_date FROM '.Data::EXTENSIONS_TABLE.' GROUP BY `year` ORDER BY installed_on DESC ';
        }
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ({$sql}) FINAL")->queryScalar();
        $sql1 = Yii::$app->db->createCommand($sql);
        $chart = $sql1->queryAll();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $totalCount,
            'sort' =>false,
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'chart' => $chart,
        ]);
    }

    /**
     * Displays a detail of row.
     * @return mixed
     */
    public function actionView()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        $from = Yii::$app->getRequest()->getQueryParam('from');
        $to = Yii::$app->getRequest()->getQueryParam('to');
        $connection=Yii::$app->getDb();
        $searchModel = new JetExtensionDetailSearch();
        $searchModel->setCustomWhere("`install_date` BETWEEN '{$from} 00:00:00' AND '{$to} 23:59:59' ");
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('view',['model' => $dataProvider, 'searchModel' => $searchModel]);
    }

    
}
