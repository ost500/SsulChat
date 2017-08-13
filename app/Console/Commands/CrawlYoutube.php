<?php

namespace App\Console\Commands;

use App\Chatting;
use App\Ssul;
use App\SsulChatting;
use App\User;
use App\Youtube;
use Google_Client;
use Google_Exception;
use Google_Service_Exception;
use Google_Service_YouTube;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\SlackMessage;

class CrawlYoutube extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:youtube';

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
        /** @var Collection $ssuls */
        $ssuls = Ssul::get();
        $ssuls->each(function (Ssul $ssul) {
            try {

                $DEVELOPER_KEY = env('YOUTUBE_API_KEY');

                $client = new Google_Client();
                $client->setDeveloperKey($DEVELOPER_KEY);

                // Define an object that will be used to make all API requests.
                $youtube = new Google_Service_YouTube($client);

                try {
                    // Call the search.list method to retrieve results matching the specified
                    // query term.
                    $searchResponse = $youtube->search->listSearch('id,snippet', array(
                        'q' => $ssul->name,
                        'maxResults' => 10,
                    ));

                    $videos = '';

                    // Add each result to the appropriate list, and then display the lists of
                    // matching videos, channels, and playlists.
                    foreach ($searchResponse['items'] as $searchResult) {
                        switch ($searchResult['id']['kind']) {
                            case 'youtube#video':

                                if (!Youtube::where('video_id', $searchResult['id']['videoId'])->exists()) {
                                    $newYoutube = new Youtube();
                                    $newYoutube->title = $searchResult['snippet']['title'];
                                    $newYoutube->picture = $searchResult['snippet']['thumbnails']['high']['url'];
                                    $newYoutube->video_id = $searchResult['id']['videoId'];
                                    $newYoutube->save();

                                    $newChat = new Chatting();

                                    $youtubeUser = User::where('name', "youtube")->first();

                                    $newChat->user_id = $youtubeUser->id;
                                    $newChat->team_id = null;
                                    $newChat->ipaddress = "127.0.0.1";
                                    $newChat->picture = $newYoutube->picture;
                                    $newChat->social = 2;


                                    $newChat->content = $newYoutube->title;
                                    $newChat->url = "https://www.youtube.com/watch?v={$newYoutube->video_id}";

                                    $newChat->save();

                                    $newSsulChatting = new SsulChatting();
                                    $newSsulChatting->ssul_id = $ssul->id;
                                    $newSsulChatting->chatting_id = $newChat->id;
                                    $newSsulChatting->save();
                                }

                                print_r($searchResult['id']['videoId']);
                                print_r($searchResult['snippet']['title']);

                                break;
                            case 'youtube#channel':

                                break;
                            case 'youtube#playlist':

                                break;
                        }
                    }

                    print_r($videos);


                } catch (Google_Service_Exception $e) {
                    sprintf('<p>A service error occurred: <code>%s</code></p>',
                        htmlspecialchars($e->getMessage()));
                } catch (Google_Exception $e) {
                    sprintf('<p>An client error occurred: <code>%s</code></p>',
                        htmlspecialchars($e->getMessage()));
                }
            } catch (\Exception $e) {
                (new SlackMessage)
                    ->from('Youtube Crawling')
                    ->content("[Youtube Crawling]에러가 발생했습니다 " . $e->getMessage() . "\n" . $e->getTraceAsString());
            }
        });
    }
}
