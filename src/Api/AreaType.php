<?php

namespace Impala\Api;

trait AreaType
{
    /**
     * Get all area types.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAreaTypes(array $params = [])
    {
        return $this->get('area-type', $params);
    }

    /**
     * Get a specific area type given its ID.
     *
     * @param string $areaTypeId ID of the area type to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAreaTypeById(string $areaTypeId)
    {
        return $this->get('area-type/' . $areaTypeId);
    }
}
