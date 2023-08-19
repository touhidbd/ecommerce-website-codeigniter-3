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
                        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
                        <a href="<?= base_url('admin/products'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> All Products</a>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Edit Product</h6>
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('admin/edit-product/'.$product->id); ?>" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?= $product->title; ?>"> 
                                            <small class="text-danger"><?= form_error('title'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="slug">Slug</label>
                                            <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="<?= $product->slug; ?>">
                                            <input type="hidden" value="<?= $product->slug; ?>" name="old_slug"> 
                                            <small class="text-danger"><?= form_error('slug'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea  class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Category Description"><?= $product->description; ?></textarea> 
                                            <small class="text-danger"><?= form_error('description'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="short_description">Short Description</label>
                                            <textarea  class="form-control" name="short_description" id="short_description" cols="30" rows="10" placeholder="Short Description"><?= $product->short_description; ?></textarea> 
                                            <small class="text-danger"><?= form_error('short_description'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?= $product->price; ?>"> 
                                            <small class="text-danger"><?= form_error('price'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sell_price">Selling Price</label>
                                            <input type="text" class="form-control" name="sell_price" id="sell_price" placeholder="Selling Price" value="<?= $product->sell_price; ?>"> 
                                            <small class="text-danger"><?= form_error('sell_price'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="quantity">Quantity</label>
                                            <input type="text" class="form-control" name="quantity" id="quantity" placeholder="Quantity" value="<?= $product->quantity; ?>"> 
                                            <small class="text-danger"><?= form_error('quantity'); ?></small>
                                        </div>
                                        <div cl
                                        <div class="mb-3">
                                            <label for="image">Image</label><br>
                                            <img width="200" src="<?= base_url('assets/uploads/products/'.$product->image) ?>" alt="" class="mb-3"><br>
                                            <input type="file" id="image" name="image"> 
                                            <input type="hidden" value="<?= $product->image; ?>" name="old_image_name">
                                            <small class="text-danger"><?php if(isset($imageError)) { echo $imageError; } ?></small>
                                        </div>
                                        <hr>
                                        <h6 class="text-primary mb-3"><b>SEO PART</b></h6>
                                        <div class="mb-3">
                                            <label for=meta_title">Meta Title</label>
                                            <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title" value="<?= $product->meta_title; ?>"> 
                                            <small class="text-danger"><?= form_error('meta_title'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_description">Meta Description</label>
                                            <textarea  class="form-control" name="meta_description" id="meta_description" cols="30" rows="10" placeholder="Meta Description"><?= $product->meta_description; ?></textarea> 
                                            <small class="text-danger"><?= form_error('meta_description'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="meta_keywords">Meta Keywords</label>
                                            <textarea  class="form-control" name="meta_keywords" id="meta_keywords" cols="30" rows="10" placeholder="Meta Keywords"><?= $product->meta_keywords; ?></textarea> 
                                            <small class="text-danger"><?= form_error('meta_keywords'); ?></small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category_id" id="category" class="form-control">
                                                <option disabled selected>Select Category</option>
                                                <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category->category_id; ?>" <?php if($category->category_id == $product->category_id) { echo 'selected'; } ?>><?= $category->category_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex">
                                                <div class="check mr-2">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="trending" name="trending" value="1" <?= $product->trending == 1 ? 'checked':''; ?>>
                                                        <label class="form-check-label" for="trending">Trending</label>
                                                    </div> 
                                                    <small class="text-danger"><?= form_error('status'); ?></small>
                                                </div>
                                                <div class="check">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="0" <?= $product->status == 0 ? 'checked':''; ?>>
                                                        <label class="form-check-label" for="status">Hidden</label>
                                                    </div> 
                                                    <small class="text-danger"><?= form_error('status'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Product</button>
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