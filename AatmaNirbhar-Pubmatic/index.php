<!DOCTYPE html>
<html lang="en">
<?php
  include("backend/connection.php");
?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pubmatic Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="index.html"><img
          src="https://www.realwire.com/writeitfiles/PubMaticlogo.jpg" alt="logo"
          style="width:150px;height:100px;" /></a>
      <a class="navbar-brand brand-logo-mini" href="index.php"><img
          src="https://www.realwire.com/writeitfiles/PubMaticlogo.jpg" alt="logo" /></a>
    </div>
    <header class="header-page">
      <div class="nav-header-text">
        <h1>
          <p class="mb-1 text-black">AatmaNirbhar Pubmatic</p>
        </h1>
      </div>
    </header>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item" id="sidebar-user">
          <a href="#" class="nav-link">
            <div class="nav-link">
              <span class="menu-title">User</span>
            </div>
          </a>
        </li>
        <li class="nav-item" id="sidebar-dashboard">
          <a class="nav-link" href="index.php" onclick="openDashboard()">
            <span class="menu-title">Dashboard</span>
            <i class="mdi mdi-home menu-icon"></i>
          </a>
        </li>
        <li class="nav-item" id="sidebar-devices">
          <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <span class="menu-title">Devices</span>
            <i class="menu-arrow"></i>
            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item" id="sidebar-devices-android"> <a class="nav-link"
                  onclick="openAndroidDevices()">Andriod </a>
              </li>
              <li class="nav-item" id="sidebar-devices-ios"> <a class="nav-link" onclick="openiOSDevices()">iOS</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item" id="sidebar-mobile-apps">
          <a class="nav-link" onclick="openmobileApps()">
            <span class="menu-title">Mobile Apps</span>
          </a>
        </li>
        <li class="nav-item" id="sidebar-test-results">
          <a class="nav-link" onclick="testresults()">
            <span class="menu-title">Test Results</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div id="dashboard" style="display:block" class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
              <i class="mdi mdi-home"></i>
            </span> Dashboard
          </h3>
          <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
            </ul>
          </nav>
        </div>
      </div>
      <div id="mobile-android" style="display:none" class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> Andriod Devices </h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page">iOS</a></li>
              <li class="breadcrumb-item"><a href="#">Andriod</a></li>
            </ol>
          </nav>
        </div>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" id="androidInput"
                  onkeyup="searchAndroidDevices()" placeholder="Type to Search">
                <input type="radio" id="DeviceName" name="Filter" checked="checked" value="DeviceName">
                <label for="DeviceName">Device Name</label><br>
                <input type="radio" id="OS" name="Filter" value="OS"><br>
                <label for="OS">OS Version</label><br>
              </div>
            </form>
        </div>


