<?php
class Cuadrado{

    private $vertices;

    public function __construct()
    {
        $this->vertices = new ArrayObject(array());
    }

    public function __get($item)
    {
        //property_exists — Comprueba si el objeto o la clase tienen una propiedad
        if(property_exists($this, $item)) {
            return $this->$item;
        }
    }

    public function __set($item, $value)
    {
        if(property_exists($this, $item)) {
            $this->{$item} = $value;
        }
    }

    public function area($puntos)
    { 
          //info: list — Asignar variables como si fueran un array -> list ( mixed $var1 , mixed ...$... = ? ) : array
          list($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2) = $this->desarmarPuntos($puntos);
         //info: sqrt — Raíz cuadrada -> sqrt ( float $arg ) : float
         //info: pow — Expresión exponencial -> pow ( number $base , number $exp ) : number
         $D1= sqrt(pow(($A1-$B1), 2)+pow(($A2-$B2), 2));
         $D2= sqrt(pow(($B1-$C1), 2)+pow(($B2-$C2), 2));
         $D3= sqrt(pow(($C1-$D1), 2)+pow(($C2-$D2), 2));
         $D4= sqrt(pow(($D1-$A1), 2)+pow(($D2-$A2), 2));

         return  $D1 * $D2;
    }

    public function desarmarPuntos($puntos)
    {
        $A1=0;  $A2=NULL; $B1=NULL; $B2=NULL; $C1=NULL;$C2=NULL; $D1=NULL; $D2=NULL;

        foreach($puntos as $attribute => $value) {
        // echo '<p>' . $attribute . ' : ' . $value . '</p>' . PHP_EOL;
            for ($columna=0; $columna<count($value); $columna++){
              //echo     $attribute."   -- ".        $value[0]."\n";

                   if($attribute==="A"){
                      $A1=  $value[0];
                      $A2=  $value[1];
                   } 
                   if($attribute==="B"){
                    $B1=  $value[0];
                    $B2=  $value[1];
                 } 
               
                 if($attribute==="C"){
                    $C1=  $value[0];
                    $C2=  $value[1];
                 } 
               
                 if($attribute==="D"){
                    $D1=  $value[0];
                    $D2=  $value[1];
                 } 
              
           }
  
         }

         return array ($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2);
    }

    public function desplazar($d)
    {
        list($P1, $P2)= $d;
        list($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2) = $this->desarmarPuntos($this->vertices);

        $DA1= $A1+$P1;
        $DA2= $A2+$P2;
        $DB1= $B1+$P1;
        $DB2= $B2+$P2;
        $DC1= $C1+$P1;
        $DC2= $C2+$P2;
        $DD1= $D1+$P1;
        $DD2= $D2+$P2;

        return array ($DA1, $DA2,$DB1, $DB2,$DC1, $DC2,$DD1, $DD2);
    }

    public function aumentarTamaño($t)
    {
        list($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2) = $this->desarmarPuntos($this->vertices);

        $TA1= $A1+$t;
        $TA2= $A2+$t;
        $TB1= $B1+$t;
        $TB2= $B2+$t;
        $TC1= $C1+$t;
        $TC2= $C2+$t;
        $TD1= $D1+$t;
        $TD2= $D2+$t;

        return array ($TA1, $TA2,$TB1, $TB2,$TC1, $TC2,$TD1, $TD2);
    }

    public function __toString(){
       
        list($A1, $A2,$B1, $B2,$C1, $C2, $D1, $D2) = $this->desarmarPuntos($this->vertices);
        
        return  "\n puntos de la vertices de un cuadrado :\n -> ". "A ".$A1."-".$A2."\n -> B ".$B1."-".$B2."\n -> C ".$C1."-".$C2." \n -> D ".$D1."-".$D2."\n";
        
    }


}
?>