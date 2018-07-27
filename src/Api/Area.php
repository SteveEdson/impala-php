<?php

namespace Impala\Api;

trait Area
{
    /**
     * Get all areas.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAreas(array $params = [])
    {
        return $this->get('area', $params);
    }

    /**
     * Get a specific area given its ID.
     *
     * @param string $areaId ID of the area to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAreaById(string $areaId)
    {
        return $this->get('area/' . $areaId);
    }
}
