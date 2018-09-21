# Trip builder

###### Malcolm Arcand Laliberté

### About
This project is built using PHP and Laravel.

### Installation
    
 
1. Download the zip and then CD into the directory of the project
2. Make sure composer is installed
3. run composer global require "laravel/installer"
4. run php artisan serve
5. Go to [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser

[http://malcolmarcand.com/trip-builder/](Demo)

### How to use

From the home page, select a trip type (Round Trip, One Way, or Multi-trip). Then, select the departure and arrival airports along with the dates of departure.

- /flights accepts a data parameter which holds the flight information in json format. There is also a timezone parameter sent through.

