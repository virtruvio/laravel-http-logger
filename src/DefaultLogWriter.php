<?php

namespace Spatie\HttpLogger;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DefaultLogWriter implements LogWriter
{
    public function logRequest(Request $request, Response $response)
    {
        $method = strtoupper($request->getMethod());

        // $uri = $request->getPathInfo();
        $uri = $request->fullUrl();

        //Added
        $ipAddress = $request->ip();
        $responseStatus = $response->status();

        // $bodyAsJson = json_encode($request->except(config('http-logger.except')));

        // $files = array_map(function (UploadedFile $file) {
        //     return $file->getClientOriginalName();
        // }, iterator_to_array($request->files));

        // $message = "{$method} {$uri} - Body: {$bodyAsJson} - Files: ".implode(', ', $files);
        $message = "|{$ipAddress}|{$method}|{$uri}|{$responseStatus}";

        // Log::info($message);
        Log::channel('mediagets')->info($message);
    }
}
