<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'attributes', 'user_id', 'browser_info', 'ip_address', 'country'];
    protected $casts = [
        'browser_info' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'attributes'=> 'json'
    ];

    public static function getDistinctNames()
    {
        return self::distinct()->get(['name'])->pluck('name')->toArray();
    }

    public static function filter(DTO\EventFilterDTO $filter, mixed $limit): Collection|array
    {
        $query = self::query();
        if ($filter->from) {
            $query->where('created_at', '>=', $filter->from);
        }
        if ($filter->to) {
            $query->where('created_at', '<=', $filter->to);
        }
        if ($filter->event) {
            $query->where('name', $filter->event);
        }
        if ($filter->user) {
            $query->where('user_id', $filter->user);
        }
        return $query->limit($limit)->get();
    }
}
