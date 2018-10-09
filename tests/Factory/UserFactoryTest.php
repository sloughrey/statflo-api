<?php
namespace App\Tests;

use App\Entity\User;
use App\Factory\UserFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserFactoryTest extends WebTestCase
{
    /**
     * Tests creating a user from the factory
     *
     * @return void
     */
    public function testUserFactory()
    {
        $factory = new \App\Factory\UserFactory();
        $user = $factory::createUser();
        echo User::class . ' = ' . get_class($user);

        $this->assertEquals(User::class, get_class($user));
    }
}
