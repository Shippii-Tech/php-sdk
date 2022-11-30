<?php

namespace Shippii\Actions;

trait ManageCarriers
{
    public function listCarriers(string $parameters)
    {
        return $this->get("carrier?{$parameters}");
    }

    public function createCarrier(array $payload)
    {
        return $this->post('carrier', $payload);
    }

    public function getCarrier(string $carrierId)
    {
        return $this->get("carrier/{$carrierId}");
    }

    public function updateCarrier(string $carrierId, array $payload)
    {
        return $this->patch("carrier/{$carrierId}", $payload);
    }

    public function deleteCarrier(string $carrierId)
    {
        return $this->delete("carrier/{$carrierId}");
    }
}