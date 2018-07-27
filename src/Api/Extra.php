<?php

namespace Impala\Api;

trait Extra
{
    /**
     * Get all extras.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getExtras(array $params = [])
    {
        return $this->get('extra', $params);
    }

    /**
     * Get a specific extra given its ID.
     *
     * @param string $extraId ID of the extra to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getExtraById(string $extraId)
    {
        return $this->get('extra/' . $extraId);
    }
}
