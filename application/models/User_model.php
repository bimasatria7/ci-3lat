<?php
class User_model extends CI_Model
{
    public function getData($dt)
    {
        return $this->db->get_where('user', ['email' => $dt])->row_array();
    }
    public function roleUser($dt)
    {
        $role = $this->getData($dt);
        if ($role['role_id'] == 1) {
            return "Admin";
        } else {
            return "User";
        }
    }

    public function edit_profile($old_image)
    {


        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {

            $config['upload_path']          = './assets/img/users/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 2048;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {

                if ($old_image != "default.png") {
                    unlink(FCPATH . 'assets/img/users/' . $old_image);
                }
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }


        $data = [
            'email' => $this->input->post('email', true),
            'name' => $this->input->post('name', true),
        ];
        $this->db->update('user', $data, ['email' => $this->input->post('email', true)]);
    }
}
