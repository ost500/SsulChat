<?php

namespace App\Http\Controllers;

use App\Morph;
use App\Ssul;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function statistics()
    {
        $dt = new Carbon('last monday');

        $statics = Ssul::rightJoin('ssul_chattings', 'ssuls.id', '=', 'ssul_chattings.ssul_id')
            ->where('ssul_chattings.created_at', '>', $dt->format('Y-m-d H:i:s'))
            ->groupBy('ssuls.id')
            ->selectRaw('count(ssuls.id) as countSsul, ssuls.*')
            ->orderBy('countSsul', 'desc')
            ->limit(8)
            ->get();
        return response()->json($statics);
    }

    public function morphStatistics()
    {
        $dt = new Carbon('last monday');

        $morphStatics = Morph::rightJoin('morph_logs', 'morph_logs.morph_id', '=', 'morphs.id')
            ->where('morph_logs.created_at', '>', $dt->format('Y-m-d H:i:s'))
            ->groupBy('morphs.id')
            ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
            ->orderBy('countMorphs', 'desc')
            ->limit(8)
            ->get();

        return response()->json($morphStatics);

    }
}
