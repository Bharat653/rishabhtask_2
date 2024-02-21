<?php
session_start();
require "connection.php";

if (isset($_POST['update'])) {

  // $id =  $_POST['id'];
  $Employe_name = $_POST['Employe_name'];
  $Employe_field = $_POST['Employe_field'];
  $department_name = $_POST['department_name'];
  $number = $_POST['number'];
  $email = $_POST['email'];
  $picture = $_FILES['picture'];
  $address = $_POST['address'];
  $hobby = $_POST['hobby'];
  $employe_code = $_POST['employe_code'];
  $designation = $_POST['designation'];
  $depart = $_POST['depart'];
  $b_salary = $_POST['b_salary'];
  $h_salary = $_POST['h_salary'];
  $d_salary = $_POST['d_salary'];
  $t_salary = $_POST['t_salary'];
  $passing_year = $_POST['passing'];
  $course = $_POST['course'];
  $university = $_POST['university'];
  $percentage = $_POST['percentage'];

  $database = new database;
    // print_r("<pre>");
    // print_r($_POST);
    // exit();
  $result = $database->updateemploye([

    // 'id' => $id,
    'Employe_name' => $Employe_name,
    'Employe_field' => $Employe_field,
    'department_name' => $department_name,
    'number' => $number,
    'email' => $email,
    'picture' => $picture,
    'address' => $address,
    'hobby' => $hobby,
    'employe_code' => $employe_code,
    'designation' => $designation,
    'depart' => $depart,
    'b_salary' => $b_salary,
    'h_salary' => $h_salary,
    'd_salary' => $d_salary,
    't_salary' => $t_salary,
    'passing_year' => $passing_year,
    'course' => $course,
    'university' => $university,
    'percentage' =>$percentage,
  ]);



  if ($result) {

    echo "Updation successfully";
  } else {
    echo "Not working";
  }
}

if (isset($_REQUEST['submit'])) {
  if (($_REQUEST['Employe_name'] == "") || ($_REQUEST['Employe_field'] == "")
    || ($_REQUEST['department_name'] == "") || ($_REQUEST['number'] == "")
    || ($_REQUEST['email'] == "")
    || ($_REQUEST['address'] == "") || ($_REQUEST['employe_code'] == "")
    || ($_REQUEST['hobby'] == "") || ($_REQUEST['designation'] == "")
    || ($_REQUEST['depart'] == "") || ($_REQUEST['b_salary'] == "")
    || ($_REQUEST['h_salary'] == "") || ($_REQUEST['d_salary'] == "")
    || ($_REQUEST['t_salary'] == "")
  ) {
    // print_r("<pre>");
    // print_r($_POST);
    // exit();
    echo "all Fileds required";
  }
  if ($database->isEmployeeCodeExists($_REQUEST['employe_code'])) {
    echo "Employee code already exists.";
  } else {
    $department = $database->addemploye();
  }
}

