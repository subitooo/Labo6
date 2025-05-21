<?php
// 1. GET с кастомными заголовками
function getWithHeaders($url, $headers) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_RETURNTRANSFER => true
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true);
}

// 2. Отправка JSON данных
function sendJson($url, $data) {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true);
}

// 3. Запрос с параметрами URL
function getWithParams($url, $params) {
    $curl = curl_init($url . '?' . http_build_query($params));
    curl_setopt_array($curl, [
        CURLOPT_RETURNTRANSFER => true
    ]);
    $result = curl_exec($curl);
    curl_close($curl);
    return json_decode($result, true);
}
