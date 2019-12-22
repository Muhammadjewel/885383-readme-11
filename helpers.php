<?php
date_default_timezone_set('Asia/Tashkent');

/**
 * Проверяет переданную дату на соответствие формату 'ГГГГ-ММ-ДД'
 *
 * Примеры использования:
 * is_date_valid('2019-01-01'); // true
 * is_date_valid('2016-02-29'); // true
 * is_date_valid('2019-04-31'); // false
 * is_date_valid('10.10.2010'); // false
 * is_date_valid('10/10/2010'); // false
 *
 * @param string $date Дата в виде строки
 *
 * @return bool true при совпадении с форматом 'ГГГГ-ММ-ДД', иначе false
 */
function is_date_valid(string $date): bool
{
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param $link mysqli Ресурс соединения
 * @param $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = [])
{
    $stmt = mysqli_prepare($link, $sql);

    if ($stmt === false) {
        $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
        die($errorMsg);
    }

    if ($data) {
        $types = '';
        $stmt_data = [];

        foreach ($data as $value) {
            $type = 's';

            if (is_int($value)) {
                $type = 'i';
            } else {
                if (is_string($value)) {
                    $type = 's';
                } else {
                    if (is_double($value)) {
                        $type = 'd';
                    }
                }
            }

            if ($type) {
                $types .= $type;
                $stmt_data[] = $value;
            }
        }

        $values = array_merge([$stmt, $types], $stmt_data);

        $func = 'mysqli_stmt_bind_param';
        $func(...$values);

        if (mysqli_errno($link) > 0) {
            $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
            die($errorMsg);
        }
    }

    return $stmt;
}

/**
 * Возвращает корректную форму множественного числа
 * Ограничения: только для целых чисел
 *
 * Пример использования:
 * $remaining_minutes = 5;
 * echo "Я поставил таймер на {$remaining_minutes} " .
 *     get_noun_plural_form(
 *         $remaining_minutes,
 *         'минута',
 *         'минуты',
 *         'минут'
 *     );
 * Результат: "Я поставил таймер на 5 минут"
 *
 * @param int $number Число, по которому вычисляем форму множественного числа
 * @param string $one Форма единственного числа: яблоко, час, минута
 * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
 * @param string $many Форма множественного числа для остальных чисел
 *
 * @return string Рассчитанная форма множественнго числа
 */
