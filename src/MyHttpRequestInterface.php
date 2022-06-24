<?php
/**
 * MyHttpRequestInterface.php
 *
 * PHP Version 8
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
declare(strict_types=1);
namespace App;

/**
 * MyHttpRequestInterface abstract data type
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
interface MyHttpRequestInterface extends MyHttpInterface
{
    /**
     * GetMethod returns the request method, ie. GET, POST, etc...
     *
     * @return string
     */
    public function getMethod();

    /**
     * SetMethod sets the request method, ie. GET, POST, etc...
     *
     * @param string $method HTTP method
     *
     * @return void
     */
    public function setMethod($method);

    /**
     * Send issues the HTTP request
     *
     * @return /App/MyHttpResponse
     */
    public function send(): MyHttpResponse;

    /**
     * GetUrl returns the request's url.
     *
     * @return string
     */
    public function getUrl();

    /**
     * SetUrl sets the request's url.
     *
     * @param string $url HTTP request url
     *
     * @return void
     */
    public function setUrl($url);
}
