<?php

namespace backend\modules\reports\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use backend\modules\reports\models\CustomQuerySearch;
use backend\modules\reports\components\Data;


/**
 * FreeAppsWithNoRevenue Controller
 */
class FreeAppsWithNoRevenueController extends BaseController
{


    /**
     * Lists all JetExtensionDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        

        $type = Yii::$app->getRequest()->getQueryParam('type')?:'daily';
        $table = Data::EXTENSIONS_TABLE;
        $table1 = Data::JET_PRODUCT_TABLE;
        $table2 = Data::ORDER_TABLE;

        $sql = "SELECT count( `jod`.`merchant_id` ) AS `count`,count( `jp`.`merchant_id` ) AS `live_products` , `jed`.`merchant_id`,`jed`.`email`,`jed`.`status`,`jed`.`app_status`,`jed`.`expire_date`,`jed`.`shopurl` FROM `{$table}` AS `jed` LEFT JOIN `{$table1}` `jp` ON `jed`.`merchant_id` = `jp`.`merchant_id` AND `jp`.`status`='Available for Purchase' LEFT JOIN `{$table2}` `jod` ON `jed`.`merchant_id` = `jod`.`merchant_id` AND `jod`.`status` = 'complete'  WHERE `jed`.`status` = 'Not Purchase' GROUP BY `jed`.`merchant_id`";
        $searchModel = new CustomQuerySearch();
        $searchModel->andFilterWhere(['lt','count',1]);
        $searchModel->setCustomQuery($sql);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        /*
        return $this->render('index',['dataProvider' => $dataProvider, 'searchModel' => $searchModel]);
        $totalCount = Yii::$app->db->createCommand("SELECT COUNT(*) FROM ({$sql}) FINAL")->queryScalar();
        $sql1 = Yii::$app->db->createCommand($sql);
        $chart = $sql1->queryAll();
        $dataProvider = new SqlDataProvider([
            'sql' => $sql,
            'totalCount' => $totalCount,
            'sort' =>[
                        'attributes' => [
                            'complete_orders','status','app_status','merchant_id','shopurl','email','expire_date'
                        ]
                    ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'chart' => $chart,
        ]);
        */
    }

    

    
}
