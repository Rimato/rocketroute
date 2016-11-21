<?php

namespace app\services\notam;


interface NOTAMPArceInterface
{
    function parseNOTAMXML(string $XML) : NOTAMEntity;
}