<?php

namespace App\Http\Controllers\Backup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    /**
     * Show the list of existing backups.
     */
    public function index()
    {
        $backupFiles = File::files(storage_path('backups'));

        $backups = collect($backupFiles)
            ->map(function ($file) {
                return [
                    'name' => $file->getFilename(),
                    'size' => $this->humanFileSize($file->getSize()),
                    'last_modified' => date('Y-m-d H:i:s', $file->getMTime()),
                ];
            })
            ->sortByDesc('last_modified')
            ->values();

        return view('admin.backup.index', compact('backups'));
    }

    /**
     * Trigger the database backup process.
     */
    public function backupNow(Request $request)
    {
        try {
            Artisan::call('backup:run --only-db');

            $message = 'Database backup completed successfully.';

            return $request->wantsJson()
                ? response()->json(['message' => $message])
                : redirect()->route('backup.index')->with('status', $message);

        } catch (\Exception $e) {
            $error = 'Database backup failed: ' . $e->getMessage();

            return $request->wantsJson()
                ? response()->json(['error' => $error], 500)
                : redirect()->route('backup.index')->with('error', $error);
        }
    }

    /**
     * Download the specified backup file.
     */
    public function downloadBackup(string $filename)
    {
        $filePath = storage_path("backups/{$filename}");

        if (!File::exists($filePath)) {
            abort(404, 'Backup file not found.');
        }

        return Response::download($filePath);
    }

    /**
     * Delete the specified backup file.
     */
    public function deleteBackup(string $filename, Request $request)
    {
        $filePath = storage_path("backups/{$filename}");

        if (!File::exists($filePath)) {
            $message = 'Backup file not found.';

            return $request->wantsJson()
                ? response()->json(['message' => $message], 404)
                : redirect()->route('backup.index')->with('error', $message);
        }

        File::delete($filePath);

        $message = 'Backup deleted successfully.';

        return $request->wantsJson()
            ? response()->json(['message' => $message])
            : redirect()->route('backup.index')->with('status', $message);
    }

    /**
     * Convert bytes to a human-readable format.
     */
    private function humanFileSize($bytes, $decimals = 2)
    {
        $size = ['B','KB','MB','GB','TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . $size[$factor];
    }
}
