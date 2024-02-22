<?php
use LDAP\Result;
class database
{
    private $db;
    private $_FILES;
    function __construct()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=project", $username, $password);
            // set the PDO error mode to exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Connected successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function adddepartment()
    {
        $department_name = $_POST['department_name'];
        $department_field = $_POST['department_field'];
        // print_r($_POST);
        $query = $this->db->prepare("INSERT INTO `department`(`department_name`, `department_field`) VALUES (?,?)");
        $result = $query->execute([$department_name, $department_field]);
        //  print_r($result);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function getdepartment()
    {
        $query = $this->db->prepare("select * from department");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    function editdepartment($data)
    {
        $query = $this->db->prepare("select * from department where id=:id ");
        $query->execute($data);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function updatedepartment($data)
    {
        // echo"<pre>";
        // print_r($data);
        // exit();
        $query = $this->db->prepare("update department set 
        department_name = :department_name,
        department_field = :department_field 
        where id =:id ");
        return $query->execute($data);
    }

    function updateemploye($data1)
    {
        // echo"<pre>";
        // print_r($data1);
        // exit();
        $query = $this->db->prepare("update employe set 
        employe_name = :employe_name,
        employe_fields = :employe_field,
        mobile_number = :mobile_number,
        department_id = :department_id,
        email = :email,
        address = :address,
        hobby = :hobby,
        designation = :designation,
        b_salary = :b_salary,
        h_salary = :h_salary,
        d_salary = :d_salary,
        employe_salary = :t_salary,
        passing_year =:passing_year,
        course = :course,
        university = :university,
        percentage = :percentage
        where id = :id ");
        $result = $query->execute($data1);
        // print_r($result);
        // exit();
    }

    function addemploye()
    {
        $Employe_name = $_POST['Employe_name'];
        $Employe_field = $_POST['Employe_field'];
        $department_id = $_POST['department_name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $employe_code = $_POST['employe_code'];
        $picture = $_FILES['picture']['name'];
        $picture2 = $_FILES['picture2']['name'];

        $designation = $_POST['designation'];
        $b_salary = $_POST['b_salary'];
        $h_salary = $_POST['h_salary'];
        $d_salary = $_POST['d_salary'];
        $t_salary = $_POST['t_salary'];

        $pict = $_FILES['picture2']['name'];
        $picture2 = implode(",", $pict);
        // echo $picture2;
        // exit();

        $hob = $_POST['hobby'];
        $hob1 = implode(",", $hob);
        // echo $hob1;

        $cour = $_POST['course'];
        $cour1 = implode(",", $cour);

        $univ = $_POST['university'];
        $univ1 = implode(",", $univ);


        $pass = $_POST['passing'];
        $pass1 = implode(",", $pass);

        $percen = $_POST['percentage'];
        $percen1 = implode(",", $percen);

        // print_r("<pre>");
        // print_r($_POST);
        // print_r($_FILES);
        // print_r("</pre>");
        // exit();
        $query = $this->db->prepare("INSERT INTO `employe`(`employe_name`, `employe_fields`, `mobile_number`, `email`, `address`, `hobby`, `employe_code`, `designation`,`b_salary`,`h_salary`,`d_salary`, `employe_salary`, `passing_year`, `course`, `university`, `percentage`,`department_id`,`picture`,`certificate` ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        // foreach ()
        $result = $query->execute([$Employe_name, $Employe_field, $number, $email, $address, $hob1, $employe_code, $designation,$b_salary,$h_salary,$d_salary, $t_salary, $pass1, $cour1, $univ1, $percen1, $department_id, $picture, $picture2]);
 
          // Process profile picture upload
          $filename = $_FILES["picture"]["name"];
          $tempname = $_FILES["picture"]["tmp_name"];
          $uploadImagePath = 'employees_docs/' . $employe_code . '/images';
          if (!file_exists($uploadImagePath)) {
              mkdir($uploadImagePath, 0777, true);
          }
          move_uploaded_file($tempname, $uploadImagePath . '/' . $filename);

        $qualification_folder = 'employees_docs/' . $employe_code . '/certificates' ;

        if (!file_exists($qualification_folder)) {
            mkdir($qualification_folder, 0777, true);
        }
        // Process multiple uploaded certificate files
        $pict = $_FILES['picture2']['name'];
        foreach ($pict as $index => $fileName) {

            $tempName = $_FILES['picture2']['tmp_name'][$index];
            $destination =  $qualification_folder . '/' . $fileName;
            move_uploaded_file($tempName, $destination);
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    function getemploye()
    {
        $query = $this->db->prepare("select emp.*,
        COALESCE(department.department_name) AS department_name
         from employe as emp inner join department on department.id = emp.department_id ");
        // $query = $this->db->prepare("select  * from employe inner join department on  department.id = employe.department_id"); 
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    function editemploye($data)
    {
        $query = $this->db->prepare("select * from employe where id = :id");
        $query->execute($data);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

  

    function addhobby()
    {
        $hobby = $_POST['hobby'];
        $query = $this->db->prepare("INSERT INTO `hobby`(`hobby_name`) VALUES (?)");
        $result = $query->execute([$hobby]);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function gethobby()
    {
        $query = $this->db->prepare("select * from hobby ");
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return $result;
        } else {
            return 0;
        }
    }
    function isEmployeeCodeExists($employeeCode)
    {
        $query = $this->db->prepare("select COUNT(*) as count from employe where employe_code = ?");
        $query->execute([$employeeCode]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}
$database = new Database();
