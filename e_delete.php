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
            // echo("connected successfully");
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function deletecategory($id) {
        try {
            // Retrieve the picture file names before deleting the row
            $query = "SELECT employe_code, certificate FROM employe WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $employe_code = $row['employe_code'];

            // Delete the row from the database
            $query = "DELETE FROM employe WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $id);
            $statement->execute();

            // Delete associated pictures
            $employeImagePath = 'employees_docs/' . $employe_code . '/images/';
            $certificateFolderPath = 'employees_docs/' . $employe_code . '/certificates';
            $certificateFiles = explode(",", $row['certificate']);

            // Delete employe image
            if (file_exists($employeImagePath)) {
                $this->deleteDirectory($employeImagePath);
            }

            // Delete certificate images
            foreach ($certificateFiles as $fileName) {
                $certificateImagePath = $certificateFolderPath . '/' . $fileName;
                if (file_exists($certificateImagePath)) {
                    unlink($certificateImagePath);
                }
            }

            // Delete the directory
            $employeDirectory = 'employees_docs/' . $employe_code;
            if (is_dir($employeDirectory)) {
                $this->deleteDirectory($employeDirectory);
            }

            header("Location: employe_data.php");
        } catch (PDOException $e) {
            echo "Failed to delete: " . $e->getMessage();
        }
    }

    private function deleteDirectory($path) {
        // Recursive function to delete a directory and its contents
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($path . "/" . $object)) {
                        $this->deleteDirectory($path . "/" . $object);
                    } else {
                        unlink($path . "/" . $object);
                    }
                }
            }
            rmdir($path);
        }
    }
}

// Create an instance of the class
$yourObject = new YourClass();
$id = $_GET['deleteid'];
// Call the method on the instance
$yourObject->deletecategory($id); // Replace $yourCountryId with the actual country ID you want to delete
?>
