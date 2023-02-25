<?php
namespace System\Database;

class Select{
    private string $_from = "";
    private array $_select = [];
    private array $wheres = [];
    private array $orderBys = [];
    private array $grupBys = [];
    private array $joins = [];

    public function select($select){
        $this->_select = $select;
        return $this;
    }
    public function from($from){
        $this->_from = $from;
        return $this;
    }
    public function where($column, $operator, $value, $quote = true){
        $this->wheres[] = ["column"=>$column, "operator"=>$operator, "value"=>$value, "quote"=>$quote];
        return $this;

    }
    public function orderBy($column, $direction="asc"){
        $this->orderBys[] = ["column"=>$column, "direction"=>$direction];
        return $this;
    }
    public function grupBy($column){
        $this->grupBys[] = $column;
        return $this;
    }
    public function join($table, $on, $type="inner"){
        $this->joins[] = ["table"=>$table, "on"=>$on, "type"=>$type];
        return $this;
        
    }
    private function build(){
        $sql="SELECT ";
        if($this->_select){
            $sql .= implode(", ", $this->_select)." ";
        }else{
            $sql .="* ";
        }
        $sql .="FROM ".$this->_from." ";
        return $sql;
    }
    public function get(){
        $postgres=new Postgres();
        return $postgres->query($this->build());
    }
}