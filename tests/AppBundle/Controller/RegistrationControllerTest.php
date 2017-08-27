<?php

// tests/UserBundle/Controller/RegistrationControllerTest.php

namespace tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testPostRegsiterNewUser()
    {
        $data = [
            'username' => 'matko',
            'email' => 'matko@gmail.com',
            'plainPassword' => [
                'first' => 'test123', 'second' => 'test123'
            ]
        ];

        $client = $this->makePOSTRequest($data);
        var_dump($client->getResponse()->getStatusCode());

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }

    public function testPostRegsiterNewUserWithInvalidEmail()
    {
        $data = [
            'username' => 'matko',
            'email' => 'matkasgasgashgamail.com',
            'plainPassword' => [
                'first' => 'test123', 'second' => 'test123'
            ]
        ];

        $client = $this->makePOSTRequest($data);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    private function makePOSTRequest($data)
    {
        $client = static::createClient();
        $client->request(
            'POST', '/users/register', array(), array(),
            array(
                'CONTENT_TYPE' => 'application/json',
            ),
            json_encode($data)
        );

        return $client;
    }
}