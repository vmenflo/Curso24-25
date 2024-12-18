<?php
class Pelicula
{
    // variables
    private $nombre;
    private $año;
    private $director;
    private $precio;
    private $alquilada;
    private $fechaDevolucion;
    private $recargo;

    // constructor
    public function __construct($n_nombre, $n_año, $n_director, $n_precio, $n_alquilada, $n_fecha_dev, $n_recargo)
    {
        $this->nombre = $n_nombre;
        $this-> año = $n_año;
        $this-> director = $n_director;
        $this-> precio = $n_precio;
        $this-> alquilada = $n_alquilada;
        $this-> fechaDevolucion = $n_fecha_dev;
        $this-> recargo = $n_recargo;
    }

    // Getter y Setter
    public function setNombre($n_nombre)
    {
        $this->nombre = $n_nombre;
    }
    public function getNombre()
    {
        return $this->nombre;
    }

    public function setAño($n_año)
    {
        $this->año = $n_año;
    }
    public function getAño()
    {
        return $this->año;
    }

    public function setDirector($n_director)
    {
        $this->director = $n_director;
    }
    public function getDirector()
    {
        return $this->director;
    }

    public function setPrecio($n_precio)
    {
        $this->precio = $n_precio;
    }
    public function getPrecio()
    {
        return $this->precio;
    }

    public function setAlquilada($n_alquilada)
    {
        $this->alquilada = $n_alquilada;
    }
    public function getAlquilada()
    {
        if($this->alquilada){
            echo "<p> Disponibilidad: Esta alquilada </p>";
        }else{
            echo "<p> Disponibilidad: Esta libre </p>";
        }
    }

    public function setFechaDev($n_fecha)
    {
        $this->fechaDevolucion = $n_fecha;
    }
    public function getFechaDev()
    {
        return $this->fechaDevolucion;
    }

    public function setRecargo($n_recargo)
    {
        $this->recargo = $n_recargo;
    }
    public function getRecargo()
    {
        return $this->recargo;
    }

    // Métodos
    public function penalizacion(){
        $fechaDev = $this->fechaDevolucion;
        $fechaActual = date("Y-m-d");

        // Convertimos
        $timeFechaDev = strtotime($fechaDev);
        $timeFechaActual = strtotime($fechaActual);

        $segundos = $timeFechaActual - $timeFechaDev;
        $diferencia = $segundos / 86400; // Así obtenemos los días

        $multa = $diferencia*$this->recargo;

        if($diferencia>0){
            echo "<p> Has excedido la fecha de devolución: ".$fechaDev." en ".$diferencia." días. </p>";
            echo "<p> Para esta pelicula tienes un recargo de ".$this->recargo." por día </p>";
            echo "<p> Tienes un recargo de ".$multa." €.</p>";
        }else{
            echo "<p> No has excedido el tiempo de devolución</p>";
        }
    }
}
