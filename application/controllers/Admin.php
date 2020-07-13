<?php

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Menu_model');
        access();
    }
    public function index()
    {
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['pg'] = "Dashboard";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('admin', $data);
        $this->load->view('templates/footer');
    }
    public function userAccess()
    {
        $data['menu'] = $this->db->get('user_role')->result_array();
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['pg'] = "User Access Management";

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            if (isset($_POST['add'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role add failed</div> ');
            }
            if (isset($_POST['edit'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role edit failed</div> ');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('access', $data);
            $this->load->view('templates/footer');
        } else {
            if (isset($_POST['add'])) {
                $this->Menu_model->addRole();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role have been added</div> ');
            }
            if (isset($_POST['edit'])) {
                $this->Menu_model->editRole();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role have been edited</div> ');
            }
            redirect('Admin/userAccess');
        }
    }

    public function userRole($role_id)
    {
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['role_menu'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $data['menu'] = $this->db->get_where('user_menu', 'id !=1')->result_array();
        $data['pg'] = "User Role Management";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('role', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div> ');
    }

    public function hapusRole($id)
    {
        $this->db->delete('user_role', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Role have been deleted</div> ');
        redirect('Admin/userAccess');
    }

    public function getRole()
    {
        echo json_encode($this->db->get_where('user_role', ['id' => $_POST['id']])->row_array());
    }
}
