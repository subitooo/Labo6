<?php

// 1. GET
$curl = curl_init('https://jsonplaceholder.typicode.com/posts');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);
curl_close($curl);
echo "GET: " . $response . "\n";

// 2. POST
$curl = curl_init('https://jsonplaceholder.typicode.com/posts');
curl_setopt_array($curl, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode([
        'title' => 'New post',
        'body' => 'Content',
        'userId' => 1
    ])
]);
$response = curl_exec($curl);
curl_close($curl);
echo "POST: " . $response . "\n";

// 3. PUT
$curl = curl_init('https://jsonplaceholder.typicode.com/posts/1');
curl_setopt_array($curl, [
    CURLOPT_CUSTOMREQUEST => 'PUT',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
    CURLOPT_POSTFIELDS => json_encode([
        'title' => 'Updated title',
        'body' => 'Updated content',
        'userId' => 1
    ])
]);
$response = curl_exec($curl);
curl_close($curl);
echo "PUT: " . $response . "\n";

// 4. DELETE
$curl = curl_init('https://jsonplaceholder.typicode.com/posts/1');
curl_setopt_array($curl, [
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_RETURNTRANSFER => true
]);
$response = curl_exec($curl);
curl_close($curl);
echo "DELETE: " . $response . "\n";