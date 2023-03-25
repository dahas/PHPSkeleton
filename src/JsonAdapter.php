<?php

namespace PHPSkeleton\Sources;

class JsonAdapter {

    private string $message = "";
    private array $data = [];

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    public function setData(array $data): void
    {
        $this->data = [$this->data, ...$data];
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function encode(): string
    {
        return json_encode([
            "message" => $this->message,
            "data" => $this->data,
            "count" => count($this->data)
        ]);
    }
}