<?php 
namespace frontend\modules\neweggcanada\components\Dashboard;

use Yii;
use yii\base\Component;
use frontend\modules\neweggcanada\components\Data;

class Earninginfo extends Component
{
    public static $_today = 0;
    public static $_week = 0;
    public static $_month = 0;
    public static $_total = 0;

    /**
     * To check Revenue
     * @param string $merchant_id
     * @return bool
     */
    public static function getTodayEarning($merchant_id)
    {
        $date=date('d-m-Y  H:i:s');
        $date1 = date('d-m-Y 00:00:00');
        if(is_numeric($merchant_id)) {

            //$query = "SELECT `order_total` FROM `newegg_can_order_detail` WHERE `order_date` BETWEEN '{$date1}' AND '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";
            $query = "SELECT `order_total` FROM `newegg_can_order_detail` WHERE `order_date` LIKE '%{$date}%' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";

            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }                  
                }
            }  
            return (float)$total; 
        }       
        
     }

    public static function getMonthlyEarning($merchant_id)
    {
        $date=date('d-m-Y');
        $date1=date('d-m-Y',strtotime('-30 days', strtotime(date('d-m-Y'))));

        if(is_numeric($merchant_id)) {
            $query = "SELECT `order_total` FROM `newegg_can_order_detail` WHERE `order_date` BETWEEN '{$date1}' AND '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";

            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }                  
                }
            }  
            return (float)$total;
        }       
         
    }

    public static function getWeeklyEarning($merchant_id)
    {
        $date=date('d-m-Y');
        $date1=date('d-m-Y',strtotime('-7 days', strtotime(date('d-m-Y'))));
        
        if(is_numeric($merchant_id)) {

            $query = "SELECT `order_total` FROM `newegg_can_order_detail` WHERE `order_date` BETWEEN '{$date1}' AND '{$date}' AND `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id` ={$merchant_id}";
            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }                  
                }
            }  
            return (float)$total; 
        }       
         
    }

    public static function getTotalEarning($merchant_id)
    {
       if(is_numeric($merchant_id)) {
            $query = "SELECT `order_total` FROM `newegg_can_order_detail` WHERE `order_status_description` = '".Data::ORDER_STATUS_INVOICED."' AND `merchant_id`=".$merchant_id;
            $result = Data::sqlRecords($query, 'all');
            $total = 0;
            if(is_array($result) && count($result)>0)
            {
                foreach ($result as $val)
                {
                    if(isset($val['order_total']))
                    {
                        $total += $val['order_total'];
                    }                  
                }
            } 
            return (float)$total; 
        }       
        
    }

   
}