<!-- Filters Start-->

        <!--filters ends here -->
     <div class ="breadcrumb">
          </div>
      <div class="row">
          <!--<div class="col-md-7 grid-margin stretch-card">-->
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Devices Available</h4>
                <div class="table-responsive">
                  <table class="table" id="androidTable">
                    <thead>
                      <tr>
                        <th> Device ID </th>
                        <th> Device Name </th>
                        <th> OS Version </th>
                        <th> Status </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                        $fetchData=fetch_devices("android");
                        if(is_array($fetchData)){
                        $sn=1;
                        foreach($fetchData as $data){
                      ?>
                        <tr>
                        <td><?php echo $data['device_id']??''; ?></td>
                        <td><?php echo $data['device_name']??''; ?></td>
                        <td><?php echo $data['device_os_version']??''; ?></td>
                        <?php
                            if($data['device_busy'] == 0){
                        ?>
                        <td><FONT COLOR="#418802">Available</FONT></td>
                        <?php
                         }
                        elseif($data['device_busy'] == 1){
                        ?>
                        <td><FONT COLOR="#ff0000">Busy</FONT></td>
                        <?php
                         }
                        else {
                        ?>
                        <td>""</td>
                        <?php
                         }
                        ?>
                       </tr>
                       <?php
                        $sn++;}}else{ ?>
                        <tr>
                          <td colspan="8">
                      <?php echo $fetchData; ?>
                    </td>
                      <tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!--
          </div> -->
          <!-- partial -->
        </div>
        <!-- mobile-android main-panel ends -->
      </div>
      <div id="mobile-ios" style="display:none" class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> iOS Devices </h3>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">iOS</a></li>
              <li class="breadcrumb-item active" aria-current="page">Andriod</li>
            </ol>
          </nav>
        </div>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Type to Search"
                  id="iOSInput" onkeyup="searchiOSDevices()">
                <input type="radio" id="iOSDeviceName" name="Filter" checked="checked" value="iOSDeviceName">
                <label for="DeviceName">Device Name</label><br>
                <input type="radio" id="iOS" name="Filter" value="iOS"><br>
                <label for="OS">OS Version</label><br>
              </div>
            </form>
          </div>
          <div class="breadcrumb">
          </div>

          <div class="row">
            <!--
          <div class="col-md-7 grid-margin stretch-card"> -->
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Devices Available</h4>
                <div class="table-responsive">
                  <table class="table" id="iOSTable">
                    <thead>
                      <tr>
                        <th>Device ID </th>
                        <th> Device Name </th>
                        <th> OS Version </th>
                        <th> Status </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                            $fetchData=fetch_devices("ios");
                            if(is_array($fetchData)){
                            $sn=1;
                            foreach($fetchData as $data){
                          ?>
                            <tr>
                            <td><?php echo $data['device_id']??''; ?></td>
                            <td><?php echo $data['device_name']??''; ?></td>
                            <td><?php echo $data['device_os_version']??''; ?></td>
                            <?php
                                if($data['device_busy'] == 0){
                            ?>
                            <center>
                            <td><label class="badge badge-gradient-success">Available</label></td>
                            </center>
                            <?php
                             }
                            elseif($data['device_busy'] == 1){
                            ?>
                            <td><label class="badge badge-gradient-warning">Busy</label></td>
                            <?php
                             }
                            else {
                            ?>
                            <td>""</td>
                            <?php
                             }
                            ?>
                           </tr>
                           <?php
                            $sn++;}}else{ ?>
                            <tr>
                              <td colspan="8">
                          <?php echo $fetchData; ?>
                        </td>
                          <tr>
                          <?php
                          }
                          ?>

                    <!--
                      <tr>
                        <td> 1 </td>
                        <td> Iphone X </td>
                        <td> iOS 15.5 </td>
                        <td> <label class="badge badge-gradient-warning">Busy </label></td>

                        </td>
                      </tr>
                      <tr>
                        <td> 2 </td>
                        <td> Iphone 11 Pro </td>
                        <td> iOS 15.5</td>
                        <td> <label class="badge badge-gradient-success">Available</label> </td>

                        </td>
                      </tr>
                      <tr>
                        <td> 3 </td>
                        <td> Iphone 6S </td>
                        <td> iOS 15 </td>
                        <td> <label class="badge badge-gradient-success">Available</label></td>

                        </td>
                      </tr>
                      <tr>
                        <td> 4 </td>
                        <td> Iphone 12 </td>
                        <td> iOS 15 </td>
                        <td> <label class="badge badge-gradient-warning">Busy</label></td>

                        </td>
                      </tr>
                      <tr>
                        <td> 5 </td>
                        <td> Iphone 11 </td>
                        <td> iOS 15 </td>
                        <td> <label class="badge badge-gradient-danger">Not Available</label></td>

                        </td>
                      </tr>

-->

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <!--
          </div> -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>

    <!-- Mobile Apps Start -->

        <div id="mobile-apps" style="display:none" class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Mobile Apps </h3>
          </div>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" id="myInput"
                  placeholder="Type to Search" onkeyup="searchFun">
              </div>
              <div class="breadcrumb">
                <button class="btn btn-block btn-lg btn-gradient-primary"
                  onclick="openuploadappdialog()">UploadApp</button>
              </div>
            </form>
        </div>
        <!-- <div class="breadcrumb">
          <button class="btn btn-block btn-lg btn-gradient-primary mt-4">Upload App</button>
         
          <span style="display:flex; justify-content:flex-end; width:100%; padding:0;">
              <button class="btn btn-block btn-lg btn-gradient-primary mt-4">Upload App</button>
          </span>

        </div>-->


       <div id="upload-build" style="display:none" class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Upload App </h3>
            </div>
            <!-- <form id="upload_form" enctype="multipart/form-data" method="post">
              <input type="file" name="file1" id="file1" onchange="uploadFile()">
              <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
              <h3 id="status"></h3>
              <p id="loaded_n_total"></p>
            </form> -->

            <input type="file" class="fileToUpload form-control"></input><br>
            <input type="text" placeholder="File name" id="filename" class="form-control" /><br>
            <button class="btn btn-success" onclick="uploadFile()">Upload</button>

            <!-- mobile-android main-panel ends -->
          </div>
       <div class="row">
          <!--<div class="col-md-7 grid-margin stretch-card">-->
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Mobile Apps Available</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> Device ID </th>
                        <th> Device Name </th>
                        <th> Platform </th>
                        <th> App ID </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> 1 </td>
                        <td> OpenWrap Unity Plugin</td>
                        <td> Andriod </td>
                        <td> </td>

                        </td>
                      </tr>
                      <tr>
                        <td> 2 </td>
                        <td> AdaptiveBannerExample </td>
                        <td> iOS </td>
                        <td> </td>

                        </td>
                      </tr>
                      <tr>
                        <td> 3 </td>
                        <td> AdMob Adaptive Banner Example </td>
                        <td> Abdriod </td>
                        <td> </td>

                        </td>
                      </tr>
                      <tr>
                        <td> 4 </td>
                        <td> OpenWrapSample </td>
                        <td> iOS </td>
                        <td> </td>

                        </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <!--
          </div> -->
          <!-- partial -->
        </div>

      </div>
      <!-- mobile-android main-panel ends -->

      <!-- Test Results starts here-->
      <div id="test-results" style="display:none" class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> Test Results </h3>

        </div>

       <div class="row">
          <!--<div class="col-md-7 grid-margin stretch-card">-->
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Test Results</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th> Status </th>
                        <th> Test Case name</th>
                        <th> Device Name </th>
                        <th> OS Version </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> Pass </td>

                        <td><a href="#test-results-testcase1" class="nav-link" onclick="opentestresultstc1()"> TC_01_Test App working</a></td>
                        <td> Samsung Galaxy </td>
                        <td> Andriod 10 </td>

                      </tr>
                      <tr>
                        <td> Pass </td>
                        <td> TC_01_Test App working</td>
                        <td> Samsung Galaxy </td>
                        <td> Andriod 10 </td>

                        </td>
                      </tr>
                      <tr>
                        <td> Pass </td>
                        <td> TC_01_Test App working</td>
                        <td> Samsung Galaxy </td>
                        <td> Andriod 10 </td>
                      </tr>
                      <tr>
                        <td> Pass </td>
                        <td> TC_01_Test App working</td>
                        <td> Samsung Galaxy </td>
                        <td> Andriod 10 </td>
                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <!--
          </div> -->
          <!-- partial -->
        </div>

      </div>
     <!-- Test Results ends here-->


      <!-- Test case 1 : test results starts here -->
      <div id="test-results-testcase1" style="display:none" class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> Test Results for TC_01_Test App working</h3>
           <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a href="#test-results" class="nav-link" onclick="testresults()">Test Results</a></li>
            </ol>
          </nav>

       </div>


        <div class="row">
              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="clearfix">
                      <h4 class="card-title float-left">Video</h4>
                      <!--
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div> -->
                      <center>
                      <video width="600"  controls>
                        <source src="http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4" type="video/mp4">
                                Your browser does not support HTML video.
                      </video>
                      </center>



                    </div>
                    <!--<canvas id="visit-sale-chart" class="mt-4"></canvas>-->
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Logs</h4>
                    <canvas id="traffic-chart"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>
                  </div>
                </div>
              </div>
        </div>
        <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">CPU Utilisation</h4>
                    </div>
                  </div>
                </div>
          </div>

        <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Memory graph</h4>
                    <div class="d-flex">
                      <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                         </div>

                      </div>
                    </div>
                  </div>
                </div>
          </div>




      </div>
 <!-- Test case 1 : test results ends here -->





    </div>
  </div>
  </div>
  </div>


  <!-- partial -->
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/todolist.js"></script>

  <script type="text/javascript">
    function openAndroidDevices() {
      document.getElementById("dashboard").style.display = "none";
      document.getElementById("mobile-ios").style.display = "none";
      document.getElementById("mobile-android").style.display = "inline";
      document.getElementById("mobile-apps").style.display = "none";
      document.getElementById("test-results").style.display = "none";
      document.getElementById("test-results-testcase1").style.display = "none";
    }

    function openDashboard() {
      document.getElementById("dashboard").style.display = "inline";
      document.getElementById("mobile-ios").style.display = "none";
      document.getElementById("mobile-android").style.display = "none";
      document.getElementById("mobile-apps").style.display = "none";
      document.getElementById("test-results").style.display = "none";
      document.getElementById("test-results-testcase1").style.display = "none";
    }

    function openiOSDevices() {
      document.getElementById("dashboard").style.display = "none";
      document.getElementById("mobile-ios").style.display = "inline";
      document.getElementById("mobile-android").style.display = "none";
      document.getElementById("mobile-apps").style.display = "none";
      document.getElementById("test-results").style.display = "none";
      document.getElementById("test-results-testcase1").style.display = "none";
    }

    function openmobileApps() {
      document.getElementById("dashboard").style.display = "none";
      document.getElementById("mobile-ios").style.display = "none";
      document.getElementById("mobile-android").style.display = "none";
      document.getElementById("mobile-apps").style.display = "inline";
      document.getElementById("test-results").style.display = "none";
      document.getElementById("test-results-testcase1").style.display = "none";
    }

    function openuploadappdialog() {
      document.getElementById("upload-build").style.display = "inline";
    }

    function testresults() {
      document.getElementById("dashboard").style.display = "none";
      document.getElementById("mobile-ios").style.display = "none";
      document.getElementById("mobile-android").style.display = "none";
      document.getElementById("mobile-apps").style.display = "none";
      document.getElementById("test-results").style.display = "inline";
      document.getElementById("test-results-testcase1").style.display = "none";
    }

    function opentestresultstc1() {
      document.getElementById("dashboard").style.display = "none";
      document.getElementById("mobile-ios").style.display = "none";
      document.getElementById("mobile-android").style.display = "none";
      document.getElementById("mobile-apps").style.display = "none";
      document.getElementById("test-results").style.display = "none";
      document.getElementById("test-results-testcase1").style.display = "inline";
      }

    function searchAndroidDevices() {
      var input, filter, table, tr, td, i, txtValue, radio = 1;
      if (document.getElementById('DeviceName').checked) {
        radio = 1
      } else if (document.getElementById('OS').checked) {
        radio = 2
      }


      input = document.getElementById("androidInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("androidTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[radio];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }


    function searchiOSDevices() {
      var input, filter, table, tr, td, i, txtValue, radio = 1;
      if (document.getElementById('iOSDeviceName').checked) {
        radio = 1
      } else if (document.getElementById('iOS').checked) {
        radio = 2
      };
      input = document.getElementById("iOSInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("iOSTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[radio];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }

    // function uploadFile() {
    //   var file = _("file1").files[0];
    //   // alert(file.name+" | "+file.size+" | "+file.type);
    //   var formdata = new FormData();
    //   formdata.append("file1", file);
    //   var ajax = new XMLHttpRequest();
    //   ajax.upload.addEventListener("progress", progressHandler, false);
    //   ajax.addEventListener("load", completeHandler, false);
    //   ajax.addEventListener("error", errorHandler, false);
    //   ajax.addEventListener("abort", abortHandler, false);
    //   ajax.open("POST", "file_upload_parser.php");
    //   ajax.send(formdata);
    // }

    function uploadFile() {
      var filename = $('#filename').val();                    //To save file with this name
      var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
      var form_data = new FormData();
      form_data.append("file", file_data);
      form_data.append("filename", filename);
      //Ajax to send file to upload
      $.ajax({
        url: "load.php",                      //Server api to receive the file
        type: "POST",
        dataType: 'script',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (dat2) {
          if (dat2 == 1) alert("Successful");
          else alert("Unable to Upload");
        }
      });
    }

    function progressHandler(event) {
      _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
      var percent = (event.loaded / event.total) * 100;
      _("progressBar").value = Math.round(percent);
      _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
    }

    function completeHandler(event) {
      _("status").innerHTML = event.target.responseText;
      _("progressBar").value = 0; //wil clear progress bar after successful upload
    }

    function errorHandler(event) {
      _("status").innerHTML = "Upload Failed";
    }

    function abortHandler(event) {
      _("status").innerHTML = "Upload Aborted";
    }


  </script>


  <!-- End custom js for this page -->
</body>

</html>