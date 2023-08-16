<?php $this->load->view('frontend/layouts/head'); ?>
<?php $this->load->view('frontend/layouts/header'); ?>

<?php 
    $this->config->config["pageTitle"] = 'User Page';
?>

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
                    <h4>User Details</h4>
                </div>
                <div class="card-body">
                    <ul>
                        <li><b>First Name:</b> <?= $_SESSION['auth_user']['first_name']; ?></li>
                        <li><b>Last Name:</b> <?= $_SESSION['auth_user']['last_name']; ?></li>
                        <li><b>Email:</b> <?= $_SESSION['auth_user']['email']; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('frontend/layouts/footer'); ?>