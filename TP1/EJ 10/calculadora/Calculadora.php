<?php
class Calculadora{
//VARIABLE
private $numero1;
private $numero2;

public function __construct($numero1, $numero2)
{
    $this->numero1 = $numero1;
    $this->numero2 = $numero2;
}
//GET Y SET
public function getNumero1(){
    return $this->numero1;
}
public function setNumero1($numero1){
$this->numero1=$numero1;
}
public function getNumero2(){
    return $this->numero2;
}
public function setNumero2($numero2){
$this->numero2=$numero2;
}

//METODOS
/**
*Devuelve la suma entre dos parametro
* @param unknown $valorSumado
* @return number
*/
public function suma(){
  $valorSumado = $this->getNumero1() + $this->getNumero2();
  return $valorSumado;

}

/**
*Devuelve la resta entre dos parametro
* @param unknown $valorResta
* @return number
*/
public function restar(){
    $valorResta  = $this->getNumero1() - $this->getNumero2();
  return $valorResta;
}

/**
*Devuelve la division entre dos parametro 
* @param unknown $valorDivision
* @return number
*/
public function dividir(){

    if ($this->getNumero2() == 0) {
        return 'No se puede dividir entre cero';
    } else {
    $valorDivision  = $this->getNumero1() / $this->getNumero2();
    return $valorDivision;
    }
}

/**
*Devuelve la multiplicacion entre dos parametro 
* @param unknown $valorMultiplicacion
* @return number
*/
public function multiplicar(){
    $valorMultiplicacion  = $this->getNumero1() * $this->getNumero2();
    return $valorMultiplicacion;
}



public function __toString(){
    return "(".$this->getNumero1().",".$this->getNumero2().") \n";
}

public function __destruct()
{
    echo $this . " instancia destruida, no hay referencias a este objeto \n";
}

}

?>