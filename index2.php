<?php 


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