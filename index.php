<?php
require "inqlude/database.php";
// Переменная подкючения к базе - $connect


echo "Привет, мир!<p> ";

$game_cube = rand(1, 6);

echo 'Бросок кубика ' . $game_cube;

$data = Array
(
    'update_id' => 871317732,
    'message' => Array
        (
            'message_id' => 77,
            'from' => Array
                (
                    'id' => 191128718,
                    'is_bot' => '',
                    'first_name' => 'Белый',
                    'last_name' => 'Билл',
                    'username' => 'Billwhite',
                    'language_code' => 'ru',
                ),

            'chat' => Array
                (
                    'id' => 191128718,
                    'first_name' => 'Белый',
                    'last_name' => 'Билл',
                    'username' => 'Billwhite',
                    'type' => 'private'
                ),

            'date' => 1658469684,
            'text' => 'respond'
        ),

);




$data = $data['callback_query'] ? $data['callback_query'] : $data['message'];
$message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']),'utf-8');

$name = $data [chat][first_name];
$id = $data [chat][id];

echo '<br>' . $name;
echo '<br>' . $id;

?>