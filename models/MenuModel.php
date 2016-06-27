<?php

class MenuModel 
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

    public function Resellers($t)
    {
        $i = 0;
        $data = "";
        $sql = "SELECT DISTINCT Login FROM Reports_Resellers_2016 ORDER BY Login ASC";
    	$results = $this->db->query($sql);
        
    	while($row = $results->fetch_assoc()) 
        {
            $Revenue = 0;
            $date = $t - 1;
            $sql2 = "SELECT * FROM Reports_Resellers_2016 WHERE Login ='".$row['Login']."' AND Date LIKE '".$date."%'";
            $results2 = $this->db->query($sql2);
            
            while($row2 = $results2->fetch_assoc()) 
            {
                $Revenue = $Revenue + $row2['Revenue'];
            }
            
            $Revenue = round($Revenue,2);
            
            $sql3 = "SELECT * FROM Accounts_Resellers_2016 WHERE Login ='".$row['Login']."'";
            $results3 = $this->db->query($sql3);
            $row3 = $results3->fetch_assoc(); 
                        
            $i = $i + 1;
            if(($i % 2) == 1)
            {
                $data = $data."<a href='?action=chart&reseller=".$row['Login']."&tid=".$_SESSION['tid']."' class='button'>".$row['Login']."<br/> S/. ".$Revenue."<br/> Activas ".$row3['Registered']." de ".$row3['Accounts']."</a>";
            }
            else
            {
                $data = $data."<a href='?action=chart&reseller=".$row['Login']."&tid=".$_SESSION['tid']."' class='button button-blue'>".$row['Login']."<br/> S/. ".$Revenue."<br/> Activas ".$row3['Registered']." de ".$row3['Accounts']."</a>";
            }
        }            
        return $data;
    }
    
}

?>