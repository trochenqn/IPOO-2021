<?php
class Reloj{
//VARIABLE
private $hora;
private $minutos;
private $segundos;
//constructor
public function __construct ($h="00", $m="00", $s="00")
{
    $this->hora = $h;
    $this->minutos = $m;
    $this->segundos = $s;
}
//GET Y SET
//hora
public function getHora()
{
    return $this->hora;
}
public function setHora($hora)
{
    $this->hora=$hora;
}
//minutos
public function getMinutos()
{
    return $this->minutos;
}
public function setMinutos($minutos)
{
    $this->minutos=$minutos;
}
//segundos
public function getSegundo()
{
    return $this->segundos;
}
public function seSegundos($segundos)
{
    $this->segundos=$segundos;
}

//METODOS
public function leerHora($h, $m, $s)
{
    $this->hora=$h;
    $this->minutos=$m;
    $this->segundos=$s;

    $this->validar();
}

public function validar()
{
    if ($this->hora <0 || $this->hora >23){
        $horaOK =false;
    }else{
        $horaOK= true;
    }

    if ($this->minutos <0 || $this->minutos >59){
        $minutosOK =false;
    }else{
        $minutosOK= true;
    }

    if ($this->segundos <0 || $this->segundos >59){
        $segundosOK =false;
    }else{
        $segundosOK= true;
    }

    if (!$horaOK || !$minutosOK || !$segundosOK){
        $this->hora="00";
        $this->minutos ="00";
        $this->segundos="00";
    }

}

public function restaSegundos() {
    $hora1 = mktime('23','59','59');
    $hora2 = mktime($this->hora, $this->minutos, $this->segundos);
    $segundos = $hora1 - $hora2 ;
    return $segundos;
     
}
public function horarioFinazalicion($segundos) {
    $nuevaHora = strtotime('-'.$segundos.' seconds', strtotime('00-00-00') );
    $nuevaHora = date('H:i:s', $nuevaHora);
    
    echo 'Reloj:  '.$nuevaHora."\n";
    
}

public function incrementar($segundos)
{
    $dato=0;
    //$segundos --;
     while($segundos>00){
      $dato= $segundos --;
        sleep(1);
         
       $this->horarioFinazalicion($dato);
    }
  echo "incremento debera pasar a 00:00:00 \n";
     
 
}

public function puesta_a_cero()
{
    $this->hora="00";
    $this->minutos ="00";
    $this->segundos="00";
}


public function __toString()
{
    return 'Hora ingresada: '.$this->getHora().':'.$this->getMinutos().':'.$this->getSegundo()."\n"; 
}

public function __destruct()
{
    echo $this . " instancia destruida, no hay referencias a este objeto \n";
}

}

?>