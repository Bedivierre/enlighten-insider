<?php


namespace Bedivierre\Enlighten\Insider\API\Promocode;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

abstract class PromocodeEvent extends EnlightenEvent
{
    protected $controller = 'promocode';

    public function __construct($clientId, $phone, $code = null, $discount = null)
    {
        parent::__construct(null, null, []);
        if(!$clientId && !$phone)
            return;
        $this->addNewCode($clientId, $phone, $code, $discount);
    }
    public function addNewCode($clientId, $phone = null, $code = null, $discount = null){
        $this->addNew($clientId, $phone);
        if($code)
            $this->addData(self::getDataType('promocode.code'), $code);
        if($discount)
            $this->addData(self::getDataType('promocode.discount'), $discount);
    }
}