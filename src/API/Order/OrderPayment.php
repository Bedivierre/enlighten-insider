<?php


namespace Bedivierre\Enlighten\Insider\API\Order;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class OrderPayment extends EnlightenEvent
{
    protected $controller = 'order';
    protected $function = 'payment';

    public function __construct($clientId, $orderId, $sum, $positions, $currency = null, $phone = null)
    {
        parent::__construct($clientId, $phone, []);
        $this->addData(self::getDataType('order.id'), $orderId);
        $this->addData(self::getDataType('order.sum'), (int)$sum);
        $this->addData(self::getDataType('order.position_count'), (int)$positions);
        $this->addBaseEntityValue('order_id', $orderId);
        if($currency && is_string($currency))
            $this->addData(self::getDataType('order.currency'), $currency);
    }
}