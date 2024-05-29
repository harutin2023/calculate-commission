<?php
namespace App\Repository\Interfaces;

interface FileReaderInterface
{
    public function setFilePath(string $filePath): void;
    public function getFileData(): array;
}
