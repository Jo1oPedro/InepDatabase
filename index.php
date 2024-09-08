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
    "nordeste" => [],
    "sudeste" => [],
    "sul" => [],
    "centro-oeste" => [],
    "norte" => [],
];

$csv = fopen("escolas-por-estado.csv", "w");
Excel::writeExcel($csv, ['oi mundo', 'dale']);
//foreach(Excel::readCsv(__DIR__ . "/analise.csv") as $line) {

//}