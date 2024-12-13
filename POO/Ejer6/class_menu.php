<?php
class Menu
{
    private $arrItem = array();

    // Metodo
    public function cargar($url, $nombre)
    {
        $this->arrItem[$nombre] = $url;
    }

    public function vertical()
    {

        echo "<p>";
        foreach ($this->arrItem as $nombre => $url) {
            echo "<a href='" . $url . "'>" . $nombre . "</a></br>";
        }
        echo "</p>";
    }

    public function horizontal()
    {

        $imprimir="";
        foreach ($this->arrItem as $nombre => $url) {
            $imprimir.= "<a href='" . $url . "'>" . $nombre . "</a> - ";
        }
        echo "<p>".substr($imprimir,0,-2)."</p>";
    }
}
