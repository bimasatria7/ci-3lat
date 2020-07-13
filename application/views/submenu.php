<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sub Menu Management</h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3 addSubMenu" data-toggle="modal" data-target="#Modal">
        Add Sub Menu +
    </button>
    <!-- Content Row -->
    <div class="row">

        <div class="col-lg">
            <?= $this->session->flashdata('message') ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Title</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Is Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($submenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $sm['menu'] ?></td>
                            <td><?= $sm['title'] ?></td>
                            <td><?= $sm['url'] ?></td>
                            <td><?= $sm['icon'] ?></td>
                            <td><?= $sm['is_active'] ?></td>
                            <td>
                                <button class="btn  btn-success editSubMenu" data-toggle="modal" data-id='<?= $sm['id'] ?>' data-target="#Modal"><i class=" fas fa-edit"></i></button>
                                <a onclick="confirm('Are you sure delete this sub menu?')" href="<?= base_url('menu/hapusSubMenu/' . $sm['id']) ?>" class="btn  btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuTitle">Add Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="menu">Menu</label>
                        <select class="form-control" name="menu" id="menu">
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"><?= $m['menu'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="title">Title</label>
                        <input class="form-control" type="text" id="title" name="title">
                        <?= form_error('title', '<small class="text-danger">', '</small><br>') ?>
                        <label for="url">URL</label>
                        <input class="form-control" type="text" id="url" name="url">
                        <?= form_error('url', '<small class="text-danger">', '</small><br>') ?>
                        <label for="icon">Icon</label>
                        <input class="form-control" type="text" id="icon" name="icon">
                        <?= form_error('icon', '<small class="text-danger">', '</small><br>') ?>
                        <input type="checkbox" name="is_active" value="1" class="form-check-input ml-1" id="is_active" checked>
                        <label class="form-check-label ml-4" for="exampleCheck1">Is Active?</label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button name="add" type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">



        </div>

    </div>

</div>
<!-- /.container-fluid -->