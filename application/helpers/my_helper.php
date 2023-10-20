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


function convDate($date) {
    return date('d F Y', strtotime($date));
}

?>