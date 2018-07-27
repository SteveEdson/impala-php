<?php

namespace Impala\Api;

trait Allocation
{
    /**
     * Get all allocations.
     *
     * @param array $params Optional params to be passed to request.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAllocations(array $params = [])
    {
        return $this->get('allocation', $params);
    }

    /**
     * Get a specific allocation given its ID.
     *
     * @param string $allocationId ID of the allocation to retrieve.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAllocationById(string $allocationId)
    {
        return $this->get('allocation/' . $allocationId);
    }
}
