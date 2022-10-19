<?php

namespace App\Models\Dokkan;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $guarded = ['id'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'card_categories');
    }

    public function links() {
        return $this->belongsToMany(Link::class, 'card_links');
    }
}
