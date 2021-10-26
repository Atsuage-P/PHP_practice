<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use cebe\markdown\Markdown as Markdown;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
    ];

    public function url()
    {
        return route('pages.show', $this->title);
    }

    public function getUrlAttribute()
    {
        return $this->url();
    }

    // public function getRouteKeyName()
    // {
    //     return 'title';
    // }

    public function parse()
    {
        $parser = new Markdown();

        return $parser->parse($this->body);
    }

    public function getMarkdownBodyAttribute()
    {
        return $this->parse();
    }
}
