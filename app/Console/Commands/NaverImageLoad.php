<?php

namespace App\Console\Commands;

use App\Ssul;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NaverImageLoad extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:NaverImage {id}';

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
        $id = $this->argument('id');

        $this->ssul = Ssul::findOrFail($id);


        $client_id = "7cfdeaICkiBH_RGuNL1d";
        $client_secret = "CXsJbctS3X";



        $encText = urlencode($this->ssul->name);
        $url = "https://openapi.naver.com/v1/search/image?display=1&sort=sim&filter=medium&query=" . $encText; // json 결과

        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = array();
        $headers[] = "X-Naver-Client-Id: " . $client_id;
        $headers[] = "X-Naver-Client-Secret: " . $client_secret;

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        echo "status_code:" . $status_code . "";
        curl_close($ch);

        if ($status_code == 200) {
            $news = json_decode($response, true);


            foreach ($news["items"] as $new) {
                echo $new["link"] . "\n";


                DB::transaction(function () use ($new) {
                    $this->ssul->picture = $new["link"];
                    $this->ssul->save();
                });


            }


        } else {
            echo "Error 내용:" . $response;
        }
    }
}
