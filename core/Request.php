<?php


namespace Core;


class Request
{
    public array $header;
    public string $method;
    public string $uri;
    public array $params;
    public array $body;

    public function __construct()
    {
        $this->header = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $this->parseURI($_SERVER['REQUEST_URI']);
        $this->params = $this->method === 'GET' ? $_GET : $_POST;

        if (array_key_exists('Content-Type', $this->header)) {
            $this->body = $this->parseBody($this->header['Content-Type']);
        } else {
            $this->body = [];
        }

    }

    private function parseBody($requestType)
    {
        switch ($requestType) {
            case 'multipart/form-data':
                return $_FILES;

            case 'application/json':
                return json_decode(file_get_contents('php://input'), true);

            default:
                return [];
        }
    }

    private function parseURI($uri)
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];

        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        return $uri;
    }
}