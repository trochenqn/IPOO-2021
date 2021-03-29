<?php
class Linea{
//variables
private $pA;
private $pB;
private $pC;
private $pD;

public function __construct($pA, $pB, $pC, $pD)
{
    $this->pA=$pA;
    $this->pB=$pB;
    $this->pC=$pC;
    $this->pD=$pD;
}
//Get y Set
public function getPA()
{
   return $this->pA;
}

public function setPA($pA)
{
    $this->pA=$pA;
}
public function getPB()
{
   return $this->pB;
}

public function setPB($pB)
{
    $this->pB=$pB;
}
public function getPC()
{
   return $this->pC;
}

public function setPC($pC)
{
    $this->pC=$pC;
}
public function getPD()
{
   return $this->pD;
}

public function setPD($pD)
{
    $this->pD=$pD;
}


public function mueveDerecha($d)
{
    $nuevoPa=$this->getPA() +$d;
    $nuevoPc=$this->getPC() +$d;
    $nuevoPb= $this->getPB();
    $nuevoPd=$this->getPD();
    
    return array ($nuevoPa, $nuevoPb, $nuevoPc ,$nuevoPd);
}

public function mueveIzquierda($d)
{
    $nuevoPa=$this->getPA()-$d;
    $nuevoPc=$this->getPC()-$d;
    $nuevoPb= $this->getPB();
    $nuevoPd=$this->getPD();
    
    return array ($nuevoPa, $nuevoPb, $nuevoPc ,$nuevoPd);
}

public function mueveArriba($d)
{
    $nuevoPa=$this->getPA();
    $nuevoPc=$this->getPC();
    $nuevoPb= $this->getPB()+$d;
    $nuevoPd=$this->getPD()+$d;
    
    return array ($nuevoPa, $nuevoPb, $nuevoPc ,$nuevoPd);
}

public function mueveAbajo($d)
{
    $nuevoPa=$this->getPA();
    $nuevoPc=$this->getPC();
    $nuevoPb= $this->getPB()-$d;
    $nuevoPd=$this->getPD()-$d;
    
    return array ($nuevoPa, $nuevoPb, $nuevoPc ,$nuevoPd);
}

public function __toString()
{
    return 'Puntos ingresados:  X1->'.$this->getPA().' X2->'.$this->getPB().' Y1->'.$this->getPC() .' Y2->'.$this->getPD()."\n"; 
}

}

?>