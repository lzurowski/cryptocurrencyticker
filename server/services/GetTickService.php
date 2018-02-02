<?php
namespace services;
 


class GetTickService {

    private $arrSymbols;


    public function __construct($arrSymbols){
        $this->arrSymbols = [];
        $avSymbols = SqlData::GetAvaliableSymbols();
        foreach($arrSymbols as $symbol){
            if(in_array($symbol,$avSymbols)){
                $this->arrSymbols[] = $symbol;
            }
        }       
    }

    public function getData(){
        $date = SqlData::GetLastDateTimeTick();
        $arrData =  SqlData::GetCurrentTick($this->arrSymbols,$date);
        $arr5m = SqlData::Get5minuteTick($this->arrSymbols, $date);
        $arr60m = SqlData::Get60minuteTick($this->arrSymbols, $date);
        $arr24h = SqlData::Get24hourTick($this->arrSymbols, $date);
        foreach($arrData as $symbol => $row){
            //5 min change
            $arrData[$symbol]['5minChange%'] = 0.0;
            if(isset($arr5m[$symbol])){
                $p = (double)$arr5m[$symbol]['average'];
                $c = (double)$row['average'];
                $arrData[$symbol]['5minChange%'] =  round( (($c-$p)/ $p) * 100.0,2); 
                //var_dump('5 min: '.$symbol. 'p: '.$p.' c: '.$c.' '.$arrData[$symbol]['5minChange']);
            }
            //60 minut change
            $arrData[$symbol]['60minChange%'] = 0.0;
            if(isset($arr60m[$symbol])){
                $p = (double)$arr60m[$symbol]['average'];
                $c = (double)$row['average'];
                $arrData[$symbol]['60minChange%'] =  round( (($c-$p)/ $p) * 100.0,2); 
                //var_dump('60 min: '.$symbol. 'p: '.$p.' c: '.$c.' '.$arrData[$symbol]['60minChange']);
            }
            //24 hour change
            $arrData[$symbol]['24hourChange%'] = 0.0;
            if(isset($arr24h[$symbol])){
                 $p = (double)$arr24h[$symbol]['average'];
                 $c = (double)$row['average'];
                 $arrData[$symbol]['24hourChange%'] =  round( (($c-$p)/ $p) * 100.0,2); 
                 //var_dump('24 hour: '.$symbol. 'p: '.$p.' c: '.$c.' '.$arrData[$symbol]['24hourChange']);
            }

        }
        return $arrData;
    }



    public function run(){
        $arr = $this->getData();
        if(empty($arr)){
           $arr = [];
        }
        echo json_encode($arr);
    }

}