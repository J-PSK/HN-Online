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
  include("connect.php");
  header('X-Frame-Options: DENY');
  header('X-Content-Type-Options: nosniff');
  header('X-XSS-Protection: 1; mode=block');
  header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
  $timeLimit = 60;  // Time limit in seconds (e.g., 60 seconds)
  $maxRequests = 15;  // Maximum number of requests allowed

  session_start();
  if (!isset($_SESSION['request_count'])) {
    $_SESSION['request_count'] = 0;
    $_SESSION['start_time'] = time();
  }
  if (time() - $_SESSION['start_time'] > $timeLimit) {
    $_SESSION['request_count'] = 1;
    $_SESSION['start_time'] = time();
  } else {
    $_SESSION['request_count']++;
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
      // Handle invalid CSRF token
      die('CSRF token validation failed');
    }
  }
  // Check if the request count exceeds the max requests
  if ($_SESSION['request_count'] > $maxRequests) {
    // Return an error response or limit access
    header('HTTP/1.1 429 Too Many Requests');
    die('Rate limit exceeded. Please try again later.');
  }

  ?>
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
                // error_reporting(0);
                $txtPrename = $_POST['txtPrename'] ?? "";
                $txtName = $_POST['txtName'] ?? "";
                $txtLname = $_POST['txtLname'] ?? "";
                $txtGender = $_POST['txtGender'] ?? "";
                $txtStatus = $_POST['txtStatus'] ?? "";
                $txtBd = $_POST['txtBd'] ?? "";
                $txtBm = $_POST['txtBm'] ?? "";
                $txtBy = $_POST['txtBy'] ?? "";
                $txtCid = $_POST['txtCid'] ?? "";
                $txtNationality = $_POST['txtNationality'] ?? "";
                $txtReligion = $_POST['txtReligion'] ?? "";
                $txtOccupation = $_POST['txtOccupation'] ?? "";
                $txtEducation = $_POST['txtEducation'] ?? "";
                $txtName2 = $_POST['txtName2'] ?? "";
                $txtLname2 = $_POST['txtLname2'] ?? "";
                $txtNameDad = $_POST['txtNameDad'] ?? "";
                $txtLnameDad = $_POST['txtLnameDad'] ?? "";
                $txtNameMom = $_POST['txtNameMom'] ?? "";
                $txtLnameMom = $_POST['txtLnameMom'] ?? "";
                $txtNo = $_POST['txtNo'] ?? "";
                $txtMo = $_POST['txtMo'] ?? "";
                $txtAlley = $_POST['txtAlley'] ?? "";
                $txtSubDistrict = $_POST['txtSubDistrict'] ?? "";
                $txtDistrict = $_POST['txtDistrict'] ?? "";
                $txtProvince = $_POST['txtProvince'] ?? "";
                $txtPostCode = $_POST['txtPostCode'] ?? "";
                $txtTel = $_POST['txtTel'] ?? "";

                $bd = $txtBy - 543 . '-' . $txtBm . '-' . $txtBd;

                require("./connect/connectpostgre.php");
                $hisQuery = "SELECT cid,hn,pname,fname,lname FROM patient where cid = :cid AND birthday = :bd LIMIT 1";
                $stmt = $pdo->prepare($hisQuery);
                $stmt->bindParam(':cid', $txtCid, PDO::PARAM_STR);
                $stmt->bindParam(':bd', $bd);
                $stmt->execute();
                $hisdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // echo "HN : " . count($hisdata) . "<br>"; // เช็ค ฐาน hosxp มีค่าให้ข้ามไปเลย

                $hn = "";
                $pname = "";
                $fname = "";
                $lname  = "";
                $hn = "";
                $txtCid;

                $sql = "SELECT * FROM patient WHERE txtCid = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $txtCid); // "s" means the parameter is a string
                $stmt->execute();
                $result = $stmt->get_result();
                $ohmdata = $result->fetch_assoc();
                // echo count($ohmdata);

                if (count($hisdata) === 1) {
                  $pname = $hisdata[0]['pname'];
                  $fname = $hisdata[0]['fname'];
                  $lname = $hisdata[0]['lname'];
                  $hn    = $hisdata[0]['hn'];
                  //   // echo "ชื่อ : " . $hisdata[0]['pname'] . ' ' . $hisdata[0]['fname'] . ' ' . $hisdata[0]['lname'];
                } else if (@$ohmdata['txtHN'] == 0) { // ไม่เจอข้อมูลใน hosxp แต่มีการ insert ขอ มาแล้ว
                  // echo "ไม่พบข้อมูล HN ของท่านในระบบของโรงพยาบาล";
                  $pname =  $ohmdata['txtPrename'] ?? '';
                  $fname = $ohmdata['txtName'] ?? '';
                  $lname = $ohmdata['txtLname'] ?? '';
                } else if ($ohmdata['txtHN'] !== 0 && count($hisdata) !== 1) {
                  $pname = $ohmdata['txtPrename'];
                  $fname = $ohmdata['txtName'];
                  $lname = $ohmdata['txtLname'];
                  $hn = $ohmdata['txtHN'];
                }
                ?>


                <?php
                // ตรวจสอบและแสดงผลลัพธ์
                // count($hisdata);
                // echo $hn;
                // echo $ohmdata['txtHN'];
                if (@$ohmdata['txtHN'] ==  '0'  && count($hisdata) < 1) {
                  if (@$ohmdata['txtHN']  == '0') {
                ?><div class="text-center" style="font-family:kanit"><?php ?>
                      <div class="fw-normal h5"><?php echo "สวัสดีคุณ "; ?></div>
                      <div class="fw-normal h3 text-success"><?php echo  $pname . $fname . " " .  $lname; ?></div>
                      <div class="text-primary" style="font-size : 60px"><?php echo "รออนุมัติ" ?>
                      </div>
                      <div class="fw-normal"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร ขอบคุณที่ใช้บริการ"; ?></div>
                      <div class="mt-5" style="margin-bottom:-30px;">
                        <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="history.back();" value="กลับสู่หน้าหลัก" style="margin-top:-50px">
                      <?php  } else { ?>
                        <div class="text-center" style="font-family:kanit">
                          <div class="fw-normal h5"><?php echo "สวัสดีคุณ "; ?></div>
                          <div class="fw-normal h3 text-success"><?php echo $row['txtPrename'] . $row['txtName'] . " " . $row['txtLname']; ?></div>
                          <div class="fw-normal"><?php echo "HN ของคุณคือ"; ?></div>
                          <div class="text-primary" style="font-size : 100px;"><?php echo $row['txtHN']; ?></div>
                          <div class="fw-normal"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร ขอบคุณที่ใช้บริการ"; ?><div>
                              <div class="mt-5" style="margin-bottom:-30px;"> <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="history.back();" value="กลับสู่หน้าหลัก" style="margin-top:-50px">
                              <?php }
                          } else if (count($hisdata) < 1) { ?>

                              <form action="confirm.data.php" method="POST">

                                <div class="h1 text-center text-primary " style="margin-top:-20px; font-family:kanit;">ลงทะเบียนผู้ป่วยใหม่</div>
                                <div class="h3 " style="font-family:kanit;">ข้อมูลส่วนบุคคล</div>
                                <hr>
                                <!-- <button class="btn btn-primary btn-block mb-5"><?php echo "ลงทะเบียนใหม่ "; ?></button> -->

                                <div class="col-md-12 mb-4 row">

                                <div class="col-md-3 mb-2">
                                        <label for="basic-url" class="form-label"> คำนำหน้า</label>
                                        <div class="input-group mb-2">

                                         

                                          <select name="txtPrename" class="form-select" aria-label="Default select example">
                                            <option selected value="0">คำนำหน้า</option>
                                            <?php
                                                  $prename = $conn->query("SELECT * FROM prename");
                                                   while ($rowPrename = $prename->fetch_assoc()) 
                                                   {
                                                    ?>
                                                      <option value="<?php echo $rowPrename['prename_id']; ?>">
                                                        <?php echo $rowPrename['prename_name'] . "<br>"; ?>
                                                      </option>
                                                    <?php
                                                   }
                                            ?>
                                          </select>
                                        </div>
                                      </div>
                                      
                                  <div class="col-md-4 mb-0">
                                    <label for="basic-url" class="form-label">ชื่อ</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <input name="txtName" required type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-5 mb-0">
                                    <label for="basic-url" class="form-label">นามสกุล</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <input name="txtLname" required type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>

                                  <div class="col-md-2 mb-0">
                                    <label for="basic-url" class="form-label">เพศ</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <select class="form-select" name="txtGender" >
                                        <option value="เพศ">เพศ</option>
                                        <option value="ชาย">ชาย</option>
                                        <option value="หญิง">หญิง</option>
                                        <option value="ไม่ระบุ">ไม่ระบุ</option>
                                      </select>
                                    </div>
                                  </div>
                              
                                  <div class="col-md-4 mb-2">
                                    <label for="basic-url" class="form-label">สถานภาพ</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <?php $status = $conn->query("SELECT * FROM status");  ?>

                                      <select name="txtStatus" class="form-select" aria-label="Default select example">
                                        <option selected value="0">สถานภาพ</option>
                                        <?php
                                        while ($rowStatus = $status->fetch_assoc()) {
                                        ?>
                                          <option value="<?php echo $rowStatus['status_id']; ?>">
                                            <?php echo $rowStatus['status_name'] . "<br>"; ?>
                                          </option>
                                        <?php
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-2 mb-0">
                                    <label for="basic-url" class="form-label">วันเกิด</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <input name="txtBd" readonly type="text" value="<?php echo $txtBd; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-2 mb-0">
                                    <label for="basic-url" class="form-label">เดือนเกิด</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <input name="txtBm" readonly type="text" value="<?php echo $txtBm; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-2 mb-0">
                                    <label for="basic-url" class="form-label">ปีเกิด</label> <label class="text-danger"> *</label>
                                    <div class="input-group mb-2">
                                      <input name="txtBy" readonly type="text" value="<?php echo $txtBy; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>

                                  <div class="col-md-6 mb-0">
                                    <div class="col-md-12 mb-2">
                                      <label for="basic-url" class="form-label">หมายเลขบัตรประชาชน</label> <label class="text-danger"> *</label>
                                      <div class="input-group mb-2">
                                        <input name="txtCid" readonly type="text" value="<?php echo $txtCid; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-3 mb-2">
                                    <label for="basic-url" class="form-label">สัญชาติ</label> <label class="text-danger"> *</label>
                                    <?php
                                    $nation = $conn->query("SELECT * FROM nation");

                                    if (!$nation) {
                                      die("Query failed: " . $conn->error);
                                    }
                                    ?>

                                    <select name="txtNationality" class="form-select" aria-label="Default select example">
                                      <option selected value="0">สัญชาติ</option>
                                      <?php while ($rownation = $nation->fetch_assoc()): ?>
                                        <option value="<?php echo $rownation['nation_id']; ?>">
                                          <?php echo htmlspecialchars($rownation['nation_name']); ?>
                                        </option>
                                      <?php endwhile; ?>
                                    </select>
                                  </div>
                                  <div class="col-md-3 mb-2">
                                    <label for="basic-url" class="form-label">ศาสนา</label> <label class="text-danger"> *</label>
                                    <?php
                                    $reg = $conn->query("SELECT * FROM reg");

                                    if (!$reg) {
                                      die("Query failed: " . $conn->error);
                                    }
                                    ?>

                                    <select name="txtReligion" class="form-select" aria-label="Default select example">
                                      <option selected value="0">ศาสนา</option>
                                      <?php while ($rowreg = $reg->fetch_assoc()): ?>
                                        <option value="<?php echo $rowreg['reg_id']; ?>">
                                          <?php echo htmlspecialchars($rowreg['reg_name']); ?>
                                        </option>
                                      <?php endwhile; ?>
                                    </select>

                                  </div>

                                  <div class="col-md-12 mb-2">
                                    <label for="basic-url" class="form-label">อิเมลล์</label> 
                                    <div class="input-group mb-2">
                                      <input name="txtEmail" type="email"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>

                                  <div class="col-md-6 mb-0">
                                    <div class="col-md-12 mb-2">
                                      <label for="basic-url" class="form-label">อาชีพ</label>
                                      <div class="input-group mb-2">
                                        <input name="txtOccupation" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6 mb-2">
                                    <label for="basic-url" class="form-label">วุฒิการศึกษา</label>
                                    <?php
                                    $edu = $conn->query("SELECT * FROM edu");

                                    if (!$edu) {
                                      die("Query failed: " . $conn->error);
                                    }
                                    ?>

                                    <select name="txtEducation" class="form-select" aria-label="Default select example">
                                      <option selected value="0">วุฒิการศึกษา</option>
                                      <?php while ($rowedu = $edu->fetch_assoc()): ?>
                                        <option value="<?php echo $rowedu['edu_id']; ?>">
                                          <?php echo htmlspecialchars($rowedu['edu_name']); ?>
                                        </option>
                                      <?php endwhile; ?>
                                    </select>
                                  </div>

                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">ชื่อ (คู่สมรส)</label>
                                    <div class="input-group mb-2">
                                      <input name="txtName2" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">นามสกุล (คู่สมรส)</label>
                                    <div class="input-group mb-2">
                                      <input name="txtLname2" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>

                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">ชื่อบิดา (ผู้ป่วย)</label>
                                    <div class="input-group mb-2">
                                      <input name="txtNameDad" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">นามสกุลบิดา (ผู้ป่วย)</label>
                                    <div class="input-group mb-2">
                                      <input name="txtLnameDad" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>

                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">ชื่อมารดา (ผู้ป่วย)</label>
                                    <div class="input-group mb-2">
                                      <input name="txtNameMom" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">นามสกุลมารดา (ผู้ป่วย)</label>
                                    <div class="input-group mb-2">
                                      <input name="txtLnameMom" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">ชื่อ ผู้ที่ติดต่อได้</label>
                                    <div class="input-group mb-2">
                                      <input name="txtName3" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-6 mb-0">
                                    <label for="basic-url" class="form-label">นามสกุล ผู้ที่ติดต่อได้</label>
                                    <div class="input-group mb-2">
                                      <input name="txtLname3" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
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
                                      <input name="txtNo" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">หมู่</label>
                                    <div class="input-group mb-2">
                                      <input name="txtMo" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">ตรอก/ซอย</label>
                                    <div class="input-group mb-2">
                                      <input name="txtAlley" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">แขวง/ตำบล</label>
                                    <div class="input-group mb-2">
                                      <input name="txtSubDistrict" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">เขต/อำเภอ</label>
                                    <div class="input-group mb-2">
                                      <input name="txtDistrict" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">จังหวัด</label>
                                    <div class="input-group mb-2">
                                      <input name="txtProvince" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">รหัสไปรณีย์</label>
                                    <div class="input-group mb-2">
                                      <input name="txtPostCode" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>
                                  <div class="col-md-3 mb-0">
                                    <label for="basic-url" class="form-label">หมายเลขโทรศัพท์</label>
                                    <div class="input-group mb-2">
                                      <input name="txtTel" type="text"  class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                    </div>
                                  </div>

                                  <div class="col-md-12  mb-2 mt-5">

                                    <!-- <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="index2.php;" value="กลับสู่หน้าหลัก" style="margin-top:-50px"> -->
                                    <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="window.location.href='index2.php';" value="กลับสู่หน้าหลัก" style="margin-top:-50px">

                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-success btn-block mb-0" style="margin-top:-50px;">
                                      ตรวจสอบข้อมูล
                                    </button>
                                    <br>
                                  </div>

                                </div>

                                <!-- <label for="">CID</label>
                                    <input class="form-control" id="disabledInput" type="text" value="<?php echo $cid; ?>" disabled>
                                    -->
                              </form>


                            <?php


                          } else { ?>
                              <div style="font-family: kanit;" class="text-center">
                                <div class="fw-normal h5"><?php echo "สวัสดีคุณ "; ?></div>
                                <div class="fw-normal h3 text-success"><?php echo $pname . $fname . " " . $lname; ?></div>
                                <div class="fw-normal"><?php echo "HN ของคุณคือ"; ?></div>
                                <div class="text-primary" style="font-size : 60px;"><?php echo $hn; ?></div>
                                <div class="fw-normal"><?php echo "โรงพยาบาลเจ้าพระยาอภัยภูเบศร ขอบคุณที่ใช้บริการ"; ?></div>
                                <div class="mt-5" style="margin-bottom:-30px;"> <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="history.back();" value="กลับสู่หน้าหลัก" style="margin-top:-50px"></div>
                              </div>

                            <?php } ?>

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