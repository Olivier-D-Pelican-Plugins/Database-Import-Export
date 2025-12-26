<?php

namespace DatabaseImportExport\Services;

use App\Models\Database;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseExportService
{

    public function export(Database $database): string
    {
        $host = $database->host->host;
        $port = $database->host->port;
        $username = $database->username;
        $password = $database->password;
        $databaseName = $database->database;

        $filename = 'database_export_' . $databaseName . '_' . now()->format('Y-m-d_H-i-s') . '.sql';
        $filepath = storage_path('app/temp-exports/' . $filename);

        if (!file_exists(dirname($filepath))) {
            mkdir(dirname($filepath), 0755, true);
        }

        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s --port=%d %s > %s 2>&1',
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($host),
            $port,
            escapeshellarg($databaseName),
            escapeshellarg($filepath)
        );

        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new Exception('Export failed: ' . implode("\n", $output));
        }

        if (!file_exists($filepath) || filesize($filepath) === 0) {
            throw new Exception('Export file is empty or was not created');
        }

        return $filepath;
    }
}
