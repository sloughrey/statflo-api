<?php
namespace App\Tests;

use App\Entity\User;
use App\Factory\UserFactory;
use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Driver\Connection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    public function testUserFactory()
    {
        $factory = new \App\Factory\UserFactory();
        $user = $factory::createUser();

        $this->assertEquals(User::class, get_class($user));
    }

    /* public function testFindById()
    {
        $conn = new Connection();

        $sql = 'INSERT INTO user (name, role) VALUES ("John Smith", "admin")';
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $id = $conn->lastInsertId();
        echo 'id is: ' . $id;

        // returns an array of arrays (i.e. a raw data set)
        $results = $stmt->fetchAll();

    } */
}
