<?php


namespace Bedivierre\Enlighten\Insider\API\Order;


use Bedivierre\Enlighten\Insider\Core\EnlightenBase;
use Bedivierre\Enlighten\Insider\Core\EnlightenData;
use Bedivierre\Enlighten\Insider\Core\EnlightenEvent;
use Bedivierre\Enlighten\Insider\Core\EnlightenUtility;

class OrderCreate extends EnlightenEvent
{
    protected $controller = 'order';
    protected $function = 'create';

    public function __construct($clientId, $orderId, $sum, $positions)
    {
        parent::__construct($clientId, []);
        $this->addEventData('order.id', $orderId);
        $this->addEventData('order.sum', (int)$sum);
        $this->addEventData('order.position_count', (int)$positions);
        $this->addBaseDataValue('order_id', $orderId);
    }
}