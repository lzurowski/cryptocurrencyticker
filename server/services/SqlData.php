<?php
namespace services;
use lib\Db as Db;

class SqlData{

    public static function GetAvaliableSymbols(){
        $arrRreturn = [];
        $sql = "SELECT DISTINCT (symbol) FROM  `tick`";
        foreach(Db::GetInstance()->queryArr($sql) as $row){
            $arrRreturn[$row['symbol']] = $row['symbol'];
        }
        return $arrRreturn;
    }

    public static function GetLastDateTimeTick(){
       $sql = "Select create_time from tick ORDER BY id DESC limit 1";
       foreach(Db::GetInstance()->queryArr($sql) as $row){
         return $row['create_time'];
       }
       return null;
    }

    public static function GetCurrentTick($arrSymbols, $date){
        $arrReturn = [];
        $sql = "
        SELECT *
        FROM  `tick` 
        WHERE TRUE 
        AND symbol IN ('".implode("','",$arrSymbols)."')
        AND create_time > DATE_SUB(  '{$date}' , INTERVAL 2 MINUTE )
        order By create_time desc";
        foreach(Db::GetInstance()->queryArr($sql) as $row){
            if(empty($arrReturn[$row['symbol']])){
                $arrReturn[$row['symbol']] = $row;
            }
        }
        return $arrReturn;
    }
    
    public static function Get5minuteTick($arrSymbols, $date){
        $arrReturn = [];
        $sql = "SELECT symbol, average, create_time
        FROM  `tick` 
        WHERE TRUE 
        AND symbol
        IN ('".implode("','",$arrSymbols)."')
        AND create_time > DATE_SUB( '{$date}' , INTERVAL 6 MINUTE )
        AND create_time < DATE_SUB( '{$date}' , INTERVAL 4 MINUTE )
        order By create_time desc";
        foreach(Db::GetInstance()->queryArr($sql) as $row){
            if(empty($arrReturn[$row['symbol']])){
                $arrReturn[$row['symbol']] = $row;
            }
        }
        return $arrReturn;
    }

    public static function Get60minuteTick($arrSymbols, $date){
        $arrReturn = [];
        $sql = "SELECT symbol, average, create_time
        FROM  `tick` 
        WHERE TRUE 
        AND symbol
        IN ('".implode("','",$arrSymbols)."')
        AND create_time > DATE_SUB( '{$date}' , INTERVAL 61 MINUTE )
        AND create_time < DATE_SUB( '{$date}' , INTERVAL 59 MINUTE )
        order By create_time desc";
        foreach(Db::GetInstance()->queryArr($sql) as $row){
            if(empty($arrReturn[$row['symbol']])){
                $arrReturn[$row['symbol']] = $row;
            }
        }
        return $arrReturn;
    }

    public static function Get24hourTick($arrSymbols, $date){
        $arrReturn = [];
        $sql = "SELECT symbol, average, create_time
        FROM  `tick` 
        WHERE TRUE 
        AND symbol
        IN ('".implode("','",$arrSymbols)."')
        AND create_time > DATE_SUB( '{$date}' , INTERVAL 1441 MINUTE )
        AND create_time < DATE_SUB( '{$date}' , INTERVAL 1439 MINUTE )
        order By create_time desc";
        foreach(Db::GetInstance()->queryArr($sql) as $row){
            if(empty($arrReturn[$row['symbol']])){
                $arrReturn[$row['symbol']] = $row;
            }
        }
        return $arrReturn;
    }

}



















