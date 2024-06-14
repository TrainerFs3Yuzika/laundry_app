<?php

function formatRupiah($amount)
{
    $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
    $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, 0);
    return $formatter->formatCurrency($amount, 'IDR');
}
