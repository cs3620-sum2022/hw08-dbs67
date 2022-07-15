<?php
/**
 * MyHttpResponse.php
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
 * MyHttpResponse models the HTTP response data structure
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
class MyHttpResponse implements MyHttpResponseInterface
{

    /**
     * Response status code
     *
     * @var int
     */
    private $_statusCode = 0;

    /**
     * Response status code reason
     *
     * @var string
     */
    private $_statusCodeMsg = '';

    /**
     * ToString returns a string representation of the class
     *
     * @category Source
     * @package  App
     * @author   Don Stringham <donstringham@weber.edu>
     * @license  MIT https://opensource.org/licenses/MIT
     * @link     https://weber.edu
     * @return   string
     */
    public function __toString(): string
    {
        return '/App/MyHttpResponse';
    }

    /**
     * GetBody returns request/response body
     *
     * @return string
     */
    public function getBody():string
    {
        return $this->_body;
    }

    /**
     * SetBody sets request/response body
     *
     * @param string $body Payload body
     *
     * @return void
     */
    public function setBody($body)
    {
        $this->_body = $body;
    }

    /**
     * GetHeaders returns request/response headers
     *
     * @return []
     */
    public function getHeaders():array
    {
        return $this->_headers;
    }

    /**
     * SetHeaders sets the request/response headers
     *
     * @param array $headers hash of strings
     */
    public function setHeaders($headers)
    {
        $this->_headers = $headers;
    }

    /**
     * SetHeader sets a request/response header
     *
     * @param string $header Header to set
     * @param string $value  Value of header
     *
     * @return void
     */
    public function setHeader($header, $value)
    {
        $this->_headers[$header] = $value;
    }

    /**
     * GetStatusCodeMsg returns the http status reason.
     *
     * @return string
     */
    public function getStatusCodeMsg(): string
    {
        return $this->_statusCodeMsg;
    }

    /**
     * SetStatusCodeMsg set the http status code.
     *
     * @param string $msg HTTP Status Code message
     *
     * @return void
     */
    public function setStatusCodeMsg($msg)
    {
        $this->_statusCodeMsg = $msg;
    }

    /**
     * GetStatusCode returns the http status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->_statusCode;
    }

    /**
     * SetStatusCode set the http status code.
     *
     * @param int $statusCode HTTP Status Code
     */
    public function setStatusCode($statusCode)
    {
        $this->_statusCode = $statusCode;
    }
    /**
     * SetMetaData sets meta data for the request/response.
     *
     * @param string $arg1 Method/Protocol
     * @param string $arg2 Path/Status Code
     * @param string $arg3 Protocol/Status Message
     *
     * @return void
     */
    public function setMetaData($arg1, $arg2, $arg3)
    {}

    /**
     * GetMetaData returns meta data for the request/response
     *
     * @return [] [$arg1, $arg2, $arg3]
     */
    public function getMetaData():array
    {
        return [];
    }
}
