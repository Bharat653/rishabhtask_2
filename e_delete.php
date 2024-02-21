<?php
include 'connection.php';
class YourClass {
    private $db;


    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
                                
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=project", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo("connected succesfully");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function deletecategory($id) {
        try {
            // Retrieve the picture file names before deleting the row
            $query = "SELECT employe_code, picture, certificate FROM employe WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
    
            $employe_code = $row['employe_code'];
            // print_r($employe_code);
            // exit();
    
            // Delete the row from the database
            $query = "DELETE FROM `employe` WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
    
            // Delete associated pictures
            $employeImagePath = 'employees_docs/' . $employe_code . '/images/' . $row['picture'];
            $certificateFolderPath = 'employees_docs/' . $employe_code . '/certificates/';
            $certificateFiles = explode(",", $row['certificate']);
            //   print_r($certificateFiles);
            // exit();
    
            // Delete employe image
            if (file_exists($employeImagePath)) {
                unlink($employeImagePath);
            }
    
            // Delete certificate images
            foreach ($certificateFiles as $fileName) {
                $certificateImagePath = $certificateFolderPath . $fileName;
                if (file_exists($certificateImagePath)) {
                    unlink($certificateImagePath);
                }
            }
    
            // Delete the directory
            $employeDirectory = 'employees_docs/' . $employe_code;
            if (is_dir($employeDirectory)) {
                rmdir($employeDirectory);
            }
    
            header("Location: employe_data.php");
        } catch (PDOException $e) {
            echo "Failed to delete: " . $e->getMessage();
        }
    }
    
}

// Create an instance of the class
$yourObject = new YourClass();
$id = $_GET['deleteid'];
// Call the method on the instance
$yourObject->deletecategory($id); // Replace $yourCountryId with the actual country ID you want to delete

?>