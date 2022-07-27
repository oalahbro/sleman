<?php

use Masehi\Converter as MasehiConverter;

/**
 * Rubah format tanggal ke format Indonesia dengan nama bulan dan hari Indonesia
 *
 * @param string $timestamp   [bisa dalam bentuk timestamp atau unix_date]
 * @param string $date_format [d F Y ==> 12 Januari 2017]
 * @param string $suffix      [contoh tuliskan WIB default false]
 *
 * @return [string] [tanggal indonesia]
 */
function indonesian_date($timestamp = '', $date_format = 'd F Y', $suffix = '')
{
    return MasehiConverter::convertDate(['date' => $timestamp, 'format' => $date_format]) . $suffix;
}
