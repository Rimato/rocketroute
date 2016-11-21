<?php
namespace app\services\geoconverter;

use app\services\base\AbstractService;
use yii\base\Exception;

class GeoConverter extends AbstractService {

    /** @var  array */
    private $_parsedData;

    /** @var  string */
    private $_DMSString;

    private function parseDMS()
    {
        $pattern = '/(\d{2})(\d{2})([ns]{1})(\d{3})(\d{2})([we]{1})/i';

        if(preg_match($pattern, $this->_DMSString, $res)){
            $this->_parsedData = $res;
        } else {
            throw new Exception('Invalid geolocation');
        }
    }

    private function convert()
    {
        $latCoef = $this->_parsedData[3] == 'N' ? 1 : -1;
        $lanCoef = $this->_parsedData[6] == 'E' ? 1 : -1;
        return [
            ($this->_parsedData[1] + $this->_parsedData[2] / 60) * $latCoef,
            ($this->_parsedData[4] + $this->_parsedData[5] / 60) * $lanCoef,
        ];
    }

    public function convertDMSToDecimal(string $dms)
    {
        $this->_DMSString = $dms;
        $this->parseDMS();
        return $this->convert();
    }
}