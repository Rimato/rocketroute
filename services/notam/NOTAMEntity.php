<?php

namespace app\services\notam;

use yii\base\Component;
use yii\base\Exception;

class NOTAMEntity extends Component {

    /** @var  array $_itemqSection */
    private $_itemqSection;

    /** @var  array $_itemeSection */
    private $_itemeSection;

    /**
     * @param array $intemq
     */
    public function setItemQsection(array $intemq)
    {
        $this->_itemqSection = $intemq;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getItemqSection()
    {
        if(!$this->_itemqSection){
            throw new Exception('Itemq not set');
        }
        return $this->_itemqSection;
    }

    /**
     * @param array $inteme
     */
    public function setItemEsection(array $inteme)
    {
        $this->_itemeSection = $inteme;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getItemeSection()
    {
        if(!$this->_itemeSection){
            throw new Exception('Iteme not set');
        }
        return $this->_itemeSection;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        $itemq = $this->getItemqSection();
        $res = substr($itemq['value'], strlen($itemq['value']) - 11, 11);
        return $res;
    }

    /**
     * @return mixed
     */
    public function getItemEData()
    {
        $iteme = $this->getItemeSection();
        return $iteme['value'];
    }

}