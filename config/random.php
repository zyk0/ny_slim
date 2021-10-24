<?php
require 'vendor/autoload.php';

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;

echo 'используем Guzzle'.'<br><br>';

// Инициализируем клиент Guzzle
$client = new GuzzleHttp\Client();

// Делаем GET запрос
$response = $client->request('GET', 'http://numbersapi.com/random/date');


echo $response->getStatusCode();// Получаем "200"
echo '<br>';
echo $response->getReasonPhrase(); //>>OK
echo '<br>';
echo $response->getHeader('content-type')[0];// Заголовок 'application/json; charset=utf8'
echo '<br>';
echo '<br>';
$data = $response->getBody();
//  массив с постами
//var_dump(json_decode( $response->getBody()->getContents()));
//echo '<br>';
//echo gettype($response->getBody()->getContents()); //>>string
//echo '<br>';

// $data = json_decode( $response->getBody()->getContents()); // преобразование в json
// echo gettype($data); //>>array

// печать с 10 по 20 пост, обрезка строки title до 14 первых символов
/*
$counter = 11;
$max = 21;
foreach ($data as $item) {
        echo $item->id.': '. substr($item->title, -10).' ___'.
            '<strong>('.ucfirst(substr($item->body, -20)).')</strong>'.'<br>';
            $counter++;
            if ($counter === $max) {
                break;
            }
}
*/
//https://coderoad.ru/54709460/%D0%9A%D0%B0%D0%BA-%D1%8F-%D0%BC%D0%BE%D0%B3%D1%83-%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B8%D1%82%D1%8C-%D1%82%D0%BE%D0%BB%D1%8C%D0%BA%D0%BE-%D0%BF%D0%B5%D1%80%D0%B2%D1%8B%D0%B5-%D0%B4%D0%B2%D0%B0-%D1%8D%D0%BB%D0%B5%D0%BC%D0%B5%D0%BD%D1%82%D0%B0-%D0%BC%D0%B0%D1%81%D1%81%D0%B8%D0%B2%D0%B0-%D0%B8%D1%81%D0%BF%D0%BE%D0%BB%D1%8C%D0%B7%D1%83%D1%8F-%D1%86%D0%B8%D0%BA%D0%BB-foreach-%D0%B2
?>