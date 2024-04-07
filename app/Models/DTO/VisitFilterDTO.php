<?php

namespace App\Models\DTO;

use Illuminate\Support\Carbon;

class VisitFilterDTO
{

    public function __construct(
        public readonly ?Carbon $from = null,
        public readonly ?Carbon $to = null,
        public readonly ?string $page = null,
        public readonly ?string $user = null
    )
    {
    }
}
