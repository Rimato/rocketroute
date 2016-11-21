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
        $NOTAMGetService = $this->getDependency('getNOTAMByICAMInterface');
        $NOTAMGetService->setToken(\Yii::$app->params['RocketRouteToken']);
        $NOTAMGetService->setUser(\Yii::$app->params['RocketRouteUser']);
        $NOTAMGetService->setReqURL(\Yii::$app->params['ReqURL']);
        $NOTAMGetService->setICAO($this->getICAO());
        $NOTAMXML = $NOTAMGetService->getNOTAMByICAO();

            /** @var NOTAMPArceInterface $parser */
        $parser = $this->getDependency('NOTAMParceInterface');
        $entity = $parser->parseNOTAMXML($NOTAMXML);

        /** @var GeoConverter $converter */
        $converter = $this->getDependency('geoConverter');
        return [
            'location' => $converter->convertDMSToDecimal($entity->getLocation()),
            'iteme' => $entity->getItemEData()
        ];
    }

}