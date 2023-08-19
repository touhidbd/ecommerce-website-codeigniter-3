<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('backend/layouts/head'); ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php $this->load->view('backend/layouts/sidebar'); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php $this->load->view('backend/layouts/header'); ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Category</h1>
                        <a href="<?= base_url('admin/categories'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> All Category</a>
                    </div>

                    <?php if(isset($_SESSION['status'])): ?>
                    <div class="alert alert-<?= $_SESSION['alert']; ?>" role="alert">
                        <?= $_SESSION['status']; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('admin/edit-category/'.$category->category_id); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= $category->category_name; ?>"> 
                                            <small class="text-danger"><?= form_error('title'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="<?= $category->category_slug; ?>"> 
                                            <input type="hidden" value="<?= $category->category_slug; ?>" name="old_slug">
                                            <small class="text-danger"><?= form_error('slug'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sub_title">Sub Title</label>
                                            <input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="Sub Title" value="<?= $category->category_sub_title; ?>"> 
                                            <small class="text-danger"><?= form_error('sub_title'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea  class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Description"><?= $category->category_description; ?></textarea> 
                                            <small class="text-danger"><?= form_error('description'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image">Image</label><br>
                                            <img width="120" src="<?= base_url('assets/uploads/category/'). $category->category_image; ?>" alt=""><br>
                                            <input class="form-control mt-3" type="file" id="image" name="image">
                                            <input type="hidden" value="<?= $category->category_image; ?>" name="old_image_name"> 
                                            <small class="text-danger"><?php if(isset($imageError)) { echo $imageError; } ?></small>
                                        </div>
                                        <hr>
                                        <h6 class="text-primary mb-3"><b>SEO PART</b></h6>
                                        <div class="mb-3">
                                            <label for=meta_title">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="<?= $category->category_meta_title; ?>"> 
                                            <small class="text-danger"><?= form_error('meta_title'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea  class="form-control" name="meta_description" id="meta_description" cols="30" rows="10" placeholder="Meta Description"><?= $category->category_meta_description; ?></textarea> 
                                            <small class="text-danger"><?= form_error('meta_description'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <textarea  class="form-control" name="meta_keywords" id="meta_keywords" cols="30" rows="10" placeholder="Meta Keywords"><?= $category->category_meta_keywords; ?></textarea> 
                                            <small class="text-danger"><?= form_error('meta_keywords'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="0" <?= $category->category_status == 0 ? 'checked':''; ?>>
                                                <label class="form-check-label" for="status">Hidden</label>
                                            </div> 
                                            <small class="text-danger"><?= form_error('status'); ?></small>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Category</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php $this->load->view('backend/layouts/footer'); ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <?php $this->load->view('backend/layouts/foot'); ?>
</body>
</html>