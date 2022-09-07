# Set up 
### Clone Repository
Through Https
```sh
git clone https://github.com/Mashfiqur/product-list-process-native-php.git
```
Through SSH
```sh
git clone git@github.com:Mashfiqur/product-list-process-native-php.git
```


### Change to the project directory
```sh
cd product-list-process-native-php/
```

### Copy docker-compose file
```sh
cp docker-compose-example.yml docker-compose.yml
```

### Build the app
```sh
docker-compose up
```

### If you want to run the parser from your terminal

Step 1 : First need to enter inside the container 
```sh
docker exec -it ecdltd-native-php-container bash
```
Step 2: Need to move some teb separated file and comma separated file inside the directory input_files/
        Suppose the name of the files are products_comma_separated.csv and products_tab_separated.tsv

Step 3: Run this command 

For CSV file:
```sh
php  index.php --file=products_comma_separated.csv --unique-combinations=uniq_combination_csv.csv
```
For TSV file:
```sh
php  index.php --file=products_tab_separated.tsv --unique-combinations=uniq_combination_tsv.csv
```

You can check the unique combinations file from output_files/ directory named as your given name