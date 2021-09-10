<?php

namespace EmgSystems\Simona\Model;

/**
 * Class WaterQualityStatus
 * Represents risk assessment results for a monitoring site
 *
 * @package emg-systems/simona-api-client
 */
class WaterQualityStatus
{
    /**
     * @var int SIMONA identifier of the monitoring site
     */
    public int $monitoringSiteId;

    /**
     * @var string WISE identifier of the monitoring site
     */
    public string $thematicId;

    /**
     * @var string Monitoring site name
     */
    public string $monitoringSiteName;

    /**
     * @var string Water quality status
     */
    public string $status;

    /**
     * @var string Risk assessment result
     */
    public string $risk;

    /**
     * @var array Geographic location of the monitoring site in WGS84 coordinates
     */
    public array $coordinates;
}
