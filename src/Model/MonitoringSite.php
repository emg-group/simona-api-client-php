<?php

namespace EmgSystems\Simona\Model;

/**
 * Class MonitoringSite
 *
 * Schema: http://dd.eionet.europa.eu/schemas/WFD2016/GML_MonitoringSite_2016.xsd
 * Elements: http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite
 *
 * @package emg-systems/simona-api-client
 */
class MonitoringSite
{
    /**
     * @var int
     */
    public int $monitoringSiteId;

    /**
     * Operational activity period - begin
     *
     * Beginning of the time period during which the monitoring site has been up and running.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/operationalActivityPeriodBegin
     *
     * @var \DateTime|null
     * @wiseId operationalActivityPeriodBegin
     */
    public ?\DateTime $opActBegin;

    /**
     * Operational activity period - end
     *
     * End of the time period during which the monitoring site has been up and running.
     * This value is required only if the end of the operational period is known or has already occurred.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/operationalActivityPeriodEnd
     *
     * @var \DateTime|null
     * @wiseId operationalActivityPeriodEnd
     */
    public ?\DateTime $opActEnd;

    /**
     * Related to - identifier
     *
     * Identifier of a related monitoring site.
     * Required only for WFD monitoring sites that are also EIONET monitoring sites (i.e. required if the value of the
     * "thematicIdIdentifierScheme" is 'euMonitoringSiteCode'). Please report the EIONET monitoring site code. The
     * EIONET monitoring site code must be a unique European code created according to the same syntax and principles
     * of the WFD European code:
     * - Use the 2-alpha character ISO country code as a prefix to the national code. (Use 'EL' for Greece and 'UK' for
     * the United Kingdom.)
     * - Use upper case letters and numbers in the national code. The hyphen '-' and the underscore '_' characters are
     * also allowed.
     * - Do not use characters with accents and other diacritical marks (national characters). Do not use spaces or
     * other special characters.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/relatedToIdentifier
     *
     * @var string
     * @wiseId relatedToIdentifier
     */
    public string $rSiteId;

    /**
     * Related to - identifier scheme
     *
     * Identifier defining the scheme used to assign the identifier value(s) in the "relatedToIdentifier" field.
     * This value is required if the "relatedToIdentifier" value is provided.
     * Use the value 'eionetMonitoringSiteCode'.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/relatedToIdentifierScheme
     *
     * @var string
     * @wiseId relatedToIdentifierScheme
     */
    public string $rSiteIdSch;

    /**
     * Feature of interest - identifier
     *
     * Identifier of the surface water body, groundwater body or marine region or sub-region being monitored.
     * This value is required.
     * Use the "thematicIdIdentifier" value of the surface water body or groundwater body, or marine region or
     * sub-region (as in http://dd.eionet.europa.eu/vocabulary/msfd/regions) to which this monitoring site is assigned.
     * The identifier information must be supplemented by providing the respective identifier scheme information in the
     * "featureOfInterestIdentifierScheme" field. For marine waters it is preferred to report the marine sub-region to
     * which the monitoring site is assigned, if available.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/featureOfInterestIdentifier
     *
     * @var string
     * @wiseId featureOfInterestIdentifier
     */
    public string $foiId;

    /**
     * Feature of interest - identifier scheme
     *
     * Identifier defining the scheme used to assign the identifier value(s) in the "featureOfInterest" attribute.
     * This value is required.
     * For surface water bodies:
     * - Use 'euSurfaceWaterBodyCode' for WFD identifiers
     * - Use 'eionetSurfaceWaterBodyCode' for EIONET identifiers
     *
     * For groundwater bodies:
     * - Use 'euGroundWaterBodyCode' for WFD identifiers
     * - Use 'eionetGroundWaterBodyCode' for EIONET identifiers
     *
     * For marine waters:
     * - Use 'euMarineRegionCode' for waters beyond the territorial waters, if territorial waters have been reported
     * under the WFD, or for waters including the territorial waters, if territorial waters have not been reported
     * under the WFD
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/featureOfInterestIdentifierScheme
     *
     * @var string
     * @wiseId featureOfInterestIdentifierScheme
     */
    public string $foiIdSch;

    /**
     * Media monitored - biota
     *
     * Monitored environmental medium.
     * Use the value 'true' if biota is being monitored on this site, otherwise use the value 'false'.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/mediaMonitoredBiota
     *
     * @var bool
     * @wiseId mediaMonitoredBiota
     */
    public bool $mediaBiota;

