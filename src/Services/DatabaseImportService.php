<?php

namespace DatabaseImportExport\Services;

use App\Models\Database;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseImportService
{
    public function import(Database $database, string $filePath): void
    {
        $host = $database->host->host;
        $port = $database->host->port;
        $username = $database->username;
        $password = $database->password;
        $databaseName = $database->database;

        $absolutePath = Storage::disk('local')->path($filePath);

        if (!file_exists($absolutePath)) {
            throw new Exception('Import file not found');
        }

        $command = sprintf(
            'mysql --user=%s --password=%s --host=%s --port=%d %s < %s 2>&1',
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($host),
            $port,
            escapeshellarg($databaseName),
            escapeshellarg($absolutePath)
        );

        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        Storage::disk('local')->delete($filePath);

        if ($returnVar !== 0) {
            throw new Exception('Import failed: ' . implode("\n", $output));
        }
    }
}
