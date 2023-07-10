<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getPicture()
    {
        if($this->media_id) {
            return Media::where('id', $this->media_id)->first()->title;
        } else {
            return 'none_picture.svg';
        }

    }
    public function getTags()
    {
        $explode = explode(';', $this->tags);
        $tags = [];
        foreach ($explode as $ex) {
            $value = trim($ex);
            $tags[] = $value;
        }
        return $tags;
    }

    public function getLabels()
    {
        $explode = explode(';', $this->labels);
        $labels = [];
        foreach ($explode as $ex) {
            $value = trim($ex);
            $labels[] = $value;
        }
        return $labels;
    }
}
