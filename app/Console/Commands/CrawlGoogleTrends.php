<?php

namespace App\Console\Commands;

use App\Channel;
use App\Ssul;
use App\Team;
use DOMDocument;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class CrawlGoogleTrends extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:googleTrends';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'google trends crawling';

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
        $client = new Client([
            'base_uri' => 'https://trends.google.com',
        ]);
        $response = $client->get('/trends/hottrends/atom/feed', [
            'query' => [
                'pn' => 'p23'
            ],
        ]);
        $body = $response->getBody();

        $body = preg_replace('~(</?|\s)([a-z0-9_]+):~is', '$1$2_', $body);


        $xml = simplexml_load_string($body);


        foreach ($xml->channel->item as $item) {
            print_r($item);

            if (!Ssul::where('name', $item->title)->exists()) {

                DB::transaction(function () use ($item) {
                    $newSsul = new Ssul();
                    $newSsul->name = $item->title;
                    $newSsul->picture = "https:" . $item->ht_picture;
                    $newSsul->save();

                    $newTeam = new Team();
                    $newTeam->ssul_id = $newSsul->id;
                    $newTeam->name = "긍정";
                    $newTeam->value = 50;
                    $newTeam->save();

                    $newTeam = new Team();
                    $newTeam->ssul_id = $newSsul->id;
                    $newTeam->name = "부정";
                    $newTeam->value = 50;
                    $newTeam->save();
                });

            }

        }

    }

}
