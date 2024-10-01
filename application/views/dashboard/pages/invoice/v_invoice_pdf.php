<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_pdf; ?></title>
    <style>
        body {

            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        #table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #32a834;
            color: white;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        table.table-top {
            /* border: 1px #000 solid;0 */
            width: 100%;
            /* text-align: center; */
            border-collapse: collapse;
        }

        .table-top td {
            border: 1px #000 solid;
            padding: 5px;
        }

        .table-top th {
            background-color: #ddd;
            font-weight: bold;
            border: 1px #000 solid;
            padding: 5px;
            text-align: center;
        }

        table.table-customer {
            /* border: 1px #000 solid;0 */
            width: 50%;
            /* text-align: center; */
            border-collapse: collapse;
        }


        .table-customer td {
            padding: 2px;
        }

        .w-100 {
            width: 100px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mb-50 {
            margin-bottom: 50px;
        }
    </style>
</head>

<body>

    <table style="margin-bottom: -10px; width: 100%">
        <tbody>
            <tr>
                <td style="width: ">
                    <img src="<?= base_url(); ?>assets/img/logo_hisfriends.png" style="width: 100px;" alt="">
                    <h3>RENTAL MOTOR BALI</h3>
                    <p>
                        Smart Residence No. 31 <br>
                        Jl. Tukad Balian Renon Denpasar, Bali 80226 <br>
                        Telp: (+62) 8181-8600-040
                    </p>
                </td>
                <td class="text-right" style="vertical-align: top;">
                    <h3>INVOICE</h3>

                    <table class="table-top">
                        <tr>
                            <th class="bg-hover">Date</th>
                            <th class="bg-hover">Invoice Num.</th>
                        </tr>
                        <tr>
                            <td class="text-center"><?= format_indo($invoice['tanggal_invoice']) ?></td>
                            <td class="text-center"><?= $invoice['no_invoice'] ?>/INV/BALI/<?= intToRoman(substr($invoice['tanggal_invoice'], 5, 2)) ?>/<?= substr($invoice['tanggal_invoice'], 2, 2) ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="width: 400px;">
                </td>

            </tr>
        </tbody>
    </table>
    <h4 style="margin-bottom: 2px;">Bill to</h4>
    <table class="table-customer mb-20">
        <tr>
            <td class="bg-hover w-100">Name</td>
            <td class="bg-hover">: <?= $invoice['nama_customer'] ?></td>
        </tr>
        <tr>
            <td class="bg-hover">Address</td>
            <td class="bg-hover">: <?= $invoice['alamat_customer'] ?></td>
        </tr>
        <tr>
            <td class="bg-hover">Telp</td>
            <td class="bg-hover">: <?= $invoice['telepon_customer'] ?></td>
        </tr>
        <tr>
            <td class="bg-hover">No. ID</td>
            <td class="bg-hover">: <?= $invoice['id_number'] ?></td>
        </tr>
    </table>
    <table class="table-top mb-50">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Description</th>
                <th>Day</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($details as $d) :
            ?>
                <tr>
                    <td><?= $no++ ?>.</td>
                    <td><?= $d->menu ?></td>
                    <td><?= $d->deskripsi ?></td>
                    <td class="text-right"><?= number_format($d->hari) ?> hari</td>
                    <td class="text-right"><?= number_format($d->qty) ?></td>
                    <td class="text-right"><?= number_format($d->harga) ?></td>
                    <td class="text-right"><?= number_format($d->total) ?></td>
                </tr>
            <?php
            endforeach;
            ?>
            <tr>
                <td colspan="5" style="border: 0px;"></td>
                <td class="" colspan="">SUBTOTAL</td>
                <td class="text-right"><?= number_format($invoice['subtotal']) ?></td>
            </tr>
            <?php
            if ($invoice['besaran_diskon'] > 0) {
            ?>
                <tr>
                    <td colspan="5" style="border: 0px;"></td>
                    <td class="" colspan="">DISKON <?= $invoice['diskon'] * 100 ?>%</td>
                    <td class="text-right"><?= number_format($invoice['besaran_diskon']) ?></td>
                </tr>
            <?php
            } ?>
            <tr>
                <td colspan="5" style="border: 0px;"></td>
                <td class="" colspan="">GRAND TOTAL</td>
                <td class="text-right"><?= number_format($invoice['total_invoice']) ?></td>
            </tr>
            <!-- <tr>
                <td colspan="6"><?= terbilang($invoice['total_invoice']) ?> Rupiah</td>
            </tr> -->
        </tbody>
    </table>

    <table style="width: 100%; border: 0px #000 solid;">
        <tr>
            <td style="vertical-align: top;">
                <h4>Payment Information: </h4>
                <p style="margin-top: 0px;">Payment for this invoice should be <br>
                    transferred to the account:
                <table>
                    <tr>
                        <td>Bank BNI</td>
                    </tr>
                    <tr>
                        <td>Bank name</td>
                        <td>: PT. Harmoni Inti Sejahtera</td>
                    </tr>
                    <tr>
                        <td>Account</td>
                        <td>: 1999888207</td>
                    </tr>
                </table>
                </p>
            </td>
            <td style="vertical-align: top; width: 200px">
                <h4>Regards,</h4>
                <img src="<?= base_url('assets/img/ttd-erika.jpg') ?>" style="margin-top: 0px; margin-left: -30px; width: 150px;" alt="">
                <h4 style=" text-decoration: underline; margin-top: 0px">(Erika Priscila)</h4>
                <p style="margin-top: -10px;">Finance Dept.</p>
            </td>
        </tr>
    </table>


</body>

</html>