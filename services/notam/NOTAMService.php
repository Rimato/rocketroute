<?php

namespace app\services\notam;

use app\services\base\AbstractService;
use app\services\geoconverter\GeoConverter;
use app\services\notam\NOTAMGetFromRocketRouteService;

/**
 * Class ICAOHandlerService
 * @package app\services
 */
class NOTAMService extends AbstractService {

    protected function getDependencyList()
    {
        return [
            'getNOTAMByICAMInterface' => NOTAMGetFromRocketRouteService::className(),
            'NOTAMParceInterface' => NOTAMXMLParser::className(),
            'geoConverter' => GeoConverter::className()
        ];
    }

    /**
     * ICAO code
     * @var string $_ICAO
     */
    private $_ICAO;

    /**
     * @return mixed
     */
    public function getICAO() : string
    {
        return $this->_ICAO;
    }

    /**
     * @param string $ICAO
     * @return mixed
     */
    public function setICAO(string $ICAO)
    {
        $this->_ICAO = $ICAO;
    }

    public function getICAOData()
    {
        /** @var NOTAMGetFromRocketRouteService $NOTANGetService */
        $NOTANGetService = $this->getDependency('getNOTAMByICAMInterface');
        $NOTANGetService->setToken(\Yii::$app->params['RocketRouteToken']);
        $NOTANGetService->setUser(\Yii::$app->params['RocketRouteUser']);
        $NOTANGetService->setReqURL(\Yii::$app->params['ReqURL']);
        $NOTANGetService->setICAO($this->getICAO());

        /** @var NOTAMPArceInterface $parser */
        $parser = $this->getDependency('NOTAMParceInterface');
        $entity = $parser->parseNOTAMXML($NOTAMXML);

        /** @var GeoConverter $converter */
        $converter = $this->getDependency('geoConverter');
        $decimail = $converter->convertDMSToDecimal($entity->getLocation());
        return $decimail;
    }

}