<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <link rel="stylesheet" href="style.css">
    <link  href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
</head>
<body>
<header class="p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="index.php" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none ">
          <img src="./img/computer.png" style="width:100px;height:100px;"></svg>
        </a>
         <br>
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white bi bi-house"> หน้าแรก</a></li><br>
          <li><a href="repairman.php" class="nav-link px-2 text-white bi bi-person-plus-fill"> พนักงาน</a></li>
          <li><a href="repairperson.php" class="nav-link px-2 text-white bi bi-card-list"> รายการยืม</a></li>
          <li><a href="repairstatus.php" class="nav-link px-2 text-white bi bi-card-checklist"> รายการคืน</a></li>
          <li><a href="repairworkschedule.php" class="nav-link px-2 text-white bi bi-calendar2-check"> ตารางงานการยืม-คืน</a></li>
          <li><a href="repairinventory.php" class="nav-link px-2 text-white bi bi-gear-fill"> อุปกรณ์</a></li>
        </ul>

        <div class="text-end">
          <a href="signin.php" class="btn btn-success me-2 bi bi-box-arrow-in-left"> Login</a>
          <a href="index.php" class="btn btn-danger float-end bi bi-box-arrow-in-right "> Logout</a>
        </div>
      </div>
    </div>
  </header>


  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="hppts://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" ></script>
  <script>
   $(document).ready(function () {
    $('#example').DataTable();
});
  </script>
</body>
</html>