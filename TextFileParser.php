<?php

class ParseTextFile
{
    /**
	 * Header Row
	 *
	 * @var array
	 */
    protected $headerRow = [];

    /**
	 * Array of product
	 *
	 * @var array
	 */
    protected $products;

    /**
	 * Array of unique grouped product
	 *
	 * @var array
	 */
    protected $uniqueProducts;

    /**
	 * Is the row header
	 *
	 * @var array
	 */
    protected $isHeaderRow = true;

    public function __construct()
    {
        $this->products       = [];
        $this->uniqueProducts = [];
    }

    public function parse($fileName, $delimiter)
    {
        try{
            $fileOpen = fopen('input_files/' . $fileName, "r");

            while (($data = fgetcsv($fileOpen, 1000, $delimiter)) !== FALSE) 
            {
                $this->parseLine($data);
            }

            fclose($fileOpen);
                
            return $this->products;
        }
        catch(\Exception $e){
            return $e->getMessage();
        }
    }

    protected function parseLine(array $line){
        if($this->isHeaderRow){
            $this->parseHeaderRow($line);
        }
        else{
            $this->parseProductRow($line);
        }
    }

    protected function parseHeaderRow(array $line){
        $this->headerRow = $line;
        $this->isHeaderRow = false;
    }

    protected function parseProductRow(array $line){
        if(isset($line[0])){

            //make a key from header values
            $key = implode(',', array_values($line));

            //Make a product row through combining header row and product row
            $value = array_combine($this->headerRow,$line);
            
            //Printing Product object 
            print_r((object) $value);

            if(array_key_exists($key, $this->products)){
                array_push($this->products[$key], $value);
            }else{
                $this->products[$key] = [$value];
            }
        }
    }

}