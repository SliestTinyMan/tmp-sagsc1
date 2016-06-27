<?php

class LoginModel
{
    private $db;

    public function __construct()
    {
        $this->db=new mysqli('localhost', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
        //$this->db=new mysqli('db-sag-sc1.cam4laqbbkeo.us-east-1.rds.amazonaws.com:3306', 'isysadm', '2H%Ws!E3cQ#K', 'db_sag_sc1');
        $this->db->query("SET NAMES 'utf8'");

        if ($this->db->connect_errno)
        {
    		echo "<script>console.log('Fallo al conectar a MySQL: ".$this->db->connect_errno.", ".$this->db->connect_error."');</script>";
		}
		echo "<script>console.log('".$this->db->host_info."');</script>";
    }

    public function Search($u,$p)
    {
        $sql = "SELECT * FROM Login_Users WHERE User='".$u."' AND Password='".$p."'";
    	$results = $this->db->query($sql);

        if ($results->num_rows > 0)
        {
            $row = $results->fetch_assoc();
            if ($row['Status'] == '0')
            {
                return 1;
            }
            else
            {
                return -1;
            }
        }
        else
        {
            return 0;
        }

    }

    public function Update($u,$ip, $d, $s)
    {
        //$sql = "UPDATE Login_Users SET IPv4='".$ip."',Date='".$d."', Status='1' WHERE User='".$u."'";
        $sql = "UPDATE Login_Users SET IPv4='".$ip."',Date='".$d."' WHERE User='".$u."'";
      $this->db->query($sql);
        $sql2 = "SELECT * FROM Login_Users WHERE User='".$u."'";
    	$results2 = $this->db->query($sql2);
        $row = $results2->fetch_assoc();
        $_SESSION['usr'] = $row['Agent'];
        $_SESSION['u'] = $u;
    }

    public function Status($u)
    {
        $sql = "UPDATE Login_Users SET Status='0' WHERE User='".$u."'";
    	$this->db->query($sql);
    }

        public function UA()
    {
        $sql = "UPDATE Login_Users SET UpdateList='0'";
        $this->db->query($sql);
    }

       public function UAD()
    {
        $sql = "UPDATE Login_Users SET UpdateList='0' WHERE User='tecnicom101'";
        $this->db->query($sql);
    }
}

?>
