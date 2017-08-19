<?php

namespace App\Console\Commands;

use App\Morph;
use App\MorphExcept;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class CacheMorph extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:morph';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Cache::pull('cache:morph');
        Cache::remember('cache:morph', 20, function () {
            $dt = new Carbon();
            print_r($dt->subDay()->format('Y-m-d H:i:s'));

            /** @var Collection $morphStatics */
            $morphStatics = Morph::rightJoin('morph_logs', function ($q) use ($dt) {
                $q->on('morph_logs.morph_id', '=', 'morphs.id');
                $q->where('morph_logs.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'));
            })
                ->groupBy('morphs.id')
                ->selectRaw('count(morphs.id) as countMorphs, morphs.*')
                ->orderBy('countMorphs', 'desc')
                ->whereNotIn('morphs.id', MorphExcept::pluck('morph_id')->values()->all())
                ->limit(8)
                ->get();

            print_r($morphStatics->toArray());
            return $morphStatics;
        });
    }
}
