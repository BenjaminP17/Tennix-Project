<?php

namespace App\Tests\EntityTests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testGetAndSetEmail(): void
    {
        $user = new User();
        $email = 'test@example.com';

        $user->setEmail($email);
        $this->assertEquals($email, $user->getEmail());
    }

    public function testGetAndSetRoles(): void
    {
        $user = new User();
        $roles = ['ROLE_ADMIN'];

        $user->setRoles($roles);
        $this->assertEquals(array_unique(array_merge($roles, ['ROLE_USER'])), $user->getRoles());
    }

    public function testGetAndSetPassword(): void
    {
        $user = new User();
        $password = 'hashedPassword';

        $user->setPassword($password);
        $this->assertEquals($password, $user->getPassword());
    }

    public function testGetAndSetFirstname(): void
    {
        $user = new User();
        $firstname = 'John';

        $user->setFirstname($firstname);
        $this->assertEquals($firstname, $user->getFirstname());
    }

    public function testGetAndSetName(): void
    {
        $user = new User();
        $name = 'Doe';

        $user->setName($name);
        $this->assertEquals($name, $user->getName());
    }

    public function testIsVerifiedAndSetIsVerified(): void
    {
        $user = new User();

        $this->assertFalse($user->isVerified());

        $user->setIsVerified(true);
        $this->assertTrue($user->isVerified());
    }

    public function testSerialization(): void
    {
        $user = new User();
        $user->setEmail('test@example.com')
             ->setPassword('password');

        $serialized = $user->serialize();
        $unserializedUser = new User();
        $unserializedUser->unserialize($serialized);

        $this->assertEquals($user->getEmail(), $unserializedUser->getEmail());
        $this->assertEquals($user->getPassword(), $unserializedUser->getPassword());
    }
}
