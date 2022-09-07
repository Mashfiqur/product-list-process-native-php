<?php

class UniqueProductCSVMaker
{
    public static function makeUniqueCSVFile(array $data, string $fileName)
    {
        if(!$fileName){
            return;
        }
        
        try {
            if (count($data)) {
                $fileOpen = fopen('output_files/' . $fileName, 'w');

                $headerRow = array_merge(array_keys(current($data)[0]), [
                    'count'
                ]);

                //Write Header Row into CSV file
                fputcsv($fileOpen, $headerRow);

                //Write Produt Row with count into CSV file
                foreach ($data as $products) {
                    if ($productCount = count($products)) {
                        $productRow = array_merge(array_values($products[0]), [
                            $productCount
                        ]);
                        fputcsv($fileOpen, $productRow);
                    }
                }

                fclose($fileOpen);

                return $fileName;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}