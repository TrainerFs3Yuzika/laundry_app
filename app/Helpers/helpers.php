<?php

function formatRupiah($amount)
{
    $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
    $formatter->setSymbol(NumberFormatter::CURRENCY_SYMBOL, 'Rp'); // Set the currency symbol to 'Rp'
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0); // No decimal places

    return $formatter->formatCurrency($amount, 'IDR');
}
