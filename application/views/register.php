<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                        </div>
                        <form class="user" method="POST" action="">
                            <div class="form-group row">
                                <div class="col-sm">
                                    <input value="<?= set_value('name') ?>" name="name" id="name" type="text" class="form-control form-control-user" placeholder="Full Name">
                                    <?= form_error('name', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input value="<?= set_value('email') ?>" type="email" name="email" id="email" class="form-control form-control-user" placeholder="Email Address">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password">
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password1" id="password1" class="form-control form-control-user" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button href="login.html" type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url() ?>Started">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>