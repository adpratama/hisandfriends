<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(['session', 'Api_Whatsapp']);
        $this->load->helper(['string', 'date', 'form']);
        $this->load->model(['M_Order', 'M_Product']);
    }

    public function index()
    {
        $cart_content = $this->cart->contents();

        if (empty($cart_content)) {
            redirect('home');
        }

        $jml_item = 0;

        foreach ($cart_content as $key => $value) {
            $jml_item = $jml_item + $value['qty'];
        }

        $subtotal = $this->cart->total();
        $ppn = $subtotal * 0.1;
        $grandtotal = $subtotal + $ppn;

        $data = [
            'title' => 'Cart',
            'style' => 'layouts/_style',
            'pages' => 'pages/order/v_cart',
            'script' => 'layouts/_script',
            'cart_content' => $cart_content,
            'jml_item' => $jml_item,
            'subtotal' => $subtotal,
            'total' => number_format($subtotal),
            'ppn' => $ppn,
            'grandtotal' => $grandtotal
        ];

        $this->load->view('index', $data);
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');

        $item_name = $this->input->post('name');
        $item_name = str_replace(['(', ')'], '-', $item_name);

        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('price'),
            'name'    => $item_name
        );

        $this->M_Order->add($data);

        $this->session->set_flashdata('message_success', $item_name . ' added successfully');
        redirect($redirect_page, 'refresh');
    }

    public function update()
    {
        $items = $this->cart->contents();
        $i = 1;
        foreach ($items as $item) {
            $data = array(
                'rowid' => $item['rowid'],
                'qty' => $this->input->post($i . '[qty]')
            );

            $this->cart->update($data);
            $i++;
        }

        redirect('order');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        redirect('order');
    }

    public function clear()
    {
        $this->cart->destroy();
        redirect('order');
    }

    public function checkout()
    {
        $cart_content = $this->cart->contents();

        if (empty($cart_content)) {
            redirect('home');
        }

        $jml_item = 0;

        foreach ($cart_content as $key => $value) {
            $jml_item = $jml_item + $value['qty'];
        }

        $subtotal = $this->cart->total();
        $ppn = $subtotal * 0.1;
        $grandtotal = $subtotal + $ppn;

        $data = [
            'title' => 'Cart',
            'style' => 'layouts/_style',
            'pages' => 'pages/order/v_checkout',
            'script' => 'layouts/_script',
            'cart_content' => $cart_content,
            'jml_item' => $jml_item,
            'subtotal' => $subtotal,
            'total' => number_format($subtotal, 2, ',', '.'),
            'ppn' => number_format($ppn, 2, ',', '.'),
            'grandtotal' => number_format($grandtotal, 2, ',', '.')
        ];

        $this->load->view('index', $data);
    }

    public function send_order()
    {
        // ambil nilai menu_kode terbesar
        $query = $this->M_Order->max_number();

        $new_code = $query["no_invoice"] + 1;

        $cart = $this->cart->contents();

        $subtotal = $this->cart->total();

        $total_item  = $this->cart->total_items();
        $ppn = $subtotal * 0.1;
        $total = $subtotal + $ppn;

        $now = date('Y-m-d H:i:s');

        $data = array(
            'no_invoice' => $new_code,
            'nama_pemesan' => trim($this->input->post('nama')),
            'email_pemesan' => trim($this->input->post('email')),
            'alamat_pemesan' => trim($this->input->post('address')),
            'telepon_pemesan' => trim($this->input->post('phone')),
            'notes' => trim($this->input->post('notes')),
            'total_item' => $total_item,
            'subtotal' => $subtotal,
            'ppn' => $ppn,
            'grand_total' => $total,
            'order_time' => $now,
            'pickup_date' => $this->input->post('pickup_date'),
            'opsi_sewa' => $this->input->post('opsi_sewa'),
        );

        $this->M_Order->add_transaction($data);

        $no = 1;
        foreach ($cart as $c) {

            // ambil menu_jual sebelumnya sesuai id product
            $item_jual = $this->M_Product->check_qty($c['id']);

            // tambahkan menu_jual sebelumnya dengan qty yang dipesan
            $new_qty = $item_jual['menu_jual'] + $c['qty'];

            $update_qty = array(
                'menu_jual' => $new_qty
            );

            $this->M_Product->update_menu_jual($update_qty, $c['id']);

            $a[] = $no . '. ' . $c['qty'] . ' ' . $c['name'];
            $no++;
            $b = array(
                'id_transaction' => $new_code,
                'id_product' => $c["id"],
                'jumlah' => $c["qty"],
                'harga_satuan' => $c["price"],
                'subtotal' => $c["subtotal"],
                'created_at' => $now,
            );
            $this->M_Order->add_transaction_detail($b);
        }

        $b = implode('%0a', $a);

        $wa_pemesan = $data["telepon_pemesan"];
        $msg2 = 'Halo, kak *' . $data['nama_pemesan'] . '*. Terima kasih sudah order ke His and Friends. Ini daftar pesanan yang sudah Kamu buat:%0a%0aPesanan: %0a' . $b . '%0a%0a*Pickup date: ' . format_indo($this->input->post('pickup_date')) . '%0a*Opsi sewa: ' . ($this->input->post('opsi_sewa')) . ',-*' . '*%0a%0aNotes: ' . $data['notes'] . '%0a%0aAdmin kami akan segera menghubungi. Mohon ditunggu ya.';

        $this->api_whatsapp->wa_notif($msg2, $wa_pemesan);

        $no_whatsapp2 = "081818600040";
        $msg = '*New Order* %0aNama pemesan: ' . $data['nama_pemesan'] . '%0aEmail: ' . $data['email_pemesan'] . '%0aAlamat: ' . $data['alamat_pemesan'] . '%0aPhone: ' . $data['telepon_pemesan'] . '%0aNotes: ' . $data['notes'] . '%0a%0aPesanan: %0a' . $b . '%0a%0a*Pickup date: ' . format_indo($this->input->post('pickup_date')) . '%0a*Opsi sewa: ' . ($this->input->post('opsi_sewa'));

        $this->api_whatsapp->wa_notif($msg, $no_whatsapp2);

        $this->cart->destroy();
        redirect('order');
    }
}
