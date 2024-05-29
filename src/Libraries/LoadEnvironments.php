<?php
namespace App\Libraries;

use App\Traits\Singleton;

class LoadEnvironments
{
    use Singleton;

    private string $path;
    private array $tmpEnv;

    /**
     * @return void
     */
    private function readEnv(): void
    {
        $this->tmpEnv = [];
        $fopen = fopen(realpath($this->path), 'r');
        if ($fopen) {
            while (($line = fgets($fopen)) !== false) {
                $line_is_comment = (substr(trim($line), 0, 1) == '#') ? true : false;
                if ($line_is_comment || empty(trim($line)))
                    continue;

                $line_no_comment = explode("#", $line, 2)[0];
                $env_ex = preg_split('/(\s?)\=(\s?)/', $line_no_comment);
                $env_name = trim($env_ex[0]);
                $env_value = isset($env_ex[1]) ? trim($env_ex[1]) : "";
                $this->tmpEnv[$env_name] = $env_value;
            }
            fclose($fopen);
        }
    }

    /**
     * @return void
     */
    private function putEnv(): void
    {
        foreach ($this->tmpEnv as $name => $value) {
            putenv("{$name}=$value");
            if (is_numeric($value))
                $value = floatval($value);
            if (in_array(strtolower($value), ["true", "false"]))
                $value = (strtolower($value) == "true") ? true : false;
            $_ENV[$name] = $value;
        }

        $this->tmpEnv = [];
    }

    public function load(string $envPath = ''): void
    {
        if (empty($envPath)) {
            throw new ErrorException(".env file path is missing");
        }

        if (!is_readable(realpath($envPath))) {
            throw new ErrorException("Permission Denied for reading the " . (realpath($envPath)) . ".");
        }

        $this->path = $envPath;
        $this->readEnv();
        $this->putEnv();
    }
}