    /**
     * Media monitored - water
     *
     * Monitored environmental medium.
     * Use the value 'true' if water is being monitored on this site, otherwise use the value 'false'.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/mediaMonitoredWater
     *
     * @var bool
     * @wiseId mediaMonitoredWater
     */
    public bool $mediaWater;

    /**
     * Media monitored - sediment
     *
     * Monitored environmental medium.
     * Use the value 'true' if sediment is being monitored on this site, otherwise use the value 'false'.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/mediaMonitoredSediment
     *
     * @var bool
     * @wiseId mediaMonitoredSediment
     */
    public bool $mediaSedim;

    /**
     * Monitoring purpose
     *
     * Monitoring purpose code(s).
     * Use a comma-separated list of values if the monitoring site has more than one of the following purposes:
     *
     * 'SUR' Surveillance monitoring
     * 'OPE' Operational monitoring
     * 'INV' Investigative monitoring
     * 'ECO' Ecological status
     * 'CHE' Chemical status
     * 'QUA' Quantitative status
     * 'TRE' Chemical trend assessment
     * 'DWD' Drinking water - WFD Annex IV.1.i
     * 'SHE' Shellfish designated waters - WFD Annex IV.1.ii
     * 'BWD' Recreational or bathing water - WFD Annex IV.1.iii
     * 'UWW' Nutrient sensitive area under the Urban Waste Water Treatment Directive - WFD Annex IV.1.iv
     * 'NID' Nutrient sensitive area under the Nitrates Directive - WFD Annex IV.1.iv
     * 'HAB' Protection of habitats or species depending on water - WFD Annex IV.1.v
     * 'RIV' International network of a river convention (including bilateral agreements)
     * 'SEA' International network of a sea convention
     * 'INT' International network of other international convention
     * 'SOE' EIONET State of Environment monitoring
     * 'QTY' Water quantity
     * 'LEV' Water quantity - groundwater level
     * 'FLO' Water quantity - streamflow
     * 'GWA' Groundwater abstraction site
     * 'AGR' Groundwater abstraction site for irrigation
     * 'IND' Groundwater abstraction site for industrial supply
     * 'DRI' Groundwater abstraction site for human consumption
     * 'MAR' Transitional, coastal or marine monitoring site
     * 'SPA' Spatial distribution monitoring
     * 'TTM' Temporal trend monitoring
     * 'MSF' Marine Strategy Framework Directive monitoring network
     * 'REF' Reference network monitoring site
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/purpose
     *
     * @var array
     * @preprocessor explode
     * @wiseId       purpose
     */
    public array $purpose;

    /**
     * Catchment area
     *
     * The area of the catchment above the monitoring site (in square kilometre).
     * This value is required for monitoring sites reported under WISE SoE reporting and located in rivers.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/catchmentArea
     *
     * @var float|null
     * @wiseId catchmentArea
     */
    public ?float $catchArea;

    /**
     * Maximum sampling depth
     *
     * Maximum sampling depth on the monitoring site (in metre).
     * This value is required for monitoring sites reported under WISE SoE reporting and located in lakes and standing
     * water bodies.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/maximumDepth
     *
     * @var float|null
     * @wiseId maximumDepth
     */
    public ?float $maxDepth;

    /**
     * Confidentiality status
     *
     * Information about the sensitivity and confidentiality status of the monitoring site location.
     * By default, all data is publicly available and free for publication. For safety or security reasons a flag can
     * be used indicating that the location of some monitoring sites (e.g. drinking water abstractions) should not be
     * published. This information is requested if reporting under WISE SoE. The default value is 'F' (free for
     * publication). The value 'N' (not for publication, restricted for internal use only) will prevent the publication
     * of the monitoring site location in the WISE dissemination products. This flag applies only to the location data:
     * the time series will still be made available. This flag does not prevent public access to data files delivered
     * to the Eionet Central Data Repository, if access to the envelopes is not restricted by the Data Provider.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/confidentialityStatus
     *
     * @var string
     * @wiseId confidentialityStatus
     */
    public string $confStatus;

    /**
     * INSPIRE identifier - local identifier
     *
     * A local identifier, assigned by the data provider.
     * The local identifier is unique within the namespace, that is no other spatial object carries the same unique
     * identifier. It is the responsibility of the data provider to guarantee uniqueness of the local identifier within
     * the namespace.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/inspireIdLocalId
     *
     * @var string
     * @wiseId inspireIdLocalId
     */
    public string $localId;

