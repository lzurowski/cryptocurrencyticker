<?php
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'autoload.php';

use services\GetTickService as GTS;

header('Access-Control-Allow-Origin: *');
        
if(empty($_REQUEST['symbols'])){
    $arrSymbol = [];
}else{
    $arrSymbol = explode(",",$_REQUEST['symbols']);
    foreach($arrSymbol as $key => $val){
        $arrSymbol[$key] = trim($val);
    }
}
$g = new GTS($arrSymbol);
$g->run();