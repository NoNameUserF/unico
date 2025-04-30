<?php 

if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Запускаем сессию только если она еще не была начата
}
require_once 'connect.php';

// Проверка выполнения запроса к БД
if (!function_exists('dbCheckError')) {
    function dbCheckError($query){
        $errInfo = $query->errorInfo();
        if ($errInfo[0] !== PDO::ERR_NONE){
            echo $errInfo[2];
            exit();
        }
        return true;
    }
}

if (!function_exists('selectAll')) {
    function selectAll($table, $params = []){
        global $pdo;
        $sql = "SELECT * FROM $table";

        if(!empty($params)){
            $i = 0;
            foreach ($params as $key => $value){
                if (!is_numeric($value)){
                    $value = "'".$value."'";
                }
                if ($i === 0){
                    $sql = $sql . " WHERE $key=$value";
                }else{
                    $sql = $sql . " AND $key=$value";
                }
                $i++;
            }
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }
}

// Запрос на получение одной строки с выбранной таблицы
if (!function_exists('selectOne')) {
    function selectOne($table, $params = []) {
        global $pdo;
        $sql = "SELECT * FROM $table";

        if(!empty($params)){
            $i = 0;
            foreach ($params as $key => $value){
                if (!is_numeric($value)){
                    $value = "'".$value."'";
                }
                if ($i === 0){
                    $sql = $sql . " WHERE $key=$value";
                } else {
                    $sql = $sql . " AND $key=$value";
                }
                $i++;
            }
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }
}
// Запись в таблицу БД
if (!function_exists('insert')) {
    function insert($table, $params){
        global $pdo;
        $i = 0;
        $coll = '';
        $mask = '';
        $bindings = [];

        // Prepare the column names and values
        foreach ($params as $key => $value) {
            if ($i === 0){
                $coll = $coll . "$key";
                $mask = $mask . ":$key";
            }else {
                $coll = $coll . ", $key";
                $mask = $mask . ", :$key";
            }
            $bindings[":$key"] = $value;  // Bind the value to the placeholder
            $i++;
        }

        // Build the SQL query
        $sql = "INSERT INTO $table ($coll) VALUES ($mask)";

        // Prepare the query
        $query = $pdo->prepare($sql);

        // Execute the query with parameter binding
        $query->execute($bindings);

        // Check for any errors
        dbCheckError($query);

        // Return the last inserted ID
        return $pdo->lastInsertId();
    }
}
// Обновление строки в таблице
if (!function_exists('update')) {
    function update($table, $id, $params){
        global $pdo;
        $i = 0;
        $str = '';
        $bindings = []; // Массив для привязки параметров

        foreach ($params as $key => $value) {
            if ($i === 0){
                $str = $str . "$key = :$key"; // Используем привязку параметра
            } else {
                $str = $str .", $key = :$key"; // Используем привязку параметра
            }
            $bindings[":$key"] = $value;  // Добавляем значение в массив привязки
            $i++;
        }

        // Строим SQL запрос с привязкой параметров
        $sql = "UPDATE $table SET $str WHERE id = :id";
        $bindings[":id"] = $id; // Привязываем id тоже

        $query = $pdo->prepare($sql);
        $query->execute($bindings);  // Передаем массив привязанных параметров
        dbCheckError($query);
    }
}

// Проверка, чтобы избежать многократного объявления функции delete
if (!function_exists('delete')) {
    function delete($table, $id){
        global $pdo;
        $sql = "DELETE FROM $table WHERE id = $id";
        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }   
}




