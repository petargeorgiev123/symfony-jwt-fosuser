<?php

namespace tests\AppBundle\Controller;

use Tests\ApiTestCaseBase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class LoginControllerTest extends WebTestCase
{
    public function testPOSTLoginUser()
    {
        $userName = "matko";
        $password = "test123";

        //$user = $this->createUser($userName, $password);
        $client = static::createClient();
        $client->request(
            'POST',
            '/users/login',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'PHP_AUTH_USER' => $userName,
                'PHP_AUTH_PW'   => $password,
            ]
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $responseArr = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseArr);
    }
}