<?php
// Подключаем необходимые файлы
include "app/database/db.php"; // Подключаем базу данных

// Проверка на активную сессию
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Получаем все стратегии и паспортные данные
$strategys = selectAll('strategys');
$passports = selectAll('passports');

// Инициализация переменных
$allAmount = 0;
$allStragysName = '';
$activityMessage = '';

// Получаем паспорт текущего пользователя
$passport = selectOne('passports', ['id_user' => $_SESSION['id']]);

// Проверяем, что паспорт найден и не равен false
if ($passport !== false && is_array($passport)) {
    $_SESSION['verification'] = $passport['verification'];
} else {
    $_SESSION['verification'] = 0; // Если паспорта нет, устанавливаем статус в 0
}

// Расчет общей суммы и названий стратегий для пользователя
foreach ($strategys as $key => $value) {
    if ($_SESSION['id'] === $value['id_user']) {
        $allAmount += $value['amount'];
        $allStragysName .= $value['name'] . ', ' . '<br>';
        $activityMessage = 'The data will be updated in 29 days'; // Пример сообщения
    }
}

// Устанавливаем минимальные сроки для стратегий
$minimumTerm = [
    'ETF Star' => '1 year',
    'Crypto 10' => '3 month',
    'Buy and Buy' => '6 month',
    'Crypto arbitrage +' => '3 month'
];

// Инициализируем массив с названиями стратегий
$nameStrategys = [
    'ETF Star' => 0,
    'Crypto 10' => 0,
    'Buy and Buy' => 0,
    'Crypto arbitrage +' => 0
];

// Проверка, какие стратегии уже активны у текущего пользователя
for ($i = 0; $i < count($strategys); $i++) {
    if ($strategys[$i]['id_user'] == $_SESSION['id']) {
        $nameStrategys[$strategys[$i]['name']] = true;
    }
}

// Инициализируем сообщение об ошибке баланса
$errorBalance = '';

// Обработка формы для добавления новой стратегии
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-strategys"])) {

    // Получаем данные из формы
    $id_user = $_POST['id_user'];
    $income = $_POST['income'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $name = $_POST['name'];

    // Проверка, достаточно ли средств
    if ($amount > $_SESSION['balance'] - $allAmount) {
        $errorBalance = 'Insufficient funds'; // Сообщение об ошибке, если недостаточно средств
    } else {
        // Данные для вставки в базу данных
        $post = [
            'id_user' => $id_user,
            'income' => $income,
            'amount' => $amount,
            'date' => $date,
            'name' => $name
        ];

        // Вставка новой стратегии в базу
        insert('strategys', $post);

        // Перенаправление на ту же страницу после успешной вставки
        header('Location: strategys.php');
        exit(); // Завершаем выполнение скрипта после редиректа
    }
}

// Обработка формы для досрочного завершения стратегии
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["button-finish"])) {

    // Получаем ID стратегии для удаления
    $id = $_POST['id'];

    // Удаление стратегии из базы
    delete('strategys', $id);

    // Перенаправление на ту же страницу после удаления
    header('Location: strategys.php');
    exit(); // Завершаем выполнение скрипта после редиректа
}
?>
