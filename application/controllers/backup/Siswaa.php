<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Siswaa extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Siswaa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $siswaa = $this->Siswaa_model->get_all();

        $data = array(
            'siswaa_data' => $siswaa
        );

        $this->template->load('template','siswaa_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Siswaa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_siswa' => $row->id_siswa,
		'nama_lengkap' => $row->nama_lengkap,
		'nama_panggilan' => $row->nama_panggilan,
		'tempat_lahir' => $row->tempat_lahir,
		'tanggal_lahir' => $row->tanggal_lahir,
		'umur' => $row->umur,
		'jenis_kelamnin' => $row->jenis_kelamnin,
		'golongan_darah' => $row->golongan_darah,
		'alamat' => $row->alamat,
		'provinsi' => $row->provinsi,
		'kabupaten' => $row->kabupaten,
		'kecamatan' => $row->kecamatan,
		'nama_ayah' => $row->nama_ayah,
		'pekerjaan_ayah' => $row->pekerjaan_ayah,
		'nama_ibu' => $row->nama_ibu,
		'pekerjaan_ibu' => $row->pekerjaan_ibu,
		'jumlah_saudara' => $row->jumlah_saudara,
		'urutan' => $row->urutan,
		'id_universitas' => $row->id_universitas,
		'id_fakultas' => $row->id_fakultas,
		'id_jurusan' => $row->id_jurusan,
		'angkatan_universitas' => $row->angkatan_universitas,
		'tahun_masuk_universitas' => $row->tahun_masuk_universitas,
		'angkatan_ppm' => $row->angkatan_ppm,
		'tahun_masuk_ppm' => $row->tahun_masuk_ppm,
		'id_kelas' => $row->id_kelas,
	    );
            $this->template->load('template','siswaa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswaa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('siswaa/create_action'),
	    'id_siswa' => set_value('id_siswa'),
	    'nama_lengkap' => set_value('nama_lengkap'),
	    'nama_panggilan' => set_value('nama_panggilan'),
	    'tempat_lahir' => set_value('tempat_lahir'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'umur' => set_value('umur'),
	    'jenis_kelamnin' => set_value('jenis_kelamnin'),
	    'golongan_darah' => set_value('golongan_darah'),
	    'alamat' => set_value('alamat'),
	    'provinsi' => set_value('provinsi'),
	    'kabupaten' => set_value('kabupaten'),
	    'kecamatan' => set_value('kecamatan'),
	    'nama_ayah' => set_value('nama_ayah'),
	    'pekerjaan_ayah' => set_value('pekerjaan_ayah'),
	    'nama_ibu' => set_value('nama_ibu'),
	    'pekerjaan_ibu' => set_value('pekerjaan_ibu'),
	    'jumlah_saudara' => set_value('jumlah_saudara'),
	    'urutan' => set_value('urutan'),
	    'id_universitas' => set_value('id_universitas'),
	    'id_fakultas' => set_value('id_fakultas'),
	    'id_jurusan' => set_value('id_jurusan'),
	    'angkatan_universitas' => set_value('angkatan_universitas'),
	    'tahun_masuk_universitas' => set_value('tahun_masuk_universitas'),
	    'angkatan_ppm' => set_value('angkatan_ppm'),
	    'tahun_masuk_ppm' => set_value('tahun_masuk_ppm'),
	    'id_kelas' => set_value('id_kelas'),
	);
        $this->template->load('template','siswaa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'nama_panggilan' => $this->input->post('nama_panggilan',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'umur' => $this->input->post('umur',TRUE),
		'jenis_kelamnin' => $this->input->post('jenis_kelamnin',TRUE),
		'golongan_darah' => $this->input->post('golongan_darah',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'provinsi' => $this->input->post('provinsi',TRUE),
		'kabupaten' => $this->input->post('kabupaten',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'nama_ayah' => $this->input->post('nama_ayah',TRUE),
		'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu',TRUE),
		'jumlah_saudara' => $this->input->post('jumlah_saudara',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'id_universitas' => $this->input->post('id_universitas',TRUE),
		'id_fakultas' => $this->input->post('id_fakultas',TRUE),
		'id_jurusan' => $this->input->post('id_jurusan',TRUE),
		'angkatan_universitas' => $this->input->post('angkatan_universitas',TRUE),
		'tahun_masuk_universitas' => $this->input->post('tahun_masuk_universitas',TRUE),
		'angkatan_ppm' => $this->input->post('angkatan_ppm',TRUE),
		'tahun_masuk_ppm' => $this->input->post('tahun_masuk_ppm',TRUE),
		'id_kelas' => $this->input->post('id_kelas',TRUE),
	    );

            $this->Siswaa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('siswaa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Siswaa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('siswaa/update_action'),
		'id_siswa' => set_value('id_siswa', $row->id_siswa),
		'nama_lengkap' => set_value('nama_lengkap', $row->nama_lengkap),
		'nama_panggilan' => set_value('nama_panggilan', $row->nama_panggilan),
		'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'umur' => set_value('umur', $row->umur),
		'jenis_kelamnin' => set_value('jenis_kelamnin', $row->jenis_kelamnin),
		'golongan_darah' => set_value('golongan_darah', $row->golongan_darah),
		'alamat' => set_value('alamat', $row->alamat),
		'provinsi' => set_value('provinsi', $row->provinsi),
		'kabupaten' => set_value('kabupaten', $row->kabupaten),
		'kecamatan' => set_value('kecamatan', $row->kecamatan),
		'nama_ayah' => set_value('nama_ayah', $row->nama_ayah),
		'pekerjaan_ayah' => set_value('pekerjaan_ayah', $row->pekerjaan_ayah),
		'nama_ibu' => set_value('nama_ibu', $row->nama_ibu),
		'pekerjaan_ibu' => set_value('pekerjaan_ibu', $row->pekerjaan_ibu),
		'jumlah_saudara' => set_value('jumlah_saudara', $row->jumlah_saudara),
		'urutan' => set_value('urutan', $row->urutan),
		'id_universitas' => set_value('id_universitas', $row->id_universitas),
		'id_fakultas' => set_value('id_fakultas', $row->id_fakultas),
		'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
		'angkatan_universitas' => set_value('angkatan_universitas', $row->angkatan_universitas),
		'tahun_masuk_universitas' => set_value('tahun_masuk_universitas', $row->tahun_masuk_universitas),
		'angkatan_ppm' => set_value('angkatan_ppm', $row->angkatan_ppm),
		'tahun_masuk_ppm' => set_value('tahun_masuk_ppm', $row->tahun_masuk_ppm),
		'id_kelas' => set_value('id_kelas', $row->id_kelas),
	    );
            $this->template->load('template','siswaa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswaa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_siswa', TRUE));
        } else {
            $data = array(
		'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
		'nama_panggilan' => $this->input->post('nama_panggilan',TRUE),
		'tempat_lahir' => $this->input->post('tempat_lahir',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'umur' => $this->input->post('umur',TRUE),
		'jenis_kelamnin' => $this->input->post('jenis_kelamnin',TRUE),
		'golongan_darah' => $this->input->post('golongan_darah',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'provinsi' => $this->input->post('provinsi',TRUE),
		'kabupaten' => $this->input->post('kabupaten',TRUE),
		'kecamatan' => $this->input->post('kecamatan',TRUE),
		'nama_ayah' => $this->input->post('nama_ayah',TRUE),
		'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah',TRUE),
		'nama_ibu' => $this->input->post('nama_ibu',TRUE),
		'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu',TRUE),
		'jumlah_saudara' => $this->input->post('jumlah_saudara',TRUE),
		'urutan' => $this->input->post('urutan',TRUE),
		'id_universitas' => $this->input->post('id_universitas',TRUE),
		'id_fakultas' => $this->input->post('id_fakultas',TRUE),
		'id_jurusan' => $this->input->post('id_jurusan',TRUE),
		'angkatan_universitas' => $this->input->post('angkatan_universitas',TRUE),
		'tahun_masuk_universitas' => $this->input->post('tahun_masuk_universitas',TRUE),
		'angkatan_ppm' => $this->input->post('angkatan_ppm',TRUE),
		'tahun_masuk_ppm' => $this->input->post('tahun_masuk_ppm',TRUE),
		'id_kelas' => $this->input->post('id_kelas',TRUE),
	    );

            $this->Siswaa_model->update($this->input->post('id_siswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('siswaa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Siswaa_model->get_by_id($id);

        if ($row) {
            $this->Siswaa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('siswaa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('siswaa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_lengkap', 'nama lengkap', 'trim|required');
	$this->form_validation->set_rules('nama_panggilan', 'nama panggilan', 'trim|required');
	$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('umur', 'umur', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamnin', 'jenis kelamnin', 'trim|required');
	$this->form_validation->set_rules('golongan_darah', 'golongan darah', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('provinsi', 'provinsi', 'trim|required');
	$this->form_validation->set_rules('kabupaten', 'kabupaten', 'trim|required');
	$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
	$this->form_validation->set_rules('nama_ayah', 'nama ayah', 'trim|required');
	$this->form_validation->set_rules('pekerjaan_ayah', 'pekerjaan ayah', 'trim|required');
	$this->form_validation->set_rules('nama_ibu', 'nama ibu', 'trim|required');
	$this->form_validation->set_rules('pekerjaan_ibu', 'pekerjaan ibu', 'trim|required');
	$this->form_validation->set_rules('jumlah_saudara', 'jumlah saudara', 'trim|required');
	$this->form_validation->set_rules('urutan', 'urutan', 'trim|required');
	$this->form_validation->set_rules('id_universitas', 'id universitas', 'trim|required');
	$this->form_validation->set_rules('id_fakultas', 'id fakultas', 'trim|required');
	$this->form_validation->set_rules('id_jurusan', 'id jurusan', 'trim|required');
	$this->form_validation->set_rules('angkatan_universitas', 'angkatan universitas', 'trim|required');
	$this->form_validation->set_rules('tahun_masuk_universitas', 'tahun masuk universitas', 'trim|required');
	$this->form_validation->set_rules('angkatan_ppm', 'angkatan ppm', 'trim|required');
	$this->form_validation->set_rules('tahun_masuk_ppm', 'tahun masuk ppm', 'trim|required');
	$this->form_validation->set_rules('id_kelas', 'id kelas', 'trim|required');

	$this->form_validation->set_rules('id_siswa', 'id_siswa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "siswaa.xls";
        $judul = "siswaa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Lengkap");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Panggilan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Umur");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamnin");
	xlsWriteLabel($tablehead, $kolomhead++, "Golongan Darah");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Provinsi");
	xlsWriteLabel($tablehead, $kolomhead++, "Kabupaten");
	xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ayah");
	xlsWriteLabel($tablehead, $kolomhead++, "Pekerjaan Ayah");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Pekerjaan Ibu");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Saudara");
	xlsWriteLabel($tablehead, $kolomhead++, "Urutan");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Universitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Fakultas");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Jurusan");
	xlsWriteLabel($tablehead, $kolomhead++, "Angkatan Universitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Masuk Universitas");
	xlsWriteLabel($tablehead, $kolomhead++, "Angkatan Ppm");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun Masuk Ppm");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Kelas");

	foreach ($this->Siswaa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_lengkap);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_panggilan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteNumber($tablebody, $kolombody++, $data->umur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamnin);
	    xlsWriteLabel($tablebody, $kolombody++, $data->golongan_darah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->provinsi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kabupaten);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pekerjaan_ayah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_ibu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pekerjaan_ibu);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_saudara);
	    xlsWriteNumber($tablebody, $kolombody++, $data->urutan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_universitas);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_fakultas);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_jurusan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->angkatan_universitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun_masuk_universitas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->angkatan_ppm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun_masuk_ppm);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_kelas);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=siswaa.doc");

        $data = array(
            'siswaa_data' => $this->Siswaa_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('siswaa_doc',$data);
    }

}

/* End of file Siswaa.php */
/* Location: ./application/controllers/Siswaa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-05-27 11:25:03 */
/* http://harviacode.com */