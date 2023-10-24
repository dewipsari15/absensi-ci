<?php
// Relasi nama karyawan
function nama_karyawan($id)
{
    $ci =& get_instance(); // Mendapatkan instance CodeIgniter
    $ci->load->database(); // Memuat library database CodeIgniter
    $result = $ci->db->where('id', $id)->get('user'); // Mendapatkan data karyawan berdasarkan ID
    foreach ($result->result() as $c) {
        $stmt = $c->nama_depan.' '.$c->nama_belakang; // Menggabungkan nama depan dan nama belakang
        return $stmt; // Mengembalikan nama lengkap karyawan
    }
}

// Format tanggal Indonesia
function convDate($date) 
{
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $tanggal = date('d', strtotime($date)); // Mengambil tanggal dari timestamp
    $bulan = $bulan[date('n', strtotime($date))]; // Mengambil bulan dalam bentuk string
    $tahun = date('Y', strtotime($date)); // Mengambil tahun dari timestamp

    return $tanggal . ' ' . $bulan . ' ' . $tahun; // Mengembalikan tanggal yang diformat
}

?>