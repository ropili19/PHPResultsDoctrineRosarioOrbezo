<?php
/**
 * PHP version 7.2
 * tests/Entity/UserTest.php
 *
 * @category EntityTests
 * @package  MiW\Results\Tests
 * @author   Javier Gil <franciscojavier.gil@upm.es>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.etsisi.upm.es ETS de Ingeniería de Sistemas Informáticos
 */

namespace MiW\Results\Tests\Entity;

use MiW\Results\Entity\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 *
 * @package MiW\Results\Tests\Entity
 * @group   users
 */
class UserTest extends TestCase
{
    /**
     * @var User $user
     */
    private $user;

    /**
     * Sets up the fixture.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->user = new User('rosario', 'rosario@correo.es', '1234', true, false);
    }

    /**
     * @covers \MiW\Results\Entity\User::__construct()
     * @covers |MiW\Results\Entity\User::getUsername()
     * @covers |MiW\Results\Entity\User::getEmail()
     * @covers |MiW\Results\Entity\User::isEnabled()
     * @covers |MiW\Results\Entity\User::isAdmin()
     */
    public function testConstructor(): void
    {
        self::assertEquals('rosario', $this->user->getUsername());
        self::assertNotEquals('correo@correo.es', $this->user->getEmail());
        self::assertEquals('rosario@correo.es', $this->user->getEmail());
        self::assertTrue($this->user->isEnabled());
        self::assertFalse($this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::getId()
     */
    public function testGetId(): void
    {
        self::assertEquals(0, $this->user->getId());
    }

    /**
     * @covers \MiW\Results\Entity\User::setUsername()
     * @covers \MiW\Results\Entity\User::getUsername()
     */
    public function testGetSetUsername(): void
    {
        $this->user->setUsername("ro");
        self::assertEquals("ro", $this->user->getUsername());
    }

    /**
     * @covers \MiW\Results\Entity\User::getEmail()
     * @covers \MiW\Results\Entity\User::setEmail()
     */
    public function testGetSetEmail(): void
    {
        $this->user->setEmail("ro@email.com");
        self::assertEquals("ro@email.com", $this->user->getEmail());
    }

    /**
     * @covers \MiW\Results\Entity\User::setEnabled()
     * @covers \MiW\Results\Entity\User::isEnabled()
     */
    public function testIsSetEnabled(): void
    {
        $this->user->setEnabled(false);
        self::assertFalse($this->user->isEnabled());
    }

    /**
     * @covers \MiW\Results\Entity\User::setIsAdmin()
     * @covers \MiW\Results\Entity\User::isAdmin
     */
    public function testIsSetAdmin(): void
    {
        $this->user->setIsAdmin(true);
        self::assertTrue($this->user->isAdmin());
    }

    /**
     * @covers \MiW\Results\Entity\User::setPassword()
     * @covers \MiW\Results\Entity\User::validatePassword()
     */
    public function testSetValidatePassword(): void
    {

        self::assertTrue($this->user->validatePassword("1234"));
    }

    /**
     * @covers \MiW\Results\Entity\User::__toString()
     */
    public function testToString(): void
    {
        self::assertEquals($this->user->getUsername(), $this->user->__toString());
    }

    /**
     * @covers \MiW\Results\Entity\User::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $jsonSerialize = $this->user->jsonSerialize();
        self::assertTrue(is_array($jsonSerialize));
    }
}