    /**
     * INSPIRE identifier - namespace
     *
     * Namespace uniquely identifying the data source of the spatial object.
     * The namespace value will be owned by the data provider of the spatial object and will be registered in the
     * INSPIRE External Object Identifier Namespaces Register.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/inspireIdNamespace
     *
     * @var string
     * @wiseId inspireIdNamespace
     */
    public string $namespace;

    /**
     * INSPIRE identifier - version identifier
     *
     * The identifier of the particular version of the spatial object, with a maximum length of 25 characters.
     * If the specification of a spatial object type with an external object identifier includes life-cycle
     * information, the version identifier is used to distinguish between the different versions of a spatial object.
     * Within the set of all versions of a spatial object, the version identifier is unique. Note 1: The maximum length
     * has been selected to allow for time stamps based on ISO 8601, for example, "2007-02-12T12:12:12+05:30" as the
     * version identifier. Note 2: The property is void, if the spatial data set does not distinguish between different
     * versions of the spatial object. It is missing, if the spatial object type does not support any life-cycle
     * information.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/inspireIdVersionId
     *
     * @var string
     * @wiseId inspireIdVersionId
     */
    public string $versionId;

    /**
     * Thematic identifier - identifier
     *
     * Unique European identifier of the monitoring site.
     * Unique identifier used to identify the spatial object within the specified identification scheme.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/thematicIdIdentifier
     *
     * @var string
     * @wiseId thematicIdIdentifier
     */
    public string $thematicId;

    /**
     * Thematic identifier - identifier scheme
     *
     * Identifier defining the scheme used to assign the thematic identifier.
     * NOTE 1: Reporting requirements for different environmental legislation mandate that each spatial object is
     * assigned an identifier conforming to specific lexical rules. NOTE 2: These rules are often inconsistent so a
     * spatial object may be assigned multiple identifiers which are used for object referencing to link information to
     * the spatial object.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/thematicIdIdentifierScheme
     *
     * @var string
     * @wiseId thematicIdIdentifierScheme
     */
    public string $themaIdSch;

    /**
     * Version lifespan - begin
     *
     * Date at which this version of the spatial object was inserted or changed by country in the spatial data set.
     * This value is required, if the "endLifespanVersion" value is reported.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/beginLifespanVersion
     *
     * @var \DateTime
     * @wiseId beginLifespanVersion
     */
    public \DateTime $beginLife;

    /**
     * Version lifespan - end
     *
     * Date at which this version of the spatial object was superseded or retired in the spatial data set.
     * This value is required, if the version of the spatial object being reported is now obsolete in the national
     * spatial data set. This attribute is kept in the data model to allow future updates and support the traceability
     * of changes to objects previously reported.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/endLifespanVersion
     *
     * @var \DateTime|null
     * @wiseId endLifespanVersion
     */
    public ?\DateTime $endLife;

    /**
     * Supersedes - identifier
     *
     * Identifiers of the spatial objects that have been deactivated and replaced by this one.
     * This value is required if the presently reported object replaces other objects previously reported.
     * Data Providers should report a comma-separated list with the 'thematicIdIdentifier' value of the objects that
     * have been replaced by the presently reported object. Note that this applies even if the geometry of the replaced
     * object was not reported. Note that this attribute does not apply to the case where a newer version of the same
     * object is being reported.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/supersedesIdentifier
     *
     * @var string
     * @wiseId supersedesIdentifier
     */
    public string $predecesId;

    /**
     * Supersedes - identifier scheme
     *
     * Identifier defining the scheme used to assign the identifier value(s) in the "supersedesIdentifier" attribute.
     * This value is required if the "supersedesIdentifier" is reported.
     * Use the value 'euMonitoringSiteCode' for WFD monitoring site identifiers.
     * Use the value 'eionetMonitoringSiteCode' for any other monitoring site identifiers reported under an EIONET data
     * flow.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/supersedesIdentifierScheme
     *
     * @var string
     * @wiseId supersedesIdentifierScheme
     */
    public string $predeIdSch;

    /**
     * Superseded by - identifier
     *
     * Identifier(s) of the newly active spatial object(s) that replace the current one.
     * This value is required if the presently reported object has been replaced.
     * Data Providers should report a comma-separated list with the 'thematicIdIdentifier' value of the objects that
     * have replaced the presently reported object. Note that this applies even if the geometry of the new objects was
     * not reported. Note that this attribute does not apply to the case where a newer version of the same object is
     * being reported.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/supersededByIdentifier
     *
     * @var string
     * @wiseId supersededByIdentifier
     */
    public string $successoId;

