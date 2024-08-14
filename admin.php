<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <?php include("connect.php"); ?>
   <!-- Auto Refresh -->
   <!-- <meta http-equiv="refresh" content="1" >  -->

    <title>HN Online</title>
</head>
<body style="background-color:#009579;">

<section class="1background-radial-gradient overflow-hidden" >

  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5" sty>
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-12 mb-0 mb-lg-0" style="z-index: 10; text-align:center">
        <img src="img/ABH-LOGO-WHITE.png" alt="" style="width:20%; margin-top:-80px; margin-bottom:-30px;">


      </div>

      <!-- box center -->
      <div class="col-lg-3 mb-5 mb-lg-0 position-relative">
    
      </div>

      




      <div class="col-lg-12 mb-5 mb-lg-0 position-relative" >
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong "></div>

        <div class="card bg-glass"  >
          <div class="card-body px-4 py-5 px-md-4 bg-white" style="widtah:900px;">


          <?php

        
          echo $_SESSION['admin'];
          IF($_SESSION['admin'] = '0')
          { 
            echo "user";
             ?><div class="text-center text-danger h4 fw-normal" style="font-family:kanit"><?php echo "รหัสผ่านไม่ถูกต้อง"; ?></div>
            <div class="mt-2 text-center">
              <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block mt-2" onclick="history.back();" value="กลับสู่หน้าหลัก" style="margin-top:-50px">
            </div><?php 
            header('Location: check_admin.php'); }
          else 
          { 

            echo "admin";
            $sql = "SELECT * FROM patient";
            $result = $conn->query($sql);
            $numrow = $result->num_rows;
            
            $i = 1;


            $sqlwait = "SELECT * FROM patient WHERE txtHN = 0";
            $resultwait = $conn->query($sqlwait);
            $numwait = $resultwait->num_rows;
            ?>

            <div class="d-grid ">
              <div class="d-grid gap-2 d-md-flex" style="font-family:kanit">
                  <p class="col-10 h4 justify-content-md-start"><?php  echo "พบข้อมูลทั้งหมด ".$numrow." รายการ"; ?></p>

                  <button class="col-1 btn btn-success justify-content-md-end"><?php  echo $numrow-$numwait; ?></button>
                  <button class="col-1 btn btn-warning justify-content-md-end"><?php  echo $numwait; ?></button>
              </div>
            </div>

            <?php
           

            ?>
            <table class="table table-striped table-hover mt-4" >
                  <thead>
                  <tr class="text-center">
                      <th>#</th>
                      <th>HN</th>
                      <th>Confirm</th>
                      <th>ชื่อ</th>
                      <th>CID</th>
                      <th>Manage</th>
             


                  </tr>
              </thead>
              <?php   
              while($row = $result->fetch_assoc()) 
              { ?>
              <tbody>
                  <tr>
                      <td class="text-center">
                        <?php echo $i; ?>
                      </td>
                      <td class="text-center col-1 ">
                            <?php 
                            $hn = $row['txtHN']; 
                            
                            if($hn == 0){
                              ?><button class="btn btn-warning">รออนุมัติ</button><?php
                            }
                            else { 
                              ?><button class="btn btn-block  btn-success"><?php echo $row['txtHN']; ?></button><?php
                            }  $i++;
                            ?>
                      </td>
                      <td class="col-1 text-center"><link href="/your-path-to-uicons/css/uicons-[your-style].css" rel="stylesheet"> <!--load all styles -->
                          <?php 
                              $cf =  $row['txtConfirm']; 
                              if($cf = 1) {
                                ?><i class="fas fa-check"></i><?php
                              } else {
                                
                              }
                            ?>
                      </td>
                      <td>
                        <a href="#" class="text-decoration-none text-dark">
                          <?php echo $row['txtPrename'].$row['txtName']." ".$row['txtLname']; ?>     
                        </a>  
                      </td>
                      <td class="text-center">
                        <?php echo $row['txtCid']; ?>
                      </td>
                      <td class="col-2 text-center">
                        <?php  ?>
                        <a href="view.data.php?id=<?php echo $row['txtCid']; ?>">
                          <div class="btn btn-primary"><i class="fa fa-edit"></i> แก้ไข</div>
                        </a>   
                          
                        <a href="delete.data.php?id=<?php echo $row['txtCid']; ?>">
                          <div class="btn btn-danger"><i class="fa fa-trash"></i> ลบ</div>
                        </a>   
                      </td>
                      
                    </tr>
                    
                  </tbody>
                  
                  <?php } ?>
                </table>
                <center>
                  <!-- <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block mt-3" onclick="history.back();" value="กลับสู่หน้าหลัก" style="margin-top:-50px"> -->
                  <div class="mt-5" style="margin-bottom:-30px;"> <input type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block" onclick="location.href='index.php'" value="ออกจากระบบ" style="margin-top:-50px">

          </center>
          <?php
          }
          ?>




           

                </div>
              </div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section: Design Block -->




</body>
</html>





