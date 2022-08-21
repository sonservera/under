<?php

// Игра "Спасти Принцессу"
// Версия для Telegram
// Автор сюжета - Дмитрий Глуховский
// Код - Дмитрий Попов. 2022 год
// Версия 0.1.4

require_once 'inqlude/database.php';




$sql_query_select = 'SELECT id, step FROM games.under_gamers WHERE step = 12';

$sql_result = mysqli_query ($connect, $sql_query_select);



while ($row = mysqli_fetch_array($sql_result)) {
    echo("ID: " . $row['id'] . "; STEP: . " . $row['step'] . "<br>");
}


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

$today = date("Y-m-d H:i:s"); //формат дата-время в формате MySQL DATATIME
echo '<p>' . $today . '<p>';

$id = $data [from][id];
$first_name = $data [from][first_name];
$last_name = $data [from][last_name];
$username = $data [from][username];
$language_code = $data [from][language_code];

// Заносим в базу любого посетителя

$sql_query_visitor = "INSERT INTO games.under_visitors (id, first_name, last_name, username, language_code, vremya) values ($id, '$first_name', '$last_name', '$username', '$language_code', '$today')";

$sql_result = mysqli_query ($connect, $sql_query_visitor);

// echo $id . '<br>';
// echo $first_name . '<br>';
// echo $last_name . '<br>';
// echo $username . '<br>';
// echo $language_code . '<br>';


// Опеределяем играл ли уже пользователь - запрашиваем наличие id в списке игороков

$sql_query_gamers = "SELECT Count(id) FROM games.under_gamers WHERE id = '$id'";

$sql_result = mysqli_query ($connect, $sql_query_gamers);


while ($row = mysqli_fetch_array($sql_result)) {
    $gamer_exist = $row['Count(id)'];
}

// Контроль знасения поиска игрока
echo '<br> Количество записей игрока = ' . $gamer_exist . '<br>';

// Пеоведение по результату поиска игрока
if ($gamer_exist = 0) {

    echo "Привет, $username, хочешь съиграть в игру?";

}

else {

// тут должен быть код продолжения. Сначала оцениваем время, прошедшее с прошлого взода, и если прошло более суток - спрашваем - хотите ли продолжжить?
// Далее - либо да, либюо нет.
//



}










# Обрабатываем сообщение
switch ($message)
{
    case 'текст':
        $method = 'sendMessage';
        $send_data = [
            'text'   => 'Я пока ничего не умею'
        ];
        break;

    case 'привет':
        $method = 'sendMessage';
        $send_data = [
            'text'   => "Привет, $name"
        ];
        break;

    case 'кнопки':
        $method = 'sendMessage';
        $send_data = [
            'text'   => 'Вот мои кнопки',
            'reply_markup' => [
                'resize_keyboard' => true,
                'keyboard' => [
                    [
                        ['text' => 'Видео'],
                        ['text' => 'Кнопка 2'],
                    ],
                    [
                        ['text' => 'Кнопка 3'],
                        ['text' => 'Кнопка 4'],
                    ]
                ]
            ]
        ];
        break;


    case 'видео':
        $method = 'sendVideo';
        $send_data = [
            //'video'   => 'https://chastoedov.ru/video/amo.mp4',
            'video'   => 'https://cloud.mail.ru/public/BkCR/xrWJLCAe7',
            'caption' => 'Вот мое видео',
            'reply_markup' => [
                'resize_keyboard' => true,
                'keyboard' => [
                    [
                        ['text' => 'Кнопка 1'],
                        ['text' => 'Кнопка 2'],
                    ],
                    [
                        ['text' => 'Кнопка 3'],
                        ['text' => 'Кнопка 4'],
                    ]
                ]
            ]
        ];
        break;

    default:
        $method = 'sendMessage';
        $send_data = [
            'text' => "
            Привет.
            Я ещё очень молодой бот и пока не понимаю о чём вы :( \nНо я быстро учусь 😃\n\nВерсия 0.3.3 👍 \n<b>Россия <i>Вперёд!</i></b> 🇷🇺 🤍💙❤️\n🔵 Отбой воздушной тревоги",
            'parse_mode' => "html"
        ];
}





echo "Hello World!<br>";
//echo $data [chat][id];
echo $data [message][chat][id] . '<br>';
echo $data [chat][first_name];

 ?>