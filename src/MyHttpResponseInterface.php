<?php
/**
 * MyHttpResponseInterface.php
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
 * MyHttpResponseInterface abstract data type
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
interface MyHttpResponseInterface extends MyHttpInterface
{
    /**
     * GetStatusCodeMsg returns the http status code.
     *
     * @return int
     */
    public function getStatusCodeMsg();

    /**
     * SetStatusCodeMsg set the http status code.
     *
     * @param string $msg HTTP Status Code message
     *
     * @return int
     */
    public function setStatusCodeMsg($msg);

    /**
     * GetStatusCode returns the http status code.
     *
     * @return int
     */
    public function getStatusCode();

    /**
     * SetStatusCode set the http status code.
     *
     * @param int $statusCode HTTP Status Code
     *
     * @return int
     */
    public function setStatusCode($statusCode);
}
