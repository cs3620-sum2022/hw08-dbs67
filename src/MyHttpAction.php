<?php
/**
 * MyHttpAction.php
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

const URL_NAME = 'url';
const HTTP_METHOD = 'GET';

class MyHttpAction implements MyHttpActionInterface {

    public function send(MyHttpRequestInterface $request) {
        $response = new MyHttpResponse();

        return $response;
    }

    public function buildHttpRequest(array $args): MyHttpRequestInterface {
        /**
         * $args[URL_NAME] = 'http://example.com';
         * $args[HTTP_METHOD] = 'GET';
         */
        return new MyHttpRequest($args[URL_NAME]);
    }

    public function buildHttpResponse(string $stringedResponse): MyHttpResponseInterface {
        // TODO Parse the response string to the appropriate parts.
        return new MyHttpResponse();
    }
}
