<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php';

use lib\Db as Db;
$start = microtime(true);
$data =  file_get_contents('https://www.binance.com/api/v3/ticker/bookTicker');
$arrData = json_decode($data);
$count = 0;
foreach($arrData as $o){
    $arrInsert = [];
    $arrInsert["symbol"] =  trim($o->symbol);
    $arrInsert["base_currency"] = substr($arrInsert["symbol"],-3);
    $arrInsert["currency"] = str_replace($arrInsert["base_currency"],'',$arrInsert["symbol"]);
    $arrInsert["bid"]= $o->bidPrice;
    $arrInsert["ask"]= $o->askPrice;
    $arrInsert["bid_qty"]= $o->bidQty;
    $arrInsert["ask_qty"]= $o->askQty;
    $arrInsert["average"]= ((double) $o->bidPrice + (double) $o->askPrice) / 2.0 ;
    $arrInsert["volume"]=  0.0;
    $arrInsert["date"]= (new \DateTime())->format('Y-m-d H:i:s');
    if( 'ETH' === $arrInsert["base_currency"] ){
        (Db::GetInstance()->insertFromArr('tick',$arrInsert))? $count++ : '';
    }
}
$end = microtime(true);
echo (new \DateTime())->format('Y-m-d H:i:s')."T: ".($end-$start).'s; inserted rows: '.$count.PHP_EOL;