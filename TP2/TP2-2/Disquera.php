<?php
class Disquera{

    //variables
    private $hora_desde;
    private $hora_hasta;
    private $estado;
    private $direccion;
    private $duenio;

    //CONSTRUCTOR --
    public function __construct($hd, $hh, $e, $d, $du)
    {
        $this->hora_desde= $hd;
        $this->hora_hasta=$hh;
        $this->estado=$e;
        $this->direccion=$d;
        $this->duenio=$du;
    }

    //GET
    public function getHoraDesde()
    {
        return $this->hora_desde;
    }
    public function getHoraHasta()
    {
        return $this->hora_hasta;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getDuenio()
    {
        return $this->duenio;
    }
    //SET
    public function setHoraDesde($hDesde)
    {
        $this->hora_desde= $hDesde;
    }
    public function setHoraHasta($hHasta)
    {
        $this->hora_hasta= $hHasta;
    }
    public function setEstado($estado)
    {
        $this->estado= $estado;
    }
    public function setDireccion($direccion)
    {
        $this->direccion=$direccion;
    }
    public function setDuenio($due)
    {
       $this->duenio=$due;
    }


    //METODOS ------------------
    /**
     * dada una hs y min retorna true si la tienda debe encontrarse abierta 
     * en ese horario y false en caso contrario.
     * @return boolean
     */ 
    public function dentroHorarioAtencion($hora, $minutos)
    {
        $abiertoDisquera= false;

        $arrayD = $this->getHoraDesde();
        $hsDesde = $arrayD["hs"];
        $minDesde= $arrayD["min"];

        $arrayH = $this->getHoraHasta();
        $hshasta=$arrayH["hs"];
        $minhasta= $arrayH["min"];

       

        if($hsDesde < $hora || ($hsDesde == $hora && $minDesde <=$minutos)){
            if ($hshasta > $hora || ($hshasta ==$hora && $minhasta>=$minutos)){
                $abiertoDisquera= true;
            }
        }
        return  $abiertoDisquera;
    }
    /**
     * que dada una hs y min corrobora que se encuentra dentro dentro del horario
     * de atencion y cambia el estado de la disquera solo si es un horario valido para la apertura
     */
    public function abrirDisquera($hora, $minutos)
    {
        if($this->dentroHorarioAtencion($hora, $minutos)){
            $this->setEstado(true);
            $respuesta=  "La disquera se encuentra abierta \n";
        }else{
            $respuesta=  "La disquera no se encuentra abierta \n";
        }
        return $respuesta;
    }
    /**
     * que dada una hs y min corrobora que se encuetra fuera del horario de atencion 
     * y cambia el estado de la disquetera solo si es un horario valido.
     */
    public function cerrarDisquetera($hora, $minutos)
    {
        if(!($this->dentroHorarioAtencion($hora, $minutos))){
            $this->setEstado(false);
            $respuesta=  "La disquera se encuentra cerrada \n";
        }else{
            $respuesta=  "La disquera todavia no cierra \n";
        }
        return $respuesta;
    }

    public function __toString()
    {
        $arrayD = $this->getHoraDesde();
        $hsDesde = $arrayD["hs"];
        $minDesde= $arrayD["min"];

        $arrayH = $this->getHoraHasta();
        $hshasta=$arrayH["hs"];
        $minhasta= $arrayH["min"];


        $horaApertura = $hsDesde.":".$minDesde;
        $horaCierre = $hshasta.":". $minhasta;

        $cadena= "La disquera el dueño es ->".$this->getDuenio()."\n se encuentra abierto desde ".$horaApertura." hasta ".$horaCierre."\nEstado";
        $cadena= $this->getEstado() ? $cadena ." Abierto":$cadena." Cerrado";
        $cadena= $cadena ."\direccion: ".$this->getDireccion()."\n";

        return $cadena;
        
    }








}
?>