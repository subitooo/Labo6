<?php
require_once 'ApiClient.php';
$client = new ApiClient('https://jsonplaceholder.typicode.com', 'user', 'pass');

// Пример GET-запроса 
echo "GET Post #1:\n";
$response = $client->get('/posts/1');
print_r($response['response']);
echo "\n";

// Пример POST-запроса 
echo "Create New Post:\n";
$newPost = $client->post('/posts', [
    'title' => 'Hello World',
    'body' => 'This is test post',
    'userId' => 1
]);
print_r($newPost['response']);
echo "\n";

// Пример PUT-запроса 
echo "Update Post #1:\n";
$updatedPost = $client->put('/posts/1', [
    'title' => 'Updated Title',
    'body' => 'Updated Content'
]);
print_r($updatedPost['response']);
echo "\n";

// Пример DELETE-запроса 
echo "Delete Post #1:\n";
$deleteResult = $client->delete('/posts/1');
print_r($deleteResult['response']);