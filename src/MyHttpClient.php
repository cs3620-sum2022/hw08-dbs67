<?php
/**
 * MyHttpClient.php
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

class MyHttpClient implements MyHttpClientInterface {
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

    /**
     * Builds a HTTP response from the provided string.
     *
     * @param string $stringedResponse
     * @return MyHttpResponseInterface
     */
    public function buildHttpResponse(string $stringedResponse): MyHttpResponseInterface {
        if (empty($stringedResponse)) {
            throw new \InvalidArgumentException('$stringedResponse is EMPTY.');
        }

        $res = new MyHttpResponse();

        // Handle the first line of the response
        $responseArray = explode("\n", $stringedResponse);
        $metaDataArray = explode(" ", trim($responseArray[0]));
        $res->setMetaData($metaDataArray[0], $metaDataArray[1], $metaDataArray[2]);
        $bodyArrayOffset = -1;

        // Handle the headers.
        foreach ($responseArray as $k => $v) {
            if ($k == 0) continue;
            $vTrimed = trim($v);
            if ($vTrimed === "") {
                $bodyArrayOffset = $k;
                break;
            }
            $headerArray = $this->parseHeaderString($vTrimed);
            $res->setHeader($headerArray['header'], $headerArray['value']);
        }

        // Handle the body.
        $bodyString = '';
        for ($i = $bodyArrayOffset; $i < count($responseArray); $i++) {
            $bodyString .= trim($responseArray[$i]);
        }
        $res->setBody($bodyString);

        return $res;
    }

    /**
     * Parses a header string on the ": " tokens and returns an array with key, value elements.
     *
     * @param string $headerString
     * @return array
     */
    private function parseHeaderString(string $headerString): array {
        $headerArray = explode(': ', $headerString);

        if (count($headerArray) != 2) {
            throw new \InvalidArgumentException('$headerString is not a valid reponse header string');
        }

        return [
            'header' => $headerArray[0],
            'value' => $headerArray[1]
        ];
    }
}
