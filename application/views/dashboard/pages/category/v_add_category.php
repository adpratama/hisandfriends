<main id="main" class="main">

    <div class="pagetitle">
        <h1>Categories</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/category">Categories</a></li>
                <li class="breadcrumb-item  <?php if ($this->uri->segment(2) == 'category') echo 'active' ?>">Add New Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">

                    <?php
                    if ($this->uri->segment(4) == true) {
                    ?>
                        <div class="card-body">
                            <h5 class="card-title">Edit Category Data</h5>

                            <?= $this->session->flashdata('message_name'); ?>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="<?= base_url('admin/category/store/' . $category["kategori_seo"]) ?>" method="POST">
                                <div class="col-12">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?= $category["kategori_nama"] ?>">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="card-header pt-0 pb-0">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <h5 class="card-title">Add New Category</h5>
                                </div>
                                <div class="col-md-6 col-12 text-end mt-3">
                                    <a href="<?= base_url('admin/category') ?>" class="btn btn-primary btn-sm">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <?= $this->session->flashdata('message_name'); ?>

                            <!-- Vertical Form -->
                            <form class="row g-3" action="<?= base_url('admin/category/store') ?>" method="POST">
                                <div class="col-12 mt-4">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name" name="category_name">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- Vertical Form -->

                        </div>
                    <?php
                    } ?>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->