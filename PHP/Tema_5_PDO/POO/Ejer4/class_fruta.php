<?php
class Fruta
{

    // Declaramos variables
    private $color, $tamanyo;

    private static $n_frutas=0;

    // Constructor
    public function __construct($color_nuevo, $tamanyo_nuevo)
    {
        $this->color = $color_nuevo;
        $this->tamanyo = $tamanyo_nuevo;
        // No se usa this porque es static, se usa self::
        self::$n_frutas++;
    }

    // Destructor
    public function __destruct(){
        self::$n_frutas--;
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
    public function imprimir(){
        echo "<h2> Información de mi fruta Pera </h2>";
        echo "<p>Color: ".$this->color."; Tamaño: ".$this->tamanyo."</p>";
    }

    // método contar fruta
    public static function cuentaFruta(){
        return self::$n_frutas;
    }
}
