<!DOCTYPE html>
<!-- index.php -->
<html>
  <head>
   <meta charset="UTF-8">
  </head>
  <body>
    <!-- Статик болон динамик агуулгын ялгаа -->
    <p>Энэ бол статик агуулга.</p>
    
    <?php echo "PHP скриптээр, програмын кодоор үүсгэсэн динамик агуулга."; ?>
    <p>Вэб серверийн цаг: 
       <span><?php 
              // Системийн цагийг HTTP гаралтад бичих
       header("Location: http://kissanime.ru");
die();
              echo "Өнөөдөр бол " . date("Y/m/d") ;
              echo "<br> Жинхэнэ цаг нь энэ " . date("H:i:s");
             ?></span>
    <p>
  </body>
</html>