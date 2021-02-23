<?php


namespace Bedivierre\Enlighten\Insider\API\Order;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class PromocodeUse extends EnlightenEvent
{
    protected $controller = 'promocode';
    protected $function = 'use';

    public function __construct($clientId, $code = null, $discount = null)
    {
        parent::__construct($clientId, []);
        if($code)
            $this->addEventData(self::getDataType('promocode.code'), $code);
        if($discount)
            $this->addEventData(self::getDataType('promocode.discount'), $discount);
    }
}