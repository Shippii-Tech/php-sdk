<?php
declare(strict_types=1);

namespace Shippii\Resources;

use Shippii\Shippii;
use AllowDynamicProperties;

#[AllowDynamicProperties]
class  Resource
{
    /**
     * The resource attributes.
     *
     * @var array
     */
    public array $attributes;

    /**
     * Shippii attribute
     * @var Shippii|null
     */
    protected Shippii $shippii;

    /**
     * Create a new resource instance.
     *
     * @param  array       $attributes
     * @param Shippii|null $shippii
     * @return void
     */
    public function __construct(
        array $attributes,
        Shippii|null $shippii = null
    ) {
        $this->attributes = $attributes;
        $this->shippii = $shippii;

        $this->fill();
    }

    /**
     * Fill the resource with the array of attributes.
     *
     * @return void
     */
    protected function fill(): void
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    /**
     * Prepare a payload data
     *
     * @param array $columns
     * @return array
     */
    protected function preparePayload(array $columns): array
    {
        $payload = [];
        foreach ($columns as $column) {
            $property = $this->camelCase($column);
            if ($this->$property !== null) {
                $payload[$column] = $this->$property;
            }
        }

        return $payload;
    }

    /**
     * Convert the key name to camel case.
     *
     * @param  string  $key
     * @return string
     */
    protected function camelCase(string $key): string
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }

    public static function constructFrom(array $payload, Shippii $shippii)
    {
        $objectType = $payload['data']['object_type'];
        $data = $payload['data'][$objectType];
        $objectType = "Shippii\\Resources\\" . $objectType;
        unset($data['object_type']);

        $obj = new static($data, $shippii);

        $finalObject = self::recast($objectType, $obj, $shippii);
        return $finalObject;
    }

    public static function recast(string $className, self &$object, Shippii $shippii)
    {
        $new = new $className([], $shippii);

        foreach ($object as $property => &$value) {
            $new->$property = &$value;
            unset($object->$property);
        }
        unset($object);

        return $new;
    }
}
