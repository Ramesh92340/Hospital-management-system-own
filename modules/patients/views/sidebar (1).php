<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Management System</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

  <style>
    /* General Styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
    }

    /* Navbar */


    .navbar .nav-links {
      display: flex;
      gap: 15px;
    }

 

    .navbar .nav-links a:hover {
      background-color: #007bff;
    }

    .navbar .search-bar {
      display: flex;
      align-items: center;
      background-color: #fff;
      border-radius: 5px;
      padding: 5px 10px;
    }

    .navbar .search-bar input {
      border: none;
      outline: none;
      flex: 1;
      padding: 5px;
      font-size: 16px;
    }

    .navbar .search-bar button {
      background: none;
      border: none;
      cursor: pointer;
      color: #007bff;
      font-size: 18px;
    }

    .navbar .search-bar button:hover {
      color: #0056b3;
    }

    /* Main Content */


    .hospital_heading {
      text-align: center;
      font-weight: 900;
    }

    /* Icon Sidebar */
    .icon-sidebar {
      position: fixed !important;
      width: 80px;
      background-color: #4b4949;
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 10px 0;
      /* height: 100vh; */
      position: sticky;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      /* position: fixed !important; */
    }

    .icon-sidebar .icon {
      margin: 20px 0;
      font-size: 20px;
      cursor: pointer;
    }

    .icon-sidebar .icon:hover {
      color: #007bff;
    }

    .service {
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      transition: background-color 0.3s ease;

    }

    /* .services-sidebar .service:hover {
      background-color: #007bff;
      color: white;
    } */






    /* Services Sidebar */
    .services-sidebar {
      width: 250px;
      background-color: #f4f5f9;
      border-right: 1px solid #ddd;
      display: none;
      flex-direction: column;
      padding: 10px;
      /* position: sticky; */
      position: fixed !important;
      position: absolute;
      top: 0;
      height: 100vh;
      overflow-y: auto;
      /* top: 0px;
      overflow-y: auto; */
    }

    .services-sidebar.active {
      display: flex;
    }

    li a {
      text-decoration: none;
      color: black;
    }

    li {
      list-style: none;
    }

    .services-sidebar .service {
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      /* transition: background-color 0.3s ease; */
      color
    }

    .services-sidebar .service:hover {
      background-color: black;
      color: white;
    }

    /* Dropdown Sub-services */
    .dropdown-content {
      display: none;
      margin-left: 20px;
      padding-left: 10px;
      animation: fadeIn 0.5s ease-in-out;
    }

    .dropdown-content a {
      text-decoration: none;
      color: black;
      padding: 5px 0;
      display: block;
      transition: color 0.3s ease;
    }

    .dropdown-content a:hover {
      color: grey;
    }

    /* Fade-in Animation */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

 


    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: transparent;
      color: white;
      padding: 10px 20px;
      position: fixed !important;
      top: 0;
      z-index: 1000;
      width: 100%;
    }




 

    .main-content {
      display: flex;
      flex: 1;
      overflow-y: auto;
      height: 100vh;
    }




    .navbar .nav-links a {
      text-decoration: none;
      color: rgb(17, 16, 16);
      padding: 5px 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .rotate-arrow {
      transform: rotate(90deg);
      transition: transform 0.3s ease;
    }

    .dynamicContent {
      position: sticky !important;
      margin-left: 80px;
      padding: 20px;
    }


    /* Icon Sidebar */



  
  </style>
</head>

<body>

  <!-- Icon Sidebar -->
  <div class="icon-sidebar">
    <img src="https://via.placeholder.com/50" alt="Logo">
    <div class="icon" data-target="dashboard"> <i class="fa-solid fa-house"></i></div>
    <div class="icon" data-target="patients"><i class="fa-solid fa-users"></i></div>
    <div class="icon" data-target="staff"><i class="fa-solid fa-user-doctor"></i></div>
    <div class="icon" data-target="reports"><i class="fa-solid fa-file-alt"></i></div>
    <div class="icon" data-target="logout"><i class="fa-solid fa-power-off"></i></div>
  </div>

  <!-- Main Content -->
  <div class=" dynamicContent">



    <div class="services-sidebar active" id="patients">
      <p class="hospital_heading">Hospital Management</p>
      </li>
      <div class="service">
        <li class="menu-item menu_tag ">
          <a class="menu-link collapsed link_tag dropdown-item " href="/Hospital-management-system-own/public/index.php">
            <p class="menu-content">

              <i class="fa-solid fa-house"></i>
              Dashboard

            </p>
          </a>
        </li>
      </div>
      <div class="service"><a class="dropdown-item   " href="#">appointment</a></div>

      <div class="service menu-item dropdown menu_tag" data-toggle="patientsDropdown">
        <i class="fa-solid fa-user-injured  menu-link dropdown-toggle link_tag "></i> Patients <i class="fa-solid fa-chevron-right"></i>
      </div>
      <div>

        <ul class="dropdown-content" id="patientsDropdown">
          <li>
            <a class="dropdown-item   " href="/Hospital-management-system-own/modules/patients/views/add_patients.php"><i class="fa-solid fa-plus"></i> Add Patient</a>
          </li>


          <li>
            <a class="dropdown-item  " href="/Hospital-management-system-own/modules/patients/views/causality.php"><i class="fa-solid fa-eye"></i> View causality</a>
          </li>

          <li>
            <a class="dropdown-item  " href="/Hospital-management-system-own/modules/patients/views/opd.php"><i class="fa-solid fa-eye"></i> View OPD</a>
          </li>
          <li>
            <a class="dropdown-item  " href="/Hospital-management-system-own/modules/patients/views/ipd.php"><i class="fa-solid fa-eye"></i> View IPD</a>
          </li>
        </ul>
      </div>


      <div class="service service menu-item dropdown menu_tag" data-toggle="DoctorSubBranch">
        <i class="fa-solid fa-user-shield"></i>Doctor / Nurse<i class="fa-solid fa-chevron-right"></i>
      </div>
      <!-- <div class="dropdown-content" > -->
      <ul class="dropdown-content" id="DoctorSubBranch">
        <li>
          <a class="dropdown-item   " href="/Hospital-management-system-own/modules/staff/views/add_doctors.php">Add Doctor</a>
        </li>
        <li>
          <a class="dropdown-item  " href="/Hospital-management-system-own/modules/staff/views/add_nurses.php">Add Nurse</a>
        </li>
        <li>
          <a class="dropdown-item  " href="/Hospital-management-system-own/modules/staff/views/add_other_staff.php">Other Staff</a>
        </li>
      </ul>

      <div class="service" data-toggle="patientsRecords">
        <i class="fa-solid fa-folder"></i> Finance<i class="fa-solid fa-chevron-right"></i>
      </div>
      <div class="dropdown-content" id="patientsRecords">


        <li>
          <a class="dropdown-item   " href="#">income</a>
        </li>
        <li>
          <a class="dropdown-item  " href="#">Expensive</a>
        </li>
        <li>
          <a class="dropdown-item  " href="#">Invoice list</a>
        </li>
        <li>
          <a class="dropdown-item  " href="#">Invoice details </a>
        </li>


      </div>

      <li class="menu-item menu_tag service">
        <a class="menu-link collapsed link_tag" href="/Hospital-management-system-own/modules/patients/views/add_patients.php">
          <p class="menu-content">
            <i class="fa-solid fa-users"></i>
            Add Patients
          </p>
        </a>
      </li>


      <li class="menu-item menu_tag service">
        <a class="menu-link collapsed link_tag" href="/Hospital-management-system-own/modules/patients/views/see_patients.php">
          <p class="menu-content">
            <i class="fa-solid fa-users"></i>
            View Patients
          </p>
        </a>
      </li>



      <li class="menu-item menu_tag service">
        <a class="menu-link collapsed link_tag" href="/Hospital-management-system-own/modules/staff/views/add_staff.php">
          <p class="menu-content">
            <i class="fa-solid fa-user-doctor"></i>
            Add Staff
          </p>
        </a>
      </li>


      <li class="menu-item menu_tag service">
        <a class="menu-link collapsed link_tag" href="/Hospital-management-system-own/modules/staff/views/see_staff.php">
          <p class="menu-content">
            <i class="fa-solid fa-user-doctor"></i>
            See Staff
          </p>
        </a>
      </li>




      <li class="menu-item menu_tag service">
        <a class="menu-link collapsed link_tag" href="logout.php">
          <p class="menu-content">
            <i class="fa-solid fa-power-off"></i>
            Logout
          </p>
        </a>
      </li>



    </div>
 


  </div>
  </div>
  <div class="services-sidebar" id="staff">


<p class="hospital_heading">Pharmacy</p>
<!-- <li><a href="#">mani</a></li> -->
<div class="service">dashboard</div>
<div class="service" data-toggle="staffDropdown">
  custmor <i class="fa-solid fa-chevron-right"></i>
</div>
<div class="dropdown-content" id="staffDropdown">

  <a href="#">Add custmor</a>
  <a href="#">custmor list</a>
  <a href="#">custmor ledger </a>
  <div class="service" data-toggle="patientsSubBranch">
    <i class="fa-solid fa-user-shield"></i>medicine<i class="fa-solid fa-chevron-right"></i>
  </div>
  <div class="dropdown-content" id="patientsSubBranch">
    <a href="#"></i> Add medicine</a>
    <a href="#"></i> medicine list </a>
    <a href="#"></i> medicine details</a>
  </div>
  <div class="service" data-toggle="patientsRecords">
    <i class="fa-solid fa-folder"></i> manufacturer<i class="fa-solid fa-chevron-right"></i>
  </div>
  <div class="dropdown-content" id="patientsRecords">
    <a href="#"></i> manufacturer</a>
    <a href="#"></i> manufacturer list</a>

  </div>
  <div class="service" data-toggle="reportRecords">
    <i class="fa-solid fa-folder"></i> return<i class="fa-solid fa-chevron-right"></i>
  </div>
  <div class="dropdown-content" id="reportRecords">
    <a href="#">Add Wastage Return </a>
    <i href="#"></i> Wastage Return List</a>
    <i href="#"> </i>Add manufacture Return </a>

  </div>
</div>
</div>

<div class="services-sidebar" id="reports">
<p class="hospital_heading">Reports Section</p>
<div class="service" data-toggle="reportsDropdown">
  Reports <i class="fa-solid fa-chevron-right"></i>
</div>
<div class="dropdown-content" id="reportsDropdown">
  <a href="#">Generate Report</a>
  <a href="#">View Reports</a>
</div>
</div>


  </div>




  <script>
    $(document).ready(function() {
      // Sidebar Service Click Handler
      $('.service').on('click', function() {
        const target = $(this).data('toggle');

        if ($(`#${target}`).is(':visible')) {
          // If the clicked dropdown is already open, close it
          $(`#${target}`).slideUp();
        } else {
          // Close all other dropdowns
          $('.dropdown-content').slideUp();
          // Open the selected dropdown
          $(`#${target}`).slideDown();
        }
      });

      // Sidebar Icon Click Handler
      $('.icon').on('click', function() {
        const target = $(this).data('target');
        $('.services-sidebar').removeClass('active'); // Hide all sidebars
        $(`#${target}`).addClass('active'); // Show the clicked sidebar
      });

      // Load content dynamically for links
      $('#addPatientLink').on('click', function(e) {
        e.preventDefault(); // Prevent default navigation
        $('#dynamicContent').load('/Hospital-management-system-own/modules/patients/views/add_patients.php');
      });

      // Focus input when the search button is clicked
      $('#searchButton').on('click', function() {
        $('#searchInput').focus();
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.nav-link').on('click', function() {
        $('.nav-item').removeClass('active'); // Remove active class from all nav items
        $(this).parent().addClass('active'); // Add active class to the clicked nav item
      });
    });
  </script>



</body>

</html>