<?php

namespace App\Http\Controllers;

use App\Morph;
use App\Page;
use App\Ssul;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $statics = Cache::get('cache:statistics');
        return response()->json($statics);
    }

    public function morphStatistics()
    {

        $morphStatics = Cache::get('cache:morph');

        return response()->json($morphStatics);

    }

    public function pageStatistics($id)
    {
        $dt = new Carbon();

        $page = Page::where('pages.id', $id);

        $pageFirst = $page->first();

        if ($dt->dayOfWeek >= $pageFirst->week_cycle) {
            $weekGap = $dt->dayOfWeek - $pageFirst->week_cycle;
        } else {
            $weekGap = 7 - ($pageFirst->week_cycle - $dt->dayOfWeek);
        }

        $dt->subDays($weekGap);

        $timeCycle = explode(":", $pageFirst->time_cycle);

        $dt->setTime($timeCycle[0], $timeCycle[1], $timeCycle[2]);


        $statics = $page->join('page_ssuls', 'page_ssuls.page_id', '=', 'pages.id')
            ->join('ssuls', 'ssuls.id', '=', 'page_ssuls.ssul_id')
            ->join('ssul_chattings', function ($q) use ($dt) {
                $q->on('ssuls.id', '=', 'ssul_chattings.ssul_id');
                $q->where('ssul_chattings.created_at', '>', $dt->format('Y-m-d H:i:s'));
            })
            ->groupBy('ssuls.id')
            ->selectRaw('count(ssul_chattings.id) as countSsul, ssuls.*')
            ->orderBy('countSsul', 'desc')
            ->limit(8)
            ->get();

        return response()->json($statics);
    }

    public function pageMorphStatistics($id)
    {
        $dt = new Carbon();

        $morphStatics = Page::where('pages.id', $id)
            ->join('page_ssuls', 'page_ssuls.page_id', '=', 'pages.id')
            ->rightJoin('ssuls', 'ssuls.id', '=', 'page_ssuls.ssul_id')
            ->join('morphs', 'morphs.ssul_id', '=', 'ssuls.id')
            ->rightJoin('morph_logs', function ($q) use ($dt) {
                $q->on('morph_logs.morph_id', '=', 'morphs.id');
                $q->where('morph_logs.created_at', '>', $dt->subWeek()->format('Y-m-d H:i:s'));
            })
            ->groupBy('morphs.id')
            ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
            ->orderBy('countMorphs', 'desc')
            ->limit(8)
            ->get();

        return response()->json($morphStatics);

    }

    public function chattingsMorphStatistics($id)
    {
        $dt = new Carbon();

        $morphStatics = Morph::where('morphs.ssul_id', $id)
            ->rightJoin('morph_logs', function ($q) use ($dt) {
                $q->on('morph_logs.morph_id', '=', 'morphs.id');
                $q->where('morph_logs.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'));
            })
            ->groupBy('morphs.id')
            ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
            ->orderBy('countMorphs', 'desc')
            ->limit(8)
            ->get();

        return response()->json($morphStatics);

    }

    public function chattingsWeekMorphStatistics($id)
    {
        $dt = new Carbon();

        $morphStatics = Morph::where('morphs.ssul_id', $id)
            ->rightJoin('morph_logs', function ($q) use ($dt) {
                $q->on('morph_logs.morph_id', '=', 'morphs.id');
                $q->where('morph_logs.created_at', '>', $dt->subWeek()->format('Y-m-d H:i:s'));
            })
            ->groupBy('morphs.id')
            ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
            ->orderBy('countMorphs', 'desc')
            ->limit(8)
            ->get();

        return response()->json($morphStatics);

    }
}
