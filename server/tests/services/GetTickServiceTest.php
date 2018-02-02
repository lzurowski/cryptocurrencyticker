<?php
namespace tests\services;
use services\SqlData as SqlData;
use services\GetTickService as GTS;
use lib\ShellPrint as P;

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'autoload.php';

class GetTickServiceTest{


    public function testResult(&$ret, &$ok){
        $ret.= (($ok)? P::color('OK !!!',P::GREEN) : P::color(' NOT PASSED !!! ',P::RED));
        P::echo($ret);
    }

    public function testRun(){
        $g = new GTS(['ETHPLN','ADAETH','XLMETH','kupa']);
        $g->run();
    }

}

$test = new GetTickServiceTest();
$test->testRun();