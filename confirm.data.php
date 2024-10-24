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

  <section class="bg-color soverflow-hidden">

    <div class="dcontainer px-4 py-2 px-md-5 text-center text-lg-start my-5">
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-12 mb-0 mb-lg-0" style="z-index: 10; text-align:center">
          <h1 class="my-1 display-3 fw-bold ls-tight mb-3" style="color: hsl(218, 81%, 95%)">
            CPA HN ONLINE
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

                error_reporting(0);
                $txtPrename = $_POST['txtPrename'];
                $txtName = $_POST['txtName'];
                $txtLname = $_POST['txtLname'];
                $txtGender = $_POST['txtGender'];
                $txtStatus = $_POST['txtStatus'];
                $txtBd = $_POST['txtBd'];
                $txtBm = $_POST['txtBm'];
                $txtBy = $_POST['txtBy'];
                $txtCid = $_POST['txtCid'];
                $txtNationality = $_POST['txtNationality'];
                $txtEmail = $_POST['txtEmail'];
                $txtReligion = $_POST['txtReligion'];
                $txtOccupation = $_POST['txtOccupation'];
                $txtEducation = $_POST['txtEducation'];
                $txtName2 = $_POST['txtName2'];
                $txtLname2 = $_POST['txtLname2'];
                $txtName3 = $_POST['txtName3'];
                $txtLname3 = $_POST['txtLname3'];
                $txtNameDad = $_POST['txtNameDad'];
                $txtLnameDad = $_POST['txtLnameDad'];
                $txtNameMom = $_POST['txtNameMom'];
                $txtLnameMom = $_POST['txtLnameMom'];
                $txtNo = $_POST['txtNo'];
                $txtMo = $_POST['txtMo'];
                $txtAlley = $_POST['txtAlley'];
                $txtSubDistrict = $_POST['txtSubDistrict'];
                $txtDistrict = $_POST['txtDistrict'];
                $txtProvince = $_POST['txtProvince'];
                $txtPostCode = $_POST['txtPostCode'];
                $txtTel = $_POST['txtTel'];


                $p = $conn->query("SELECT * FROM prename WHERE prename_id = '".$txtPrename."' ");  
                $rowP = $p->fetch_assoc();
                $prename = $rowP['prename_name'];

                $s = $conn->query("SELECT * FROM status WHERE status_id = '".$txtStatus."' ");  
                $rowS = $s->fetch_assoc();
                $status = $rowS['status_name'];

                $n = $conn->query("SELECT * FROM nation WHERE nation_id = '".$txtNationality."' ");  
                $rowN = $n->fetch_assoc();
                $nation = $rowN['nation_name'];

                $r = $conn->query("SELECT * FROM reg WHERE reg_id = '".$txtReligion."' ");  
                $rowR = $r->fetch_assoc();
                $reg = $rowR['reg_name'];

                $e = $conn->query("SELECT * FROM edu WHERE edu_id = '".$txtEducation."' ");  
                $rowE = $e->fetch_assoc();
                $edu = $rowE['edu_name'];
                


                ?>

                <form action="add.data.php" method="POST">

        

                  <div class="h1 text-center text-primary " style="margin-top:-20px; font-family:kanit;">ตรวจสอบข้อมูล</div>
                  <div class="h3 " style="font-family:kanit;">ข้อมูลส่วนบุคคล</div>
                  <hr>
                  <!-- <button class="btn btn-primary btn-block mb-5"><?php echo "ลงทะเบียนใหม่ "; ?></button> -->

                  <div class="col-md-12 mb-4 row">

                    <div class="col-md-3 mb-2">
                      <label for="basic-url" class="form-label"> คำนำหน้า</label>
                      <div class="input-group mb-2">
                        <input name="txtPrename" readonly type="hidden" value="<?php echo $txtPrename; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        <input name="prename" readonly type="text" value="<?php echo $prename; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-4 mb-0">
                      <label for="basic-url" class="form-label">ชื่อ</label>
                      <div class="input-group mb-2">
                        <input name="txtName" readonly type="text" value="<?php echo $txtName; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-5 mb-0">
                      <label for="basic-url" class="form-label">นามสกุล</label>
                      <div class="input-group mb-2">
                        <input name="txtLname" readonly type="text" value="<?php echo $txtLname; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-2 mb-2">
                      <label for="basic-url" class="form-label">เพศ</label>
                      <div class="input-group mb-2">
                        <input name="txtGender" readonly type="text" value="<?php echo $txtGender; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-4 mb-2">
                      <label for="basic-url" class="form-label">สถานภาพ</label>
                      <div class="input-group mb-2">
                        <input name="txtStatus" readonly type="hidden" value="<?php echo $txtStatus; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        <input name="status" readonly type="text" value="<?php echo $status; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-2 mb-0">
                      <label for="basic-url" class="form-label">วันเกิด</label>
                      <div class="input-group mb-2">
                        <input name="txtBd" readonly type="text" value="<?php echo $txtBd; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-2 mb-0">
                      <label for="basic-url" class="form-label">เดือนเกิด</label>
                      <div class="input-group mb-2">
                        <input name="txtBm" readonly type="text" value="<?php echo $txtBm; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-2 mb-0">
                      <label for="basic-url" class="form-label">ปีเกิด</label>
                      <div class="input-group mb-2">
                        <input name="txtBy" readonly type="text" value="<?php echo $txtBy; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-6 mb-0">
                      <div class="col-md-12 mb-2">
                        <label for="basic-url" class="form-label">หมายเลขบัตรประชาชน</label>
                        <div class="input-group mb-2">
                          <input name="txtCid" readonly type="text" value="<?php echo $txtCid; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3 mb-2">
                      <label for="basic-url" class="form-label">สัญชาติ</label>
                      <div class="input-group mb-2">
                        <input name="txtNationality" readonly type="hidden" value="<?php echo $txtNationality; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        <input name="nation" readonly type="text" value="<?php echo $nation; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                      </div>
                    
                    <div class="col-md-3 mb-2">
                      <label for="basic-url" class="form-label">ศาสนา</label>
                      <div class="input-group mb-2">
                        <input name="txtReligion" readonly type="hidden" value="<?php echo $txtReligion; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        <input name="reg" readonly type="text" value="<?php echo $reg; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-12 mb-2">
                      <label for="basic-url" class="form-label">อิเมลล์</label>
                      <div class="input-group mb-2">
                        <input name="txtEmail" readonly type="email" value="<?php echo $txtEmail; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-6 mb-0">
                      <div class="col-md-12 mb-2">
                        <label for="basic-url" class="form-label">อาชีพ</label>
                        <div class="input-group mb-2">
                          <input name="txtOccupation" readonly type="text" value="<?php echo $txtOccupation; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6 mb-2">
                      <label for="basic-url" class="form-label">วุฒิการศึกษา</label>
                      <div class="input-group mb-2">
                        <input name="txtEducation" readonly type="hidden" value="<?php echo $txtEducation; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                        <input name="edu" readonly type="text" value="<?php echo $edu; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">ชื่อ (คู่สมรส)</label>
                      <div class="input-group mb-2">
                        <input name="txtName2" readonly type="text" value="<?php echo $txtName2; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">นามสกุล (คู่สมรส)</label>
                      <div class="input-group mb-2">
                        <input name="txtLname2" readonly type="text" value="<?php echo $txtLname2; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">ชื่อบิดา (ผู้ป่วย)</label>
                      <div class="input-group mb-2">
                        <input name="txtNameDad" readonly type="text" value="<?php echo $txtNameDad; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">นามสกุลบิดา (ผู้ป่วย)</label>
                      <div class="input-group mb-2">
                        <input name="txtLnameDad" readonly type="text" value="<?php echo $txtLnameDad; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">ชื่อมารดา (ผู้ป่วย)</label>
                      <div class="input-group mb-2">
                        <input name="txtNameMom" readonly type="text" value="<?php echo $txtNameMom; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">นามสกุลมารดา (ผู้ป่วย)</label>
                      <div class="input-group mb-2">
                        <input name="txtLnameMom" readonly type="text" value="<?php echo $txtLnameMom; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">ชื่อ ผู้ที่ติดต่อได้</label>
                      <div class="input-group mb-2">
                        <input name="txtName3" readonly type="text" value="<?php echo $txtName3; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-6 mb-0">
                      <label for="basic-url" class="form-label">นามสกุล ผู้ที่ติดต่อได้</label>
                      <div class="input-group mb-2">
                        <input name="txtLname3" readonly type="text" value="<?php echo $txtLname3; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                  </div>




                  <div class="h3 " style="font-family:kanit;">ข้อมูลที่อยู่</div>
                  <hr>
                  <!-- <button class="btn btn-primary btn-block mb-5"><?php echo "ลงทะเบียนใหม่ "; ?></button> -->

                  <div class="col-md-12 mb-4 row">
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">เลขที่</label>
                      <div class="input-group mb-2">
                        <input name="txtNo" readonly type="text" value="<?php echo $txtNo; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">หมู่</label>
                      <div class="input-group mb-2">
                        <input name="txtMo" readonly type="text" value="<?php echo $txtMo; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">ตรอก/ซอย</label>
                      <div class="input-group mb-2">
                        <input name="txtAlley" readonly type="text" value="<?php echo $txtAlley; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">แขวง/ตำบล</label>
                      <div class="input-group mb-2">
                        <input name="txtSubDistrict" readonly type="text" value="<?php echo $txtSubDistrict; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">เขต/อำเภอ</label>
                      <div class="input-group mb-2">
                        <input name="txtDistrict" readonly type="text" value="<?php echo $txtDistrict; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">จังหวัด</label>
                      <div class="input-group mb-2">
                        <input name="txtProvince" readonly type="text" value="<?php echo $txtProvince; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">รหัสไปรณีย์</label>
                      <div class="input-group mb-2">
                        <input name="txtPostCode" readonly type="text" value="<?php echo $txtPostCode; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>
                    <div class="col-md-3 mb-0">
                      <label for="basic-url" class="form-label">หมายเลขโทรศัพท์</label>
                      <div class="input-group mb-2">
                        <input name="txtTel" readonly type="text" value="<?php echo $txtTel; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                    </div>

                    <div class="col-md-12  mb-2 mt-5">

                      <!-- <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="history.back();" value="แก้ไขข้อมูล" style="margin-top:-50px"> -->
                      <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="window.location.href='check_cid.php';" value="กลับสู่หน้าหลัก" style="margin-top:-50px">

                      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-0" style="margin-top:-50px;">
                        ยืนยันข้อมูล
                      </button>
                      <br>
                    </div>

                  </div>






                  <!-- <label for="">CID</label>
                    <input class="form-control" id="disabledInput" type="text" value="<?php echo $cid; ?>" disabled>
                     -->
                </form>


                <?php



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