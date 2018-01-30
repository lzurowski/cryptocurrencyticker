<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php';

use lib\Db as Db;

$start = microtime(true);

$arrCurrency = ['ETHPLN','BTCPLN','BCCPLN','BTGPLN','LTCPLN','LSKPLN','DASHPLN','GAMEPLN'];
$url = "https://bitbay.net/API/Public/[currency]/ticker.json";
$count = 0;
foreach($arrCurrency as $c){
    $u = str_replace('[currency]',$c,$url);
    $data =  file_get_contents($u);
    $o = json_decode($data);
    $arrInsert = [];
    $arrInsert["symbol"] =  $c;
    $arrInsert["base_currency"] = substr($c,-3);
    $arrInsert["currency"] = str_replace($arrInsert["base_currency"],'',$c);
    $arrInsert["bid"]= $o->bid;
    $arrInsert["ask"]= $o->ask;
    $arrInsert["bid_qty"]= 0;
    $arrInsert["ask_qty"]= 0;
    $arrInsert["average"]= $o->average;
    $arrInsert["volume"]=  $o->volume;
    $arrInsert["date"]= (new \DateTime())->format('Y-m-d H:i:s');
    (Db::GetInstance()->insertFromArr('tick',$arrInsert))? $count++ : '';

}
$end = microtime(true);
echo (new \DateTime())->format('Y-m-d H:i:s')." T: ".($end-$start).'s; inserted rows: '.$count.PHP_EOL;