<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        "/api/login",
        "/api/logout",
        "/api/posts",
        "/api/posts/id",
        "/api/posts/*",
        // 'auth\PostController@update',
        // 'auth\PostController@destroy'

        // route('post.update'),
        // 'http://127.0.0.1:8000/api/posts/{id?}'
    ];
}
