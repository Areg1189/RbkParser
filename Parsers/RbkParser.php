<?php

namespace Parsers;

require_once __DIR__ . "/../vendor/autoload.php";

use App\Models\PostImage;
use PHPHtmlParser\Dom;
use App\Models\Post;

class RbkParser implements Parser
{
    private $limit = 15;
    private $cookie;
    private $source = 'rbc.ru';

    public function __construct()
    {
        $time = time();
        $this->cookie = "cookie$time.txt";
    }

    public function __destruct()
    {
        unlink($this->cookie);
    }

    public function run()
    {
        $time = time();
        $json = $this->getContent("https://www.rbc.ru/v10/ajax/get-news-feed/project/rbcnews/lastDate/{$time}/limit/{$this->limit}");
        $data = json_decode($json, true);
        $items = $data['items'];
        foreach ($items as $i => $item) {
            sleep(rand(1, 7));
            $url = $this->getPostLink($item['html']);
            $date = $item['publish_date_t'];
            $content = $this->getContent($url);
            $dom = new Dom;
            $dom->loadStr($content);
            $post = new Post();
            $data = [
                'slug' => mb_strtolower(md5(time().$i)),
                'title' => $this->getTitle($dom),
                'sub_title' => $this->getSubTitle($dom),
                'body' => $this->getSubBody($dom),
                'source' => $this->source,
                'origin_url' => $url,
                'post_date' => date('Y-m-d H:i:s', $date)
            ];
            if ($postId = $post->create($data)) {
                $imageData = $this->getPostImages($dom);
                if (!empty($imageData)) {
                    $image = new PostImage();
                    $imageData['post_id'] = $postId;
                    $image->create($imageData);

                }
            }
        }
    }

    public function getContent($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->cookie);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function getPostLink($html)
    {
        $dom = new Dom();
        $dom->loadStr($html);
        $a = $dom->find('a');
        return $a->getAttribute('href');
    }

    public function getTitle($dom)
    {
        $title = false;
        $node = $dom->find('title');
        if (count($node)) {
            $text = $node->text;
            $data = explode('::', $text);
            $title = $data[0];
        }
        return $title;
    }

    public function getSubTitle($dom)
    {
        $subTitle = false;
        $node = $dom->find('.article__text__overview');
        if (count($node)) {
            $subTitle = $node->innerHtml;
        }
        return $subTitle;
    }

    public function getSubBody($dom)
    {
        $body = false;
        $node = $dom->find('.article__text');
        if (count($node)){
            $nodes = $node->find('p');
            if (count($nodes)) {
                foreach ($nodes as $i => $content) {
                    $body .= $content;
                }
            }
        } else{

        }
        return $body;
    }

    public function getPostImages($dom)
    {
        $images = [];
        $node = $dom->find('.article__main-image__image');
        if (count($node)) {
            $images['name'] = copyImage($dom->find('.article__main-image__image')->getAttribute('src'), 'public/images/posts', time() . '.jpg');
            $images['details'] = $dom->find('.article__main-image__image')->getAttribute('alt');
        }
        return $images;
    }

}

(new RbkParser())->run();