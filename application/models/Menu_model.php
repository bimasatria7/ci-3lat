<?php
class Menu_model extends CI_Model
{
    public function getMenu($dt)
    {
        $role_id = $dt;
        $queryMenu = "   SELECT            user_menu.id , menu
                                        FROM               user_menu JOIN user_access_menu
                                        ON                    user_menu.id = user_access_menu.menu_id
                                        WHERE            user_access_menu.role_id = $role_id
                                        ORDER BY       user_access_menu.menu_id ASC ";
        return $this->db->query($queryMenu)->result_array();
    }

    public function getSubContent($dt)
    {
        $menuId = $this->getMenu($dt);
        foreach ($menuId as $mi) {
            $mi = $menuId['id'];
            $queryMenu = "   SELECT *
                                        FROM               user_sub_menu JOIN user_menu
                                        ON                    user_sub_menu.menu_id = user_menu.id
                                        WHERE            user_sub_menu.menu_id = '$mi' AND user_sub_menu.is_active = 1
            ";
        }
        return $this->db->query($queryMenu)->result_array();
    }
    public function getSubMenu()
    {
        $queryMenu = "   SELECT         user_sub_menu.* , user_menu.menu
                                            FROM            user_sub_menu JOIN user_menu
                                            ON                 user_sub_menu.menu_id = user_menu.id
            ";

        return $this->db->query($queryMenu)->result_array();
    }
    public function addMenu()
    {
        $this->db->insert('user_menu', ['menu' => htmlspecialchars($this->input->post('menu', true))]);
    }
    public function editMenu()
    {
        $this->db->update('user_menu', ['menu' => $this->input->post('menu', true)], ['id' => $this->input->post('id', true)]);
    }

    public function addSubMenu()
    {
        $data = [
            'menu_id' => htmlspecialchars($this->input->post('menu', true)),
            'title' => htmlspecialchars($this->input->post('title', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
        ];

        $this->db->insert('user_sub_menu', $data);
    }

    public function editSubMenu()
    {
        $data = [
            'menu_id' => htmlspecialchars($this->input->post('menu', true)),
            'title' => htmlspecialchars($this->input->post('title', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
        ];

        $this->db->update('user_sub_menu', $data, ['id' => $this->input->post('id', true)]);
    }

    public function addRole()
    {
        $this->db->insert('user_Role', ['role' => htmlspecialchars($this->input->post('role', true))]);
    }
    public function editRole()
    {
        $this->db->update('user_role', ['role' => $this->input->post('role', true)], ['id' => $this->input->post('id', true)]);
    }
}
