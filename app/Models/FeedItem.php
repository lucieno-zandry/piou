<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedItem extends Model
{
    use HasFactory;

    protected $fillable = ['feed_id', 'title', 'description', 'link'];

    // Define the relationship with the Feed model
    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}