<?php
/**
 * Created by PhpStorm.
 * User: Rimato
 * Date: 10.11.2016
 * Time: 15:37
 */

namespace app\services\notam;


interface GetNOTAMByICAMInterface
{
    function getNOTAMByICAM(string $ICAM) : NOTAMEntity;
}