<?php
return [
  'shipping_methods'=>[
      'flat_rate' => [
          'name'=>__("Flat rate"),
          'desc'=>__("Lets you charge a fixed rate for shipping.")
      ],
      'free_shipping' => [
          'name'=>__("Free shipping"),
          'desc'=>__("Free shipping is a special method which can be triggered with coupons and minimum spends.")
      ],
      'local_pickup' => [
          'name'=>__("Local pickup"),
          'desc'=>__("Allow customers to pick up orders themselves. By default, when using local pickup store base taxes will apply regardless of customer address.")
      ],
  ]
];
