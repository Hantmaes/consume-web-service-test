<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class NewsItem extends Model implements Feedable
{
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'ares_firma_fin' => $this->ares_firma_fin,
            'ares_ulice_fin' => $this->ares_ulice_fin,
            'ares_mesto_fin' => $this->ares_mesto_fin,
            'ares_psc_fin' => $this->ares_psc_fin,
            'ares_dic_fin' => $this->ares_dic_fin,
            'updated' => $this->updated_at,
            'link' => $this->link,
          
        ]);
    }

    public static function getFeedItems()
    {
    return NewsItem::all();
    }
}
