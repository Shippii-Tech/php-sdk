<?php
declare(strict_types=1);

namespace Shippii;

use GuzzleHttp\Client as HttpClient;
use Shippii\Actions\ManageCarriers;
use Shippii\Actions\ManageCarriersAccounts;
use Shippii\Actions\ManageCountries;
use Shippii\Actions\ManageInvoices;
use Shippii\Actions\ManageLabels;
use Shippii\Actions\ManageOrganisationObjects;
use Shippii\Actions\ManageOrganisations;
use Shippii\Actions\ManageShipments;
use Shippii\Actions\ManageUsers;

class Shippii
{
    use MakesHttpRequests,
        ManageCountries,
        ManageShipments,
        ManageCarriersAccounts,
        ManageCarriers,
        ManageUsers,
        ManageOrganisations,
        ManageLabels,
        ManageOrganisationObjects,
        ManageInvoices;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public int $timeout = 30;

    /**
     * The Shippii Key
     *
     * @var string
     */
    public string $apiKey;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public HttpClient $guzzle;

    /**
     * Create a new Forge instance.
     *
     * @param string|null $apiKey
     */
    public function __construct(string $apiKey = null, HttpClient $guzzle = null)
    {
        if ($apiKey !== null) {
            $this->setApiKey($apiKey, $guzzle);
        }

        if (! is_null($guzzle)) {
            $this->guzzle = $guzzle;
        }
    }

    /**
     * Set a new timeout.
     *
     * @param  int  $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Set the api key and setup the guzzle request object.
     *
     * @return $this
     */
    public function setApiKey(string $apiKey, $guzzle = null)
    {
        $this->apiKey = $apiKey;
        //$host = 'https://api.shippii.dev/';
        $host = "http://shippii.test";
        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => $host,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param array  $collection
     * @param string $class
     * @param array  $extraData
     * @param array  $meta
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [], $meta = []): array
    {
        $collection = array_map(function ($data) use ($class, $extraData) {
            if (is_array($data)) {
                return new $class($data + $extraData, $this);
            }
        }, $collection);

        $collection['meta'] = $meta;

        return $collection;
    }

    /**
     * Prepare query parameters string
     *
     * @param array $parameters
     * @return string
     */
    protected function prepareRequestParameters(array $parameters): string
    {
        $queryParameters = '';
        foreach ($parameters as $name => $value)
        {
            $queryParameters .= "{$name}={$value}&";
        }

        return $queryParameters;
    }
}