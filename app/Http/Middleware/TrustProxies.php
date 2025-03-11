<?php
namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * Trust all proxies (or specify IPs if needed)
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * Set the trusted headers to use
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_FOR;
}
