<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }
</style>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Invoices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item  <?php if ($this->uri->segment(2) == 'invoice') echo 'active' ?>">Invoices</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message_name') ?>"></div>
                <div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('message_error') ?>"></div>
                <div class="card">
                    <div class="card-header text-end">
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#reportExcel">
                            Report
                        </button>
                        <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createNewInvoice">
                            Create Invoice
                        </button> -->
                    </div>
                    <div class="card-body">
                        <table class="table datatable" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Num.</th>
                                    <th scope="col">Order time</th>
                                    <th scope="col">Pickup date</th>
                                    <th scope="col">Customer</th>
                                    <!-- <th>Print</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($orders as $i) :
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $i->no_invoice ?></td>
                                        <td><?= format_indo($i->order_time) ?></td>
                                        <td><?= format_indo($i->pickup_date) ?></td>
                                        <td><?= $i->nama_pemesan ?></td>
                                        <td>
                                            <!-- <a href="<?= base_url('admin/invoice/edit/' . $i->no_invoice) ?>" class="btn btn-outline-primary btn-sm">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/order/detail/' . $i->no_invoice) ?>" class="btn btn-info btn-sm" target="_blank">
                                                <i class="bi bi-file-pdf"></i> Print
                                            </a> -->
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?= $i->no_invoice ?>">
                                                Detail pesanan
                                            </button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<div class="modal fade" id="reportExcel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/invoice/report') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="from" class="form-label">From</label>
                            <input type="date" name="from" id="from" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="to" class="form-label">To</label>
                            <input type="date" name="to" id="to" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Download excel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
foreach ($orders as $i) :
?>

    <div class="modal fade" id="detail<?= $i->no_invoice ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?= $i->no_invoice ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/invoice/add') ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="status_customer" class="form-label">Pickup date</label>
                                <input type="datetime-local" name="pickup_date" id="pickup_date" class="form-control" value="<?= $i->pickup_date ?>" readonly>
                            </div>
                        </div>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Motor</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $details = $this->M_Order->detail_order($i->Id);

                                foreach ($details as $d) :
                                ?>
                                    <tr>
                                        <td><?= $d->menu_nama ?></td>
                                        <td><?= $d->jumlah ?></td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
endforeach; ?>