<?php

class M_model extends CI_Model
    {
        function get_absensi_by_karyawan($id_karyawan) {
            $this->db->where('id_karyawan', $id_karyawan);
            return $this->db->get('absensi')->result();
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
            $this->db->where('id', $id);
            $this->db->update('absensi', $data);
        }
    }
?>