<?php

use Sdad\Trab\Excel;

require_once __DIR__ . "/vendor/autoload.php";

$mapper = [
    "Restrição de Atendimento",
    "Escola",
    "Código INEP",
    "UF",
    "Município",
    "Localização",
    "Localidade Diferenciada",
    "Categoria Administrativa",
    "Endereço",
    "Telefone",
    "Dependência Administrativa",
    "Categoria Escola Privada",
    "Conveniada Poder Público",
    "Regulamentação pelo Conselho de Educação",
    "Porte da Escola",
    "Etapas e Modalidade de Ensino Oferecidas",
    "Outras Ofertas Educacionais",
    "Latitude",
    "Longitude",
];

$regioes = [
    "AL" => "nordeste",
    "BA" => "nordeste",
    "CE" => "nordeste",
    "MA" => "nordeste",
    "PB" => "nordeste",
    "PE" => "nordeste",
    "PI" => "nordeste",
    "RN" => "nordeste",
    "SE" => "nordeste",
    "MG" => "sudeste",
    "ES" => "sudeste",
    "RJ" => "sudeste",
    "SP" => "sudeste",
    "PR" => "sul",
    "SC" => "sul",
    "RS" => "sul",
    "GO" => "centro-oeste",
    "MT" => "centro-oeste",
    "MS" => "centro-oeste",
    "DF" => "centro-oeste",
    "AC" => "norte",
    "AP" => "norte",
    "AM" => "norte",
    "PA" => "norte",
    "RO" => "norte",
    "RR" => "norte",
    "TO" => "norte"
];

$escolasPorEstado = [];
$escolasPorRegiao = [];

foreach(Excel::readCsv(__DIR__ . "/analise.csv") as $line) {
    if(!array_key_exists($line[3], $escolasPorEstado)) {
        $escolasPorEstado[$line[3]] = 0;
    } else {
        $escolasPorEstado[$line[3]]++;
    }
}

foreach($escolasPorEstado as $key => $totalEscolas) {
    if(!array_key_exists($regioes[$key], $escolasPorRegiao)) {
        $escolasPorRegiao[$regioes[$key]] = $totalEscolas;
    } else {
        $escolasPorRegiao[$regioes[$key]] += $totalEscolas;
    }
}

Excel::writeExcelOneLine("totalEscolasRegiao.csv", $escolasPorRegiao);
Excel::writeExcelOneLine("totalEscolasEstado.csv", $escolasPorEstado);
