<?php
function makeCurlRequest($url, $method = 'GET', $data = null, $headers = []) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);

    if ($method === 'POST') {
        curl_setopt($curl, CURLOPT_POST, true);
    } elseif (in_array($method, ['PUT', 'DELETE'])) {
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    }

    if ($data !== null) {
        if (is_array($data)) {
            $data = json_encode($data);
            $headers[] = 'Content-Type: application/json';
        }
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }

    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }

    $response = curl_exec($curl);
    $error = curl_error($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($error) {
        echo "Ошибка запроса: $error\n";
    } elseif ($code >= 400) {
        echo "HTTP ошибка $code\nОтвет:\n$response\n";
    } else {
        echo "Успешно (HTTP $code)\n";
        $data = json_decode($response, true);
        print_r($data);
    }

    echo "\n\n";
}

echo "Успешный запрос:\n";
makeCurlRequest('https://jsonplaceholder.typicode.com/posts/1');

echo "Ошибка 404:\n";
makeCurlRequest('https://jsonplaceholder.typicode.com/posts/666');

echo "Ошибка Curl:\n";
makeCurlRequest('https://notrealsite.site');