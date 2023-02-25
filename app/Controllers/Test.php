<?php
namespace App\Controllers;

class Test{
    public function metodo(){
        view("blog",[
            "test"=>"Olavo de carvalho",
            "sumario"=>"Inicio do site",
    ]);
    }
    public function artigo(){
        echo "Poque o comunismo deu certo";
    }
    public function texto(){
        echo "<img src='https://upload.wikimedia.org/wikipedia/commons/1/12/Victims_of_the_1921_famine_in_Russia.jpg'/> ";   
    }
}