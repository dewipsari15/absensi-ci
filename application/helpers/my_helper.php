<?php
function nama_karyawan($id)
{
    $ci =& get_instance();
    $ci->load->database();
    $result = $ci->db->where('id', $id)->get('user');
    foreach ($result->result() as $c) {
        $stmt = $c->nama_depan.' '.$c->nama_belakang;
        return $stmt;
    }
}


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

    $tanggal = date('d', strtotime($date));
    $bulan = $bulan[date('n', strtotime($date))];
    $tahun = date('Y', strtotime($date));

    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

?>