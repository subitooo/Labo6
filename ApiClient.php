<?php
/*Класс для работы с API*/
class ApiClient {
    private $baseUrl;
    private $headers;
    private $authToken;

    public function __construct($baseUrl, $authToken = null) {
        $this->baseUrl = $baseUrl;
        $this->authToken = $authToken;
        $this->headers = ['Content-Type: application/json'];
    }

    private function sendRequest($method, $endpoint, $data = null) {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Аутентификация
        if ($this->authToken) {
            $this->headers[] = "Authorization: Bearer {$this->authToken}";
        }

        // Настройка метода
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
        } elseif ($method !== 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        // Передача данных
        if ($data) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        // Заголовки
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        // Логирование (можно добавить запись в файл)
        error_log("Request: $method $url - Code: $httpCode");

        if ($error) {
            throw new Exception("cURL Error: $error");
        }

        if ($httpCode >= 400) {
            throw new Exception("API Error: HTTP $httpCode");
        }

        return json_decode($response, true);
    }

    public function get($endpoint) {
        return $this->sendRequest('GET', $endpoint);
    }

    public function post($endpoint, $data) {
        return $this->sendRequest('POST', $endpoint, $data);
    }

    public function put($endpoint, $data) {
        return $this->sendRequest('PUT', $endpoint, $data);
    }

    public function delete($endpoint) {
        return $this->sendRequest('DELETE', $endpoint);
    }
}