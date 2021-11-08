<?php declare(strict_types=1);

namespace EmgSystems\Simona\test;

use EmgSystems\Simona\Client;
use Exception;
use PHPUnit\Framework\TestCase;

/**
 * Unit test for the API client
 *
 * @package emg-systems/simona-api-client
 * @covers  \EmgSystems\Simona\Client
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
    public function testAvailability(): void
    {
        $this->assertTrue(Client::isAvailable());
    }

    /**
     * Loading monitoring sites and checking deserialization
     *
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
     *
     * @throws Exception
     */
    public function testWaterQuality(): void
    {
        $waterQuality = $this->client->waterQuality('HU101845839');
        $this->assertEquals(272417, $waterQuality->monitoringSiteId);
    }

    /**
     * Testing exception on Curl error.
     *
     * @throws Exception
     */
    public function testCurlError(): void
    {
        $client = new Client('ftp', 'simona-bp.test');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Protocol "ftp" not supported or disabled in libcurl');
        $this->expectExceptionCode(1);
        $client->monitoringSites('hu');
    }

    /**
     * Testing response body is null.
     *
     * @throws Exception
     */
    public function testNullResponseBody(): void
    {
        $client = $this->getMockBuilder(Client::class)->onlyMethods(['getResponseBody'])->getMock();
        $client->expects(self::once())->method('getResponseBody')->willReturn(null);
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Unprocessable response');
        $client->monitoringSites('hu');
    }

    /**
     * Testing response body is invalid json.
     *
     * @throws Exception
     */
    public function testInvalidJsonBody(): void
    {
        $client = $this->getMockBuilder(Client::class)->onlyMethods(['getResponseBody'])->getMock();
        $client->expects(self::once())->method('getResponseBody')->willReturn('{');
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid response returned');
        $client->monitoringSites('hu');
    }
}
