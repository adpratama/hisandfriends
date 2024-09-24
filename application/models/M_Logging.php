<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Logging extends CI_Model
{
    public function addLogAccess($data)
    {
        return $this->db->insert('log_access', $data);
    }

    public function list_log()
    {
        return $this->db->order_by('access_time', 'DESC')->get('log_access')->result();
    }

    public function add_log($user_id, $action, $table_name, $record_id)
    {
        $data = array(
            'user_id' => $user_id,
            'action' => $action,
            'table_name' => $table_name,
            'record_id' => $record_id
        );

        $this->db->insert('logs', $data);
    }
}
