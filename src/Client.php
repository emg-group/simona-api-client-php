<?php

namespace EmgSystems\Simona;

use EmgSystems\Simona\Model\MonitoringSite;
use EmgSystems\Simona\Model\WaterQualityStatus;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Client of the SIMONA public API
 * @package emg-systems/simona-api-client
 */
class Client
{
    const PROTOCOL = 'https';
    const BASE_URL = 'simona.emg.systems';

    /** @var resource */
    protected $curl;

    protected Serializer $serializer;

    /**
     * API client constructor.
     */
    public function __construct()
    {
        $this->initCurl();
        $this->serializer = new Serializer(
            [
                new ObjectNormalizer(),
                new ArrayDenormalizer(),
                new DateTimeNormalizer()],
            [new JsonEncoder()]);
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
     * @param string $countryCode ISO 3166-1 alpha-2 country code
     * @return MonitoringSite[]
     * @throws Exception
     */
    public function monitoringSites(string $countryCode): array
    {
        $json = $this->execute('GET', "water-quality/monitoring-site/{$countryCode}");
        return $this->serializer->deserialize($json, MonitoringSite::class . '[]', 'json');
    }

    /**
     * Loads water quality status information about a single monitoring site
     *
     * @param string $thematicId WISE id of the monitoring site
     * @return WaterQualityStatus
     * @throws Exception
     */
    public function waterQuality(string $thematicId): WaterQualityStatus
    {
        $json = $this->execute('GET', "water-quality/status/monitoring-site/{$thematicId}");
        return $this->serializer->deserialize($json, WaterQualityStatus::class, 'json');
    }

    /**
     * Translates relative URI to absolute URL
     *
     * @param $uri string Endpoint URI
     * @return string Absolute URL
     */
    protected function getUrl(string $uri): string
    {
        return self::PROTOCOL . '://' . self::BASE_URL . '/' . $uri;
    }

    /**
     * Executes an HTTP request and returns the response as an array
     * @param string $httpMethod
     * @param string $uri
     * @return string
     * @throws Exception
     */
    protected function execute(string $httpMethod, string $uri): string
    {
        curl_setopt_array($this->curl, [
            CURLOPT_URL => $this->getUrl($uri),
            CURLOPT_POST => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($httpMethod)
        ]);
        $response = curl_exec($this->curl);
        if ($errorNumber = curl_errno($this->curl)) {
            throw new Exception(curl_error($this->curl), $errorNumber);
        }
        $headerSize = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
        $body = substr($response, $headerSize);

        if (!$body) {
            throw new Exception('Unprocessable response');
        }

        return $body;
    }

    protected function initCurl()
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, [
            CURLOPT_HTTPHEADER => [
                'Accept: application/json'
            ],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_AUTOREFERER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_MAXREDIRS => 20,
            CURLOPT_HEADER => true,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS,
            CURLOPT_USERAGENT => 'SIMONA API Client (Curl)',
            CURLOPT_CONNECTTIMEOUT => 30,
            CURLOPT_TIMEOUT => 30
        ]);
    }


}
