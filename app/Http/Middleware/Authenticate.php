<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $links = session()->has('links') ? session('links') : [];
            $currentLink = request()->path(); // Getting current URI like 'category/books/'
            array_unshift($links, $currentLink); // Putting it in the beginning of links array
            session(['links' => $links]); // Saving links array to the session
            return route('login');
        }
    }
}
