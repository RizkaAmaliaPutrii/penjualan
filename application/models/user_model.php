<?php defined ('BASEPATH') OR exit('No direct script access allowed');
class User_model extends CI_Model{
    protected $_table = 'user';
    protected $primary = 'id';

    public function getAll()
    {
        return $this->db->where('is_active',1)->get($this->_table)->result();
    }
    public function save(){
        $data = array(
            'nik' => htmlspecialchars($this->input->post('nik'), true),
            'username' => htmlspecialchars($this->input->post('username'), true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => htmlspecialchars($this->input->post('email'), true),
            'full_name' => htmlspecialchars($this->input->post('full_name'), true),
            'phone' => htmlspecialchars($this->input->post('phone'), true),
            'alamat' => htmlspecialchars($this->input->post('alamat'), true),
            'role' => htmlspecialchars($this->input->post('role'), true),
            'is_active' => 1,
        );
        return $this->db->insert('user', $data);
    }
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }
    public function editData()
    {
        $id = $this->input->post('id');
        $data = array(
            'username' => htmlspecialchars($this->input->post('username'), true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'email' => htmlspecialchars($this->input->post('email'), true),
            'full_name' => htmlspecialchars($this->input->post('full_name'), true),
            'phone' => htmlspecialchars($this->input->post('phone'), true),
            'role' => htmlspecialchars($this->input->post('role'), true),
            'is_active' => 1,
        );
        return $this->db->set($data)->where($this->primary,$id)->update($this->_table);
    }
    public function delete($id)
    {
        $this->db->where('id',$id)->delete($this->_table);
        if($this->db->affected_rows()>0){
            return $this->session->set_flashdata("success","Data Berhasil DiDelete");
        }
    }
}