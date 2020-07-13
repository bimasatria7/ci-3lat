<?php

function access()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('Started');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        if ($menu == "Aplikasi") $menu = "User";
        $menu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $menu['id'];
        $user_access = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ]);

        if ($user_access->num_rows() < 1) {
            redirect('Started/denied');
        }
    }
}

function box_check($role_id, $menu_id)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
