<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<?php
  include 'sqlInsertPHP.php';
  include 'takeDataSQL.php';
  $dataSQL = new takeDataSQL();
  $dataSQL->findSuppliers();
  $dataSQL->idSupplier = 0;
  $dataSQL->findServices();
  $dataSQL->findTelephones();
  $nameTitle = "После ввода цифр, нажмите 'Enter'.";
  $shopName = "Услуги поставщика";
  $myfile = fopen("webinfo.txt", "r") or die("Unable to open file!");
  
  $name = isset($_POST['celcii']) ? $_POST['celcii'] : "";
//  $option = isset($_POST['supplier']) ? $_POST['supplier'] : "Выберите поставщика";
//  if ($option) {
//    echo "<script>console.log('Debug Objects: " . $option . "' );</script>";
//  }
  if (isset($_POST['supplier'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $option = htmlspecialchars($_REQUEST['supplier']);
        
        echo "<script>console.log('Debug Objects: " . $option . "' );</script>";
    }
    $cookie_name = "supplier";
    $cookie_value = $option;
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//    $dataSQL = new takeDataSQL();
    $shopName = $dataSQL->takeData($option);
    $dataSQL->findServices();
    $dataSQL->findTelephones();
//    $dataSQL->closeConn();
  } else {
      $option = "Выберите поставщика";
  }
  if (isset($_POST['celcii'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
              $name = htmlspecialchars($_REQUEST['celcii']);
              $connectSQL = new SqlInsert();
              if ($name != "") {
                  $name2 = round(((9 / 5) * (int)$name + 32), 1);
                  $connectSQL->send_toSql($name, $name2);
              }
              $connectSQL->close_conn();
              if (!empty($name)) {
                  echo "<script>console.log('Температура: " . $name . "' );</script>";
              } 
              if(isset($_COOKIE["supplier"])) {
                  $option = $_COOKIE["supplier"];
                  
              }
    }
  }
  $dataSQL->closeConn();

  
?>
<html lang="ru">
<head>
<meta charset="utf-8">
<title>Local suppliers</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,400;8..144,800&display=swap" rel="stylesheet">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <div class="title_descr">
            <div class="illustr">
                <img src="https://hsto.org/webt/82/ui/ik/82uiiktyk5fmbezropgye812p-4.png" alt="GeekBrains">
            </div>
            <div class="main_title">
                <h1 id="headMainTitle"><?php echo $option ?></h1>
                <form id="headerForm" class="form-field__header" name="headerForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <select id="supplier" class="form-field__header_select" name="supplier" onchange="HeaderForm()" value="<?php echo $option ?>">
                        <option value="Выберите услугу">Выберите услугу</option>
                        <?php while ($Name = $dataSQL->suppliers->fetch_column(0)) {?>
                        <option value="<?php echo $Name ?>"><?php echo $Name ?></option>
                        <?php }?>
                    </select>
                    
                </form>
            </div>
        </div>
        <div class="main_info">
            <div class="main_info_main">
                <div class="main_info_details">
                    <div class="name_my">Услуги поставщика</div>
                    <img src="temp_illustr.jpg" alt="Temperature">
                </div>
                <div class="main_info_details">
                    <h3><?php echo $shopName ?></h3>
                    
                    <form id="supplierForm" class="form-field__header" name="supplierForm" method="">
                        <select id="servises" class="form-field__header_select" name="servises">
                            <option value="Выберите поставщика">Выберите услугу</option>
                            <?php while ($Name = $dataSQL->servises->fetch_column(0)) {?>
                            <option value="<?php echo $Name ?>"><?php echo $Name ?></option>
                            <?php }?>
                        </select>
                    </form>
                </div>
                <div class="main_info_details">
                    <h3 id="headServises">Детали услуги</h3>
                    
                </div>
            </div>
            <div class="main_info_footer">
                <div class="footer_title"><p>Телефоны поставщика</p></div>
                <form id="supplierTelephone" class="form-field__footer" name="supplierTelephone" method="">
                        <select id="telephones" class="form-field__header_footer" name="telephones">
                            <option value="Выберите телефон">Выберите телефон</option>
                            <?php while ($Name = $dataSQL->telephones->fetch_column(0)) {?>
                            <option value="<?php echo $Name ?>"><?php echo $Name ?></option>
                            <?php }?>
                        </select>
                    </form>
            </div>
        </div>
    </div>
    <script src="animation1.js"></script>
</body>
</html>