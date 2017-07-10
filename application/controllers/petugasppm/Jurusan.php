<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('petugasppm/Jurusan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
             // validasi login
        if (!$this->session->userdata('level')){
            redirect('login');
        }else{
          if ($this->session->userdata('level')!='petugas') {
            redirect ('validasi_level');
            # code...
          }
        }
        $jurusan = $this->Jurusan_model->get_all();

        $data = array(
            'jurusan_data' => $jurusan
        );

        $this->template->load('petugasppm/v_petugas','petugasppm/jurusan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jurusan' => $row->id_jurusan,
		'jurusan' => $row->jurusan,
	    );
            $this->template->load('petugasppm/v_petugas','petugasppm/jurusan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jurusan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('petugasppm/jurusan/create_action'),
	    'id_jurusan' => set_value('id_jurusan'),
	    'jurusan' => set_value('jurusan'),
	);
        $this->template->load('petugasppm/v_petugas','petugasppm/jurusan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jurusan' => $this->input->post('jurusan',TRUE),
	    );

            $this->Jurusan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('petugasppm/jurusan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('petugasppm/jurusan/update_action'),
		'id_jurusan' => set_value('id_jurusan', $row->id_jurusan),
		'jurusan' => set_value('jurusan', $row->jurusan),
	    );
            $this->template->load('petugasppm/v_petugas','petugasppm/jurusan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('petugasppm/jurusan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jurusan', TRUE));
        } else {
            $data = array(
		'jurusan' => $this->input->post('jurusan',TRUE),
	    );

            $this->Jurusan_model->update($this->input->post('id_jurusan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('petugasppm/jurusan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jurusan_model->get_by_id($id);

        if ($row) {
            $this->Jurusan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('petugasppm/jurusan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('petugasppm/jurusan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');

	$this->form_validation->set_rules('id_jurusan', 'id_jurusan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function pdf()
    {
        $data = array(
            'jurusan_data' => $this->Jurusan_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('jurusan_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('jurusan.pdf', 'D'); 
    }

}
