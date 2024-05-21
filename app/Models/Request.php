<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['data'];

    public static function getForLastDaysGrouped(int $range = 7): array
    {
        for ($i = ($range-1); $i >= 0; $i--) {
            $result[] = ['date' => date("Y-m-d", strtotime("-$i days")), 'count' => '0'];
        }
        $query = self::where('created_at', '>=', Carbon::now()->subDays($range))
            ->select([DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count')])
            ->groupBy('date');
        foreach ($query->get() as $row) {
            $key = array_search($row->date, array_column($result, 'date'));
            $result[$key]['count'] = $row->count;
        }
        return $result;
    }
}
