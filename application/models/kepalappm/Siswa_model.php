<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswa_model extends CI_Model
{

    public $table = 'siswa';
    public $table_nis = 'nomor_induk_siswa';
    public $id = 'id_siswa';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    // SELECT * FROM siswa join jurusan on siswa.id_jurusan=jurusan.id_jurusan
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->join('nomor_induk_siswa', 'nomor_induk_siswa.siswa_id=siswa.id_siswa','left');
        $this->db->join('jurusan', 'siswa.id_jurusan=jurusan.id_jurusan');
        $this->db->join('fakultas', 'siswa.id_fakultas=fakultas.id_fakultas');
        $this->db->join('universitas', 'siswa.id_universitas=universitas.id_universitas');
        $this->db->join('kelas', 'siswa.id_kelas=kelas.id_kelas');

        return $this->db->get($this->table)->result();
    }


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->join('nomor_induk_siswa', 'nomor_induk_siswa.siswa_id=siswa.id_siswa','left');
        $this->db->join('jurusan', 'siswa.id_jurusan=jurusan.id_jurusan');
        $this->db->join('fakultas', 'siswa.id_fakultas=fakultas.id_fakultas');
        $this->db->join('universitas', 'siswa.id_universitas=universitas.id_universitas');
        $this->db->join('kelas', 'siswa.id_kelas=kelas.id_kelas');

        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_siswa', $q);
	$this->db->or_like('siswa', $q);
	$this->db->or_like('nama_panggilan', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	// $this->db->or_like('umur', $q);
	$this->db->or_like('jenis_kelamnin', $q);
	$this->db->or_like('golongan_darah', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('provinsi', $q);
	$this->db->or_like('kabupaten', $q);
	$this->db->or_like('kecamatan', $q);
	$this->db->or_like('nama_ayah', $q);
	$this->db->or_like('pekerjaan_ayah', $q);
	$this->db->or_like('nama_ibu', $q);
	$this->db->or_like('pekerjaan_ibu', $q);
	$this->db->or_like('jumlah_saudara', $q);
	$this->db->or_like('urutan', $q);
	$this->db->or_like('universitas', $q);
	$this->db->or_like('fakultas', $q);
	$this->db->or_like('jurusan', $q);
	$this->db->or_like('tahun_masuk_universitas', $q);
	$this->db->or_like('tahun_masuk_ppm', $q);
	$this->db->or_like('id_kelas', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_siswa', $q);
	$this->db->or_like('siswa', $q);
	$this->db->or_like('nama_panggilan', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	// $this->db->or_like('umur', $q);
	$this->db->or_like('jenis_kelamnin', $q);
	$this->db->or_like('golongan_darah', $q);
	$this->db->or_like('no_hp', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('provinsi', $q);
	$this->db->or_like('kabupaten', $q);
	$this->db->or_like('kecamatan', $q);
	$this->db->or_like('nama_ayah', $q);
	$this->db->or_like('pekerjaan_ayah', $q);
	$this->db->or_like('nama_ibu', $q);
	$this->db->or_like('pekerjaan_ibu', $q);
	$this->db->or_like('jumlah_saudara', $q);
	$this->db->or_like('urutan', $q);
	$this->db->or_like('universitas', $q);
	$this->db->or_like('fakultas', $q);
	$this->db->or_like('jurusan', $q);
	$this->db->or_like('tahun_masuk_universitas', $q);
	$this->db->or_like('tahun_masuk_ppm', $q);
	$this->db->or_like('id_kelas', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);        
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);        
        $this->db->update($this->table, $data);

        // $query = $this->db->get_by_id($id);
        // if ($query->num_rows() > 0){
        //     $this->db->update($this->table_nis, $data);
        // }
        // else{
        //     $this->db->insert($this->table_nis, $data);
        // }
        
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
