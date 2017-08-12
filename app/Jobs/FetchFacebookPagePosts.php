<?php

namespace App\Jobs;

use App\Page;
use App\PagePost;
use App\PagePostPicture;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchFacebookPagePosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $page;

    /**
     * FetchFacebookPagePosts constructor.
     * @param $id
     * @throws Exception
     */
    public function __construct($id)
    {
        $this->page = Page::findOrFail($id);
        if ($this->page->fb_page_id == "") {
            throw new Exception();
        }
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client([
            'base_uri' => 'https://graph.facebook.com/',
        ]);
        $response = $client->get($this->page->fb_page_id . '/posts?fields=attachments,message,full_picture&access_token=427264620986956|99892342ae43a174020519c255dac6f7', [

        ]);
        $body = \GuzzleHttp\json_decode($response->getBody()->getContents());

        $data = $body->data;
//        print_r($data);

        foreach ($data as $item) {


            $message = $item->message;
            $fullPicture = "";
            if (isset($item->full_picture)) {
                $fullPicture = $item->full_picture;
            }


            if (!PagePost::where('fb_unique_id', $item->id)->exists()) {

                $newPagePost = new PagePost();
                $newPagePost->fb_unique_id = $item->id;
                $newPagePost->page_id = $this->page->id;
                $newPagePost->message = $message;
                $newPagePost->main_photo = $fullPicture;
                $newPagePost->save();


                if (isset($item->attachments)) {

                    foreach ($item->attachments as $attachment) {

                        foreach ($attachment as $item) {
                            if (isset($item->subattachments)) {

                                foreach ($item->subattachments->data as $subattachItem) {
                                    print_r($subattachItem->media->image->src);
                                    $newPagePostPicture = new PagePostPicture();
                                    $newPagePostPicture->page_post_id = $newPagePost->id;
                                    $newPagePostPicture->photo = $subattachItem->media->image->src;
                                    $newPagePostPicture->save();

                                }
                            }

                        }

                    }
                }
            }

        }

    }
}
