<?php

namespace Impala;

interface ApiInterface
{
    /**
     * Makes a request to Impala API.
     *
     * @param string $method The HTTP method to use.
     * @param string $url    The endpoint of the API to call.
     * @param array  $params Optional parameters to pass in the request.
     * @return $response
     */
    public function makeRequest(string $method, string $url, array $params = []);
}
