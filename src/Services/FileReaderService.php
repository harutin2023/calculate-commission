<?php
namespace App\Services;

use App\Repository\Interfaces\FileReaderInterface;
use App\Traits\Singleton;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class FileReaderService implements FileReaderInterface
{
    use Singleton;
    private array $fileContent = [];
    private string $filePath;


    /**
     * @param string $filePath
     * @return void
     */
    public function setFilePath(string $filePath): void
    {
        if (file_exists($filePath) === false) {
            throw new FileNotFoundException(
                'File was not found. Please make sure file name/path are correct and the file exists.'
            );
        }
        $this->filePath = $filePath;
    }

    public function getFileData(): array
    {
        $fileContent = file_get_contents($this->filePath);
        $data = [];
        if (strlen($fileContent) > 0) {
            $rows = explode("\n", $fileContent);
            foreach ($rows as $row) {
                $data[] = json_decode($row, true);
            }
        }
        return $data;
    }
}