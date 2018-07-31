<?php

header('Content-Type: text/html; charset=utf8');

$ano = (int) ((isset($_GET['ano']))? $_GET['ano']: date('Y'));

function diaSamanaPorDiaAno($dia, $mes, $ano){
    $d = $dia;
    $m = (($mes <= 2)? $mes + 12: $mes);
    $a = (($mes <= 2)? $ano -  1: $ano);

    $k = (($d + (2 * $m) + floor((3 * ($m + 1)) / 5) + ($a + floor($a / 4) - floor($a / 100) + floor($a / 400) + 2)) % 7);

    $sem = [6, 0, 1, 2, 3, 4, 5];
    return $sem[$k];
}

function primeiroDiaDoAno($ano){
    return diaSamanaPorDiaAno(1, 1, $ano);
}

function anoBissexto($ano){
    return (($ano % 400 == 0) || (($ano % 4 == 0) && ($ano % 100 != 0)));
}

function templateMes($titulo, $dias, &$iDia){

    $r[] = '╔════════════════════╗ ';
    $r[] = '║' . str_pad($titulo, 20, ' ', STR_PAD_BOTH) . '║ ';
    $r[] = '╠════════════════════╣ ';
    $r[] = '║ D  S  T  Q  Q  S  S║ ';
    $r[] = '╠════════════════════╣ ';
    $r = array_merge($r, templateMesLinha($dias, $iDia));
    $r[] = '╚════════════════════╝ ';

    return $r;
}

function templateMesLinha($max, &$iDia){
    $tMes = [
        [  1,  2,  3,  4,  5,  6,  7],
        [  8,  9, 10, 11, 12, 13, 14],
        [ 15, 16, 17, 18, 19, 20, 21],
        [ 22, 23, 24, 25, 26, 27, 28],
        [ 29, 30, 31, 32, 33, 34, 35],
        [ 36, 37, 38, 39, 40, 41, 42],
    ];

    $r = [];
    $init = $iDia;
    $lDias = [];

    foreach($tMes as $ws => $dIds) foreach($dIds as $ks => $dId){
        $q = ($dId - $init);
        if($q > 0 && $q <= $max){
            $lDias[$ws][$ks] = $q;
            $iDia = (($ks + 1 == 7)? 0: $ks + 1);
        }else{
            $lDias[$ws][$ks] = '';
        }
    }

    foreach($lDias as $ws => $dIds){
        $l = [];
        foreach($dIds as $ks => $dId){
            $l[] = str_pad($dId, 2, ' ', STR_PAD_LEFT);
        }
        $r[] = '║' . implode(' ', $l) . '║ ';
    }

    return $r;
}



$meses = [
    'Janeiro'   => 31,
    'Fevereiro' => 28 + anoBissexto($ano),
    'Marco'     => 31,
    'Abril'     => 30,
    'Maio'      => 31,
    'Junho'     => 30,
    'Julho'     => 31,
    'Agosto'    => 31,
    'Setembro'  => 30,
    'Outubro'   => 31,
    'Novembro'  => 30,
    'Dezembro'  => 31,
];

$id = 0;
$cl = 4;
$out = [];
$iDia = primeiroDiaDoAno($ano);

$out[-1] = str_pad($ano, ($cl * 23), ' ', STR_PAD_BOTH);
foreach($meses as $titulo => $dias){
    foreach(templateMes($titulo, $dias, $iDia) as $k => $l){
        $out[$k = ($k + (floor($id / $cl) * 12))] = ((isset($out[$k]))? $out[$k]: '') . $l;
    }$id++;
}

echo '<pre>' . implode("\n", $out) . '</pre>';