<?php
namespace Budgetlens\PostNLApi\Traits;

use Budgetlens\PostNLApi\Exceptions\InvalidBarcodeException;

/**
 * Barcode (helper) trait
*/

trait BarcodeTrait
{
    public static function getBarcodeSerie(string $type, string $range, bool $eps = false)
    {
        switch ($type) {
            case '2S':
                $serie = '0000000-9999999';
                break;
            case '3S':
                if ($eps) {
                    switch (strlen($range)) {
                        case 4:
                            $serie = '0000000-9999999';
                            break 2;
                        case 3:
                            $serie = '10000000-20000000';
                            break 2;
                        case 1:
                            $serie = '5210500000-5210600000';
                            break 2;
                        default:
                            throw new InvalidBarcodeException('Invalid range');
                            break;
                    }
                }
                // Regular domestic codes
                $serie = (strlen($range) === 4 ? '987000000-987600000' : '0000000-9999999');
                break;
            default:
                // GlobalPack
                $serie = '0000-9999';
                break;
        }

        return $serie;
    }
}
