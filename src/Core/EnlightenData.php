<?php


namespace Bedivierre\Enlighten\Insider\Core;

class EnlightenData
{
    public static $types = [
        'first_name'=>'first_name',
        'last_name'=>'last_name',
        'middle_name'=>'middle_name',
        'birth_date'=>'birth_date',
        'passport'=>'passport',
        'car_licence'=>'car_licence',
        'snils'=>'snils',
        'soldier_num'=>'soldier_num',
        'payment_card'=>'payment_card',

        'message'=>'message',

        'address'=>'address',
        'email'=>'email',
        'phone'=>'phone',
        'website'=>'website',
        'place'=>'place',

        'vk'=>'vk',
        'instagram'=>'instagram',
        'fb'=>'fb',
        'twittwer'=>'twittwer',

        'discount_card.sampo'=>'discount_card.sampo',
        'discount_card.obriens'=>'discount_card.obriens',
        'discount_card.fourcheeses'=>'discount_card.fourcheeses',
        'discount_card.fazenda'=>'discount_card.fazenda',

        'order.sum'=>'order.sum',
        'order.position_count'=>'order.position_count',
        'order.currency'=>'order.currency',
        'order.payment_status'=>'order.payment_status',

        'network.ip'=>'network.ip',
        'network.mac'=>'network.mac',
    ];
    public static $places = [
        'sampo'=>'sampo',
        'pizza'=>'pizza',
        'pub1'=>'pub1',
        'pub2'=>'pub2',
        'pub3'=>'pub3',
        'pub4'=>'pub4',
        'fazenda'=>'fazenda',
        'fourcheeses'=>'fourcheeses',
    ];
    public static $websites = [
        'sampo'=>'sampo',
        'pizza'=>'pizza',
        'obriens'=>'obriens',
        'fazenda'=>'fazenda',
        'fourcheeses'=>'fourcheeses',
    ];


    public function getType($type){
        return isset(self::$types[$type]) ? self::$types[$type] : 'common';
    }
}