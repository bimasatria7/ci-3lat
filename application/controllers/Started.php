<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Started extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Started_model');
    }

    //////Login Controller/////
    public function index()
    {
        if ($this->session->userdata('email')) redirect('Aplikasi');
        $this->load->model('User_model');
        $data['pg'] = "Login";
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/start_header', $data);
            $this->load->view('login');
            $this->load->view('templates/start_footer');
        } else {
            $this->login();
            redirect('Started');
        }
    }

    private function login()
    {
        $email = htmlspecialchars($this->input->post('email', true));
        $password = $this->input->post('password', true);
        $user = $this->User_model->getData($email);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('Admin');
                    } else {
                        redirect('Aplikasi');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div> ');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your account not activated</div> ');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account not registered</div> ');
        }
    }

    /////End Login Controller/////


    /////Registration Controller/////
    public function registration()
    {

        if ($this->session->userdata('email')) redirect('Aplikasi');
        $data['pg'] = "User Registration";
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|matches[password1]', [
            'matches' => 'Password dont match',
            'min_length' => 'Password too short',
            'max_length' => 'Password too long'
        ]);

        $this->form_validation->set_rules('password1', 'Password Confirmation', 'required|matches[password]');
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/start_header', $data);
            $this->load->view('register');
            $this->load->view('templates/start_footer');
        } else {
            $token = base64_encode(random_bytes(32));
            $this->Started_model->register();
            $this->Started_model->token($token);
            $this->_sendEmail($token, 'active');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created , please activate your account</div> ');
            redirect('Started');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [

            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'lazeft721@gmail.com',
            'smtp_pass' => 'lazeft098',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->from('lazeft721@gmail.com', 'Lazeft Soft');
        $this->email->to($this->input->post('email'));

        if ($type == "active") {
            $this->email->subject('Activation Your Account');
            $this->email->message('Please follow this  <a href="' . base_url() . 'Started/activate?email=' . $this->input->post('email') . '&token=' . $token . '">
            link</a> to activate your account');
        } elseif ($type == "forgot") {
            $this->email->subject('Forgot Password');
            $this->email->message('Please follow this  <a href="' . base_url() . 'Started/forgot?email=' . $this->input->post('email') . '&token=' . $token . '">
            link</a> to reset your password');
        }


        if ($this->email->send()) {
            return true;
        } else {
            redirect('Started/connection_error');
        }
    }

    public function activate()
    {
        $email = $this->input->get('email', true);
        $token = $this->input->get('token', true);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                $one_day = 60 * 60 * 24;
                if (time() - $user_token['date_created'] < $one_day) {

                    $this->db->update('user', ['is_active' => 1], ['email' => $email]);
                    $this->db->delete('user_token', ['email'  => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account activation success! please login</div> ');
                    redirect('Started');
                } else {
                    $this->db->delete('user', ['email'  => $email]);
                    $this->db->delete('user_token', ['email'  => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! token expired, please recreate your account</div> ');
                    redirect('Started');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! token invalid</div> ');
                redirect('Started');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email</div> ');
            redirect('Started');
        }
    }



    /////End Registration Controller/////



    /////Forgot Password Controller/////

    public function forgotpassword()
    {
        $data['pg'] = "Forgot Password";

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/start_header', $data);
            $this->load->view('forgot');
            $this->load->view('templates/start_footer');
        } else {
            $token = base64_encode(random_bytes(32));
            $this->Started_model->token($token);
            $this->_sendEmail($token, 'forgot');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account is valid , please check your email</div> ');
        }
    }

    public function resetpassword()
    {
        $data['pg'] = "Reset Password";
        $email = $this->input->get('email', true);
        $token = $this->input->get('token', true);

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                $one_day = 60 * 60 * 24;
                if (time() - $user_token['date_created'] < $one_day) {

                    $this->form_validation->set_rules('newpass', 'New Password', 'required|trim|min_length[4]|matches[repass]');
                    $this->form_validation->set_rules('repass', 'Password Confirmation', 'required|trim|matches[newpass]');

                    if ($this->form_validation->run() == false) {

                        $this->load->view('templates/start_header', $data);
                        $this->load->view('reset');
                        $this->load->view('templates/start_footer');
                    } else {
                        $this->db->update('user', ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)], ['email' => $email]);
                        $this->db->delete('user_token', ['email'  => $email]);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Reset password success! please login</div> ');
                        redirect('Started');
                    }
                } else {
                    $this->db->delete('user_token', ['email'  => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! token expired, please recreate your account</div> ');
                    redirect('Started/forgotpassword');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! token invalid</div> ');
                redirect('Started/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email</div> ');
            redirect('Started/forgotpassword');
        }
    }

    /////End Forgot Password Controller/////


    public function denied()
    {
        $data['pg'] = "Access Denied";
        $this->load->view('templates/header', $data);
        $this->load->view('denied');
        $this->load->view('templates/start_footer');
    }

    public function connection_error()
    {
        $data['pg'] = "Error Connection";
        $this->load->view('templates/header', $data);
        $this->load->view('error_conn');
        $this->load->view('templates/start_footer');
    }
}
