<?php

return  [
    'order_status_admin' => [
        'pending' => [
            'status' => 'pending',
            'details' => 'İncelemede',

        ],
        'processed_and_ready_to_ship' => [
            'status'  => 'Processed and ready to ship',
            'details' => 'Your package has beeen processed and will be wity our deilvery partner soon'
        ],
        'dropped_off' => [
            'status' => 'Dropped off',
            'details' => 'Your package has been dropped off by the seller'
        ],
        'shipped' => [
            'status' => 'Shipped',
            'details' => ''
        ],

        'out_for_delivery' => [
            'status'  => 'Out For Delivery',
            'details' => 'Our delivery partner will attempt to delivery your package'
        ],

        'delivered' => [
            'status' => 'Delivered',
            'details' => 'Delivered'
        ],
        'cancelled' => [
            'status' => 'Cancelled',
            'details' => 'Cancelled'
        ]
     ],

     'order_status_vendor' =>[
        'pending' => [
            'status' => 'Pending',
            'details' => 'Your order is currently pending'
        ],

        'processed_and_ready_to_ship' => [
            'status'  => 'Processed and ready to ship',
            'details' => 'Your package has been processed and will be with our delivery partner soon'
        ]
     ]


];
