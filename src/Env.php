<?php

declare(strict_types=1);

namespace Eva\Env;

class Env implements EnvInterface
{
    protected array $data = [];

    public function load(string $path): void
    {
        $this->data = [];
        $envFile = file_get_contents($path);
        $envFile = str_replace(["\r\n", "\r"], "\n", $envFile);
        $envData = explode("\n", trim($envFile));

        foreach ($envData as $envStr) {
            [$env, $value] = explode('=', $envStr);
            $this->set(trim($env), trim($value, "' \t\n\r\0\x0B"));
        }
    }

    public function set(string $env, string $value): void
    {
        $this->data[$env] = $value;
    }

    public function get(string $env): string
    {
        return $this->data[$env];
    }

    public function getAll(): array
    {
        return $this->data;
    }
}
