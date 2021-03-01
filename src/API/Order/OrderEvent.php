<?php


namespace Bedivierre\Enlighten\Insider\API\Order;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

abstract class OrderEvent extends EnlightenEvent
{
    protected $controller = 'order';

    public function __construct($clientId = null, $orderId = null, $sum = null, $positions = null, $phone = null)
    {
        parent::__construct(null, null, []);
        if(!$clientId && !$phone)
            return;
        if(!$orderId || !$sum || !$positions)
            return;
        $this->addNewOrder($clientId, $orderId, $sum, $positions, $phone);
    }
    public function addNewOrder($clientId, $orderId, $sum, $positions, $phone = null)
    {
        parent::addNew($clientId, $phone, []);
        $this->addData('order.id', $orderId);
        $this->addData('order.sum', (int)$sum);
        $this->addData('order.position_count', (int)$positions);
        $this->addBaseEntityValue('order_id', $orderId);
    }
    public function setCurrency($currency){
        if($currency && is_string($currency))
            $this->addData(self::getDataType('order.currency'), $currency);
    }
}