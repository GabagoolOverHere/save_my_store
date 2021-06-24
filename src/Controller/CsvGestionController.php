<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;

$url ='https://data.cityofnewyork.us/api/views/43nn-pn8j/rows.csv?accessType=DOWNLOAD&#039;';

    $handle = fopen($url, 'r');
    $i=0;


while ($line=fgetcsv($handle, 0, ',')) {
    if ($i>1) {
        break;
    }

    echo '<pre>';

    var_dump($line);

    echo '</pre>';
    $i++;
}

$restaurant = array_slice($line, 0, 2);

echo 'Je suis restaurant : ';
var_dump($restaurant);


$restaurant_seconde_partie = array_slice($line, 3, 4);

echo 'Je suis restaurant 2 : ';
var_dump($restaurant_seconde_partie);

$restaurant_third_part = array_slice($line, 18, 2);

echo 'Je suis restaurant 3 : ';
var_dump($restaurant_third_part);

$quartier = array_slice($line, 2, 1);

echo 'Je suis quartier : ';
var_dump($quartier);

$type_pbl = array_slice($line, 10, 2);
echo 'Je suis type pbl : ';
var_dump($type_pbl);



$restaurant_total = array_merge_recursive($restaurant, $restaurant_seconde_partie, $restaurant_third_part);
echo 'Je suis restaurant_total : ';
var_dump($restaurant_total);
