<?php
class M_model extends CI_Model
{
    // Mendapatkan data absensi berdasarkan karyawan
    function get_absensi_by_karyawan($id_karyawan) {
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->get('absensi')->result();
    }

    // Mendapatkan data masuk berdasarkan karyawan
    function get_masuk($id_karyawan) {
        $this->db->where('id_karyawan', $id_karyawan);
        return $this->db->get('absensi')->result();
    }

    // Mendapatkan data izin berdasarkan tabel dan karyawan
    function get_izin($table, $id_karyawan)
    {
        return $this->db->where('id_karyawan', $id_karyawan)
                        ->where('kegiatan', '-')
                        ->get($table);
    }

    // Mendapatkan data absen berdasarkan tabel dan karyawan
    function get_absen($table, $id_karyawan)
    {
        return $this->db->where('id_karyawan', $id_karyawan)
                        ->where('keterangan_izin', 'masuk')
                        ->get($table);
    }

    // Mendapatkan data berdasarkan user dari tabel tertentu
    function get_data_by_user($table, $user_id) {
        $this->db->where('id_karyawan', $user_id);
        return $this->db->get($table);
    }

    // Mendapatkan semua data dari tabel tertentu
    function get_data($table){
        return $this->db->get($table);
    }

    // Mendapatkan data dari tabel berdasarkan kondisi tertentu
    function getwhere($table, $data){
        return $this->db->get_where($table, $data);
    }

    // Menghapus data dari tabel berdasarkan kondisi
    public function delete($table, $field, $id) {
        $data = $this->db->delete($table, array($field => $id));
        return $data;
    }

    // Menambahkan data ke dalam tabel
    public function tambah_data($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    // Mendapatkan data dari tabel berdasarkan ID kolom
    public function get_by_id($table, $id_column, $id) {
        $data = $this->db->where($id_column, $id)->get($table);
        return $data;
    }

    // Memperbarui data dalam tabel berdasarkan kondisi tertentu
    public function update_data($table, $data, $where) {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    // Memperbarui status pulang berdasarkan ID
    public function updateStatusPulang($id) {
        date_default_timezone_set('Asia/Jakarta');
        $data = array(
            'jam_pulang' => date('Y-m-d H:i:s'),
            'status' => 'true'
        );
    
        $this->db->select('jam_masuk');
        $this->db->where('id', $id);
        $query = $this->db->get('absensi');
        $row = $query->row();
        $jam_masuk = $row->jam_masuk;
    
        $data['jam_masuk'] = $jam_masuk;
    
        $this->db->where('id', $id);
        $this->db->update('absensi', $data);
    }
    
    // Mendapatkan gambar pengguna
    public function image_user()
    {
        $id_karyawan = $this->session->userdata('id');
        $this->db->select('image');
        $this->db->from('user');
        $this->db->where('id_karyawan');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $result = $query->row();
            return $result->image;
        } else {
            return false;
        }
    }

    // Memperbarui gambar pengguna
    public function update_image($user_id, $new_image) {
        $data = array(
            'image' => $new_image
        );

        $this->db->where('id', $user_id);
        $this->db->update('user', $data);

        return $this->db->affected_rows();
    }

    // Mendapatkan gambar saat ini berdasarkan ID pengguna
    public function get_current_image($user_id) {
        $this->db->select('image');
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->image;
        }

        return null;
    }

    // Mendapatkan password berdasarkan ID
    public function getPasswordById($id)
    {
        $this->db->select('password');
        $this->db->where('id', $id);
        $query = $this->db->get('user');

        if ($query->num_rows() == 1) {
            $row = $query->row();
            return $row->password;
        } else {
            return false;
        }
    }

    // Mengupdate password berdasarkan ID
    public function update_password($id, $new_password)
    { 
        $this->db->set('password', $new_password);
        $this->db->where('id', $id);
        $this->db->update('user');

        return $this->db->affected_rows() > 0;
    }

    // Memeriksa kehadiran berdasarkan ID karyawan dan tanggal
    public function cek_absen($id_karyawan, $tanggal) {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('date', $tanggal);
        $query = $this->db->get('absensi');
        
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Memeriksa izin berdasarkan ID karyawan dan tanggal
    public function cek_izin($id_karyawan, $tanggal) {
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('date', $tanggal);
        $this->db->where('status', 'true');
        $query = $this->db->get('absensi');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Mendapatkan data per hari berdasarkan tanggal
    public function getPerHari($tanggal)
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('date', $tanggal);
        $query = $this->db->get();
        return $query->result();
    }

    // Mendapatkan rekap per minggu berdasarkan rentang tanggal
    public function getRekapPerMinggu($start_date, $end_date) {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('date >=', $start_date);
        $this->db->where('date <=', $end_date);
        $query = $this->db->get();
        return $query->result();
    }        

    // Mendapatkan rekap per bulan berdasarkan bulan
    public function getRekapPerBulan($bulan) {
        $this->db->select('MONTH(date) as bulan, COUNT(*) as total_absensi, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('MONTH(date)', $bulan);
        $this->db->group_by('bulan');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mendapatkan rekap harian berdasarkan bulan
    public function getRekapHarianByBulan($bulan) {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        $this->db->where('MONTH(absensi.date)', $bulan);
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mendapatkan data bulanan berdasarkan bulan
    public function getBulanan($bulan)
    {
        $this->db->select("absensi.*, user.*");
        $this->db->from("absensi");
        $this->db->join("user", "absensi.id_karyawan = user.id", "left");
        $this->db->where("DATE_FORMAT(date, '%m') = ", $bulan);
        $query = $this->db->get();
        return $query->result();
    }

    // Mendapatkan jumlah data absensi
    public function get_absensi_count() {
        return $this->db->count_all_results('absensi');
    }

    // Mendapatkan jumlah baris karyawan
    public function get_karyawan_rows() {
        return $this->db->get_where('user', array('role' => 'karyawan'))->num_rows();
    }
    
    // Mendapatkan data berdasarkan peran
    public function get_data_by_role($role)
    {
        $this->db->where('role', $role);
        return $this->db->get('user');
    }

    // Mendapatkan data absensi
    public function getDataAbsensi()
    {
        $this->db->select('absensi.*, user.*');
        $this->db->from('absensi');
        $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
        return $this->db->get()->result();
    }
}
?>