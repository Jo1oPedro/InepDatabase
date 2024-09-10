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

$totalEscolas = 0;
$escolasPorEstado = [];
$escolasPorRegiao = [];
$escolasLocalizacao = [];
$totalEscolasPublicasPrivadas = [];
$proporcaoModalidadeEscolas = [];
$proporcaoPorteEscolasEmMg = [];

foreach(Excel::readCsv(__DIR__ . "/analise.csv") as $line) {
    $totalEscolas++;
    if(!array_key_exists($line[3], $escolasPorEstado)) {
        $escolasPorEstado[$line[3]] = 1;
    } else {
        $escolasPorEstado[$line[3]]++;
    }
    if(!array_key_exists($line[5], $escolasLocalizacao)) {
        $escolasLocalizacao[$line[5]] = 1;
    } else {
        $escolasLocalizacao[$line[5]]++;
    }
    if(!array_key_exists($line[7], $totalEscolasPublicasPrivadas)) {
        $totalEscolasPublicasPrivadas[$line[7]] = 1;
    } else {
        $totalEscolasPublicasPrivadas[$line[7]]++;
    }
    if(!array_key_exists($line[15], $proporcaoModalidadeEscolas)) {
        $proporcaoModalidadeEscolas[$line[15]] = 1;
    } else {
        $proporcaoModalidadeEscolas[$line[15]]++;
    }
    if($line[3] === "MG") {
        if(!array_key_exists($line[14], $proporcaoPorteEscolasEmMg)) {
            $proporcaoPorteEscolasEmMg[$line[14]] = 1;
        } else {
            $proporcaoPorteEscolasEmMg[$line[14]]++;
        }
    }
}

foreach($escolasPorEstado as $key => $totalEscolasEstado) {
    if(!array_key_exists($regioes[$key], $escolasPorRegiao)) {
        $escolasPorRegiao[$regioes[$key]] = $totalEscolasEstado;
    } else {
        $escolasPorRegiao[$regioes[$key]] += $totalEscolasEstado;
    }
}

$proporcaoEscolas = [];
foreach($proporcaoModalidadeEscolas as $key => $modalidade) {
    $proporcaoEscolas[$key] = number_format(($modalidade / $totalEscolas) * 100, 2);
}

Excel::writeExcelOneLine("totalEscolasRegiao.csv", $escolasPorRegiao);
Excel::writeExcelOneLine("totalEscolasEstado.csv", $escolasPorEstado);
Excel::writeExcelOneLine("totalEscolasLocalizao.csv", $escolasLocalizacao);
Excel::writeExcelOneLine("totalEscolasPublicasPrivadas.csv", $totalEscolasPublicasPrivadas);
Excel::writeExcelOneLine("totalProporcaoModalidadeEscolas.csv", $proporcaoModalidadeEscolas);
Excel::writeExcelOneLine("totalProporcaoPorteEscolasMg.csv", $proporcaoPorteEscolasEmMg);