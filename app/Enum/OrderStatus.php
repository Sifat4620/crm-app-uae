<?php

namespace App\Enum;

enum OrderStatus: string
{
    case Active     = 'active';
    case Processing = 'processing';
    case Pending    = 'pending';
    case Canceled   = 'canceled';
    case Terminated = 'terminated';
    case Fraud      = 'fraud';
}
