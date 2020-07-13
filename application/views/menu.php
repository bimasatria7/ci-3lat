<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Menu Management</h1>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary mb-3 addMenu" data-toggle="modal" data-target="#Modal">
        Add Menu +
    </button>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-6">
            <?= $this->session->flashdata('message') ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1;
                    foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $m['menu'] ?></td>
                            <td>
                                <button class="btn  btn-success editMenu" data-toggle="modal" data-id="<?= $m['menu'] ?>" data-target="#Modal"><i class=" fas fa-edit"></i></button>
                                <a onclick="confirm('Are you sure delete this menu?')" href="<?= base_url('menu/hapusMenu/' . $m['id']) ?>" class="btn  btn-danger"><i class="fas fa-trash"></i></a>
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
                    <h5 class="modal-title" id="menuTitle">Add Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="form-group">
                        <label for="menu">Menu</label>
                        <input type="hidden" id="id" name="id">
                        <input class="form-control" type="text" id="menu" name="menu">
                        <?= form_error('menu', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="modal-footer modal-menu">
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