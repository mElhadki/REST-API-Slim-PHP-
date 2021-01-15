[![php Logo](https://guillaume-richard.fr/wp-content/uploads/2019/08/slim_framework_logo.png)](https://guillaume-richard.fr)
[![php Logo](https://www.php.net/images/logos/php-logo.svg)](https://www.php.net/)

# REST-API-Slim-PHP-
Creating a Rest API with Slim PHP Framework


## How To Run??

To run this project you must have 

```
    installed a virtual server i.e XAMPP on your PC.
   
```
Open your terminal and run the following command 

```
composer require slim/slim "^3.12"

```

After Starting Apache and MySQL in XAMPP, follow the following steps

```
1st Step: Extract file
2nd Step: Copy the main project folder
3rd Step: Paste in xampp/htdocs
```
Now Connecting Database

```
 4th Step: Open a browser and go to URL "http://localhost/phpmyadmin/"
 5th Step: Then, click on the databases tab
 6th Step: Create a database naming "gallery" and then click on the import tab
 7th Step: Click on browse file and select "art.sql" file which is inside the folder
 8th Step: Click on go.
```
After Creating Database,
```
 9th Step: Open a browser and go to URL "http://localhost/Slim-php/public/index.php/api/art" to see the data 
 You can test the api in postman if you want 
```
