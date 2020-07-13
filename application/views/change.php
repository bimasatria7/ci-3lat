<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $pg ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-lg-6">

            <?= $this->session->flashdata('message') ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="currenpasst">Current Password</label>
                    <input name="currentpass" type="password" class="form-control" id="currentpass" placeholder="Input your current password">
                    <?= form_error('currentpass', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="newpass">New Password</label>
                    <input name="newpass" type="password" class="form-control" id="newpass" placeholder="Input new password">
                    <?= form_error('newpass', '<small class="text-danger">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="repass">Repeat Password</label>
                    <input name="repass" type="password" class="form-control" id="repass" placeholder="Repeat password">
                    <?= form_error('repass', '<small class="text-danger">', '</small>') ?>
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>

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