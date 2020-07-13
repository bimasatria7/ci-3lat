<?php

class Aplikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        access();
    }
    public function index()
    {
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['pg'] = "My Profile";
        // $data['menu'] = $this->User_model->getMenu($this->session->userdata('role_id'));
        // $data['sub_menu'] = $this->User_model->getSubMenu($this->session->userdata('role_id'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/top_bar', $data);
        $this->load->view('user', $data);
        $this->load->view('templates/footer');
    }
    public function editProfile()
    {
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['pg'] = "Edit Profile";

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run()  == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->User_model->edit_profile($data['user']['image']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile have been edited</div> ');
            redirect('Aplikasi');
        }
    }

    public function changepassword()
    {
        $data['user'] = $this->User_model->getData($this->session->userdata('email'));
        $data['role'] = $this->User_model->roleUser($data['user']['email']);
        $data['pg'] = "Change Password";

        $this->form_validation->set_rules('currentpass', 'Password', 'required|trim');
        $this->form_validation->set_rules('newpass', 'New Password', 'required|trim|min_length[4]|matches[repass]');
        $this->form_validation->set_rules('repass', 'Password Confirmation', 'required|trim|matches[newpass]');

        if ($this->form_validation->run()  == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/top_bar', $data);
            $this->load->view('change', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('currentpass');
            $new_password = $this->input->post('newpass');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password</div> ');
                redirect('Aplikasi/changepassword');
            } else {
                if ($new_password == $current_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password</div> ');
                    redirect('Aplikasi/changepassword');
                } else {
                    $this->db->update('user', ['password' => password_hash($this->input->post('newpass'), PASSWORD_DEFAULT)], ['email' => $data['user']['email']]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password have been changed</div> ');
                    redirect('Aplikasi');
                }
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div> ');
        redirect('Started');
    }
}
