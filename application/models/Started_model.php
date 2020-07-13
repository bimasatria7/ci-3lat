<?php
class   Started_model extends CI_Model
{
    public function register()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.png',
            'role_id' => 2,
            'is_active' => 0,
            'date_created' => time()
        ];

        $this->db->insert('user', $data);
    }

    public function token($token)
    {

        $data = [
            'email' => htmlspecialchars($this->input->post('email', true)),
            'token' => $token,
            'date_created' => time()
        ];
        $this->db->insert('user_token', $data);
    }
}
