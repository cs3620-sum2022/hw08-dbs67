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

class MyHttpAction implements MyHttpActionInterface {
    const URL_NAME = 'url';
    const HTTP_METHOD = 'GET';

    // TODO Add doc blocks
    public function send(MyHttpRequestInterface $request) {
        $responseString = file_get_contents('http://www.example.com/');

        if ($responseString === false) {
            throw new \RuntimeException("FAILED: at the request or to get a response");
        }

        $response = new MyHttpResponse();

        $response->setStatusCode(200);
        $response->setStatusCodeMsg("OK");
        $response->setBody($responseString);

        return $response;
    }

    // TODO Add doc blocks
    public function buildHttpRequest(array $args): MyHttpRequestInterface {
        if (count($args) === 0) {
            throw new \InvalidArgumentException('You must provide at least one parameter in $args.');
        }

        if (empty($args[$this::URL_NAME])) {
            throw new \InvalidArgumentException('You must provide an URL_NAME parameter in $args.');
        }

        if (!empty($args[$this::HTTP_METHOD])) {
            return new MyHttpRequest($args[$this::URL_NAME], $args[$this::HTTP_METHOD]);
        }

        return new MyHttpRequest($args[$this::URL_NAME]);
    }

    // TODO Add doc blocks
    public function buildHttpResponse(string $stringedResponse): MyHttpResponseInterface {
        // TODO Parse the response string to the appropriate parts.
        return new MyHttpResponse();
    }
}
