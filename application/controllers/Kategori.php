<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kategori extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kategori = $this->db->get('tbl_kategori')->result();
        } else {
            $this->db->where('id_kategori', $id);
            $kategori = $this->db->get('tbl_kategori')->result();
        }
        $this->response($kategori, 200);
    }

    
      //Mengirim atau menambah data kontak baru
      function index_post() {
        $data = array(
                    'id_kategori'       => $this->post('id_kategiri'),
                    'kategori'          => $this->post('kategori'));
        $insert = $this->db->insert('tbl_kategori', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

      //Memperbarui data kontak yang telah ada
      function index_put() {
        $id = $this->put('id_kategori');
        $data = array(
                    'id_kategori'       => $this->put('id'),
                    'kategori'          => $this->put('kategori'));
        $this->db->where('id_kategori', $id);
        $update = $this->db->update('tbl_kategori', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

     //Menghapus salah satu data kontak
     function index_delete() {
        $id = $this->delete('id_kategori');
        $this->db->where('id_kategori', $id);
        $delete = $this->db->delete('tbl_kategori');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
?>