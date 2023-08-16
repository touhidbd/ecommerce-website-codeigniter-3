<?php $this->load->view('frontend/layouts/head'); ?>
<?php $this->load->view('frontend/layouts/header'); ?>

<div class="container" style="padding-top: 120px;">
    <div class="row">
        <div class="col-md-7 mt-5 mx-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Register</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('register'); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" value="<?= set_value('first_name'); ?>" name="first_name">
                                    <small class="text-danger"><?= form_error('first_name'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" value="<?= set_value('last_name'); ?>" name="last_name">
                                    <small class="text-danger"><?= form_error('last_name'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" value="<?= set_value('email'); ?>" name="email">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cpassword">Confirm Password</label>
                                    <input type="password" class="form-control" name="cpassword">
                                    <small class="text-danger"><?= form_error('cpassword'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Register Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('frontend/layouts/footer'); ?>