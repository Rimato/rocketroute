<?php

namespace app\services\notam;

use yii\base\Component;

class NOTAMXMLParser extends Component  implements NOTAMPArceInterface {

    /** @var  string */
    private $_NOTAMXML;

    /** @var  array */
    private $_vals;

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
        $simple = $XML;
        $p = xml_parser_create();
        xml_parse_into_struct($p, $simple, $vals);
        xml_parser_free($p);
        $this->_vals = $vals;
        $itemq = array_shift($this->findByTag('ITEMQ'));
        $iteme= array_shift($this->findByTag('ITEME'));
        $entity = new NOTAMEntity();
        $entity->setItemQsection($itemq);
        $entity->setItemEsection($iteme);
        return $entity;
    }

    /**
     * @param $tag
     * @return array
     */
    private function findByTag($tag)
    {
        $item = array_filter($this->_vals, function($item) use ($tag){
            return $item['tag'] == $tag;
        });
        return $item;
    }
}