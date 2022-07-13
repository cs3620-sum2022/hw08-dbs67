<?php
/**
 * MyHttpInterface.php
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
 * MyHttpInterface abstract data type
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
interface MyHttpInterface
{
    /**
     * GetHeaders returns request/response headers
     *
     * @return []
     */
    public function getHeaders():array;

    /**
     * SetHeaders sets the request/response headers
     *
     * @param array $headers hash of strings
     *
     * @return void
     */
    public function setHeaders($headers);

    /**
     * SetHeader sets a request/response header
     *
     * @param string $header Header to set
     * @param string $value  Value of header
     *
     * @return void
     */
    public function setHeader($header, $value);

    /**
     * GetBody returns request/response body
     *
     * @return string
     */
    public function getBody():string;

    /**
     * SetBody sets request/response body
     *
     * @param string $body Payload body
     *
     * @return void
     */
    public function setBody($body);

    /**
     * SetMetaData sets meta data for the request/response.
     *
     * @param string $arg1 Method/Protocol
     * @param string $arg2 Path/Status Code
     * @param string $arg3 Protocol/Status Message
     *
     * @return void
     */
    public function setMetaData($arg1, $arg2, $arg3);

    /**
     * GetMetaData returns meta data for the request/response
     *
     * @return [] [$arg1, $arg2, $arg3]
     */
    public function getMetaData():array;
}