$gdepartment = $database->getdepartment();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form | CodingLab</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>
  <?php require_once "bar/upperbar.php"; ?>
  <div class="container">

    <div class="wrapper">
      <!-- <div class="title"><span>Add Employee</span></div> -->
      <form action="employe.php" method="post" enctype="multipart/form-data">
        <h1>Personal</h1>
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-book"></i></span>
              <input type="text" class="form-control" name="Employe_name" placeholder="First Name" required>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-list"></i></span>
              <input type="text" class="form-control" name="Employe_field" placeholder="Employee Field" required>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-at"></i></span>
              <select name="department_name" class="form-control">
                <option>Select Department</option>
                <?php foreach ($gdepartment as $data) : ?>
                  <option value="<?php echo $data['id']; ?>"><?php echo $data['department_name']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fa-brands fa-pinterest"></i></span>
              <input type="number" class="form-control" name="number" placeholder="Mobile Number" required>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-image"></i></span>
              <input type="text" class="form-control" name="email" placeholder="Email Address">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
              <input type="file" class="form-control" name="picture" placeholder="Employee Picture">
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-image"></i></span>
              <input type="text" class="form-control" name="address" placeholder="Address">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
              <fieldset data-role="controlgroup" name="hobby">
                <legend>Choose your Hobby:</legend>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="hobby1" name="hobby[]" value="Walking">
                  <label class="form-check-label" for="hobby1">Walking</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="hobby2" name="hobby[]" value="Eating">
                  <label class="form-check-label" for="hobby2">Eating</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="hobby3" name="hobby[]" value="Running">
                  <label class="form-check-label" for="hobby3">Running</label>
                </div>
              </fieldset>
            </div>
          </div>
        </div>

        <h1>Organization</h1>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-image"></i></span>
              <input type="text" class="form-control" name="employe_code" placeholder="Employee Code">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
            <span class="input-group-text"><i class="fas fa-list"></i></span>
              <fieldset data-role="controlgroup" name="designation">
                <legend>Choose designation:</legend>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="designation1" name="designation" value="Senior Manager" checked>
                  <label class="form-check-label" for="designation1">Senior Manager</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="designation2" name="designation" value="Associate">
                  <label class="form-check-label" for="designation2">Associate</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="designation2" name="designation" value="Associate">
                  <label class="form-check-label" for="designation2">Tester</label>
                </div>
                <!-- Add similar blocks for other designations -->
              </fieldset>
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
            <span class="input-group-text"><i class="fas fa-list"></i></span>
              <fieldset data-role="controlgroup" name="depart">
                <legend>Choose your department:</legend>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="depart1" name="depart" value="Production" checked>
                  <label class="form-check-label" for="depart1">Production</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" id="depart1" name="depart" value="Production" checked>
                  <label class="form-check-label" for="depart1">destruction</label>
                </div>
                <!-- Add similar blocks for other departments -->
              </fieldset>
            </div>
          </div>
        </div>

        <h1>Salary</h1>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
              <input type="number" class="form-control" name="b_salary" placeholder="Basic Pay">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
              <input type="number" class="form-control" name="h_salary" placeholder="House Allowance">
            </div>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="input-group">
            <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
              <input type="number" class="form-control" name="d_salary" placeholder="Dearness Allowance">
            </div>
          </div>
          <div class="col-md-6">
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-rupee-sign"></i></span>
              <input type="number" class="form-control" name="t_salary" placeholder="Total Salary" readonly>
            </div>
          </div>
        </div>

        <h1>Qualification</h1>

        <div class="row mb-3">
          <div class="card">
            <div class="card-body">
              <div class="records">
                <div class="record-row">
                  <input type="number" placeholder="Passing Year" name="passing[]" class="inputs form-control" />
                  <input type="text" placeholder="Course" name="course[]" class="inputs form-control" />
                  <input type="text" placeholder="University" name="university[]" class="inputs form-control" />
                  <input type="number" placeholder="Percentage" name="percentage[]" class="inputs form-control" />
                  <input type="file" name="picture2[]" class="form-control" multiple />
                  <button type="button" class="addmorebtn btn btn-success">+</button>
                  <button type="button" class="deletemorebtn d-none btn btn-danger">-</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row button">
          <input type="submit" value="Submit" name="submit" class="btn btn-primary">
        </div>

      </form>
    </div>
  </div>
  <?php require_once "bar/script.php"; ?>
</body>


<script>
  // calculate the salary
  $(document).ready(function() {
    $("[name='b_salary'], [name='h_salary'], [name='d_salary']").on('input', function() {
      calculateTotalSalary();
    });

    function calculateTotalSalary() {
      var basicSalary = parseFloat($("[name='b_salary']").val()) || 0;
      var houseSalary = parseFloat($("[name='h_salary']").val()) || 0;
      var dearnessSalary = parseFloat($("[name='d_salary']").val()) || 0;

      var totalSalary = basicSalary + houseSalary + dearnessSalary;
      $("[name='t_salary']").val(totalSalary);
    }
  });
  // add more functionality
  $(document).on("click", ".addmorebtn", function() {
    var parent = $(this).parents('.records');
    var clone = parent.clone();
    clone.find(".inputs").val("");
    $(this).parents('.records').after(clone);
    shoHide();
  });

  $(document).on('click', '.deletemorebtn', function() {
    var parent = $(this).parents('.records');
    parent.remove();
    shoHide();
  });

  function shoHide() {
    if ($('.records').length <= 1) {
      $('.addmorebtn').removeClass('d-none');
      $('.deletemorebtn').addClass('d-none');
    } else {
      $('.addmorebtn').addClass('d-none');
      $('.deletemorebtn').removeClass('d-none');
      $('.addmorebtn').last().removeClass('d-none');
    }
  }
</script>
</html>