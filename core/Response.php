<?php


namespace Core;


class Response
{
    private array $header = [];

    public function __construct()
    {
    }

    public function headers(array $headers)
    {
        foreach ($headers as $key => $value)
        {
            header($key, $value);
        }

        return $this;
    }

    public function status(int $statusCode)
    {
        http_response_code($statusCode);
        return $this;
    }

    public function json(array $data)
    {
        return json_encode($data);
    }
}