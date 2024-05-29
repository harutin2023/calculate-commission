<?php
namespace App\Traits;

use App\Libraries\Countries;
trait HelperTrait
{
    public function ceil(float $amount, int $precision): float
    {
        $pow = pow(10, $precision);
        return (ceil( $pow * $amount) + ceil($pow * $amount - ceil($pow * $amount))) / $pow;
    }

    public function convert(array $rates, string $currency, float $amount): float
    {
        if (!empty($rates[$currency]) && $rates[$currency] > 0) {
            $amount = $amount / $rates[$currency];
        }

        return $amount;
    }

    public function isEuropeCountry(string $countryCode): bool
    {
        return in_array($countryCode, Countries::COUNTRY_CODES, true);
    }
}
