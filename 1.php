<?php

// 1. GET-запрос
function performGetRequest() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// 2. POST-запрос
function performPostRequest() {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $data = [
        'title' => 'New post',
        'body' => 'Content',
        'userId' => 1
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// 3. PUT-запрос
function performPutRequest() {
    $url = 'https://jsonplaceholder.typicode.com/posts/1';
    $data = [
        'title' => 'Обновленный заголовок',
        'body' => 'Обновленное содержание'
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

// 4. DELETE-запрос
function performDeleteRequest() {
    $url = 'https://jsonplaceholder.typicode.com/posts/1';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response === '' ? 'Удалено' : 'Ошибка';
}