<?php

namespace Contracts\Middleware;

interface Contract
{
    /**
     * @param mixed $request
     * @param mixed $next
     * @param mixed ...$role
     * @return mixed
     */
    public function handle($request, $next, ...$role);
}
