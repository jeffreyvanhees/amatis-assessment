<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'vat_included',
        'vat_rate',
    ];

    /**
     * Calculate price excluding VAT
     * @param $value
     * @return float|int
     */
    public function getPriceAttribute($value)
    {
        if ($this->vat_included) {
            return 100 / (100 + $this->vat_rate) * $value;
        }

        return $value;
    }

    /**
     * Calculate VAT-value
     * @param $value
     * @return mixed
     */
    public function getVatAttribute($value)
    {
        return $this->price / 100 * $this->vat_rate;
    }

    /**
     * Calculate the price including VAT
     * @param $value
     * @return float|int
     */
    public function getPriceIncludingVatAttribute($value)
    {
        return array_sum([
            $this->price,
            $this->vat,
        ]);
    }
}
