<?php


namespace Bedivierre\Enlighten\Insider\API\Promocode;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class PromocodeUse extends EnlightenEvent
{
    protected $controller = 'promocode';
    protected $function = 'use';

    public function __construct($clientId, $phone, $code = null, $discount = null)
    {
        parent::__construct($clientId, $phone, []);
        if($code)
            $this->addData(self::getDataType('promocode.code'), $code);
        if($discount)
            $this->addData(self::getDataType('promocode.discount'), $discount);
    }
}