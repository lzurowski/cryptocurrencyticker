<?php
namespace tests\services;
use services\SqlData as SqlData;
use lib\ShellPrint as P;

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'autoload.php';

class SqlDataTest{


    public function testResult(&$ret, &$ok){
        $ret.= (($ok)? P::color('OK !!!',P::GREEN) : P::color(' NOT PASSED !!! ',P::RED));
        P::echo($ret);
    }

    public function  testGetAvaliableSymbols(){
        $ret = P::color('TEST: '.__METHOD__.' := ',P::BLUE);
        $ok =true;
        $arrSymbols =  SqlData::GetAvaliableSymbols();
        if(!is_array($arrSymbols)){
            $ret.= P::color('ERROR symbols is not arr'.PHP_EOL,P::RED);
            $ok = false;
        }
        foreach($arrSymbols as $key => $value){
             if($key !== $value){
                 $ret.= P::color($key .' not equal '. $value.PHP_EOL.P::RED);
                 $ok = false;
             }
        }
        $this->testResult($ret, $ok);
     }

     public function testGetLastDateTimeTick(){
        $ret = P::color('TEST: '.__METHOD__.' := ',P::BLUE);
        $ok = true;
        $date = SqlData::GetLastDateTimeTick();
        if(empty($date)){
            $ret.= P::color('ERROR tick last date is  Empty'.PHP_EOL,P::RED);
            $ok = false;
        }
        $dt = \DateTime::createFromFormat("Y-m-d H:i:s", $date);
        if( !($dt !== false && !array_sum($dt->getLastErrors()))){
            $ret.= P::color('ERROR wrong date format'.PHP_EOL,P::RED);
            $ok = false;
        }
        $this->testResult($ret, $ok);
     }


     public function  testGetCurrentTick(){
        $ret = P::color('TEST: '.__METHOD__.' := ',P::BLUE);
        $ok = true;
        $arrSymbols =  SqlData::GetAvaliableSymbols();
        $date = SqlData::GetLastDateTimeTick();
        $arrTicks =  SqlData::GetCurrentTick($arrSymbols, $date);

        if(!is_array($arrTicks) || empty($arrTicks)){
            $ret.= P::color('ERROR ticks is not arr, or Empty'.PHP_EOL,P::RED);
            $ok = false;
        }
        foreach($arrTicks as $symbol => $row){
            if(!in_array($symbol,$arrSymbols)){
                $ret.= P::color('ERROR wrong table keys'.PHP_EOL,P::RED);
                $ok = false;
            }
        }        
        $this->testResult($ret, $ok);
     }

     public function  testGet5minuteTick(){
        $ret = P::color('TEST: '.__METHOD__.' := ',P::BLUE);
        $ok = true;
        $arrSymbols =  SqlData::GetAvaliableSymbols();
        $date = SqlData::GetLastDateTimeTick();
        $arrTicks =  SqlData::Get5minuteTick($arrSymbols, $date);

        if(!is_array($arrTicks) || empty($arrTicks)){
            $ret.= P::color('ERROR ticks is not arr, or Empty'.PHP_EOL,P::RED);
            $ok = false;
        }
        foreach($arrTicks as $symbol => $row){
            if(!in_array($symbol,$arrSymbols)){
                $ret.= P::color('ERROR wrong table keys'.PHP_EOL,P::RED);
                $ok = false;
            }
        }        
        $this->testResult($ret, $ok);
     }
     
     public function  testGet60minuteTick(){
        $ret = P::color('TEST: '.__METHOD__.' := ',P::BLUE);
        $ok = true;
        $arrSymbols =  SqlData::GetAvaliableSymbols();
        $date = SqlData::GetLastDateTimeTick();
        $arrTicks =  SqlData::Get60minuteTick($arrSymbols, $date);

        if(!is_array($arrTicks) || empty($arrTicks)){
            $ret.= P::color('ERROR ticks is not arr, or Empty'.PHP_EOL,P::RED);
            $ok = false;
        }
        foreach($arrTicks as $symbol => $row){
            if(!in_array($symbol,$arrSymbols)){
                $ret.= P::color('ERROR wrong table keys'.PHP_EOL,P::RED);
                $ok = false;
            }
        }        
        $this->testResult($ret, $ok);
     }

     public function  testGet24hourTick(){
        $ret = P::color('TEST: '.__METHOD__.' := ',P::BLUE);
        $ok = true;
        $arrSymbols =  SqlData::GetAvaliableSymbols();
        $date = SqlData::GetLastDateTimeTick();
        $arrTicks =  SqlData::Get24hourTick($arrSymbols, $date);

        if(!is_array($arrTicks) || empty($arrTicks)){
            $ret.= P::color('ERROR ticks is not arr, or Empty'.PHP_EOL,P::RED);
            $ok = false;
        }
        foreach($arrTicks as $symbol => $row){
            if(!in_array($symbol,$arrSymbols)){
                $ret.= P::color('ERROR wrong table keys'.PHP_EOL,P::RED);
                $ok = false;
            }
        }        
        $this->testResult($ret, $ok);
     }


}

$test = new SqlDataTest();
$test->testGetAvaliableSymbols();
$test->testGetLastDateTimeTick();
$test->testGetCurrentTick();
$test->testGet5minuteTick();
$test->testGet60minuteTick();
$test->testGet24hourTick();