 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Aplikasi') ?>">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">MENMG <sup><?= $role ?></sup></div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider">
     <?php

        $role_id = $this->session->userdata('role_id');
        $queryMenu = "   SELECT            user_menu.id , menu
                                        FROM               user_menu JOIN user_access_menu
                                        ON                    user_menu.id = user_access_menu.menu_id
                                        WHERE            user_access_menu.role_id = $role_id
                                        ORDER BY       user_access_menu.menu_id ASC ";
        $menu =  $this->db->query($queryMenu)->result_array();
        foreach ($menu as $m) : ?>

         <div class="sidebar-heading">
             <?= $m['menu'] ?>
         </div>

         <?php
            $mi = $m['id'];
            $queryMenu = "   SELECT *
                                        FROM               user_sub_menu JOIN user_menu
                                        ON                    user_sub_menu.menu_id = user_menu.id
                                        WHERE            user_sub_menu.menu_id = '$mi' AND user_sub_menu.is_active = 1
            ";
            $sub_menu = $this->db->query($queryMenu)->result_array();

            foreach ($sub_menu as $sm) : ?>
             <?php if ($sm['title'] == $pg) : ?>
                 <li class="nav-item active">
                 <?php else : ?>
                 <li class="nav-item">
                 <?php endif; ?>
                 <a class="nav-link pb-0" href="<?= base_url($sm['url']) ?>">
                     <i class="<?= $sm['icon'] ?>"></i>
                     <span><?= $sm['title'] ?></span></a>
                 </li>

             <?php endforeach; ?>
             <hr class="sidebar-divider d-none d-md-block mt-4">
         <?php endforeach; ?>


         <!-- Divider -->



         <!-- Nav Item - Charts -->
         <li class="nav-item mx-auto">
             <button type="button" data-toggle="modal" data-target="#logoutModal" class="btn-sm btn-danger">
                 <i class="fas fa-fw fa-sign-out-alt"></i>
                 <span>Logout</span></button>
         </li>



         <!-- Divider -->
         <hr class="mt-3 sidebar-divider d-none d-md-block">

         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
             <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>

 </ul>
 <!-- End of Sidebar -->