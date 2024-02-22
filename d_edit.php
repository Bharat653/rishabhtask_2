<?php
session_start();

require 'connection.php';
$result = [];

if (isset($_GET['editid'])) {
    $id = $_GET['editid'];
    $database = new database;
    $result = $database->editemploye(['id' => $id]);
    // echo "<pre>";
    // print_r($result);
    // echo "</pre>";
    // exit();
    // return $result;
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
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <?php require_once "bar/upperbar.php"; ?>
    <div class="container">

        <div class="wrapper">
            <div class="title"><span>Add Employe</span></div>
            <form action="employe.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <i class="fas fa-book" ></i>
                            <input type="text"  name="id" value="<?php echo $result['id'] ?>" placeholder="First Name" required readonly>
                        </div>
                <h1>Personal </h1>
                <!-- Employe_name -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-book"></i>
                            <input type="text" name="Employe_name" value="<?php echo $result['employe_name'] ?>" placeholder="First Name" required>
                        </div>
                    </div>
                    <!-- Employe_field -->
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-list"></i>
                            <input type="text" name="Employe_field" placeholder="Employe_field" value="<?php echo $result['employe_fields'] ?>" required>
                        </div>
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-at"></i>
                            <select name="department_id" class="form-control input-sm" style="padding-left: 3.5rem;">
                                <option>Select Department</option>
                                <?php foreach ($gdepartment as $data) : ?>
                                    <option value="<?php echo $data['id']; ?>" <?=($data['id'] == $result['department_id']? 'selected' : '')?>><?php echo $data['department_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- number -->
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fa-brands fa-pinterest"></i>
                            <input type="number" name="number" placeholder="Mobile number" value="<?php echo $result['mobile_number'] ?>" required>
                        </div>
                    </div>
                </div>
                <!-- email  -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-image"></i>
                            <input type="text" name="email" value="<?php echo $result['email'] ?>" placeholder="email Address">
                        </div>
                    </div>
                    <!-- picture  -->
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-rupee-sign"></i>
                            <input type="file" name="picture" value="<?php echo $result['picture'] ?>" placeholder="Employe picture">
                        </div>
                    </div>
                </div>
                <!-- address  -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-image"></i>
                            <input type="text" name="address" value="<?php echo $result['address'] ?>" placeholder="address">
                        </div>
                    </div>
                    <!-- hobby  -->
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <?php
                           
                            ?>
                            <i class="fas fa-rupee-sign"></i>
                            <fieldset data-role="controlgroup" name="hobby">
                                <?php
                                $hobbies = explode(',',$result['hobby']);
                                ?>
                                <legend>Choose your Hobby:</legend>
                                <label for="vehicle1"><input type="checkbox" id="Walking" name="hobby[]" value="Walking" <?= (in_array('Walking',$hobbies)? 'checked' : '' )?> > Walking</label><br> 
          
                                <label for="vehicle2"><input type="checkbox" id="Eating" name="hobby[]" value="Eating" <?= (in_array('Eating',$hobbies)? 'checked' : '' )?> > Eating</label><br>
                
                                <label for="vehicle3"><input type="checkbox" id="Running" name="hobby[]" value="Running" <?= (in_array('Running',$hobbies)? 'checked' : '' )?> > Running</label><br>
                            </fieldset>
                        </div>
                    </div>
                   
                </div>

                <!-- ///////// -->
                <h1>Organistation</h1>

                <!-- employe_code -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-image"></i>
                            <input type="text" name="employe_code" value="<?php echo $result['employe_code'] ?>" placeholder="employe_code " readonly >
                        </div>
                    </div>
                    <!-- designation -->
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-rupee-sign"></i>
                            <fieldset data-role="controlgroup" name="designation" value="<?php echo $result['designation'] ?>">
                                <legend>Choose your designation:</legend>
                                <label for="Senior Manager">Senior Manager</label>
                                <input type="radio" name="designation" id="Senior Manager" value="Senior Manager" checked></br>
                                <label for="Associate">Associate</label>
                                <input type="radio" name="designation" id="Associate" value="Associate"></br>
                                <label for="Manager">Manager</label>
                                <input type="radio" name="designation" id="Manager" value="Manager"></br>
                                <label for="Designer">Designer</label>
                                <input type="radio" name="designation" id="Designer" value="Designer"></br>
                                <label for="Developer">Developer</label>
                                <input type="radio" name="designation" id="Developer" value="Developer">
                            </fieldset>
                        </div>
                    </div>
                </div>

                <!-- depart -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-image"></i>
                            <fieldset data-role="controlgroup" name="depart">
                                <legend>Choose your depart:</legend>
                                <label for="Production ">Production </label>
                                <input type="radio" name="depart" id="Production " value="Production " checked></br>

                                <label for="Manufacturing ">Manufacturing </label>
                                <input type="radio" name="depart" id="Manufacturing " value="Manufacturing "></br>

                                <label for="Testing ">Testing </label>
                                <input type="radio" name="depart" id="Testing " value="Testing "></br>

                                <label for="Customer Support">Customer Support</label>
                                <input type="radio" name="depart" id="Customer Support" value="Customer Support"></br>

                            </fieldset>
                        </div>
                    </div>

                </div>
                <h1>Salary</h1>
                <!-- Row 7 -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-image"></i>
                            <input type="number" name="b_salary" value="<?php echo $result['b_salary'] ?>" placeholder="Basic Pay">
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-rupee-sign"></i>
                            <input type="number" name="h_salary"  value="<?php echo $result['h_salary'] ?>" placeholder="House Allowance">
                        </div>
                    </div>
                </div>
                <!-- row 8 -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-image"></i> 
                            <input type="number" name="d_salary" value="<?php echo $result['d_salary'] ?>" placeholder="Dearness Allowance">
                        </div>
                    </div>
                    <!-- t_salary -->
                    <div class="col-md-6 mb-4">
                        <div class="row">
                            <i class="fas fa-rupee-sign"></i>
                            <input type="number" name="t_salary" value="<?php echo $result['employe_salary'] ?>" placeholder="Total Salary" readonly >
                        </div>
                    </div>
                </div>

                <h1>Qualification</h1>

                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($result['passing_year'])) {
                                $passingYear = $result['passing_year'];
                                $passingYearExploded = explode(',', $passingYear);
                            }
                            if (isset($result['course'])) {
                                $course = $result['course'];
                                $courseExploded = explode(',', $course);
                            }
                            if (isset($result['university'])) {
                                $university = $result['university'];
                                $universityExploded = explode(',', $university);
                            }
                            if (isset($result['percentage'])) {
                                $percentage = $result['percentage'];
                                $percentageExploded = explode(',', $percentage);
                            }
                            ?>
                            <?php
                            for ($i = 0; $i < count($passingYearExploded); $i++) {
                            ?>

                                <div class="records">
                                    <div class="record-row">

                                        <input type="hidden" name="total_qualifications_added" value="<?= count($passingYearExploded); ?>">
                                        <input type="number" placeholder="Passing Year" name="passing[<?= $i ?>]" class="inputs" value="<?= $passingYearExploded[$i]; ?>" />
                                        <input type="text" placeholder="Course" name="course[<?= $i ?>]" class="inputs" value="<?= $courseExploded[$i]; ?>" />
                                        <input type="text" placeholder="University" name="university[<?= $i ?>]" class="inputs" value="<?= $universityExploded[$i]; ?>" />
                                        <input type="number" placeholder="Percentage" name="percentage[<?= $i ?>]" class="inputs" value="<?= $percentageExploded[$i]; ?>" />
                                        <input type="file" name="certificate[]" />
                                        <button type="button" class="addmorebtn">+</button>
                                        <button type="button" class="deletemorebtn d-none">-</button>
                                    <?php } ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- button -->
                <div class="row button">
                    <input type="submit" value="update" name="update">
                </div>

            </form>
        </div>
    </div>
    <?php require_once "bar/script.php"; ?>
</body>

<script>
    // calculate the salary
    $(document).ready(function() {
        checkQualification();
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

    function checkQualification() {
        let total_qualification_added = $('[name="total_qualifications_added"]').val();
        console.log(total_qualification_added);
    }

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