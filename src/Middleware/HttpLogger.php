<?php

namespace Spatie\HttpLogger\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\HttpLogger\LogWriter;
use Spatie\HttpLogger\LogProfile;

class HttpLogger
{
    protected $logProfile;
    protected $logWriter;

    public function __construct(LogProfile $logProfile, LogWriter $logWriter)
    {
        $this->logProfile = $logProfile;
        $this->logWriter = $logWriter;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->logProfile->shouldLogRequest($request)) {
            $this->logWriter->logRequest($request, $next($request));
        }

        return $next($request);
    }
}
