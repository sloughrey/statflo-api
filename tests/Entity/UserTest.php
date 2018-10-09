<?php
namespace App\Tests;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\RecursiveValidator;

class UserTest extends KernelTestCase
{
    public function testToArray()
    {
        $user = new User();
        $user->setName('Sean');
        $user->setRole('admin');

        $userArr = $user->toArray();
        
        $this->assertInternalType('array', $userArr);
    }

   /*  public function testCreateValidUser()
    {
        $user = new User();
        $user->setName('Sean Loughrey');
        $user->setRole('client');

        // Arrrgh... how does one get an entity annotation validator to work in a unit test :(
        $validator = new RecursiveValidator();
        $errors = $validator->validate($user);
        
        $this->assertEmpty($errors);
    }

    public function testCreateInvalidUser()
    {
        $user = new User();
        $user->setName('Sean Loughrey');
        $user->setRole('clientttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt'); // 103 chars max is 100

        // Arrrgh... how does one get an entity annotation validator to work in a unit test :(
        $validator = new RecursiveValidator();
        $errors = $validator->validate($user);
        
        $this->assertNotEmpty($errors);
    } */
}
