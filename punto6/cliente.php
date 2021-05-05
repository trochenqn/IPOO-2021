<?php
class cliente{

    private $tipoDoc;
    private $dni;
    private $nombre;
    private $apellido;


    public function __contruct($miTipoDoc, $midni, $minombre, $miapellido)
    {
        $this->tipoDoc= $miTipoDoc;
        $this->dni=$midni;
        $this->nombre=$minombre;
        $this->apellido=$miapellido; 
    }
    
    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }
    public function setTipoDoc($miTipoDoc)
    {
     $this->tipoDoc = $miTipoDoc;
    }

    public function getdni()
    {
        return $this->dni ;
    }

    public function setdni($midni)
    {
        $this->dni  = $midni;
    }

    public function getnombre()
    {
        return $this->nombre;
    }

    public function setnombre($minombre)
    {
        $this->nombre = $minombre;
    }

public function getapellido()
{
    return $this->apellido;
}

public function setapellido($miapellido)
{
    $this->apellido= $miapellido;
}



public function __tostring()
{
    $cadena = "Tipo: ". $this->getTipoDoc()."\n";
    $cadena .= "Dni: ".$this->getdni()."\n";
    $cadena .= "Noombre: ".$this->getnombre()."\n";
    $cadena .= "Apellido: ".$this->getapellido()."\n";

    return $cadena;
}


}
