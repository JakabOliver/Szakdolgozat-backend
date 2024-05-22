<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PageVisit extends Model
{
    use HasFactory;

    protected $fillable = ['page', 'user_id', 'browser_info', 'ip_address', 'country'];
    protected $casts = [
        'browser_info' => 'array',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function getDistinctPageNames()
    {
        return self::distinct()->get(['page'])->pluck('page')->toArray();
    }

    public static function filter(DTO\VisitFilterDTO $filter, mixed $limit): Collection|array
    {
        $query = self::query();
        if ($filter->from) {
            $query->where('created_at', '>=', $filter->from);
        }
        if ($filter->to) {
            $query->where('created_at', '<=', $filter->to);
        }
        if ($filter->page) {
            $query->where('page', $filter->page);
        }
        if ($filter->user) {
            $query->where('user_id', $filter->user);
        }
        $query->orderBy('created_at', 'desc');
        return $query->limit($limit)->get();

    }

    public static function getCountByTypeForPastSevenDays(?string $page)
    {

        for ($i = (6); $i >= 0; $i--) {
            $result[] = ['date' => date("Y-m-d", strtotime("-$i days")), 'count' => '0'];
        }
        $query = self::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select([DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count')])
            ->where('page', '=', '/'.$page)
            ->groupBy('date');
        foreach ($query->get() as $row) {
            $key = array_search($row->date, array_column($result, 'date'));
            $result[$key]['count'] = $row->count;
        }
        return $result;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(TrackedUser::class);
    }
}
