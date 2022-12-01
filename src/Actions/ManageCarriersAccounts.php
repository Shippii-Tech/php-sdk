<?php
declare(strict_types=1);

namespace Shippii\Actions;

use Shippii\Resources\CarrierAccount;

trait ManageCarriersAccounts
{
    public function listCarriersAccounts(array $parameters = [])
    {
        $parameters = $this->prepareRequestParameters($parameters);
        $response = $this->get("carrier-account?{$parameters}");

        return $this->transformCollection(
            collection: $response['data'],
            class: CarrierAccount::class,
            meta: $response['meta'],
        );
    }

    public function createCarrierAccount(array $payload)
    {
        return new CarrierAccount($this->post('carrier-account', $payload)['data'], $this);
    }

    public function getCarrierAccount(string $carrierAccountId)
    {
        return new CarrierAccount($this->get("carrier-account/{$carrierAccountId}")['data'], $this);
    }

    public function updateCarrierAccount(string $carrierAccountId, array $payload)
    {
        return new CarrierAccount($this->patch("carrier-account/{$carrierAccountId}", $payload)['data'], $this);
    }

    public function deleteCarrierAccount(string $carrierAccountId)
    {
        return $this->delete("carrier-account/{$carrierAccountId}");
    }

    public function getCarrierAccountFields(string $carrierCode)
    {
        $attributes = [
            'fields' => $this->get("carrier-account/fields/{$carrierCode}")['data'],
            'carrier_code' => $carrierCode,
        ];

        return new CarrierAccount($attributes, $this);
    }
}