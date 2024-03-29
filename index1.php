<?php

// Игра "Спасти Принцессу"
// Версия для Telegram
// Автор сюжета - Дмитрий Глуховский
// Код - Дмитрий Попов aka Qartie. 2022 год
// Версия 0.1.5

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

$today = date("Y-m-d H:i:s"); //формат дата-время в формате MySQL DATATIME
echo '<p>' . $today . '<p>';

echo $data ['message']['chat']['id'] . ' <= Цифры видно? ' . '<br>';

$data = $data['callback_query'] ? $data['callback_query'] : $data['message'];

$message = mb_strtolower(($data['text'] ? $data['text'] : $data['data']),'utf-8');

$id = $data ['from']['id'];
$first_name = $data ['from']['first_name'];
$last_name = $data ['from']['last_name'];
$username = $data ['from']['username'];
$language_code = $data ['from']['language_code'];


// Заносим в базу любого посетителя

$sql_query_visitor = "INSERT INTO games.under_visitors (id, first_name, last_name, username, language_code, vremya) values ($id, '$first_name', '$last_name', '$username', '$language_code', '$today')";

$sql_result = mysqli_query ($connect, $sql_query_visitor);


// Тест для проверки вычисления разницы во времени


$origin = date_create('2020-08-13 18:57:48');
$target = date_create('2019-12-13 18:57:48');
$time_interval = date_diff($origin, $target);
// echo $time_interval . ' - Интервал<br>';
echo $time_interval->format('%a дней') . '<br>';
// echo $time_interval->format('%R%a дней') . '<br>';


// Опеределяем играл ли уже пользователь - запрашиваем наличие id в списке игороков

$sql_query_gamers = "SELECT Count(id) FROM games.under_gamers WHERE id = '$id'";

$sql_result = mysqli_query ($connect, $sql_query_gamers);


while ($row = mysqli_fetch_array($sql_result)) {
    $gamer_exist = $row['Count(id)']; // подсчитываем количество строк в запросе
}

// Контроль значения поиска игрока
echo '<br> Количество записей игрока (gamer_exist) = ' . $gamer_exist . '<br>';

// Пеоведение по результату поиска игрока
if ($gamer_exist == 0) {

    echo "Привет, $first_name, хочешь сыграть в игру?"; // "сЫграть" - так правильно. см. Правописание гласных после приставок.
    // Тут будет действие по отправке кнопок игроку "Да" и "Нет"

}

else {

// тут должен быть код продолжения. Сначала оцениваем время, прошедшее с прошлого входа, и если прошло более суток - спрашваем - хотите ли продолжжить?
// Далее - либо да, либо нет.
//

$sql_query_continue = "SELECT date_time FROM games.under_gamers WHERE id = '$id'";
$sql_result = mysqli_query ($connect, $sql_query_continue);


while ($row = mysqli_fetch_array($sql_result)) {
    $gamer_last_visit = $row['date_time'];
    echo "последний визит геймера $gamer_last_visit";
}

// echo $sql_result;

}



function gameCube ()
{
    $game_cube = rand(1, 6);
    echo $game_cube;
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



echo '<br>';
gameCube();
echo '<br>';

gameCube();
echo '<br>';



//echo $data [chat][id];
echo '<br>' . $data ['message']['chat']['id'] . ' <= Цифры слева видно? ' . '<br>';
echo $data ['chat']['first_name'];

 ?>