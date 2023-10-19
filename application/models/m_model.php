<?php

class M_model extends CI_Model
    {
        function get_absensi_by_karyawan($id_karyawan) {
            $this->db->where('id_karyawan', $id_karyawan);
            return $this->db->get('absensi')->result();
        }

        function get_masuk($id_karyawan) {
            $this->db->where('id_karyawan', $id_karyawan);
            return $this->db->get('absensi')->result();
        }

        function get_izin($table, $id_karyawan)
        {
            return $this->db->where('id_karyawan', $id_karyawan)
            ->where('kegiatan', '-')
            ->get($table);
        }

        function get_absen($table, $id_karyawan)
        {
            return $this->db->where('id_karyawan', $id_karyawan)
            ->where('keterangan_izin', 'masuk')
            ->get($table);
        }

        function get_data_by_user($table, $user_id) {
            $this->db->where('id_karyawan', $user_id);
            return $this->db->get($table);
        }

        function get_data($table){
            return $this->db->get($table);
        }

        function getwhere($table, $data){
            return $this->db->get_where($table, $data);
        }

        public function delete($table, $field, $id) {
            $data = $this->db->delete($table, array($field => $id));
            return $data;
        }

        public function tambah_data($table, $data) {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }

        public function get_by_id($table, $id_column, $id) {
            $data = $this->db->where($id_column, $id)->get($table);
            return $data;
        }

        public function update_data($table, $data, $where) {
            $this->db->update($table, $data, $where);
            return $this->db->affected_rows();
        }

        public function updateStatusPulang($id) {
            date_default_timezone_set('Asia/Jakarta');
            $data = array(
                'jam_pulang' => date('Y-m-d H:i:s'),
                'status' => 'true'
            );
        
            // Dapatkan data jam masuk sebelum memperbarui
            $this->db->select('jam_masuk');
            $this->db->where('id', $id);
            $query = $this->db->get('absensi');
            $row = $query->row();
            $jam_masuk = $row->jam_masuk; // Dapatkan nilai jam masuk sebelum memperbarui
        
            // Tetapkan nilai jam masuk yang sama ke dalam data sebelum memperbarui
            $data['jam_masuk'] = $jam_masuk;
        
            // Lakukan pembaruan data dengan tetap mempertahankan jam masuk yang sama
            $this->db->where('id', $id);
            $this->db->update('absensi', $data);
        }
        
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

        public function update_image($user_id, $new_image) {
            $data = array(
                'image' => $new_image
            );
    
            $this->db->where('id', $user_id); // Sesuaikan dengan kolom dan nama tabel yang sesuai
            $this->db->update('user', $data); // Sesuaikan dengan nama tabel Anda
    
            return $this->db->affected_rows(); // Mengembalikan jumlah baris yang diupdate
        }

        public function get_current_image($user_id) {
            $this->db->select('image');
            $this->db->from('user'); // Gantilah 'user_table' dengan nama tabel Anda
            $this->db->where('id', $user_id);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                $row = $query->row();
                return $row->image;
            }
    
            return null; // Kembalikan null jika data tidak ditemukan
        }

        public function cek_absen($id_karyawan, $tanggal) {
            $this->db->where('id_karyawan', $id_karyawan);
            $this->db->where('date', $tanggal);
            $query = $this->db->get('absensi');
        
            if ($query->num_rows() > 0) {
                return true; // Jika sudah ada entri absen untuk karyawan dan tanggal tertentu
            } else {
                return false; // Jika belum ada entri absen untuk karyawan dan tanggal tertentu
            }
        }

        public function cek_izin($id_karyawan, $tanggal) {
            $this->db->where('id_karyawan', $id_karyawan);
            $this->db->where('date', $tanggal);
            $this->db->where('status', 'true'); // Hanya mencari entri dengan status izin
            $query = $this->db->get('absensi');

            if ($query->num_rows() > 0) {
                return true; // Jika sudah ada entri izin untuk karyawan dan tanggal tertentu
            } else {
                return false; // Jika belum ada entri izin untuk karyawan dan tanggal tertentu
            }
        }

        public function getPerHari($tanggal)
        {
            $this->db->select('absensi.*, user.username');
            $this->db->from('absensi');
            $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
            $this->db->where('date', $tanggal);
            $query = $this->db->get();
            return $query->result();
        }

        public function getRekapPerMinggu($start_date, $end_date) {
            $this->db->select('absensi.*, user.username');
            $this->db->from('absensi');
            $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
            $this->db->where('date >=', $start_date);
            $this->db->where('date <=', $end_date);
            $query = $this->db->get();
            return $query->result();
        }        

        public function getRekapPerBulan($bulan) {
            $this->db->select('MONTH(date) as bulan, COUNT(*) as total_absensi, user.username');
            $this->db->from('absensi');
            $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
            $this->db->where('MONTH(date)', $bulan); // Menyaring data berdasarkan bulan
            $this->db->group_by('bulan');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getRekapHarianByBulan($bulan) {
            $this->db->select('absensi.*, user.username');
            $this->db->from('absensi');
            $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
            $this->db->where('MONTH(absensi.date)', $bulan);
            $query = $this->db->get();
            return $query->result_array();
        }

        public function getBulanan($bulan)
        {
            $this->db->select("absensi.*, user.username");
            $this->db->from("absensi");
            $this->db->join("user", "absensi.id_karyawan = user.id", "left");
            $this->db->where("DATE_FORMAT(date, '%m') = ", $bulan); // Perbaikan di sini
            $query = $this->db->get();
            return $query->result();
        }

        public function get_absensi_count() {
            return $this->db->count_all_results('absensi');
        }

        public function get_karyawan_rows() {
            return $this->db->get_where('user', array('role' => 'karyawan'))->num_rows();
        }
        
        public function get_data_by_role($role)
        {
            $this->db->where('role', $role);
            return $this->db->get('user');
        }

        public function getDataAbsensi()
        {
            // Ganti 'absensi' dengan tabel yang sesuai dalam database Anda
            $this->db->select('absensi.*, user.username');
            $this->db->from('absensi');
            $this->db->join('user', 'absensi.id_karyawan = user.id', 'left');
            return $this->db->get()->result();
        }
    }
?>