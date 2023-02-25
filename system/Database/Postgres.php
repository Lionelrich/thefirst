<?php
namespace System\Database;


class Postgres{
    private function connect(){
        return pg_connect("host=".DB_HOST." dbname=".DB_NAME." user=".DB_USER." password=".DB_PASSWORD);
    }
    public function query($query){
        $db=$this->connect();
        $result=pg_query($query);   
        $return=array();
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)){
            $return[] = $line;
        }
        return $return;
    }
}