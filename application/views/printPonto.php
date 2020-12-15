<h4>Registros do CPF: <?= $cpf; ?></h4>

<div class="usuarios">
    <table id="custom">
        <head>
            <tr id="titulo">
                <td>DATA</td>
                <td>DIA DA SEMANA</td>
                <td>MARCAÇÃO 1</td>
                <td>MARCAÇÃO 2</td>
                <td>MARCAÇÃO 3</td>
                <td>MARCAÇÃO 4</td>
                <td>DÉBITO</td>
                <td>HE NORMAL</td>
                <td>SALDO</td>
            </tr>
        </head>
        <body>
            <?php
            $count = 0;
            $acumulo = 0;
            $somaHE = 0;
            $acumulaHora = 0;
            $acumulaMinuto = 0;
                foreach($registros as $registro){
                    if($registro->marcacao1 != NULL){
                        $count += 1;
                    }
                    if($registro->marcacao2 != NULL){
                        $count += 1;
                    }
                    if($registro->marcacao3 != NULL){
                        $count += 1;
                    }
                    if($registro->marcacao4 != NULL){
                        $count += 1;
                    }
                    ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($registro->data)); ?></td>
                            <td>
                                <?php
                                    $dia = date('D', strtotime($registro->data));
                                    switch($dia){
                                        case 'Sun':
                                            echo "DOM";
                                            break;
                                        case 'Mon':
                                            echo "SEG";
                                            break;
                                        case 'Tue':
                                            echo "TER";
                                            break;
                                        case 'Wed':
                                            echo "QUA";
                                            break;
                                        case 'Thu':
                                            echo "QUI";
                                            break;
                                        case 'Fri':
                                            echo "SEX";
                                            break;
                                        case 'Sat':
                                            echo "SAB";
                                            break;
                                    }
                                ?>
                            </td>
                            <td><?= $registro->marcacao1; ?></td>
                            <td><?= $registro->marcacao2; ?></td>
                            <td><?= $registro->marcacao3; ?></td>
                            <td><?= $registro->marcacao4; ?></td>
                            <td>
                                <?php
                                    $debito = '';
                                    $atraso = '';
                                    $horaExtra = '';
                                    $qtdHE = '';
                                    $horaDia = new DateTime('08:00');
                                    $horaSabado = new DateTime('04:00');
                                    $horaEntrada = new DateTime('08:00');
                                    $retornoAlmoco = new DateTime('14:00');
                                    $marcacao1 = new DateTime($registro->marcacao1);
                                    $marcacao2 = new DateTime($registro->marcacao2);
                                    $marcacao3 = new DateTime($registro->marcacao3);
                                    $marcacao4 = new DateTime($registro->marcacao4);
                                    if($dia != "Sat"){
                                        //Verifica se existem registros em m4, m3 e m2, caso não existam, debita 1 dia.
                                        if($registro->marcacao4 == NULL && $registro->marcacao3 == NULL && $registro->marcacao2 == NULL){
                                            $debito = $horaDia->diff($marcacao1)->format('%H:%I');
                                            if($debito == "00:00"){
                                                $debito = "08:00";
                                            }
                                        //verifica se existem registros em m4 e m3, caso não existam, debita 1/2 dia.
                                        }else if($registro->marcacao4 == NULL && $registro->marcacao3 == NULL){
                                            $horaManha = new DateTime($marcacao2->diff($marcacao1)->format('%H:%I'));
                                            $debito = $horaDia->diff($horaManha)->format('%H:%I');
                                        //Verifica se o registro em m1 e m3 é maior que a hora de entrada (08:00), caso seja, debita a diferença.
                                        }
                                        if($registro->marcacao1 > "08:00" && $registro->marcacao3 > "14:00" && $registro->marcacao4 != NULL){
                                            $atraso1 = strtotime($marcacao1->diff($horaEntrada)->format('%H:%I'));
                                            $atraso2 = strtotime($marcacao3->diff($retornoAlmoco)->format('%H:%I'));
                                            $hora = date("H",$atraso2);
                                            $minutos = date("i", $atraso2);
                                            $segundos = date("s", $atraso2);
                                            $aux = strtotime("+$minutos minutes", $atraso1);
                                            $aux = strtotime("+$segundos seconds", $aux);
                                            $aux = strtotime("+$hora hours", $aux);
                                            $tempo = date("H:i", $aux);
                                            $debito = $tempo;
                                        }
                                    }
                                    if($dia == 'Sat'){
                                        if($registro->marcacao1 > "08:00" && $registro->marcacao2 < "12:00"){
                                            $diff = new DateTime($marcacao2->diff($marcacao1)->format("%H:%I"));
                                            $debito = $horaSabado->diff($diff)->format('%H:%I');
                                        }
                                    }
                                    echo $debito;
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($dia == "Sat"){
                                        if($registro->marcacao2 > "12:00"){
                                            $tempoSabado = $marcacao2->diff($marcacao1)->format('%H:%I');
                                            $tempoDia = new DateTime($tempoSabado);
                                            $horaExtra = $horaSabado->diff($tempoDia)->format("%H:%I");
                                            echo $horaExtra;
                                        }
                                    }else{
                                        if($registro->marcacao2 > "12:00"){
                                            $tempoSemana = $marcacao2->diff($marcacao1)->format('%H:%I');
                                            $tempoDia = new DateTime($tempoSemana);
                                            $horaExtra = $horaSabado->diff($tempoDia)->format("%H:%I");
                                            echo $horaExtra;
                                        }
                                        if($registro->marcacao4 > "18:00"){
                                            $tempoSemana = $marcacao4->diff($marcacao3)->format('%H:%I');
                                            $tempoDia = new DateTime($tempoSemana);
                                            $horaExtra = $horaSabado->diff($tempoDia)->format("%H:%I");
                                            echo $horaExtra;
                                        }
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    if($debito != '' ){
                                        echo "-$debito";
                                    }else if($horaExtra != ''){
                                        echo $horaExtra;
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php
                    $aux = explode(':', $horaExtra);
                    if($aux[0] != '00'){
                        $acumulaHora += intval($aux[0]);
                    }
                    if($aux[1] != '00'){
                        $acumulaMinuto += intval($aux[1]);
                    }
                    
                    echo $acumulaHora. " ".$acumulaMinuto;

                    //Cálculo da quantidade de horas trabalhadas no período.
                    if($debito == ''){
                        if($dia == 'Sat'){
                            $acumulo += 4;
                        }else{
                            $acumulo += 8;
                        }
                    }
                }
            ?>
        </body>
    </table>
    <hr>
    Total de Horas Trabalhadas: <?php echo $acumulo; ?><br>
    Total de Horas Extras: <br>
    Pontos Batidos: <?php echo $count; ?>
</div>