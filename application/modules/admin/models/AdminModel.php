<?php
class AdminModel extends CI_Model
{
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