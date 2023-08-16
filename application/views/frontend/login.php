<?php $this->load->view('frontend/layouts/head'); ?>
<?php $this->load->view('frontend/layouts/header'); ?>

<div class="container" style="padding-top: 120px;">
    <div class="row">
        <div class="col-md-7 mt-5 mx-auto">

            <?php if(isset($_SESSION['status'])): ?>
            <div class="alert alert-<?= $_SESSION['alert']; ?>" role="alert">
                <?= $_SESSION['status']; ?>
            </div>
            <?php endif; ?>

            <div class="card shadow">
                <div class="card-header">
                    <h4>Login</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('login'); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" class="form-control" value="<?= set_value('email'); ?>" name="email">
                                    <small class="text-danger"><?= form_error('email'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    <small class="text-danger"><?= form_error('password'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('frontend/layouts/footer'); ?>