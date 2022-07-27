<?php

function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
{

    // mengambil nilai kode ex: USR0015 hasil USR
    $kode = substr($id_terakhir, 0, $panjang_kode);

    // mengambil nilai angka
    // ex: USR0015 hasilnya 0015
    $angka = substr($id_terakhir, $panjang_kode, $panjang_angka);

    // menambahkan nilai angka dengan 1
    // kemudian memberikan string 0 agar panjang string angka menjadi 4
    // ex: angka baru = 6 maka ditambahkan strig 0 tiga kali
    // sehingga menjadi 0006
    $angka_baru = str_repeat('0', $panjang_angka - strlen($angka + 1)) . ($angka + 1);

    // menggabungkan kode dengan nilang angka baru
    return $kode . $angka_baru;
}

function format_ribuan($num)
{
    // Format akan berfungsi jika terdapat kelipatan ribuan.
    // Contoh 1000 -> 1 ribu
    // Contoh 1000000 -> 1 juta
    // Contoh 1000000000 -> 1 miliar
    // Contoh 1000000000000 -> 1 triliun
    if ($num >= 1000) {
        $x               = round($num);
        $x_number_format = number_format($x);
        $x_array         = explode(',', $x_number_format);
        $x_parts         = [' ribu', ' juta', ' miliar', ' triliun'];
        $x_count_parts   = count($x_array) - 1;
        $x_display       = $x;
        $x_display       = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];

        return $x_display;
    }

    return $num;
}
