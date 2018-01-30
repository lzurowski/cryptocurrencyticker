<?php 

namespace lib;



class Db {
   
    private static $instance = null;
    private $connection = null;

    /**
     * Undocumented function
     *
     * @return Db
     */
    public static function GetInstance(){
        if( empty (static::$instance ) ){
            static::$instance = new Db(DbConfig::DNS, DbConfig::USER, DbConfig::PASS);
        }
        return static::$instance;

    }


    /**
     * Undocumented function
     *
     * @param [string] $dsn
     * @param [string] $user
     * @param [string] $pass
     */
    public function __construct($dsn, $user=NULL, $pass=NULL) {
        $this->connection = new \PDO($dsn, $user, $pass);
        $this->numExecutes = 0;
        $this->numStatements = 0;
    }

    /**
     * Undocumented function
     *
     * @param [string] $sql
     * @return []
     */
    public function queryArr($sql){
        $arr = [];
        foreach ($this->connection->query($sql,\PDO::FETCH_ASSOC) as $row) {
           $arr[] = $row;
        }
        return $arr;
    }

    /**
     * Undocumented function
     *
     * @param [string] $table
     * @param [] $arr
     * @return void
     */
    public function insertFromArr($table, $arr){
        $arrColumns = array_keys($arr);
        $arrColumnsKeys = (function($arrColumns){
            $arr = [];
            foreach($arrColumns as $c){
                $arr[] = ':'.$c;
            }
            return $arr;
        })($arrColumns);

        $stmt =  $this->connection->prepare($sql = "INSERT INTO {$table} (".implode(', ',$arrColumns).") VALUES (".implode(', ',$arrColumnsKeys).");");
        foreach($arr as $key => $value){
            $stmt->bindValue(':'.$key, trim($value));
       
        }
        $return = $stmt->execute();
        return $return;
    }


}