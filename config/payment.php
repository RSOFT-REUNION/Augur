<?php

use Carbon\Carbon;

return [
    'redirect_url' => 'https://paiement.systempay.fr/vads-payment/',
    'obligatory_fields' => [
        'vads_action_mode' => 'INTERACTIVE',
        'vads_amount' => '4525',
        'vads_ctx_mode' => 'TEST',
        'vads_currency' => '978',
        'vads_page_action' => 'PAYMENT',
        'vads_payment_config' => 'SINGLE',
        'vads_site_id' => '10868856',
        'vads_trans_date' => Carbon::now('UTC')->format('YmdHis'),
        'vads_trans_id' => 'x2115p',
        'vads_version' => 'V2',
    ]
];
