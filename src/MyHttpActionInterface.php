<?php
/**
 * MyHttpActionInterface.php
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
 * MyHttpActionInterface abstract data type
 *
 * @category Source
 * @package  App
 * @author   Don Stringham <donstringham@weber.edu>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://weber.edu
 */
interface MyHttpActionInterface {
    /**
     * Send will send a request and return the response.
     *
     * @param MyHttpRequestInterface $request
     *
     * @return MyHttpResponseInterface
     */
    public function send(MyHttpRequestInterface $request);

    /**
     * buildHttpRequest news a HttpRequest and loads the passed in data.
     *
     * @param array $args
     *
     * @return MyHttpRequestInterface
     */
    public function buildHttpRequest(array $args): MyHttpRequestInterface;

    /**
     * buildHttpResponse news a HttpResponse and loads the passed in data.
     *
     * @param string $stringedResponse
     *
     * @return MyHttpResponseInterface
     */
    public function buildHttpResponse(string $stringedResponse): MyHttpResponseInterface;
}
