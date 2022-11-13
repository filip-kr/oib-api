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

    public function isOibValid(?string $oib): bool
    {
        if (strlen($oib) != 11) {
            return false;
        }

        if (!is_numeric($oib)) {
            return false;
        }

        $oibArray = array_map('intval', str_split($oib));

        $lastDigit = $oibArray[10];

        $oibArray[0] += 10;

        for ($i = 0; $i < 10; $i++) {
            if ($oibArray[$i] % 10 === 0) {
                $oibArray[$i] = 10;
            } else {
                $oibArray[$i] %= 10;
            }

            $oibArray[$i] *= 2;
            $oibArray[$i] %= 11;
            $oibArray[$i + 1] += $oibArray[$i];
        }

        if ($oibArray[9] === 1) {
            $controlDigit = 0;
        } else {
            $controlDigit = 11 - $oibArray[9];
        }

        if ($controlDigit === $lastDigit) {
            return true;
        }

        return false;
    }
}
