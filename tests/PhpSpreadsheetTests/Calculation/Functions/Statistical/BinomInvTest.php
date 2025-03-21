<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Statistical;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

class BinomInvTest extends AllSetupTeardown
{
    #[\PHPUnit\Framework\Attributes\DataProvider('providerBINOMINV')]
    public function testBINOMINV(mixed $expectedResult, mixed ...$args): void
    {
        $this->runTestCaseReference('BINOM.INV', $expectedResult, ...$args);
    }

    public static function providerBINOMINV(): array
    {
        return require 'tests/data/Calculation/Statistical/BINOMINV.php';
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providerBinomInvArray')]
    public function testBinomInvArray(
        array $expectedResult,
        string $trials,
        string $probabilities,
        string $alphas
    ): void {
        $calculation = Calculation::getInstance();

        $formula = "=BINOM.INV({$trials}, {$probabilities}, {$alphas})";
        $result = $calculation->_calculateFormulaValue($formula);
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-14);
    }

    public static function providerBinomInvArray(): array
    {
        return [
            'row/column vectors' => [
                [[32, 53], [25, 44]],
                '100',
                '{0.3, 0.5}',
                '{0.7; 0.12}',
            ],
        ];
    }
}
