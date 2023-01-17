<?php
declare(strict_types=1);

namespace Shippii\Resources;

class ShipmentWebhook extends Resource
{
    public string $id;
    public string $reference;
    public string $system_reference;
    public array $sendable;
    public array $carrier;
    public array $label;
    public array $parcels;
}