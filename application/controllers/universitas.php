<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Universitas extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        $this->load->model('Universitas_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // validasi login
        if (!$this->session->userdata('level')){
            redirect('login');
        }else{
          if ($this->session->userdata('level')!='admin') {
            redirect ('validasi_level');
            # code...
          }
        }
        $universitas = $this->Universitas_model->get_all();

        $data = array(
            'universitas_data' => $universitas
        );

        $this->template->load('v_admin','universitas_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Universitas_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_universitas' => $row->id_universitas,
		'universitas' => $row->universitas,
	    );
            $this->template->load('v_admin','universitas_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('universitas'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Tambah',
            'action' => site_url('universitas/create_action'),
	    'id_universitas' => set_value('id_universitas'),
	    'universitas' => set_value('universitas'),
	);
        $this->template->load('v_admin','universitas_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'universitas' => $this->input->post('universitas',TRUE),
	    );

            $this->Universitas_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('universitas'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Universitas_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Ubah',
                'action' => site_url('universitas/update_action'),
		'id_universitas' => set_value('id_universitas', $row->id_universitas),
		'universitas' => set_value('universitas', $row->universitas),
	    );
            $this->template->load('v_admin','universitas_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('universitas'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_universitas', TRUE));
        } else {
            $data = array(
		'universitas' => $this->input->post('universitas',TRUE),
	    );

            $this->Universitas_model->update($this->input->post('id_universitas', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('universitas'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Universitas_model->get_by_id($id);

        if ($row) {
            $this->Universitas_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('universitas'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('universitas'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('universitas', 'universitas', 'trim|required');

	$this->form_validation->set_rules('id_universitas', 'id_universitas', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function pdf()
    {
        $data = array(
            'universitas_data' => $this->Universitas_model->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        $html = $this->load->view('universitas_pdf', $data, true);
        $this->load->library('pdf');
        $pdf = $this->pdf->load();
        $pdf->WriteHTML($html);
        $pdf->Output('universitas.pdf', 'D'); 
    }

}
