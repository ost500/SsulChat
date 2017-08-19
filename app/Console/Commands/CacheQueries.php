<?php

namespace App\Console\Commands;

use App\Ssul;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheQueries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:statistics';

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

        Cache::remember('cache:statistics', 20, function () {
            $dt = new Carbon();
            $statics = Ssul::rightJoin('ssul_chattings', function ($q) use ($dt) {
                $q->on('ssuls.id', '=', 'ssul_chattings.ssul_id');
                $q->where('ssul_chattings.created_at', '>', $dt->subDay()->format('Y-m-d H:i:s'));
            })
                ->groupBy('ssuls.id')
                ->selectRaw('count(ssuls.id) as countSsul, ssuls.*')
                ->orderBy('countSsul', 'desc')
                ->limit(8)
                ->get();
            Cache::pull('cache:statistics');
            return $statics;
        });
    }
}
