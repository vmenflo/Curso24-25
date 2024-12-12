<?php
class Empleado
{
    // variables
    private $nombre;
    private $salario;

    // constructor
    public function __construct($n_nombre, $n_salario)
    {
        $this->nombre = $n_nombre;
        $this->salario = $n_salario;
   
    }

    // Getter y Setter
    public function setNombre($n_nombre)
    {
        $this->nombre = $n_nombre;
    }
    public function setSalario($n_salario)
    {
        $this->salario = $n_salario;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getSalario()
    {
        return $this->salario;
    }

    // método
    public function impuesto(){
        if($this->salario>=3000){
            echo "<p> Tiene que pagar impuestos</p>";
        }else{
            echo "<p> No tiene que pagar impuestos</p>";
        }
    }
}
