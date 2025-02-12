<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'symbol'];

    /**
     * Retrieve the full currency display (e.g., "US Dollar ($)").
     *
     * @return string
     */
    public function getDisplayNameAttribute(): string
    {
        return "{$this->name} ({$this->symbol})";
    }

    /**
     * Retrieve the default currency (e.g., USD).
     *
     * @return Currency|null
     */
    public static function getDefaultCurrency()
    {
        return self::where('code', 'USD')->first(); // Replace 'USD' with your app's default currency
    }

    /**
     * Retrieve a currency symbol by its code.
     *
     * @param string $currencyCode
     * @return string
     */
    public static function getSymbol(string $currencyCode): string
    {
        $currency = self::where('code', $currencyCode)->first();
        return $currency ? $currency->symbol : $currencyCode; // Fallback to code if symbol not found
    }
}
