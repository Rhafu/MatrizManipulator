<?php


class Matriz{

    //Propriedades
    private array $matriz;
    private int $lines;
    private int $columns;

    public function __construct(array $matriz)
    {
        if(
            $this->isValidSize($matriz)
        ){
            if($this->hasNoEmptyLine($matriz))
            {    
                $this->matriz = $matriz;
                $this->columns = count($matriz[0]);
                $this->lines = count($matriz);
            }else{
                throw new Exception("Erro: matriz possui linhas em branco");
            }
       }else{
            throw new Exception("Erro: matriz é inválida");
       }
    }

    public function printMatriz(){
        for($i = 0; $i < $this->lines; $i++){
            echo "|";
            for($j = 0; $j < $this->columns; $j++){
                echo " ".$this->matriz[$i][$j]."";
            }
            echo " |</br>";

        }
    }

    public static function sumMatrizes(Matriz $matriz1, Matriz $matriz2){
        if(
           $matriz1->getLines() == $matriz2->getLines()
            &&
           $matriz1->getColumns() == $matriz2->getColumns()
        ){
            $arrayMatriz1 = $matriz1->getArrayMatriz();
            $arrayMatriz2 = $matriz2->getArrayMatriz();
            $newMatriz = array();

            for($i = 0; $i < $matriz1->getLines(); $i++){
                for($j = 0; $j < $matriz1->getColumns(); $j++){
                        $newMatriz[$i][$j] = $arrayMatriz1[$i][$j] + $arrayMatriz2[$i][$j];
                }        
            }

            return new Matriz($newMatriz);
        }else{
            throw new InvalidArgumentException("Erro: o número de linhas e colunas das matrizes precisam ser iguais");
        }
    }

    private function getLines(){
        return $this->lines;
    }

    private function getColumns(){
        return $this->columns;
    }

    private function getArrayMatriz(){
        return $this->matriz;
    }
    // private function checkSumPossibility(Matriz $matriz1, Matriz $matriz2){
    

    
    private function isValidSize($matriz){
        //Toda quantidade de items de uma matriz é divisível pela linha e pela coluna

        // quantidade de elementos é a quantidade recursiva menos a contagem dos arrays
        $qtdElements = count($matriz, COUNT_RECURSIVE) - count($matriz);

        if(
            //Contando as linhas e dividindo pela quantidade de elementos da matriz
            $qtdElements % count($matriz) == 0 
            
            &&    
            //Contanto as colunas (são contadas com vista à primeira linha)
            $qtdElements % count($matriz[0]) == 0
    
        ){
            return true;
        }

        return false;
            
    }

    private function hasNoEmptyLine($matriz){
        //Verificando arrays
        foreach($matriz as $line){
            if(!sizeof($line)){
                return false;
            }
        }

        return true;
    }
}

// Testando classe
try{
    $matriz1 = new Matriz(array(array(1, 2, 3), array(4, 5, 6)));
    $matriz2 = new Matriz(array(array(1, 2, 3), array(4, 5, 6)));

    $matriz3 = Matriz::sumMatrizes($matriz1, $matriz2);
    $matriz3->printMatriz();
}catch(Exception $erro){
    echo $erro->getMessage();
}
