<?php
declare(strict_types=1);

namespace Shippii\Actions;

use Shippii\Models\Message\Message;
use Shippii\Models\Shipment\Shipment;
use Shippii\Util\Util;

trait ManageShipments
{
    /**
     * Get Shipments
     *
     * @param array $queryParams
     * @return Shipment[]
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Shippii\Exceptions\FailedActionException
     * @throws \Shippii\Exceptions\NotFoundException
     * @throws \Shippii\Exceptions\RateLimitExceededException
     * @throws \Shippii\Exceptions\ValidationException
     */
    public function getShipments(array $queryParams = []): array
    {
        $parameters = $this->prepareRequestParameters($queryParams);
        $response = $this->get("v1/shipment?{$parameters}")['data'];

        return Util::convertToShippiiObjectCollection(Shipment::class, $response);
    }

    /**
     * Get Shipments
     *
     * @param string $shipmentId
     * @return Shipment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Shippii\Exceptions\FailedActionException
     * @throws \Shippii\Exceptions\NotFoundException
     * @throws \Shippii\Exceptions\RateLimitExceededException
     * @throws \Shippii\Exceptions\ValidationException
     */
    public function getShipment(string $shipmentId): Shipment
    {
        $response = $this->get("v1/shipment/{$shipmentId}")['data'];

        return Util::convertToShippiiObject(Shipment::class, $response);
    }

    /**
     * Create shipment
     *
     * @param array $payload
     * @return Shipment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Shippii\Exceptions\FailedActionException
     * @throws \Shippii\Exceptions\NotFoundException
     * @throws \Shippii\Exceptions\RateLimitExceededException
     * @throws \Shippii\Exceptions\ValidationException
     */
    public function createShipment(array $payload): Shipment
    {
        $response = $this->post('v1/shipment', $payload)['data'];

        return Util::convertToShippiiObject(Shipment::class, $response);
    }

    /**
     * Update shipment
     *
     * @param string $shipmentId
     * @param array $payload
     * @return Shipment
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Shippii\Exceptions\FailedActionException
     * @throws \Shippii\Exceptions\NotFoundException
     * @throws \Shippii\Exceptions\RateLimitExceededException
     * @throws \Shippii\Exceptions\ValidationException
     */
    public function updateShipment(string $shipmentId, array $payload): Shipment
    {
        $response = $this->patch("v1/shipment/{$shipmentId}", $payload)['data'];

        return Util::convertToShippiiObject(Shipment::class, $response);
    }

    /**
     * Update the state of a shipment.
     *
     * @param string $shipmentId
     * @param string $shipmentState
     * @return Message
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Shippii\Exceptions\FailedActionException
     * @throws \Shippii\Exceptions\NotFoundException
     * @throws \Shippii\Exceptions\RateLimitExceededException
     * @throws \Shippii\Exceptions\ValidationException
     */
    public function updateShipmentState(string $shipmentId, string $shipmentState): Message
    {
        $response = $this->post("v1/shipment/{$shipmentId}/update-state/{$shipmentState}");
        $response =  ['message' => $response['message']];

        return Util::convertToShippiiObject(Message::class, $response);
    }

    /**
     * Archive shipment
     *
     * @param string $shipmentId
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Shippii\Exceptions\FailedActionException
     * @throws \Shippii\Exceptions\NotFoundException
     * @throws \Shippii\Exceptions\RateLimitExceededException
     * @throws \Shippii\Exceptions\ValidationException
     */
    public function archiveShipment(string $shipmentId): void
    {
        $this->patch("v1/shipment/archive/{$shipmentId}");
    }
}