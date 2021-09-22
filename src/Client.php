<?php

namespace packlink;

use GuzzleHttp\Exception\GuzzleException;
use packlink\Model\ClientModel;
use packlink\Model\PackagingModel;
use packlink\Model\WarehousesModel;
use packlink\Util\Serialize;

class Client
{
    private Packlink $packlink;
    private Serialize $serialize;

    public function __construct(string $apiKey)
    {
        $this->packlink = new Packlink($apiKey);
        $this->serialize = new Serialize();
    }

    /**
     * @return ClientModel|null
     * @throws GuzzleException
     */
    public function getClient(): ?ClientModel
    {
        $response = $this->packlink->requestGet(Endpoint::ENDPOINT_CLIENT);

        if ($response === null) {
            return null;
        }

        return $this->serialize->deserializeClientModel($response);
    }

    /**
     * @return PackagingModel[]|null
     * @throws GuzzleException
     */
    public function getPackages(): ?array
    {
        $response = $this->packlink->requestGet(Endpoint::ENDPOINT_PACKAGES);

        if ($response === null) {
            return null;
        }

        return $this->serialize->deserializePackagingModel($response);
    }

    /**
     * @return WarehousesModel[]|null
     * @throws GuzzleException
     */
    public function getWarehouses(): ?array
    {
        $response = $this->packlink->requestGet(Endpoint::ENDPOINT_WAREHOUSES);

        if ($response === null) {
            return null;
        }

        return $this->serialize->deserializeWarehousesModel($response);
    }
}