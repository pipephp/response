<?php

namespace Pipe;

class Response
{
    private static $instance;

    public $headers = [];
    public $content = '';
    public $status = 200;

    public static function getInstance(): static
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function html($content, int $code = 200):self
    {
        return $this->status($code)
            ->header('Content-Type', 'text/html')
            ->content($content)
            ->send();
    }
    public function json($content, int $code = 200):self
    {
        return $this->status($code)
            ->header('Content-Type', 'application/json')
            ->content(json_encode($content))
            ->send();
    }

    public function status(int $code):self
    {
        $this->status = $code;

        return $this;
    }

    public function content($content):self
    {
        $this->content = $content;

        return $this;
    }

    public function header(string $name, $value = '', bool $replace = true, int $code = 0):self
    {
        $this->headers["$name: $value"] = [
            'replace' => $replace,
            'code' => $code,
        ];

        return $this;
    }

    public function sendHeaders():self
    {
        foreach ($this->headers as $header => $options) {
            header($header, $options['replace'], $options['code']);
        }
        return $this;
    }

    public function sendContent():self
    {
        echo $this->content;

        return $this;
    }

    public function send():self
    {
        return $this->sendHeaders()->sendContent();
    }
}
