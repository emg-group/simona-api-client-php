<?php declare(strict_types=1);

namespace EmgSystems\Simona\test;

use EmgSystems\Simona\Client;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for the API client
 * @package emg-systems/simona-api-client
 */
final class ClientTest extends TestCase
{
    protected Client $client;

    /**
     * Setting up test resources
     */
    function setUp(): void
    {
        $this->client = new Client('http', 'simona-bp.test');
    }

    /**
     * Testing the availability of cURL library
     */
    public function testFoo(): void
    {
        $this->assertTrue(Client::isAvailable());
    }

    /**
     * Loading monitoring sites and checking deserialization
     * @throws Exception
     */
    public function testMonitoringSiteLoading(): void
    {
        $monitoringSites = $this->client->monitoringSites('hu');
        $this->assertEquals(true, is_array($monitoringSites));
        $this->assertEquals('HU', $monitoringSites[0]->country);
    }

    /**
     * Loading water quality status information
     * @throws Exception
     */
    public function testWaterQuality(): void
    {
        $waterQuality = $this->client->waterQuality('HU101845839');
        $this->assertEquals(272417, $waterQuality->monitoringSiteId);
    }
}
