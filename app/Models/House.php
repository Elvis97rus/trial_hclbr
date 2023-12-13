<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
                            'name',
                            'price',
                            'bedrooms',
                            'bathrooms',
                            'storeys',
                            'garages'
                        ];

    public function scopeBedrooms(Builder $query, int $num): void
    {
        $query->where('bedrooms', $num);
    }

    public function scopeBathrooms(Builder $query, int $num): void
    {
        $query->where('bathrooms', $num);
    }

    public function scopeStoreys(Builder $query, int $num): void
    {
        $query->where('storeys', $num);
    }

    public function scopeGarages(Builder $query, int $num): void
    {
        $query->where('garages', $num);
    }

    public function scopeName(Builder $query, string $name): void
    {
        $query->where('name','like', "%$name%");
    }
    public function scopePrice(Builder $query, array $price): void
    {
        if ($price['from']){
            $query->where('price', '>', $price['from']);
        }
        if ($price['to']){
            $query->where('price', '<=', $price['to']);
        }
    }

    public static function getFilteredHouses(array $form): array
    {
        if (!$form['name'] && !$form['price']['from'] && !$form['price']['to']
            && !$form['bathrooms'] && !$form['storeys'] && !$form['garages']
            && !$form['bedrooms'])
        {
            return static::all()->toArray();
        }

        $query = static::query();

        if ($form['bedrooms']){
            $query->bedrooms(intval($form['bedrooms']));
        }

        if ($form['bathrooms']){
            $query->bathrooms(intval($form['bathrooms']));
        }

        if ($form['storeys']){
            $query->storeys(intval($form['storeys']));
        }

        if ($form['garages']){
            $query->garages(intval($form['garages']));
        }

        if ($form['name']){
            $query->name(($form['name']));
        }

        if ($form['price']['from'] || $form['price']['to']){
            $query->price(($form['price']));
        }

        if ($query){
            return $query->get()->toArray();
        }

        return [];
    }
}
