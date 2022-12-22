<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait Trans
{
    public function getTransNameAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)[App::currentLocale()];
        }
        return '';
    }
    public function getEnNameAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)['en'];
        }
        return '';
    }
    public function getArNameAttribute()
    {
        if ($this->name) {
            return json_decode($this->name, true)['ar'];
        }
        return '';
    }
    public function getTransDescriptionAttribute()
    {
        if ($this->description) {
            return json_decode($this->description, true)[App::currentLocale()];
        }
        return '';
    }
    public function getEnDescriptionAttribute()
    {
        if ($this->description) {
            return json_decode($this->description, true)['en'];
        }
        return '';
    }
    public function getArDescriptionAttribute()
    {
        if ($this->description) {
            return json_decode($this->description, true)['ar'];
        }
        return '';
    }
    public function getFinalPriceAttribute()
    {
        if ($this->sale_price) {
            return $this->sale_price;
        }

        return $this->price;
    }
    public function getDiscountTypeAttribute($value)
    {
        if ($this->type == 'value') {
            return $this->discount . '$';
        } elseif ($this->type == 'percentage') {
            return $this->discount . '%';
        } else return '';
    }
}
//
