<?php
class m1 extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

public function selectdata()
        {
        $query = $this->db->query('SELECT name,val FROM country');

foreach ($query->result() as $row)
{
        
        echo $row->name;
        echo $row->val;
}

echo 'Total Results: ' . $query->num_rows();

}
}