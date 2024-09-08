<?php

namespace Sdad\Trab;

class Excel
{
    public static function readCsv(string $csvName)
    {
        $file = fopen($csvName, "r");
        $header = true;
        if($file !== false) {
            while(($line = fgetcsv($file)) !== false) {
                if($header) {
                    $header = false;
                    continue;
                }
                $lineGenerator = $line;
                yield $lineGenerator;
            }
        }
        fclose($file);
    }

    public static function writeExcelOneLine($csv, $data)
    {
        $csv = fopen($csv, "w");
        fputcsv($csv, array_keys($data));
        fputcsv($csv, $data);
        fclose($csv);
    }
}