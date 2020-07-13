<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Reset your password</h1>
                                </div>

                                <?= $this->session->flashdata('message') ?>
                                <form class="user" action="" method="POST">
                                    <div class="form-group">
                                        <input type="password" name="newpass" id="newpass" class="form-control form-control-user" value="<?= set_value('newpass') ?>" aria-describedby="emailHelp" placeholder="Enter new password">
                                        <?= form_error('newpass', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="repass" id="repass" class="form-control form-control-user" value="<?= set_value('repass') ?>" aria-describedby="emailHelp" placeholder="Repeat password">
                                        <?= form_error('repass', '<small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>