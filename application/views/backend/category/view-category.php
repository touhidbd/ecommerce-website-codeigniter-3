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
                        <h1 class="h3 mb-0 text-gray-800">Category List</h1>
                        <a href="<?= base_url('admin/add-category'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Category</a>
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
                                    <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
                                </div>
                                <div class="card-body">
                                    <?php if($categories): ?>
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Name</th>
                                                    <th>Image</th>
                                                    <th>Slug</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter = 1; foreach($categories as $category): ?>
                                                <tr>
                                                    <td><?= $counter; ?></td>
                                                    <td><?= $category->category_name; ?></td>
                                                    <td><img width="50" src="<?= base_url('assets/uploads/category/').$category->category_image; ?>" alt=""></td>
                                                    <td><?= $category->category_slug; ?></td>
                                                    <td><?= $category->category_status == 0 ? 'Hidden': 'Published'; ?></td>
                                                    <td>
                                                        <a href="<?= base_url('admin/edit-category/').$category->category_id; ?>" class="btn btn-sm btn-success">Edit</a>
                                                        <button data-toggle="modal" data-target="#deleteCategory" data-id="<?= $category->category_id; ?>" class="btn delete-category btn-sm btn-danger">Delete</button>
                                                    </td>
                                                </tr>
                                                <?php $counter++; endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Delete Modal-->
                                    <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ready to delete?</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">Are you sure to delete this category?</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    <a id="btn-delete" class="btn btn-danger" href="<?= base_url('admin/delete-category/').$category->category_id; ?>">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                        <h6 class="text-center">No category found!</h6>
                                    <?php endif; ?>
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
    
    <script>
        $('.delete-category').click(function(){
            var dataId = $(this).data("id");
            $('#btn-delete').attr("href", "<?= base_url('admin/delete-category/'); ?>"+dataId);
        });
    </script>
</body>
</html>