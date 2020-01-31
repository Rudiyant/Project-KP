<?php
class AdminModel extends CI_Model
{
    public function __construct()
	{
		$this->load->database();
    }
    
    public function cariNiy()
	{
		$cari = $this->input->post('cari', TRUE);
		$data = $this->db->query("SELECT * from karyawan where niy like '%$cari%' ");
		return $data->result();
    }
    
    function getData($select, $table, $where=false)
    {
        if($where)
        {
            return $this->db
                        ->select($select)
                        ->from($table)
                        ->where($where)
                        ->get()
                        ->row();
        }
        else
        {
            return $this->db
                    ->select($select)
                    ->get($table)
                    ->result();
            
        } 
    }

    // function postData($table,$value)
    // {
    //     return $this->db
    //                 ->$insert($table,$value);
    // }

    function getJoin($kolom, $table1, $table2, $syarat)
    {
        $this->db->select($kolom);
        $this->db->from($table1);
        $this->db->join($table2, $syarat);

        $query = $this->db->get()->result();

        return $query;
    }
 
    
}
?>