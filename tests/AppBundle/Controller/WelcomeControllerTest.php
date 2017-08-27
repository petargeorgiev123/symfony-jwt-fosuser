<?php

namespace tests\AppBundle\Controller;

use Tests\ApiTestCaseBase;

class WelcomeControllerTest extends ApiTestCaseBase
{
    public function testGETWelocmeMessageForUser()
    {
        $token = $this->getTokenForTestUser();

        $this->client->request(
            'GET',
            '/users/welcome',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer '.$token],
            []
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('Hello user.', json_decode($this->client->getResponse()->getContent(), true));
    }

    /**
     * Creates some user and returns his token
     *
     * @return [string
     */
    private function getTokenForTestUser()
    {
        $userName = "admin";
        $password = "admin";

        $user = $this->createUser($userName, $password);

        $token = $this->getService('lexik_jwt_authentication.encoder')
            ->encode(['username' => 'admin']);

        return $token;
    }
}