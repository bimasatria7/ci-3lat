<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $pg ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row pl-3">
        <div class="card mb-3" style="max-width: 800px;">
            <div class="row no-gutters">
                <div class="col-md-4 pb-2">
                    <?= form_open_multipart('Aplikasi/editProfile') ?>
                    <img src="<?= base_url('assets/img/users/') . $user['image']; ?>" class="card-img mb-2" alt="...">
                    <input type="file" name="image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="<?= $user['name'] ?>" class="form-control" name="name" id="name">
                            <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $user['email'] ?>">
                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
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