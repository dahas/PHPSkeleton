<?php

namespace PHPSkeleton\Sources;

class Json {

    private string $content = "";
    private array $jsonData = [];

    public function assignData(array $data): void
    {
        $this->jsonData = array_merge($this->jsonData, $data);
    }

    public function getData(): array
    {
        return $this->jsonData;
    }

    public function flush(): void
    {
        header('Content-Type: application/json');
        print json_encode([
            "result" => "success",
            "data" => $this->jsonData,
            "count" => count($this->jsonData)
        ]);
        $this->jsonData = [];
    }
}