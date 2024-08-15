<main id="main" class="main">

    <div class="pagetitle">
        <h1>Logs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item  <?php if ($this->uri->segment(2) == 'logging') echo 'active' ?>">Logging</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body mt-3">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">IP Address</th>
                                    <th scope="col">Source</th>
                                    <th scope="col">Medium</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($logs as $c) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $c->ip_address ?></td>
                                        <td><?= $c->utm_source ?></td>
                                        <td><?= $c->utm_medium ?></td>
                                        <td><?= format_indo($c->access_time) ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->