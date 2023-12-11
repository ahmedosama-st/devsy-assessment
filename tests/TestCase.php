<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function jsonAs(
        JWTSubject $user,
        $method,
        $endpoint,
        array $data = [],
        array $headers = []
    ): \Illuminate\Testing\TestResponse {
        $token = auth('api')->tokenById($user->id);

        return $this->json(
            $method,
            $endpoint,
            $data,
            array_merge($headers, [
                'Authorization' => 'Bearer '.$token,
            ])
        );
    }
}
