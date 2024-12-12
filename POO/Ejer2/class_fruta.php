<?php
class Fruta
{

    // Declaramos variables
    private $color, $tamanyo;

    // Constructor
    public function __construct($color_nuevo, $tamanyo_nuevo)
    {
        $this->color = $color_nuevo;
        $this->tamanyo = $tamanyo_nuevo;
        $this->imprimir();
    }

    // métodos getter y setter
    public function setColor($color_nuevo)
    {
        $this->color = $color_nuevo;
    }
    public function setTamanyo($tamanyo_nuevo)
    {
        $this->tamanyo = $tamanyo_nuevo;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function getTamanyo()
    {
        return $this->tamanyo;
    }

    // método imprimir
    private function imprimir(){
        echo "<h2> Información de mi fruta Pera </h2>";
        echo "<p>Color: ".$this->color."; Tamaño: ".$this->tamanyo."</p>";
    }
}
