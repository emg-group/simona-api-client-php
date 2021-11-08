<?php

namespace EmgSystems\Simona;

use EmgSystems\Simona\Model\MonitoringSite;
use EmgSystems\Simona\Model\WaterQualityStatus;
use Exception;
use JsonMapper;

/**
 * Client of the SIMONA public API
 *
 * @package emg-systems/simona-api-client
 */
class Client
{
    /** @var resource */
    protected $curl;

    /** @var JsonMapper Service used for mapping JSON responses to objects */
    protected JsonMapper $mapper;

    /** @var string HTTP protocol used for accessing the API endpoints */
    private string $protocol;

    /** @var string Base URL use for creating absolute endpoint URLs */
    private string $baseUrl;

    /**
     * API client constructor.
     *
     * @param string|null $protocol
     * @param string|null $baseUrl
     */
    public function __construct(?string $protocol = null, ?string $baseUrl = null)
    {
        $config = json_decode(file_get_contents("config.json"));
        $this->protocol = $protocol ?? $config->API->protocol;
        $this->baseUrl = $baseUrl ?? $config->API->baseUrl;

        $this->initCurl();
        $this->mapper = new JsonMapper();
    }

    /**
     * Checks whether the cURL extension is available.
     *
     * @return bool
     */
    public static function isAvailable(): bool
    {
        return extension_loaded('curl');
    }

    /**
     * Loads surface water body monitoring sites within a country
     *
     * @param string $countryCode   ISO 3166-1 alpha-2 country code
     *
     * @return MonitoringSite[]
     * @throws Exception
     */
    public function monitoringSites(string $countryCode): array
    {
        $response = $this->execute('GET', "water-quality/monitoring-site/{$countryCode}");
        return $this->mapper->mapArray($response, [], MonitoringSite::class);
    }

    /**
     * Loads water quality status information about a single monitoring site
     *
     * @param string $thematicId   WISE id of the monitoring site
     *
     * @return WaterQualityStatus
     * @throws Exception
     */
    public function waterQuality(string $thematicId): WaterQualityStatus
    {
        $response = $this->execute('GET', "water-quality/status/monitoring-site/{$thematicId}");
        return $this->mapper->map($response, new WaterQualityStatus());
    }

    /**
     * Translates relative URI to absolute URL
     *
     * @param $uri string Endpoint URI
     *
     * @return string Absolute URL
     */
    protected function getUrl(string $uri): string
    {
        return "{$this->protocol}://{$this->baseUrl}/{$uri}";
    }

    /**
     * Executes an HTTP request and returns the response as an array
     *
     * @param string $httpMethod
     * @param string $uri
     *
     * @return mixed
     * @throws Exception
     */
    protected function execute(string $httpMethod, string $uri)
    {
        curl_setopt_array($this->curl, [
            CURLOPT_URL           => $this->getUrl($uri),
            CURLOPT_POST          => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($httpMethod)
        ]);
        $response = curl_exec($this->curl);
        $errorNumber = curl_errno($this->curl);
        if ($errorNumber) {
            throw new Exception(curl_error($this->curl), $errorNumber);
        }

        $body = $this->getResponseBody($response);
        if (!$body) {
            throw new Exception('Unprocessable response');
        }

        $json = json_decode($body);
        if (null === $json) {
            throw new Exception('Invalid response returned');
        }

        return $json;
    }

    protected function initCurl()
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, [
            CURLOPT_HTTPHEADER      => [
                'Accept: application/json'
            ],
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_AUTOREFERER     => true,
            CURLOPT_FOLLOWLOCATION  => false,
            CURLOPT_MAXREDIRS       => 20,
            CURLOPT_HEADER          => true,
            CURLOPT_PROTOCOLS       => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_USERAGENT       => 'SIMONA API Client (Curl)',
            CURLOPT_CONNECTTIMEOUT  => 30,
            CURLOPT_TIMEOUT         => 30
        ]);
    }

    /**
     * @param string $response
     *
     * @return string|null
     */
    protected function getResponseBody(string $response): ?string
    {
        $headerSize = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        return substr($response, $headerSize) ?: null;
    }
}
