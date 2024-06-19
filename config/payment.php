<?php

use Carbon\Carbon;

return [
    'redirect_url' => 'https://paiement.systempay.fr/vads-payment/',
    'key' => [
        'TEST' =>'bVolYMzIEPhkOnsB',
        'PRODUCTION' =>'7LbLUNEcCTUVzJII',
        ],
    'obligatory_fields' => [
        'vads_action_mode' => 'INTERACTIVE',
        'vads_ctx_mode' => env('SYSTEMPAY_TEST_OR_PROD', 'TEST'),
        'vads_currency' => '978',
        'vads_page_action' => 'PAYMENT',
        'vads_payment_config' => 'SINGLE',
        'vads_site_id' => env('SYSTEMPAY_SITE_ID', '10868856'),
        'vads_trans_date' => Carbon::now('UTC')->format('YmdHis'),
        'vads_trans_id' => '',
        'vads_version' => 'V2',
    ]
];
