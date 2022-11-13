<?php

declare(strict_types=1);

namespace App\Service;

final class OibService
{
    public function generateOib(): string
    {
        $oib = [];
        for ($i = 0; $i < 10; $i++) {
            $oib[$i] = rand(0, 9);
        }

        $lastDigitArray = $oib;
        $lastDigitArray[0] += 10;

        for ($i = 0; $i < 10; $i++) {
            if ($lastDigitArray[$i] % 10 === 0) {
                $lastDigitArray[$i] = 10;
            } else {
                $lastDigitArray[$i] %= 10;
            }

            $lastDigitArray[$i] *= 2;
            $lastDigitArray[$i] %= 11;

            if (isset($lastDigitArray[$i + 1])) {
                $lastDigitArray[$i + 1] += $lastDigitArray[$i];
            }
        }

        if ($lastDigitArray[9] === 1) {
            $lastDigit = 0;
        } else {
            $lastDigit = 11 - $lastDigitArray[9];
        }

        $oib[10] = $lastDigit;

        return implode($oib);
    }
}