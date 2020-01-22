<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Esteticista_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertEsteticista($data) {
        $this->db->insert('Esteticista', $data);
    }

    function getEsteticista() {
        $query = $this->db->get('esteticista');
        return $query->result();
    }

    function getEsteticistaBySearch($search) {
        $this->db->order_by('id', 'desc');
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $this->db->or_like('department', $search);
        $query = $this->db->get('esteticista');
        return $query->result();
    }

    function getEsteticistaByLimit($limit, $start) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('esteticista');
        return $query->result();
    }

    function getEsteticistaByLimitBySearch($limit, $start, $search) {

        $this->db->like('id', $search);

        $this->db->order_by('id', 'desc');

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $this->db->or_like('department', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('esteticista');
        return $query->result();
    }

    function getEsteticistaById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('esteticista');
        return $query->row();
    }

    function updateEsteticista($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('Esteticista', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('esteticista');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
