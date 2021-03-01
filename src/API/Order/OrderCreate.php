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

    public function __construct($clientId, $orderId, $sum, $positions, $phone = null)
    {
        parent::__construct($clientId, $phone, []);
        $this->addData('order.id', $orderId);
        $this->addData('order.sum', (int)$sum);
        $this->addData('order.position_count', (int)$positions);
        $this->addBaseEntityValue('order_id', $orderId);
    }
}