<?php
declare(strict_types=1);

namespace Shippii\Models\Shipment;

use Shippii\Models\Address\Address;

final class ShipmentReceivable
{
    public string|null $id = null;
    public string|null $user_id = null;
    public string|null $first_name = null;
    public string|null $last_name = null;
    public string|null $email = null;
    public string|null $mobile_phone_e164 = null;
    public string|null $mobile_phone_national = null;
    public string|null $mobile_phone_raw = null;
    public string|null $registered_at = null;
    public string|null $created_at = null;
    public string|null $updated_at = null;
    public string|null $type = null;
    public Address|null $address = null;
}