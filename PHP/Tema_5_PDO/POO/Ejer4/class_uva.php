<?php
require "class_fruta.php";
class Uva extends Fruta{
    private $tieneSemilla;

    public function __construct($color_nuevo, $tamanyo_nuevo,$tiene){
        $this->tieneSemilla=$tiene;
        parent::__construct($color_nuevo, $tamanyo_nuevo);
    }

    public function tieneSemilla(){
        return $this->tieneSemilla;
    }

    // método imprimir
    public function imprimir(){
        echo "<p>Color: ".parent::getColor()."; Tamaño: ".parent::getTamanyo()."</p>";
    }
}
