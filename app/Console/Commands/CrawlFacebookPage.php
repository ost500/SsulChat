<?php

namespace App\Console\Commands;

use Facebook\Facebook;
use Facebook\FacebookRequest;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CrawlFacebookPage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:facebookPage';

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
        $fb = new Facebook([
            'app_id' => '427264620986956',
            'app_secret' => '99892342ae43a174020519c255dac6f7',
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/',
        ]);
        $response = $client->get('/1527339707336364/posts?fields=attachments&access_token=427264620986956|99892342ae43a174020519c255dac6f7', [

        ]);
        $body = \GuzzleHttp\json_decode($response->getBody()->getContents());

        print_r($body);

//        print_r($fb->request('GET', '1527339707336364', ['fields' => 'about']));
//        print_r($graphObject);
    }
}