function get_noun_plural_form(int $number, string $one, string $two, string $many): string
{
    $number = (int)$number;
    $mod10 = $number % 10;
    $mod100 = $number % 100;

    switch (true) {
        case ($mod100 >= 11 && $mod100 <= 20):
            return $many;

        case ($mod10 > 5):
            return $many;

        case ($mod10 === 1):
            return $one;

        case ($mod10 >= 2 && $mod10 <= 4):
            return $two;

        default:
            return $many;
    }
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template($name, array $data = [])
{
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

/**
 * Проверяет, что переданная ссылка ведет на публично доступное видео с youtube
 * @param string $youtube_url Ссылка на youtube видео
 * @return bool
 */
function check_youtube_url($youtube_url)
{
    $res = false;
    $id = extract_youtube_id($youtube_url);

    if ($id) {
        $api_data = ['id' => $id, 'part' => 'id,status', 'key' => 'AIzaSyBN-AXBnCPxO3HJfZZdZEHMybVfIgt16PQ'];
        $url = "https://www.googleapis.com/youtube/v3/videos?" . http_build_query($api_data);

        $resp = file_get_contents($url);

        if ($resp && $json = json_decode($resp, true)) {
            $res = $json['pageInfo']['totalResults'] > 0 && $json['items'][0]['status']['privacyStatus'] == 'public';
        }
    }

    return $res;
}

/**
 * Возвращает код iframe для вставки youtube видео на страницу
 * @param string $youtube_url Ссылка на youtube видео
 * @return string
 */
function embed_youtube_video($youtube_url)
{
    $res = "";
    $id = extract_youtube_id($youtube_url);

    if ($id) {
        $src = "https://www.youtube.com/embed/" . $id;
        $res = '<iframe width="760" height="400" src="' . $src . '" frameborder="0"></iframe>';
    }

    return $res;
}

/**
 * Возвращает img-тег с обложкой видео для вставки на страницу
 * @param string $youtube_url Ссылка на youtube видео
 * @return string
 */
function embed_youtube_cover($youtube_url)
{
    $res = "";
    $id = extract_youtube_id($youtube_url);

    if ($id) {
        $src = sprintf("https://img.youtube.com/vi/%s/mqdefault.jpg", $id);
        $res = '<img alt="youtube cover" width="320" height="120" src="' . $src . '" />';
    }

    return $res;
}

/**
 * Извлекает из ссылки на youtube видео его уникальный ID
 * @param string $youtube_url Ссылка на youtube видео
 * @return array
 */
function extract_youtube_id($youtube_url)
{
    $id = false;

    $parts = parse_url($youtube_url);

    if ($parts) {
        if ($parts['path'] == '/watch') {
            parse_str($parts['query'], $vars);
            $id = $vars['v'] ?? null;
        } else {
            if ($parts['host'] == 'youtu.be') {
                $id = substr($parts['path'], 1);
            }
        }
    }

    return $id;
}

/**
 * @param $index
 * @return false|string
 */
function generate_random_date($index)
{
    $deltas = [['minutes' => 59], ['hours' => 23], ['days' => 6], ['weeks' => 4], ['months' => 11]];
    $dcnt = count($deltas);

    if ($index < 0) {
        $index = 0;
    }

    if ($index >= $dcnt) {
        $index = $dcnt - 1;
    }

    $delta = $deltas[$index];
    $timeval = rand(1, current($delta));
    $timename = key($delta);

    $ts = strtotime("$timeval $timename ago");
    $dt = date('Y-m-d H:i:s', $ts);

    return $dt;
}

function dbFetchData ($link, $sql, $data = []) {
    $result = [];
    $statement = db_get_prepare_stmt($link, $sql, $data);
    mysqli_stmt_execute($statement);
    $resource = mysqli_stmt_get_result($statement);

    if ($resource) {
        $result = mysqli_fetch_all($resource, MYSQLI_ASSOC);
    }

    return $result;
}

function dbInsertData($link, $sql, $data = []) {
    $statement = db_get_prepare_stmt($link, $sql, $data);
    $result = mysqli_stmt_execute($statement);

    if ($result) {
        $result = mysqli_insert_id($link);
    }

    return $result;
}

function truncateTextIfNecessary ($text, $maxTextLength = 300) {
    if (strlen($text) < $maxTextLength) {
        return '<p>' . $text . '</p>';
    }

    $textAsArray = explode(' ', $text);
    $truncatedText = '';
    $index = 0;
    while (strlen($truncatedText . ' ' . $textAsArray[$index]) < $maxTextLength) {
        $truncatedText .= ' ' . $textAsArray[$index];
        $index++;
    }
    $result = '<p>' . $truncatedText . '...</p><a class="post-text__more-link" href="#">Читать далее</a>';
    return $result;
}

function getRelativeTime ($postPublishedDate) {
    $dateDiff = strtotime('now') - strtotime($postPublishedDate);
    $dateDiffInMinutes = floor($dateDiff / 60);
    $dateDiffInHours = floor($dateDiff / 3600);
    $dateDiffInDays = floor($dateDiff / 86400);
    $dateDiffInWeeks = floor($dateDiff / 604800);
    $dateDiffInMonths = floor($dateDiffInWeeks / 4);

    if ($dateDiffInMinutes < 60) {
        $relativeTime = $dateDiffInMinutes . ' ' . get_noun_plural_form($dateDiffInMinutes, 'минута', 'минуты', 'минут') . ' назад';
    } elseif ($dateDiffInMinutes >= 60 && $dateDiffInHours < 24) {
        $relativeTime = $dateDiffInHours . ' ' . get_noun_plural_form($dateDiffInHours, 'час', 'часа', 'часов') . ' назад';
    } elseif ($dateDiffInHours >= 24 && $dateDiffInDays < 7) {
        $relativeTime = $dateDiffInDays . ' ' . get_noun_plural_form($dateDiffInDays, 'день', 'дня', 'дней') . ' назад';
    } elseif ($dateDiffInDays >= 7 && $dateDiffInWeeks < 5) {
        $relativeTime = $dateDiffInWeeks . ' ' . get_noun_plural_form($dateDiffInWeeks, 'неделья', 'недели', 'недель') . ' назад';
    } elseif ($dateDiffInWeeks >= 5) {
        $relativeTime = $dateDiffInMonths . ' ' . get_noun_plural_form($dateDiffInMonths, 'месяц', 'месяца', 'месяцов') . ' назад';
    }
    
    return $relativeTime;
}

function renderPostTimeElement ($post) {
    $randomPostDate = generate_random_date($post);    
    $postDateForTitle = date('d.m.Y H:i', strtotime($randomPostDate));

    return '<time class="post__time" title="' . $postDateForTitle . '" datetime="' . $randomPostDate . '">' . getRelativeTime($randomPostDate) . '</time>';
}

$username = 'Muhammadjavohir';

$connection = mysqli_init();
mysqli_options($connection, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
mysqli_real_connect($connection, 'localhost', 'root', '', 'readme');
mysqli_set_charset($connection, 'utf8');

if (!$connection) {
    print("Ошибка подключения: " . mysqli_connect_error());
}