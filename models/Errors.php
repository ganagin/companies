<?php

class Errors {

    /**
     * Errors constructor.
     *
     * @param Exception $e
     */
    public function __construct(Exception $e)
    {
        $error = $e->getMessage();
        $file = $e->getFile();
        $line = $e->getLine();
        $trace = debug_backtrace();
        $files = ["$file:$line"];

        foreach ($trace as $t) {
            $file = $t['file'] ?? null;
            $line = $t['line'] ?? null;
            if ($file && $line) {
                $files[] = "$file:$line";
            }
        }

        $error = $error . ' --- ' . implode(' --- ', $files);
        error_log($error);

        if (PHP_SAPI === 'cli') {

            exit(1);

        } else {

            http_response_code(500);
            echo json_encode([
                'error' => 'Server error',
            ]);

        }
    }
}
