<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">

  <?php
  require_once './vendor/autoload.php'; // path ของไฟล ืautoload.php ใน vendor
  $dotenv = Dotenv\Dotenv::createImmutable('./'); //path ที่เก็บ ไฟล์ .env
  $dotenv->load();
  include("connect.php"); ?>
  <title>HN Online</title>
</head>

<body style="background-color:#009579; ">

  <section class="bg-color soverflow-hidden">

    <div class="dcontainer px-4 py-2 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-12 mb-0 mb-lg-0" style="z-index: 10; text-align:center">
          <h1 class="my-1 display-3 fw-bold ls-tight mb-3" style="color: hsl(218, 81%, 95%)">
            COMPLETED
          </h1>
        </div>

        <!-- box center -->
        <div class="col-lg-3 mb-5 mb-lg-0 position-relative">
        </div>

        <div class="col-lg-6 mb-0 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">


              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">


                <?php

                // error_reporting(0);

                $txtPrename = filter_var($_POST['txtPrename'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtName = filter_var($_POST['txtName'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtLname = filter_var($_POST['txtLname'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtGender = filter_var($_POST['txtGender'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtStatus = filter_var($_POST['txtStatus'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtBd = filter_var($_POST['txtBd'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtBm = filter_var($_POST['txtBm'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtBy = filter_var($_POST['txtBy'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtCid = filter_var($_POST['txtCid'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtNationality = filter_var($_POST['txtNationality'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtReligion = filter_var($_POST['txtReligion'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtEmail = filter_var($_POST['txtEmail'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtOccupation = filter_var($_POST['txtOccupation'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtEducation = filter_var($_POST['txtEducation'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtName2 = filter_var($_POST['txtName2'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtLname2 = filter_var($_POST['txtLname2'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtNameDad = filter_var($_POST['txtNameDad'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtLnameDad = filter_var($_POST['txtLnameDad'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtNameMom = filter_var($_POST['txtNameMom'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtLnameMom = filter_var($_POST['txtLnameMom'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtNo = filter_var($_POST['txtNo'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtMo = filter_var($_POST['txtMo'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtAlley = filter_var($_POST['txtAlley'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtSubDistrict = filter_var($_POST['txtSubDistrict'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtDistrict = filter_var($_POST['txtDistrict'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtProvince = filter_var($_POST['txtProvince'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtPostCode = filter_var($_POST['txtPostCode'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtTel = filter_var($_POST['txtTel'], FILTER_SANITIZE_SPECIAL_CHARS) ?? "";
                $txtHN = 0;
                $txtConfirm = 0;



                // Construct the SQL query
                $sql = "INSERT INTO Patient (txtPrename, txtName, txtLname, txtGender, txtStatus, txtBd, txtBm, txtBy, txtCid, txtNationality, txtReligion, txtEmail, txtOccupation, txtEducation, txtName2, txtLname2, txtNameDad, txtLnameDad, txtNameMom, txtLnameMom, txtNo, txtMo, txtAlley, txtSubDistrict, txtDistrict, txtProvince, txtPostCode, txtTel,txtHN,txtConfirm,txtadmin) 
        VALUES ('$txtPrename', '$txtName', '$txtLname', '$txtGender', '$txtStatus', '$txtBd', '$txtBm', '$txtBy', '$txtCid', '$txtNationality', '$txtReligion', '$txtEmail', '$txtOccupation', '$txtEducation', '$txtName2', '$txtLname2', '$txtNameDad', '$txtLnameDad', '$txtNameMom', '$txtLnameMom', '$txtNo', '$txtMo', '$txtAlley', '$txtSubDistrict', '$txtDistrict', '$txtProvince', '$txtPostCode', '$txtTel','$txtHN','$txtConfirm','0')";
                // error_reporting(0);
                // Execute the query

                if ($conn->query($sql)) {

                ?><div class="text-center" style="font-family:kanit">
                    <div class="fw-normal h4"><?php echo "ขอขอบคุณ "; ?></div>
                    <div class="fw-normal h2 text-primary"><?php echo $txtPrename . $txtName . " " . $txtLname; ?></div>
                    <div class="fw-normal"><?php echo "เราได้รับข้อมูลของท่านเรียบร้อยแล้ว"; ?></div>
                    <div class="fw-normal"><?php echo "เราจะดำเนินการส่ง Email ยืนยันให้คุณ เมื่อระบบได้ทำการอนุมัติเลข HN เรียบร้อยแล้ว"; ?></div>
                    <div class="mt-5 mb-2 " style="margin-bottom:-30px;"> <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="location.href='index.php'" value="กลับสู่หน้าหลัก" style="margin-top:-50px"></div>
                    <div class="fw-light"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร ขอบคุณที่ใช้บริการ"; ?></div>
                  <?php
                }
                 else {
                  echo '<div class="text-center" style="font-family:kanit">พบข้อผิดพลาดไม่สามารถเพิ่มข้อมูลได้ </div>';
                }

                $conn->close();
                  ?>
                  </div>
              </div>
            </div>
          </div>
        </div>
  </section>
  <!-- Section: Design Block -->

</body>

</html>