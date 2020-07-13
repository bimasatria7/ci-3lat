<?php

class Menu extends CI_Controller
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
        $data['pg'] = "Menu Management";
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            if (isset($_POST['add'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu added failed</div> ');
            }
            if (isset($_POST['edit'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Menu edit failed</div> ');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('menu', $data);
            $this->load->view('templates/footer');
        } else {
            if (isset($_POST['add'])) {
                $this->Menu_model->addMenu();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu have been added</div> ');
            }
            if (isset($_POST['edit'])) {
                $this->Menu_model->editMenu();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu have been edited</div> ');
            }
            redirect('Menu');
        }
    }


    public function subMenu()
    {
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['pg'] = "Sub Menu Management";
        $data['submenu'] = $this->Menu_model->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'Icon', 'required|trim');
        if ($this->form_validation->run() == false) {
            if (isset($_POST['add'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Menu add failed</div> ');
            }
            if (isset($_POST['edit'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sub Menu edit failed</div> ');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('submenu', $data);
            $this->load->view('templates/footer');
        } else {
            if (isset($_POST['add'])) {
                $this->Menu_model->addSubMenu();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu have been added</div> ');
            }
            if (isset($_POST['edit'])) {
                $this->Menu_model->editSubMenu();
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu have been edited</div> ');
            }
            redirect('Menu/subMenu');
        }
    }

    public function hapusMenu($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu have been deleted</div> ');
        redirect('Menu');
    }
    public function hapusSubMenu($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sub Menu have been deleted</div> ');
        redirect('Menu/subMenu');
    }


    //AJAX get data send to modal

    public function getMenu()
    {
        echo json_encode($this->db->get_where('user_menu', ['menu' => $_POST['id']])->row_array());
    }

    public function getSubMenu()
    {
        echo json_encode($this->db->get_where('user_sub_menu', ['id' => $_POST['id']])->row_array());
    }
}
