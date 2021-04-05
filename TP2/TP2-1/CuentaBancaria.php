<?php
class CuentaBancaria{

    //variables
private $numeroDeCuenta;
private $clienteDNI;
private $saldoActual;
private $interesAnual;


public function __construct($NC, $CD=null, $SA, $IA)
{
    $this->numeroDeCuenta = $NC;
    $this->clienteDNI = $CD;
    $this->saldoActual = $SA;
    $this->interesAnual = $IA;
}

// Observadoras
public function getSaldoActual()
{
    return $this->saldoActual;
}

public function setSaldoActual($saldoActual)
{
    $this->saldoActual= $saldoActual;
}

public function getInteresAnual()
{
    return $this->interesAnual;
}

public function getNumeroDeCuenta()
{
    return $this->numeroDeCuenta;
}

public function getClienteDni()
{
    return $this->clienteDNI;
}
public function setClienteDni($cliente)
{
   $this->clienteDNI = $cliente;
}

//Metodos
public function actualizarSaldo()
{
    $interesDiario = $this->getInteresAnual()/365;
    $sumaInteresDiario = $this->getSaldoActual() * $interesDiario;
    $this->setSaldoActual($this->getSaldoActual()+$sumaInteresDiario);

    return "La cuenta se actualizo con exito, SALDO: $".$this->getSaldoActual()." \n";

}

public function depositar($cant)
{
   $this->setSaldoActual($this->getSaldoActual()+$cant);

   return "Se deposito la suma de -> $".$cant.", SALDO: $".$this->getSaldoActual();
}

public function retirar($cant)
{
    if ($this->getSaldoActual()<=0){
        return "La cuenta bancaria Nro  ".$this->getNumeroDeCuenta() . ", del titular DNI Nro ->".$this->getClienteDni(). " no posee Fondos \n";
    }else{
        if ($this->getSaldoActual()<$cant){
            return "La cuenta bancaria Nro  ".$this->getNumeroDeCuenta() . " solo puede retirar -> Pesos: ".$this->getSaldoActual(). " \n"; 
        }else{
            $this->setSaldoActual($this->getSaldoActual()-$cant);
            return "A cuenta bancaria Nro  ".$this->getNumeroDeCuenta() . " se efectuo el retiro de -> Pesos: ". $cant . " \n".
                    "Posee un SALDO de: ".$this->getSaldoActual();
        }
    }
}

public function __toString()
{
    return "* Nro de cuenta-> ".$this->getNumeroDeCuenta()." \n".
    "* Cliente de la cuenta -> ".$this->getClienteDni()." \n".
     "* Saldo de la cuenta ->".$this->getSaldoActual()."\n";
}


}




?>
