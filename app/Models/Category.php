<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;
    protected $table = 'categories';
    public $translatedAttributes = ['name'];
    protected $guarded = [];

    //relation
    public function Childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function Parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getParent(){
        if($this->Parent)
            return $this->Parent->translate(LaravelLocalization::getCurrentLocale())->name;

        return '-';
    }
}
