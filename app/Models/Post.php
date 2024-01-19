<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'rubric_id'];

    public function rubric(): BelongsTo
    {
        return $this->belongsTo(Rubric::class);
    }
        
    protected $table = 'posts';

    public function tags() 
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getDate()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
    // protected $primaryKey = 'Code';
    // public $incrementing = false;
    // protected $keyType = 'string';
    // public $timestamps = false;

    // public $attributes = [
    //     'content' => 'lorem1'
    // ];

}