    /**
     * Superseded by - identifier scheme
     *
     * Identifier defining the scheme used to assign the identifier value(s) in the "supersededByIdentifier" attribute.
     * This value is required if the "supersededByIdentifier" is reported.
     * Use the value 'euMonitoringSiteCode' for WFD monitoring site identifiers.
     * Use the value 'eionetMonitoringSiteCode' for any other monitoring site identifiers reported under an EIONET data
     * flow.
     *
     * http://dd.eionet.europa.eu/datasets/latest/WISE_SpatialData/tables/MonitoringSite/elements/supersededByIdentifierScheme
     *
     * @var string
     * @wiseId supersededByIdentifierScheme
     */
    public string $succeIdSch;

    /**
     * WISE evolution type
     *
     * Type of the event that produced modified version of the object being reported (creation, change, deletion,
     * aggregation, splitting).
     *
     * This value is required.
     * This attribute is required to explicitly report changes and update the current status of the object in the Water
     * Information System for Europe. The following allowable values have the same meaning defined in the INSPIRE SU
     * theme: 'creation', 'deletion', 'aggregation', 'splitting' and 'change'. The allowable values are based on those
     * defined in http://inspire.ec.europa.eu/codelist/EvolutionType... codelist. See also Annex F of the INSPIRE Data
     * Specification on Statistical Units (D2.8.III.1_v3.0RC3) for examples of application. For the purposes of the
     * WISE reporting, the change types required in the WFD reporting were added: 'changeCode',
     * 'changeBothAggregationAndSplitting', 'changeExtendedArea', 'changeExtendedDepth', 'changeExtendedAreaAndDepth',
     * 'changeReducedArea', 'changeReducedDepth', 'changeReducedAreaAndDepth', 'noChange'. Please note that the
     * 'noChange' should not be used if predecessors or successors are reported for a given spatial object. A typical
     * example for the use of the 'noChange' option is the reporting of a water body that had no geometry or identifier
     * changes since the 1st RBMP reporting cycle. Please refer to the section on 'Life cycle information' in the WISE
     * GIS Guidance for further information.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/wiseEvolutionType
     *
     * @var string
     * @wiseId wiseEvolutionType
     */
    public string $wEvolution;

    /**
     * Name - english version
     *
     * Name of the spatial object, in English.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/nameTextInternational
     *
     * @var string
     * @wiseId nameTextInternational
     */
    public string $nameTxtInt;

    /**
     * Name - national version
     *
     * Name, in the national language.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/nameText
     *
     * @var string
     * @wiseId nameText
     */
    public string $nameText;

    /**
     * Name - language code
     *
     * Language code of the language used in the "nameText" field.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/nameLanguage
     *
     * @var string
     * @wiseId nameLanguage
     */
    public string $nameTxtLan;

    /**
     * Link
     *
     * Hyperlink to where additional information on the spatial object is available on the web, at national level.
     *
     * http://dd.eionet.europa.eu/dataelements/latest/link
     *
     * @var string
     * @wiseId link
     */
    public string $link;

    /**
     * Integer field containing the value 2010 in the shapefiles pertaining to WFD2010 and the value 2016 in the
     * shapefiles pertaining to WFD2016
     *
     * @var int
     */
    public int $cYear;

    /**
     * Status code of the thematic identifier in the WISE register (refer to Status
     * [http://dd.eionet.europa.eu/vocabulary/datadictionary/status/] for further information).
     *
     * @var string
     */
    public string $statusCode;

    /**
     * Date of reference for the status code (typically the date when the data is extracted for publication).
     *
     * @var \DateTime|null
     */
    public ?\DateTime $statusDate;

    /**
     * Currently used only for records where cYear = 2010, provides information about the reason why a given identifier
     * has been superseded or deprecated, or why the 2010 and 2016 objects are not identical.
     *
     * @var string
     */
    public string $remarks;

    /**
     * ISO 3166-1 alpha-2
     *
     * @var string
     */
    public string $country;

    /**
     * Additional information about the comparability between 2010 and 2016 objects, or about quality issues detected in
     * the data (please refer to the CDR deliveries for a full report on the quality control of WFD2016 deliveries).
     *
     * @var string
     */
    public string $qcCheck;

    /**
     * Geographic location of the monitoring site using WGS84.
     * @var LngLat
     */
    public LngLat $coordinates;
}
