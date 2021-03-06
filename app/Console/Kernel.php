<?php

namespace App\Console;

use App\Console\Commands\CacheLikeBests;
use App\Console\Commands\CacheMainSsuls;
use App\Console\Commands\CacheMorph;
use App\Console\Commands\CacheQueries;
use App\Console\Commands\CrawlFacebookPage;
use App\Console\Commands\CrawlGoogleTrends;
use App\Console\Commands\CrawlInstagram;
use App\Console\Commands\CrawlYoutube;
use App\Console\Commands\MorphCommand;
use App\Console\Commands\NaverImageLoad;
use App\Console\Commands\NewsCrawling;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        NewsCrawling::class,
        CrawlGoogleTrends::class,
        CrawlInstagram::class,
        MorphCommand::class,
        CrawlFacebookPage::class,
        CrawlYoutube::class,
        CacheQueries::class,
        CacheMorph::class,
        NaverImageLoad::class,
        CacheLikeBests::class,
        CacheMainSsuls::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('crawl:googleTrends')
            ->hourly();

        $schedule->command('crawl:naverNews')
            ->hourly();

        $schedule->command('crawl:instagram')
            ->hourly();

        $schedule->command('crawl:youtube')
            ->hourly();

        $schedule->command('cache:statistics')
            ->everyMinute();

        $schedule->command('cache:morph')
            ->everyMinute();

        $schedule->command('cache:likeBests')
            ->everyFiveMinutes();

        $schedule->command('cache:mainSsuls')
            ->everyFiveMinutes();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
