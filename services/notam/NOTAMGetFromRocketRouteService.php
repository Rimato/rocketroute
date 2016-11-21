<?php

namespace app\services\notam;

use app\services\base\AbstractService;
use yii\base\Exception;

class NOTAMGetFromRocketRouteService extends AbstractService
{

    /** @var  string $_usr */
    private $_usr;

    /** @var  string $_token */
    private $_token;

    /** @var  string $_ICAO */
    private $_ICAO;

    /** @var  string $_reqURL*/
    private $_reqURL;

    /**
     * @param string $usr
     */
    public function setUser(string $usr)
    {
        $this->_usr = $usr;
    }

    /**
     * @return string
     */
    public function getUsr() : string
    {
        return $this->_usr;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->_token = $token;
    }

    /**
     * @return string
     */
    public function getToken() : string
    {
        return $this->_token;
    }

    /**
     * @param string $ICAO
     */
    public function setICAO (string $ICAO)
    {
        $this->_ICAO = $ICAO;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getICAO() : string
    {
        if(!$this->_ICAO){
            throw new Exception('ICAO not set');
        }
        return $this->_ICAO;
    }

    /**
     * @param string $URL
     */
    public function setReqURL(string $URL)
    {
        $this->_reqURL = $URL;
    }

    public function getReqURL() :string
    {
        return $this->_reqURL;
    }

    /**
     * @return string with NOTAM XML
     */
    public function getNOTAMByICAO()
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><REQWX/>');
        $xml->addChild('USR', $this->getUsr());
        $xml->addChild('PASSWD', $this->getToken());
        $xml->addChild('ICAO', $this->getICAO());
        $req = $xml->asXML();
        $client = new \SoapClient($this->_reqURL);
        return $client->getNotam($req);
    }
}