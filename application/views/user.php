<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <?= $this->session->flashdata('message') ?>
    <!-- Content Row -->
    <div class="row pl-3">

        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/users/') . $user['image']; ?>" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name'] ?></h5>
                        <p class="card-text"><?= $user['email'] ?></p>
                        <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']) ?></small></p>
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