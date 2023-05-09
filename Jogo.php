<?php 
//⬛
$Board = array_fill(0, 9, ' ');

// FUNÇÃO QUE FAZ EXIBIR O TABULEIRO
function ExibirTabuleiro($Board){
    $tamanho = 3;
    $PosBoard = 0;

    for ($i = 0; $i < $tamanho; $i++) {

        for ($j = 0; $j < $tamanho; $j++) {
            if ($j == 0) {
                echo " ";
            } else {
                echo "|";
            }
            echo $Board[$PosBoard];
            $PosBoard += 1;
        }
        echo "\n";
    }
}

// FUNÇÃO QUE ALTERA O TABULEIRO 
function AlteraTabuleiro($Board, $Jogada, $Jogador){
    $Board[$Jogada - 1] = $Jogador;
    return $Board;
}

// VALIDAÇÃO DE VENCEDOR
function Vencedor ($Board, $Jogada){
    //$Board = $Board[$Jogada -1];
    $Winner = false;

    if (
        ($Board[0] === 'X' && $Board[1] === 'X' && $Board[2] === 'X') ||
        ($Board[3] === 'X' && $Board[4] === 'X' && $Board[5] === 'X') ||
        ($Board[6] === 'X' && $Board[7] === 'X' && $Board[8] === 'X') ||
        ($Board[0] === 'X' && $Board[3] === 'X' && $Board[6] === 'X') ||
        ($Board[1] === 'X' && $Board[4] === 'X' && $Board[7] === 'X') ||
        ($Board[2] === 'X' && $Board[5] === 'X' && $Board[8] === 'X') ||
        ($Board[0] === 'X' && $Board[4] === 'X' && $Board[8] === 'X') ||
        ($Board[2] === 'X' && $Board[4] === 'X' && $Board[6] === 'X')
    ) {
        $Winner = 'X';
    }

    if (
        ($Board[0] === 'O' && $Board[1] === 'O' && $Board[2] === 'O') ||
        ($Board[3] === 'O' && $Board[4] === 'O' && $Board[5] === 'O') ||
        ($Board[6] === 'O' && $Board[7] === 'O' && $Board[8] === 'O') ||
        ($Board[0] === 'O' && $Board[3] === 'O' && $Board[6] === 'O') ||
        ($Board[1] === 'O' && $Board[4] === 'O' && $Board[7] === 'O') ||
        ($Board[2] === 'O' && $Board[5] === 'O' && $Board[8] === 'O') ||
        ($Board[0] === 'O' && $Board[4] === 'O' && $Board[8] === 'O') ||
        ($Board[2] === 'O' && $Board[4] === 'O' && $Board[6] === 'O')
    ) {
        $Winner = 'O';
    }   

    return $Winner;
}



// FUNÇÃO QUE VALIDA A JOGADA NA QUESTÃO DE SE JÁ FOI JOGADO NAQUELA POSIÇÃO
function ValidaJogada($Board, $Jogada, $Jogador){

    $Jogada-= 1;
    if ($Board[$Jogada] == ' ') {
        return true;

    }else{
        if ($Jogador == 'X'){
            echo "Jogada INválida... \n";
        }
        return false;
    }
}

// FUNÇÃO QUE REALIZA A JOGADA SOMENTE SE ELA FOR VÁLIDA

/// O PRINCIPAL --------------------------
function main (){

    $Board = array_fill(0, 9, ' ');
    $Winner = false;
    $Rodada = 0;
    
    $a = rand(1, 2);
    if ($a == 1){
        $temp = false;
    }else{
        $temp = true;
    }
    
    while ($Winner == false AND $Rodada <9){

        if ($temp == true){
            $Jogador = 'X';
        }else{
            $Jogador = 'O';
        }
    
        do {
            if ($Jogador == 'X'){
                $Jogada = readline('Faça sua Jogada: ');
            }else{
                echo "O Computador irá fazer sua jogada! \n";
                $Jogada = rand (0,8);
            }            
        }while (ValidaJogada($Board, $Jogada, $Jogador) == false);


        $Board = AlteraTabuleiro($Board, $Jogada, $Jogador);

        if (Vencedor($Board, $Jogada) == 'X') {
            echo "O Jogador X Venceu a partida! \n";
            echo"\n";
            $Winner = true;
            
        }elseif(Vencedor($Board, $Jogada) == 'O'){
            echo "O Jogador O (VULGO BOT) Venceu a partida! \n";
            echo"\n";
            $Winner = true;
        }

        ExibirTabuleiro($Board);
        echo"\n";

        $Rodada ++;
        $temp = !$temp;
    }

    Revanche(readline("Que tal uma revanche?"));
}

function Revanche ($resp){
    if ($resp == 1){
        echo "OK Vamos recomeçar então!: \n";
        main();
    }
}

main();

