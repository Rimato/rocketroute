<?php

namespace app\services\notam;

use yii\base\Component;

class NOTAMXMLParser extends Component  implements NOTAMPArceInterface {

    /** @var  string */
    private $_NOTAMXML;

    public function setNOTAMXMJ(string $NOTAMXML) {
        $this->_NOTAMXML = $NOTAMXML;
    }

    /**
     * @return string
     */
    public function getNOTAMXML(){
        return $this->_NOTAMXML;
    }

    /**
     * @param string $XML
     * @return NOTAMEntity
     */
    public function parseNOTAMXML(string $XML) : NOTAMEntity
    {

        $entity = new NOTAMEntity();
        return $entity;
    }
}