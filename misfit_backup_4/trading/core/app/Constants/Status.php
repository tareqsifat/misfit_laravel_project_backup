<?php

namespace App\Constants;

class Status
{

    const ENABLE  = 1;
    const DISABLE = 0;

    const YES = 1;
    const NO  = 0;

    const VERIFIED   = 1;
    const UNVERIFIED = 0;

    const PAYMENT_INITIATE = 0;
    const PAYMENT_SUCCESS  = 1;
    const PAYMENT_PENDING  = 2;
    const PAYMENT_REJECT   = 3;

    const TICKET_OPEN   = 0;
    const TICKET_ANSWER = 1;
    const TICKET_REPLY  = 2;
    const TICKET_CLOSE  = 3;

    const PRIORITY_LOW    = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH   = 3;

    const USER_ACTIVE = 1;
    const USER_BAN    = 0;

    const KYC_UNVERIFIED = 0;
    const KYC_PENDING    = 2;
    const KYC_VERIFIED   = 1;

    const CRYPTO_CURRENCY = 1;
    const FIAT_CURRENCY   = 2;

    const BUY_SIDE_ORDER  = 1;
    const SELL_SIDE_ORDER = 2;

    const BUY_SIDE_TRADE  = 1;
    const SELL_SIDE_TRADE = 2;

    const ORDER_TYPE_LIMIT  = 1;
    const ORDER_TYPE_MARKET = 2;

    const ORDER_OPEN      = 0;
    const ORDER_COMPLETED = 1;
    const ORDER_CANCELED  = 9;
}
