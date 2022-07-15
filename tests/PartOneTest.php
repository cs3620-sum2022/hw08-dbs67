<?php
/**
 * Unit-test for Part 1
 *
 * PHP Version 8
 *
 * @category UnitTests
 * @package  Tests
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
declare(strict_types=1);
namespace App\Tests;

use App\MyHttpAction;
use App\MyHttpRequest;
use PHPUnit\Framework\TestCase;

/**
 * PartOneTest tests the HttpRequest and HttpResponse classes
 *
 * @category UnitTests
 * @package  App\Tests
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
class PartOneTest extends TestCase
{
    /**
     * Set up data needed for every unit-test
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   null
     */
    public function setUp(): void
    {
        $this->httpActions = new MyHttpAction();
        $this->harness = $this->httpActions->buildHttpRequest([MyHttpAction::URL_NAME => 'http://example.com']);
    }

    /**
     * Tests if unit-test can be run
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   null
     */
    public function testCanary(): void
    {
        // arrange & act & assert
        $this->assertTrue($this->harness instanceof MyHttpRequest);
    }

    /**
     * Tests send a simple request to http://example.com
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     */
    public function testExampleCom(): void
    {
        // arrange
        $this->harness->setHeader('Connection', 'keep-alive');
        // act
        $actual = $this->httpActions->send($this->harness);
        // assert
        $this->assertEquals(200, $actual->getStatusCode());
        $this->assertEquals($actual->getStatusCodeMsg(), "OK");
        $this->assertStringContainsString("<title>Example Domain</title>", $actual->getBody());
    }

    /**
     * Tests the HTTP request builder method.
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     */
    public function testBuildHttpRequest(): void
    {
        // arrange
        $args[MyHttpAction::URL_NAME] = 'http://example.com';
        $args[MyHttpAction::HTTP_METHOD] = 'GET';
        // act
        $actual = $this->httpActions->buildHttpRequest($args);
        // assert
        $this->assertEquals('GET', $actual->getMethod());
        $this->assertEquals('http://example.com', $actual->getUrl());
    }
}
