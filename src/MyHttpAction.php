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
    public function send(MyHttpRequestInterface $request): MyHttpResponseInterface {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $request->getUrl());
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $res = curl_exec($ch);

        if ($res === false) {
            throw new \RuntimeException(curl_error($ch));
        }

        curl_close($ch);

        return $this->buildHttpResponse($res);
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
        if (empty($stringedResponse)) {
            throw new \InvalidArgumentException('$stringedResponse is EMPTY.');
        }

        $responseArray = explode("\n", $stringedResponse);

        print_r($responseArray);
        die();

        return new MyHttpResponse();
    }
}
