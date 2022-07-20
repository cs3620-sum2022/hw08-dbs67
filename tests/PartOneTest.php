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

use App\MyHttpClient;
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
        $this->httpClient = new MyHttpClient();
        $this->req = $this->httpClient->buildHttpRequest([MyHttpClient::URL_NAME => 'http://example.com']);
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
        $this->assertTrue($this->req instanceof MyHttpRequest);
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
        $this->req->setHeader('Connection', 'keep-alive');
        // act
        $actual = $this->httpClient->send($this->req);
        // assert
        $this->assertEquals(200, $actual->getStatusCode());
        $this->assertEquals("OK", $actual->getStatusCodeMsg());
        $this->assertStringContainsString("<title>Example Domain</title>", $actual->getBody());
        $this->assertArrayHasKey("Age", $actual->getHeaders());
        $this->assertArrayHasKey("Content-Type", $actual->getHeaders());
        $this->assertArrayHasKey("Date", $actual->getHeaders());
        $this->assertArrayHasKey("Last-Modified", $actual->getHeaders());
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
        $args[MyHttpClient::URL_NAME] = 'http://example.com';
        $args[MyHttpClient::HTTP_METHOD] = 'GET';
        // act
        $actual = $this->httpClient->buildHttpRequest($args);
        // assert
        $this->assertEquals('GET', $actual->getMethod());
        $this->assertEquals('http://example.com', $actual->getUrl());
    }

    /**
     * Tests the HTTP response builder method.
     *
     * @category UnitTests
     * @package  App\Tests
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     */
    public function testBuildHttpResponse(): void
    {
        // arrange
        $responseString = <<<TEXT
        HTTP/1.1 200 OK
        Age: 391045
        Cache-Control: max-age=604800
        Content-Type: text/html; charset=UTF-8
        Date: Tue, 19 Jul 2022 23:44:53 GMT
        Etag: "3147526947+ident"
        Expires: Tue, 26 Jul 2022 23:44:53 GMT
        Last-Modified: Thu, 17 Oct 2019 07:18:26 GMT
        Server: ECS (dna/63AA)
        Vary: Accept-Encoding
        X-Cache: HIT
        Content-Length: 1256

        <!doctype html>
        <html>
        <head>
            <title>Example Domain</title>

            <meta charset="utf-8" />
            <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1" />
            <style type="text/css">
            body {
                background-color: #f0f0f2;
                margin: 0;
                padding: 0;
                font-family: -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;

            }
            div {
                width: 600px;
                margin: 5em auto;
                padding: 2em;
                background-color: #fdfdff;
                border-radius: 0.5em;
                box-shadow: 2px 3px 7px 2px rgba(0,0,0,0.02);
            }
            a:link, a:visited {
                color: #38488f;
                text-decoration: none;
            }
            @media (max-width: 700px) {
                div {
                    margin: 0 auto;
                    width: auto;
                }
            }
            </style>
        </head>

        <body>
        <div>
            <h1>Example Domain</h1>
            <p>This domain is for use in illustrative examples in documents. You may use this
            domain in literature without prior coordination or asking for permission.</p>
            <p><a href="https://www.iana.org/domains/example">More information...</a></p>
        </div>
        </body>
        </html>
        TEXT;
        // act
        $actual = $this->httpClient->buildHttpResponse($responseString);
        // assert
        $this->assertEquals('200', $actual->getStatusCode());
        $this->assertEquals('OK', $actual->getStatusCodeMsg());
        $this->assertArrayHasKey("Age", $actual->getHeaders());
        $this->assertArrayHasKey("Content-Type", $actual->getHeaders());
        $this->assertArrayHasKey("Date", $actual->getHeaders());
        $this->assertArrayHasKey("Last-Modified", $actual->getHeaders());
    }
}
