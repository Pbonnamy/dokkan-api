<?php

namespace App\Traits;

use App\Models\Card;
use App\Models\Category;
use App\Models\Link;
use Illuminate\Support\Facades\Log;
use Weidner\Goutte\GoutteFacade;

trait DokkanScrapingTrait
{
    protected $total = 0;

    public function get_dokkan_data()
    {
        $crawler = GoutteFacade::request('GET', 'https://www.dokkanbattleoptimizer.com/');

        $this->get_categories($crawler);
        $this->get_links($crawler);
    }

    function get_cards($crawler)
    {
        $crawler->filter('.character')->each(function ($node) {
            if ($node->attr('data-name')) {
                $this->total++;

                Card::updateOrCreate(
                    [
                        'dokkan_id' => $node->attr('data-id') + 1
                    ],
                    [
                        'name' => $node->attr('data-name'),
                        'dokkan_id' => $node->attr('data-id') + 1,
                        'image' => $node->filter('img')->attr('src')
                    ]
                );
            }
        });
    }

    function get_categories($crawler)
    {
        $crawler->filter('#filters [data-category] option')->each(function ($node) {
            if ($node->attr('value')) {
                Category::updateOrCreate(
                    [
                        'dokkan_id' => $node->attr('value')
                    ],
                    [
                        'name' => $node->text(),
                        'dokkan_id' => $node->attr('value')
                    ]
                );
            }
        });

        $this->info('Categories updated');
    }

    function get_links($crawler)
    {
        $crawler->filter('#filters [data-link] option')->each(function ($node) {
            if ($node->attr('value')) {
                Link::updateOrCreate(
                    [
                        'dokkan_id' => $node->attr('value')
                    ],
                    [
                        'name' => $node->text(),
                        'effect' => $node->attr('data-skill-description'),
                        'dokkan_id' => $node->attr('value')
                    ]
                );
            }
        });

        $this->info('Links updated');
    }
}