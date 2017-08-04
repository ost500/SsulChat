<?php

namespace App\Http\Controllers;

use App\Morph;
use App\Page;
use App\Ssul;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $dt = new Carbon();

        $statics = Ssul::rightJoin('ssul_chattings', 'ssuls.id', '=', 'ssul_chattings.ssul_id')
            ->where('ssul_chattings.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'))
            ->groupBy('ssuls.id')
            ->selectRaw('count(ssuls.id) as countSsul, ssuls.*')
            ->orderBy('countSsul', 'desc')
            ->limit(8)
            ->get();
        return response()->json($statics);
    }

    public function morphStatistics()
    {
        $dt = new Carbon();

        $morphStatics = Morph::rightJoin('morph_logs', 'morph_logs.morph_id', '=', 'morphs.id')
            ->where('morph_logs.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'))
            ->groupBy('morphs.id')
            ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
            ->orderBy('countMorphs', 'desc')
            ->limit(8)
            ->get();

        return response()->json($morphStatics);

    }

    public function pageStatistics($id)
    {
        $dt = new Carbon();


        $statics = Page::where('pages.id', $id)->join('page_ssuls', 'page_ssuls.page_id', '=', 'pages.id')
            ->join('ssuls', 'ssuls.id', '=', 'page_ssuls.ssul_id')
            ->join('ssul_chattings', 'ssuls.id', '=', 'ssul_chattings.ssul_id')
            ->where('ssul_chattings.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'))
            ->groupBy('ssuls.id')
            ->selectRaw('count(ssuls.id) as countSsul, ssuls.*')
            ->orderBy('countSsul', 'desc')
            ->limit(8)
            ->get();
        return response()->json($statics);
    }

    public function pageMorphStatistics()
    {
        $dt = new Carbon();

        $morphStatics = Morph::rightJoin('morph_logs', 'morph_logs.morph_id', '=', 'morphs.id')
            ->where('morph_logs.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'))
            ->groupBy('morphs.id')
            ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
            ->orderBy('countMorphs', 'desc')
            ->limit(8)
            ->get();

        return response()->json($morphStatics);

    }
}
