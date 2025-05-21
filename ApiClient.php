<?php
class ApiClient {
    private $base;
    private $auth;

    public function __construct($base_url, $user, $pass) {
        $this->base = trim($base_url, '/');
        $this->auth = 'Authorization: Basic '.base64_encode("$user:$pass");
    }

    private function call($method, $path, $data = null) {
        // Собираем полный URL
        $full_url = $this->base.'/'.ltrim($path, '/');

        // Настройка CURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $full_url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            $this->auth,
            'Content-Type: application/json'
        ]);

        // Добавляем данные если есть
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        // Выполняем запрос
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        curl_close($curl);

        // Возвращаем результат
        return [
            'code' => $status,
            'error' => $error ? $error : false,
            'response' => json_decode($result, true)
        ];
    }

    public function get($path) {
        return $this->call('GET', $path);
    }

    public function post($path, $data) {
        return $this->call('POST', $path, $data);
    }

    public function put($path, $data) {
        return $this->call('PUT', $path, $data);
    }

    public function delete($path) {
        return $this->call('DELETE', $path);
    }
}