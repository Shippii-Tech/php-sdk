<?php
declare(strict_types=1);

namespace Shippii\Models\Shipment;

use Shippii\Models\Tag\Tag;
use Shippii\Models\Line\Line;
use Shippii\Models\User\User;
use Shippii\Models\Label\Label;
use Shippii\Models\Parcel\Parcel;
use Shippii\Models\Address\Address;
use Shippii\Models\Carrier\Carrier;
use Shippii\Models\ActivityLog\ActivityLog;
use Shippii\Models\OrganisationObject\OrganisationObject;
use Shippii\Models\Shipment\ShipmentReceivable;

final class Shipment
{
    const OBJECT_NAME = 'shipment';
    
    public string|null $id = null;
    public string|null $rate_id = null;
    public int|null $type = null;
    public string|null $state = null;
    /** @var ShipmentMetadata[]|null  */
    public array|null $metadata = null;
    /** @var Tag[]|null  */
    public array|null $tags = null;
    public string|null $group = null;
    public string|null $creator_id = null;
    public string|null $creator_type = null;
    public string|null $sendable_id = null;
    public string|null $sendable_address_id = null;
    public string|null $receivable_id = null;
    public string|null $receivable_address_id = null;
    public string|null $sendable_reference = null;
    public string|null $system_reference = null;
    public Address|null $receivable_address = null;
    public ShipmentReceivable|null $receivable = null;
    public ShipmentReceivable|null $receiver = null;
    public Address|null $sendable_address = null;
    public OrganisationObject|null $organisation_object = null;
    public string|null $carrier_identification = null;
    public Carrier|null $carrier = null;
    public User|null $creator = null;
    /** @var Line[]|null  */
    public array|null $shipment_lines = null;
    /** @var ActivityLog[]|null  */
    public array|null $logs = null;
    public ShipmentCarrierData|null $shipment_carrier_data = null;
    public string|null $created_at = null;
    public string|null $updated_at = null;

    public string|null $reference = null;
    public ShipmentSendable|null $sendable = null;
    public Label|null $label = null;
    /** @var Parcel[]|null */
    public array|null $parcels = null;
}