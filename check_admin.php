<?php session_start(); ?>
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

<body style="background-color:#009579;">

  <section class="1background-radial-gradient overflow-hidden">

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-12 mb-0 mb-lg-0" style="z-index: 10; text-align:center">
          <img src="img/ABH-LOGO-WHITE.png" alt="" style="width:20%; margin-top:-80px; margin-bottom:-30px;">
        </div>

        <!-- box center -->
        <div class="col-lg-3 mb-5 mb-lg-0 position-relative">

        </div>



        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">



              <form method="post" action="check_admin.php">


                <div class="row">
                  <div class="col-md-12 mb-0">
                    <div data-mdb-input-init class="form-outline">
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                        <input type="text" name="txtCid" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                      </div>

                      <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                        <input type="password" name="txtPassword" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
                      </div>
                    </div>
                  </div>




                </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto mb-5">
              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-0" style="margin-top:-50px;">
                เข้าสู่ระบบ
              </button>
              <!-- <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block mt-2" onclick="history.back();" value="กลับสู่หน้าหลัก" style="margin-top:-50px"> -->
              <div class="mt-5" style="margin-bottom:-30px;"> <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="location.href='index.php'" value="กลับสู่หน้าหลัก" style="margin-top:-50px">


              </div>

              </form>




              <?php

              if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $txtCid = $_POST['txtCid'];

                $sql = "SELECT * FROM patient WHERE txtCid = '" . $txtCid . "' ";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                $admin = $row['txtAdmin'];


                // Dummy validation (replace with actual validation logic)
                if ($admin === '1') {
                  $_SESSION['admin'] = $admin;
                  $_SESSION['loggedin'] = true;
                  header('Location: admin.php');
                  exit;
                } else {
                  echo 'Invalid login credentials.';
                }
              }
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