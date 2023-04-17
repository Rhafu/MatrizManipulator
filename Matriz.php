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

    public function sumToThisMatriz(Matriz $matrizToAdd){
        if(
            $matrizToAdd->getLines() == $this->lines
             &&
            $matrizToAdd->getColumns() == $this->columns
         ){
            $numberOfLines = $this->getLines();
            $numberOfColumns = $this->getColumns();

            $recieverMatriz = $this->matriz;
            $delivererMatriz = $matrizToAdd->matriz;
            $myNewMatriz = array();

            for($lineIndex = 0; $lineIndex < $numberOfLines; $lineIndex++){
                for($columnIndex = 0; $columnIndex < $numberOfColumns; $columnIndex++){
                        $myNewMatriz[$lineIndex][$columnIndex] = $recieverMatriz[$lineIndex][$columnIndex] + $delivererMatriz[$lineIndex][$columnIndex];
                }        
            }

            $this->matriz = $myNewMatriz;
         }else{
            throw new InvalidArgumentException("Erro: a matriz que você deseja adicionar à sua não é correspondente em tamanho.");
        }
    }

    public static function sumTwoMatrizes(Matriz $matriz1, Matriz $matriz2){
        if(
           $matriz1->getLines() == $matriz2->getLines()
            &&
           $matriz1->getColumns() == $matriz2->getColumns()
        ){
            $numberOfLines = $matriz1->getLines();
            $numberOfColumns = $matriz2->getColumns();
            $matrizToSum1 = $matriz1->getArrayMatriz();
            $matrizToSum2 = $matriz2->getArrayMatriz();
            $newMatriz = array();

            for($lineIndex = 0; $lineIndex < $numberOfLines; $lineIndex++){
                for($columnIndex = 0; $columnIndex < $numberOfColumns; $columnIndex++){

                        $newMatriz[$lineIndex][$columnIndex] = $matrizToSum1[$lineIndex][$columnIndex] + $matrizToSum2[$lineIndex][$columnIndex];
                }        
            }

            return new Matriz($newMatriz);
        }else{
            throw new InvalidArgumentException("Erro: o número de linhas e colunas das matrizes precisam ser iguais");
        }
    }

    public function multiplyByAScalarAndSave(float $scalar){
        $modifiedMatriz = $this->matriz;

        for($lineIndex = 0; $lineIndex < $this->getLines(); $lineIndex++){
            for($columnIndex = 0; $columnIndex < $this->getColumns(); $columnIndex++){
                $modifiedMatriz[$lineIndex][$columnIndex] = $modifiedMatriz[$lineIndex][$columnIndex] * $scalar;
            }
        }
        
        $this->matriz = $modifiedMatriz;
    }

    
    public function multiplyByAScalarAndReturn(float $scalar){
        $modifiedMatriz = $this->matriz;

        for($lineIndex = 0; $lineIndex < $this->getLines(); $lineIndex++){
            for($columnIndex = 0; $columnIndex < $this->getColumns(); $columnIndex++){
                $modifiedMatriz[$lineIndex][$columnIndex] = $modifiedMatriz[$lineIndex][$columnIndex] * $scalar;
            }
        }

        return new Matriz($modifiedMatriz);
    }


    public function printMatriz(){
        for($i = 0; $i < $this->lines; $i++){
            echo "|";
            for($j = 0; $j < $this->columns; $j++){
                echo " ".$this->matriz[$i][$j]."";
            }
            echo " |". PHP_EOL;

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
   
    private function isValidSize(array $matriz){
        //Toda quantidade de items de uma matriz é divisível pela linha e pela coluna

        // Quantidade de elementos é a quantidade recursiva menos a contagem dos arrays. Contagem recursiva é a contagem que olha para os valores dentro do Array.
        $numberOfElements = count($matriz, COUNT_RECURSIVE) - count($matriz);

        if(
            //Contando as linhas e dividindo pela quantidade de elementos da matriz
            $numberOfElements % count($matriz) == 0 
            
            &&    
            //Contanto as colunas (são contadas com vista à primeira linha)
            $numberOfElements % count($matriz[0]) == 0
    
        ){
            return true;
        }

        return false;
            
    }

    private function hasNoEmptyLine(array $matriz){
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

    $matriz1->sumToThisMatriz($matriz2);

    $matriz1->printMatriz();

    $matriz1->multiplyByAScalarAndSave(2);

    $matriz1->printMatriz();

}catch(Exception $erro){
    echo $erro->getMessage();
}
