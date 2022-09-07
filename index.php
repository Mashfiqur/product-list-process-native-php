<?php  

    require "TextFileParser.php";
    require "UniqueProductCSVMaker.php";



    $short_options = "";
    $long_options = ["file:", "unique-combinations:"];
    $options = getopt($short_options, $long_options);

    if(isset($options['file']) && isset($options['unique-combinations'])){
        $fileExtension = pathinfo($options['file'], PATHINFO_EXTENSION);

        switch ($fileExtension) {
            case 'csv':
                $products = (new ParseTextFile)->parse($options['file'], ",");
                break;
            case 'tsv':
                $products = (new ParseTextFile)->parse($options['file'], "\t");
                break;
            default:
                $products = null;
        }

        if(count($products)){
            $fileName = (new UniqueProductCSVMaker)->makeUniqueCSVFile($products, $options['unique-combinations']);
            
            print_r("Please check the output_files folder with your given name" . PHP_EOL);
        }
    }

?>  