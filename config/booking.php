<?php
return [
    'booking_route_prefix'=>env("BOOKING_ROUTER_PREFIX",'booking'),
    'services'=>[
        'product'=>Modules\Product\Models\Product::class
    ],
    'payment_gateways'=>[
        'offline_payment'=>Modules\Order\Gateways\OfflinePaymentGateway::class,
    ],
    'statuses'=>[
        'completed',
        'processing',
        'confirmed',
        'cancelled',
        'paid',
        'unpaid',
    ]
];
