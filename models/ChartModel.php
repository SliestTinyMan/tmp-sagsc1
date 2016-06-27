<?php

class ChartModel 
{
    private $db;

    public function __construct()
    {
        //$this->db=new mysqli("intranet.tecnicom.pe:3306", "int_sup1", "oZtz9~LIl[Fp", "int16_tecnicom_lima");
        $this->db=new mysqli("localhost", "int_sup1", "oZtz9~LIl[Fp", "int16_tecnicom_lima");
        $this->db->query("SET NAMES 'utf8'");

        if ($this->db->connect_errno) 
        {
    		echo "<script>console.log('Fallo al conectar a MySQL: ".$this->db->connect_errno.", ".$this->db->connect_error."');</script>";
		}
		echo "<script>console.log('".$this->db->host_info."');</script>";
    }

    public function Draw($r, $d)
    {
        $data = 0;
        $sql = "SELECT * FROM Reports_Resellers_2016 WHERE Login = '".$r."' AND Date LIKE '".$d."%'";
    	$results = $this->db->query($sql);
        
    	while($row = $results->fetch_assoc()) 
        {
            $data = $data + $row['Revenue'];
        }
        return $data;
    }
    
}

?>