<?php

namespace App\Models\DTO;

use Illuminate\Support\Carbon;

class EventFilterDTO
{

    public function __construct(
        public readonly ?Carbon $from = null,
        public readonly ?Carbon $to = null,
        public readonly ?string $event = null,
        public readonly ?string $user = null
    )
    {
    }
}
