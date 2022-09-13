<?php

namespace App\Traits;

use App\Models\Card;
use App\Models\Category;
use App\Models\Element;
use App\Models\Link;
use App\Models\Rarity;
use App\Models\Type;
use Illuminate\Support\Facades\Log;
use Weidner\Goutte\GoutteFacade;

trait DokkanScrapingTrait
{
    protected $total = 0;
    protected $progressBar;

    public function get_dokkan_data()
    {
        $crawler = GoutteFacade::request('GET', 'https://www.dokkanbattleoptimizer.com/');

        $this->get_categories($crawler);
        $this->get_links($crawler);
        $this->get_total_count($crawler);
        $this->get_cards($crawler);
    }

    function get_total_count($crawler)
    {
        $this->total = 0;

        $crawler->filter('.character')->each(function ($node) {
            if ($node->attr('data-name')) {
                $this->total++;
            }
        });

        $this->progressBar = $this->output->createProgressBar($this->total);
        $this->progressBar->setFormat('%current%/%max% [%bar%] %percent:3s%% %elapsed:6s%/%estimated:-6s%');
        $this->progressBar->start();
    }

    function get_cards($crawler)
    {
        $crawler->filter('.character')->each(function ($node) {
            if ($node->attr('data-name')) {

                $dokkan_id = $node->attr('data-id') + 1;

                $card = Card::updateOrCreate(
                    [
                        'dokkan_id' => $dokkan_id
                    ],
                    [
                        'name' => $node->attr('data-name'),
                        'dokkan_id' => $dokkan_id,
                        'image' => $node->filter('img')->attr('src'),
                        'rarity_id' => Rarity::where('name', $node->attr('data-rarity'))->first()->id,
                        'type_id' => Type::where('name', $node->attr('data-class'))->first()->id,
                        'element_id' => Element::where('name', $node->attr('data-type'))->first()->id,
                    ]
                );

                $categories = array_values(array_filter(explode('-', str_replace(str_split('[]'), '-', $node->attr('data-categories')))));

                foreach ($categories as $category) {
                    $card->categories()->syncWithoutDetaching(Category::where('dokkan_id', $category)->first()->id);
                }

                $links = array_values(array_filter(explode('-', str_replace(str_split('[]'), '-', $node->attr('data-links')))));

                foreach ($links as $link) {
                    $card->links()->syncWithoutDetaching(Link::where('dokkan_id', $link)->first()->id);
                }

                $this->progressBar->advance();
            }
        });

        $this->progressBar->finish();
        $this->info("\nCards updated");
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
