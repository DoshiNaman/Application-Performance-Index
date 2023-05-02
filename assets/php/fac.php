
<?php

if($i==1){
  echo'<script>$("#table22").hide();</script>';
}

//alert
if(isset($_SESSION["success"]) and $_SESSION["success"]!=""){
  echo'
  <script>            
  handleAlerts("success", "'.$_SESSION["success"].'")
  setTimeout(function(){
      $("#alertCLose").trigger("click");
      ';
      $_SESSION['success'] = "";
      echo'
  }, 5000);
  </script>
  ';
}
//alert
if(isset($_SESSION["danger"]) and $_SESSION["danger"]!=""){
  echo'
  <script>            
  handleAlerts("danger", "'.$_SESSION["danger"].'")
  setTimeout(function(){
      $("#alertCLose").trigger("click");
      ';
      $_SESSION['danger'] = "";
      echo'
  }, 5000);
  </script>
  ';
}

/* Submit */ 

if(isset($_POST["submitTLP"])){
  $n=$_POST["subName"];
  $b=$_POST["subdrop"];
  $c=$_POST["scheduleClass"];
  $d=$_POST["actualClass"];
  $e=$_POST["semester"];
  $point=($d/$c)*50;
  $point=round($point,2);
  if($e=="0"){
      $_SESSION["danger"]='Select Sem';
      echo "<script>location.href = 'home.php';</script>";
  }
  elseif($b=="0"){
      $_SESSION["danger"]='Select Subject Code';
      echo "<script>location.href = 'home.php';</script>";
  }
  elseif($n=="Invalid" or $n==""){
      $_SESSION["danger"]='Invalid Subject Code';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $sql = "SELECT * FROM TLP WHERE id='".$a."' AND subject='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-TLP.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO TLP VALUES ('$a', '$b','$n',$point,0,'','$e',$c,$d,'$fpdfname',0, '',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='TLP Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='TLP Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitGR"])){
  $b=$_POST["subdrop"];
  $c=$_POST["subName"];
  $d=$_POST["year"];
  $e=$_POST["resultInstitute"];
  $f=$_POST["resultGtu"];
  $g=$_POST["semester"];
  if(($e-$f) < 0 ){
      $point=($e-$f)*2;
  }
  else{
      $point=($e-$f)*4;
  }
  if($g=="0"){
      $_SESSION["danger"]='Select Sem';
      echo "<script>location.href = 'home.php';</script>";
  }
  elseif($b=="0"){
      $_SESSION["danger"]='Select Subject Code';
      echo "<script>location.href = 'home.php';</script>";
  }
  elseif($c=="Invalid" or $c==""){
      $_SESSION["danger"]='Invalid Subject Code';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $sql = "SELECT * FROM GR WHERE id='".$a."' AND subject='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-GR.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO GR VALUES ('$a', '$b', '$c', '$d', $point, $e, $f, 0, $g, '$fpdfname', 0, '', '',NULL)";
          echo $sql;
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='GR Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='GR Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
              #echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
      }
  
  }
  
}

if(isset($_POST["submitDISC"])){
  $b=$_POST["nooftlp"];
  $c=$_POST["nooflwp"];
  $d=$_POST["noofbl"];
  $e=$_POST["noofm"];
  $f=$_POST["nooff"];
  $point=0;

  if($b==0){ $point=$point+5;}
  elseif($b==1){ $point=$point+4;}
  elseif($b==2){ $point=$point+3;}
  else{$point=$point+0;}

  if($c==0){ $point=$point+5;}
  elseif($c==1){ $point=$point+4;}
  elseif($c==2){ $point=$point+3;}
  elseif($c==3){ $point=$point+2;}
  else{$point=$point+0;}

  $point=$point+($d*2);

  if($e==0){ $point=$point+10;}
  elseif($e==1){ $point=$point+5;}
  else{$point=$point+0;}

  if($f==0){ $point=$point+5;}
  elseif($f==1){ $point=$point+0;}
  else{$point=$point+(-5);}



  $sql = "SELECT * FROM DISC WHERE id='".$a."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $_SESSION["danger"]='Entry already there';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $sql = "INSERT INTO DISC VALUES ('$a', $b, $c, $d, $e, $f, $point, 0, '', 0, '',NULL)";
      if (mysqli_query($conn, $sql)) {
          $_SESSION["success"]='DISC Entry Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='DISC Denied Successfully';
          echo "<script>location.href = 'home.php';</script>";
          #echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
}

if(isset($_POST["submitDP"])){
  $b=$_POST["port"];
  $c=$_POST["role"];
  $d=$_POST["duration"];
  $point=0;
  if($b=="0"){
      $_SESSION["danger"]='Select Portfolio';
      echo "<script>location.href = 'home.php';</script>";
  }
  else if($c=="0"){
      $_SESSION["danger"]='Select Role';
      echo "<script>location.href = 'home.php';</script>";
  }
  else if($d=="0"){
      $_SESSION["danger"]='Select Duration';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $dur="";
      $rr="";
      if($d==1 and $c==1){
          $point=5*1;
          $dur="1year";
          $rr="coordinator";
      }
      else if($d==1 and $c==2){
          $point=1;
          $dur="1year";
          $rr="cocooordinator";
      }
      else if($d==1 and $c==3){
          $point=1;
          $dur="1year";
          $rr="member";
      }
      else if($d==2 and $c==1){
          $point=5*(0.5);
          $dur="6month";
          $rr="coordinator";
      }
      else if($d==2 and $c==2){
          $point=(0.5);
          $dur="6month";
          $rr="cocooordinator";
      }
      else if($d==2 and $c==3){
          $point=(0.5);
          $dur="6month";
          $rr="member";
      }

      $sql = "SELECT * FROM DP WHERE id='".$a."' AND name='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-DP.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO DP VALUES ('$a','$b',$point,'$rr','$dur','',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='DP Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='DP Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitIP"])){
  $b=$_POST["port"];
  $c=$_POST["role"];
  $d=$_POST["duration"];
  $point=0;
  if($b=="0"){
      $_SESSION["danger"]='Select Portfolio';
      echo "<script>location.href = 'home.php';</script>";
  }
  else if($c=="0"){
      $_SESSION["danger"]='Select Role';
      echo "<script>location.href = 'home.php';</script>";
  }
  else if($d=="0"){
      $_SESSION["danger"]='Select Duration';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $dur="";
      $rr="";
      if($d==1 and $c==1){
          $point=5*1;
          $dur="1year";
          $rr="coordinator";
      }
      else if($d==1 and $c==2){
          $point=1;
          $dur="1year";
          $rr="cocooordinator";
      }
      else if($d==1 and $c==3){
          $point=1;
          $dur="1year";
          $rr="member";
      }
      else if($d==2 and $c==1){
          $point=5*(0.5);
          $dur="6month";
          $rr="coordinator";
      }
      else if($d==2 and $c==2){
          $point=(0.5);
          $dur="6month";
          $rr="cocooordinator";
      }
      else if($d==2 and $c==3){
          $point=(0.5);
          $dur="6month";
          $rr="member";
      }

      $sql = "SELECT * FROM IP WHERE id='".$a."' AND name='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-IP.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO IP VALUES ('$a','$b',$point,'$rr','$dur','',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='IP Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='IP Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitCTS"])){
  $b=$_POST["activity"];
  $d=$_POST["date"];
  $point=5;

  $sql = "SELECT * FROM CTS WHERE id='".$a."' AND date='".$d."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $_SESSION["danger"]='Entry already there';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $fpdfname=$d."-CTS.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "INSERT INTO CTS VALUES ('$a','$b','$d',$point,'',0,0,'$fpdfname','',NULL)";
      if (mysqli_query($conn, $sql)) {
          $_SESSION["success"]='CTS Entry Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='CTS Denied Successfully';
          echo "<script>location.href = 'home.php';</script>";
      }
  }
  
}

if(isset($_POST["submitRAA1"])){
  $b=$_POST["activity"];
  $c=$_POST["date"];
  $d=$_POST["for"];
  $e=$_POST["nop"];
  $f=$_POST["role"];
  $point=0;
  if($d=="0"){
      $_SESSION["danger"]='Select for';
      echo "<script>location.href = 'home.php';</script>";
  }
  else if($f=="0"){
      $_SESSION["danger"]='Select role';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $for="";
      $rol="";
      if($d==1){$for="Students";}
      elseif($d==2){$for="Faculty";}
      
      if($f==1){$point=5;$rol="Coordinator";}
      elseif($f==2){$point=0;$rol="Co-coordinator";}
      

      $sql = "SELECT * FROM RAA1 WHERE id='".$a."' AND date='".$c."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$c."-RAA1.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA1 VALUES ('$a','$b','$for','$c','$rol','$e',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA1 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA1 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitRAA2"])){
  $b=$_POST["title"];
  $c=$_POST["date"];
  $d=$_POST["place"];
  $e=$_POST["sa"];
  $f=$_POST["nop"];
  $g=$_POST["nod"];
  if($g > 10){$point=10;}
  else{$point=$g;}
  
  
  $sql = "SELECT * FROM RAA2 WHERE id='".$a."' AND date='".$c."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $_SESSION["danger"]='Entry already there';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $fpdfname=$c."-RAA2.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "INSERT INTO RAA2 VALUES ('$a','$b','$d','$c','$e','$f','$g',$point,'',0,0,'$fpdfname','',NULL)";
      if (mysqli_query($conn, $sql)) {
          $_SESSION["success"]='RAA2 Entry Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA2 Denied Successfully';
          echo "<script>location.href = 'home.php';</script>";
      }
  }
}

if(isset($_POST["submitRAA3"])){
  $b=$_POST["name"];
  $c=$_POST["date"];
  $d=$_POST["nod"];
  $e=$_POST["dateoe"];
  if($d > 4){$point=5;}
  else{$point=$d*1.25;}
  
  
  $sql = "SELECT * FROM RAA3 WHERE id='".$a."' AND date='".$c."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $_SESSION["danger"]='Entry already there';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $fpdfname=$c."-RAA3.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "INSERT INTO RAA3 VALUES ('$a','$b','$c','$e','$d',$point,'',0,0,'$fpdfname','',NULL)";
      if (mysqli_query($conn, $sql)) {
          $_SESSION["success"]='RAA3 Entry Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA3 Denied Successfully';
          echo "<script>location.href = 'home.php';</script>";
      }
  }
}

if(isset($_POST["submitRAA4"])){
  $b=$_POST["name"];
  $c=$_POST["date"];
  $d=$_POST["type"];
  $e=$_POST["nom"];
  $point=5;
  if($d=="0"){
      $_SESSION["danger"]='Select type';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $type="";
      if($d==1){$type="National";}
      elseif($d==2){$type="International";}
    
      $sql = "SELECT * FROM RAA4 WHERE id='".$a."' AND date='".$c."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$c."-RAA4.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA4 VALUES ('$a','$b','$c','$type','$e',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA4 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA4 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitRAA5"])){
  $b=$_POST["name"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $g=$_POST["title"];
  $c=$_POST["index"];
  $d=$_POST["issn"];
  $e=$_POST["journal"];
  $f=$_POST["vpage"];
  $point=5;
  if($c=="0"){
      $_SESSION["danger"]='Select index';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($c==1){$index="SCi";}
      elseif($c==2){$index="Scoupus";}
      elseif($c==3){$index="UGC";}
      elseif($c==4){$index="IJET";}
    
      $sql = "SELECT * FROM RAA5 WHERE id='".$a."' AND name='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-RAA5.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA5 VALUES ('$a','$b','$g','$index','$d','$e','$f',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA5 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA5 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitRAA6"])){
  $b=$_POST["name"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $g=$_POST["pi"];
  $c=$_POST["pp"];
  $d=$_POST["cvp"];
  $point=0;
  if($c=="0"){
      $_SESSION["danger"]='Select Presented/Publish';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($c==1){$point=3;$index="Presented International";}
      elseif($c==2){$point=2;$index="Presented National";}
      elseif($c==3){$point=1;$index="Publish";}
    
      $sql = "SELECT * FROM RAA6 WHERE id='".$a."' AND name='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-RAA6.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA6 VALUES ('$a','$b','$g','$d','$index',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA6 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA6 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitRAA7"])){
  $b=$_POST["title"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $g=$_POST["year"];
  $c=$_POST["pub"];
  $d=$_POST["authors"];
  $point=0;
  if($c=="0"){
      $_SESSION["danger"]='Select Publisher';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($c==1){$point=10;$index="International Publisher";}
      elseif($c==2){$point=5;$index="National Publisher";}
      elseif($c==3){$point=3;$index="chapter in edited book";}
      elseif($c==4){$point=10;$index="editor of book by international publisher";}
      elseif($c==5){$point=5;$index="editor of book by any publisher";}
    
      $sql = "SELECT * FROM RAA7 WHERE id='".$a."' AND title='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-RAA7.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA7 VALUES ('$a','$b','$g','$d','$index',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA7 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA7 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitRAA8"])){
  $n=$_POST["subName"];
  $b=$_POST["subdrop"];
  $c=$_POST["link"];
  $e=$_POST["semester"];
  $point=5;
  $index="";
  if($e=="0"){
      $_SESSION["danger"]='Select Sem';
      echo "<script>location.href = 'home.php';</script>";
  }
  elseif($b=="0"){
      $_SESSION["danger"]='Select Subject Code';
      echo "<script>location.href = 'home.php';</script>";
  }
  elseif($n=="Invalid" or $n==""){
      $_SESSION["danger"]='Invalid Subject Code';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $sql = "SELECT * FROM RAA8 WHERE id='".$a."' AND subject='".$b."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$b."-RAA8.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA8 VALUES ('$a','$n','$b',$e,'$c',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA8 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA8 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
  
  
}

if(isset($_POST["submitRAA9"])){
  $c=$_POST["name"];
  $b=$_POST["o1"];
  $point=0;
  if($b=="0"){
      $_SESSION["danger"]='Select Option 1';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($b==1){$point=20;$index="International Grant";}
      elseif($b==2){$point=30;$index="International Grant + Publish";}
      elseif($b==3){$point=10;$index="National Grant";}
      elseif($b==4){$point=14;$index="National Grant + Publish";}
    
      $sql = "SELECT * FROM RAA9 WHERE id='".$a."' AND name='".$c."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$a."-RAA9.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA9 VALUES ('$a','$c','$index',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA9 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA9 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitRAA10"])){
  $b=$_POST["name"];
  $g=$_POST["noc"];
  $c=$_POST["nameou"];
  $point=0;
  if($b=="0"){
      $_SESSION["danger"]='Select Program';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($b==1){$point=10;$index="Phd";}
      elseif($b==2){$point=15;$index="Phd Thesis";}
      elseif($b==3){$point=3;$index="Pg";}
      elseif($b==4){$point=1;$index="Ug";}
      $index=strtolower($index);
      $index=str_replace(' ', '-', $index);

      $sql = "SELECT * FROM RAA10 WHERE id='".$a."' AND name='".$index."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$index."-RAA10.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO RAA10 VALUES ('$a','$index','$g','$c',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='RAA10 Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='RAA10 Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitINV"])){
  $b=$_POST["nameIns"];
  $c=$_POST["levelIns"];
  $d=$_POST["date"];
  $e=$_POST["topic"];
  $point=0;
  if($c=="0"){
      $_SESSION["danger"]='Select level of institute';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $rol="";
      if($c==1){$point=5;$rol="international";}
      elseif($c==2){$point=3;$rol="national";}
      else{$point=2;$rol="local";}
      

      $sql = "SELECT * FROM INV WHERE id='".$a."' AND date='".$d."'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
          $_SESSION["danger"]='Entry already there';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $fpdfname=$d."-INV.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "INSERT INTO INV VALUES ('$a','$b','$rol','$d','$e',$point,'',0,0,'$fpdfname','',NULL)";
          if (mysqli_query($conn, $sql)) {
              $_SESSION["success"]='INV Entry Successfully';
              echo "<script>location.href = 'home.php';</script>";
          } else {
              $_SESSION["danger"]='INV Denied Successfully';
              echo "<script>location.href = 'home.php';</script>";
          }
      }
  }
}

if(isset($_POST["submitAO"])){
  $b=$_POST["work"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $point=3;
  $sql = "SELECT * FROM AO WHERE id='".$a."' AND title='".$b."'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $_SESSION["danger"]='Entry already there';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $fpdfname=$b."-AO.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "INSERT INTO AO VALUES ('$a', '$b', $point, 0, '', 0, '$fpdfname', '',NULL)";
      if (mysqli_query($conn, $sql)) {
          $_SESSION["success"]='AO Entry Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='AO Denied Successfully';
          echo "<script>location.href = 'home.php';</script>";
          #echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
}


/* Edit */
if(isset($_POST["editTLP"])){
  $n=$_POST["subName"];
  $b=$_POST["subCode"];
  $c=$_POST["scheduleClass"];
  $d=$_POST["actualClass"];
  $e=$_POST["sem"];
  $point=($d/$c)*50;
  $point=round($point,2);
  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE TLP SET point='$point',scheduleClass='$c',actualClass='$d'  WHERE id='$a' AND subject='$b'" ;
  }
  else{
      $fpdfname=$b."-TLP.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE TLP SET point='$point',scheduleClass='$c',actualClass='$d',attachment='$fpdfname'  WHERE id='$a' AND subject='$b'" ;
  }
  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='TLP Updated Successfully';
      echo "<script>location.href = 'home.php'; </script>";
  } else {
      $_SESSION["danger"]='TLP Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }
}

if(isset($_POST["editGR"])){
  $b=$_POST["subCode"];
  $c=$_POST["subName"];
  $d=$_POST["year"];
  $e=$_POST["resultInstitute"];
  $f=$_POST["resultGtu"];
  if(($e-$f) < 0 ){
      $point=($e-$f)*2;
  }
  else{
      $point=($e-$f)*4;
  }
  
  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE GR SET point='$point', resultInstitute='$e', resultGtu='$f', year='$d'  WHERE id='$a' AND subject='$b'" ;
  }
  else{
      $fpdfname=$b."-GR.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE GR SET point='$point', resultInstitute='$e', resultGtu='$f', year='$d', attachment='$fpdfname' WHERE id='$a' AND subject='$b'";
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='GR Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='GR Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }

}

if(isset($_POST["editDISC"])){
  $b=$_POST["nooftlp"];
  $c=$_POST["nooflwp"];
  $d=$_POST["noofbl"];
  $e=$_POST["noofm"];
  $f=$_POST["nooff"];
  $point=0;

  if($b==0){ $point=$point+5;}
  elseif($b==1){ $point=$point+4;}
  elseif($b==2){ $point=$point+3;}
  else{$point=$point+0;}

  if($c==0){ $point=$point+5;}
  elseif($c==1){ $point=$point+4;}
  elseif($c==2){ $point=$point+3;}
  elseif($c==3){ $point=$point+2;}
  else{$point=$point+0;}

  $point=$point+($d*2);

  if($e==0){ $point=$point+10;}
  elseif($e==1){ $point=$point+5;}
  else{$point=$point+0;}

  if($f==0){ $point=$point+5;}
  elseif($f==1){ $point=$point+0;}
  else{$point=$point+(-5);}

  $sql = "UPDATE DISC SET TLP='$b', point='$point', LWP='$c', BL='$d', MJC='$e', F='$f' WHERE id='".$a."'";
  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='DISC Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='DISC Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }

}

if(isset($_POST["editDP"])){
  $b=$_POST["port"];
  $c=$_POST["role"];
  $d=$_POST["duration"];
  $point=0;
  $dur="";
  $rr="";
  if($d==1 and $c==1){
      $point=5*1;
      $dur="1year";
      $rr="coordinator";
  }
  else if($d==1 and $c==2){
      $point=1;
      $dur="1year";
      $rr="cocooordinator";
  }
  else if($d==1 and $c==3){
      $point=1;
      $dur="1year";
      $rr="member";
  }
  else if($d==2 and $c==1){
      $point=5*(0.5);
      $dur="6month";
      $rr="coordinator";
  }
  else if($d==2 and $c==2){
      $point=(0.5);
      $dur="6month";
      $rr="cocooordinator";
  }
  else if($d==2 and $c==3){
      $point=(0.5);
      $dur="6month";
      $rr="member";
  }

  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE DP SET role='$rr', point='$point', duration='$dur'  WHERE id='$a' AND name='$b'" ;
  }
  else{
      $fpdfname=$b."-DP.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE DP SET role='$rr', point='$point', duration='$dur', attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='DP Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='DP Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }
  

}

if(isset($_POST["editIP"])){
  $b=$_POST["port"];
  $c=$_POST["role"];
  $d=$_POST["duration"];
  $point=0;
  $dur="";
  $rr="";
  if($d==1 and $c==1){
      $point=5*1;
      $dur="1year";
      $rr="coordinator";
  }
  else if($d==1 and $c==2){
      $point=1;
      $dur="1year";
      $rr="cocooordinator";
  }
  else if($d==1 and $c==3){
      $point=1;
      $dur="1year";
      $rr="member";
  }
  else if($d==2 and $c==1){
      $point=5*(0.5);
      $dur="6month";
      $rr="coordinator";
  }
  else if($d==2 and $c==2){
      $point=(0.5);
      $dur="6month";
      $rr="cocooordinator";
  }
  else if($d==2 and $c==3){
      $point=(0.5);
      $dur="6month";
      $rr="member";
  }

  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE IP SET role='$rr', point='$point', duration='$dur'  WHERE id='$a' AND name='$b'" ;
  }
  else{
      $fpdfname=$b."-DP.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE IP SET role='$rr', point='$point', duration='$dur', attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='IP Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='IP Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }
  

}

if(isset($_POST["editCTS"])){
    $b=$_POST["activity"];
    $d=$_POST["editCTS"];
    $point=5;
  
    if($_FILES['attachment']['name'] == "") {
        $sql = "UPDATE CTS SET activity='$b' WHERE id='$a' AND date='$d'" ;
    }
    else{
        $fpdfname=$d."-CTS.pdf";
        $attachment=$_FILES['attachment']['name'];
        $attachment_type=$_FILES['attachment']['type'];
        $attachment_size=$_FILES['attachment']['size'];
        $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
        $attachment_store="../../document/".$a."/".$attachment;
        move_uploaded_file($attachment_tem_loc,$attachment_store);
        $newpath="../../document/".$a."/".$fpdfname;
        rename($attachment_store, $newpath);
        $sql = "UPDATE CTS SET activity='$b',attachment='$fpdfname' WHERE id='$a' AND date='$d'" ;
    }
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"]='CTS Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    } else {
        $_SESSION["danger"]='CTS Not Updated Successfully';
        echo "<script>location.href = 'home.php';</script>";
    }
    
}


if(isset($_POST["editRAA1"])){
  $b=$_POST["name"];
  $c=$_POST["date"];
  $d=$_POST["for"];
  $e=$_POST["nop"];
  $f=$_POST["role"];
  $point=0;
  if($d=="0"){
      $_SESSION["danger"]='Select for';
      echo "<script>location.href = 'home.php';</script>";
  }
  else if($f=="0"){
      $_SESSION["danger"]='Select role';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $for="";
      $rol="";
      if($d==1){$for="Students";}
      elseif($d==2){$for="Faculty";}
      
      if($f==1){$point=5;$rol="Coordinator";}
      elseif($f==2){$point=0;$rol="Co-coordinator";}
      
      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA1 SET name='$b',considering='$for',role='$rol',participants='$e',point='$point'  WHERE id='$a' AND date='$c'" ;
      }
      else{
          $fpdfname=$c."-RAA1.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA1 SET name='$b',considering='$for',role='$rol',participants='$e',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
      }

      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA1 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA1 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["editRAA2"])){
  $b=$_POST["title"];
  $c=$_POST["date"];
  $d=$_POST["place"];
  $e=$_POST["sa"];
  $f=$_POST["nop"];
  $g=$_POST["nod"];
  if($g > 10){$point=10;}
  else{$point=$g;}
  
  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE RAA2 SET title='$b',place='$d',sponsoring_agency='$e',participants='$f',days='$g',point='$point'  WHERE id='$a' AND date='$c'" ;
  }
  else{
      $fpdfname=$c."-RAA2.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE RAA2 SET title='$b',place='$d',sponsoring_agency='$e',participants='$f',days='$g',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='RAA2 Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='RAA2 Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }   
}

if(isset($_POST["editRAA3"])){
  $b=$_POST["name"];
  $c=$_POST["date"];
  $d=$_POST["nop"];
  $e=$_POST["dateoe"];
  if($d > 4){$point=5;}
  else{$point=$d*1.25;}

  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE RAA3 SET name='$b',date_of_examination='$e',duration='$d',point='$point'  WHERE id='$a' AND date='$c'" ;
  }
  else{
      $fpdfname=$c."-RAA3.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE RAA3 SET name='$b',date_of_examination='$e',duration='$d',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='RAA3 Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='RAA3 Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }   
}

if(isset($_POST["editRAA4"])){
  $b=$_POST["name"];
  $c=$_POST["date"];
  $d=$_POST["type"];
  $e=$_POST["nom"];
  $point=5;
  if($d=="0"){
      $_SESSION["danger"]='Select type';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $type="";
      if($d==1){$type="National";}
      elseif($d==2){$type="International";}
      
      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA4 SET name='$b',type='$type',membership='$e',point='$point'  WHERE id='$a' AND date='$c'" ;
      }
      else{
          $fpdfname=$c."-RAA4.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA4 SET name='$b',type='$type',membership='$e',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$c'" ;
      }

      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA4 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA4 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["editRAA5"])){
  $b=$_POST["name"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $g=$_POST["title"];
  $c=$_POST["index"];
  $d=$_POST["issn"];
  $e=$_POST["journal"];
  $f=$_POST["vpage"];
  $point=5;
  
  if($c=="0"){
      $_SESSION["danger"]='Select index';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($c==1){$index="SCi";}
      elseif($c==2){$index="Scoupus";}
      elseif($c==3){$index="UGC";}
      elseif($c==4){$index="IJET";}
      
      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA5 SET title='$g',indexing='$index',issn='$d',journal='$e',vpage='$f',point='$point'  WHERE id='$a' AND name='$b'" ;
      }
      else{
          $fpdfname=$b."-RAA5.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA5 SET title='$g',indexing='$index',issn='$d',journal='$e',vpage='$f',point='$point',attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
      }

      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA5 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA5 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["editRAA6"])){
  $b=$_POST["name"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $g=$_POST["pi"];
  $c=$_POST["pp"];
  $d=$_POST["cvp"];
  $point=0;
  if($c=="0"){
      $_SESSION["danger"]='Select Presented/Publish';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($c==1){$point=3;$index="Presented International";}
      elseif($c==2){$point=2;$index="Presented National";}
      elseif($c==3){$point=1;$index="Publish";}
      
      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA6 SET pi='$g',cvp='$d',pp='$index',point='$point'  WHERE id='$a' AND name='$b'" ;
      }
      else{
          $fpdfname=$b."-RAA6.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA6 SET pi='$g',cvp='$d',pp='$index',point='$point',attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
      }

      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA6 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA6 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["editRAA7"])){
  $b=$_POST["title"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $g=$_POST["year"];
  $c=$_POST["pub"];
  $d=$_POST["authors"];
  $point=0;
  if($c=="0"){
      $_SESSION["danger"]='Select Publisher';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($c==1){$point=10;$index="International Publisher";}
      elseif($c==2){$point=5;$index="National Publisher";}
      elseif($c==3){$point=3;$index="chapter in edited book";}
      elseif($c==4){$point=10;$index="editor of book by international publisher";}
      elseif($c==5){$point=5;$index="editor of book by any publisher";}
      
      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA7 SET year='$g',authors='$d',publisher='$index',point='$point'  WHERE id='$a' AND title='$b'" ;
      }
      else{
          $fpdfname=$b."-RAA7.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA7 SET year='$g',authors='$d',publisher='$index',point='$point',attachment='$fpdfname'  WHERE id='$a' AND title='$b'" ;
      }

      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA7 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA7 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["editRAA8"])){
  $b=$_POST["subCode"];
  $c=$_POST["name"];
  $d=$_POST["link"];
  $point=5;
  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE RAA8 SET link='$d',point='$point'  WHERE id='$a' AND subject='$b'" ;
  }
  else{
      $fpdfname=$b."-RAA8.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE RAA8 SET link='$d',point='$point',attachment='$fpdfname'  WHERE id='$a' AND subject='$b'" ;
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='RAA8 Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='RAA8 Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  }   
}

if(isset($_POST["editRAA9"])){
  $b=$_POST["o1"];
  $c=$_POST["name"];
  $point=0;
  if($b=="0"){
      $_SESSION["danger"]='Select Option 1';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      $index="";
      if($b==1){$point=20;$index="International Grant";}
      elseif($b==2){$point=30;$index="International Grant + Publish";}
      elseif($b==3){$point=10;$index="National Grant";}
      elseif($b==4){$point=14;$index="National Grant + Publish";}
      
      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA9 SET type='$index',point='$point'  WHERE id='$a' AND name='$c'" ;
      }
      else{
          $fpdfname=$a."-RAA9.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA9 SET type='$index',point='$point',attachment='$fpdfname'  WHERE id='$a' AND name='$c'" ;
      }

      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA9 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA9 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["editRAA10"])){
  $b=$_POST["name"];
  $c=$_POST["noc"];
  $e=$_POST["nameou"];
  if($b=="0"){
      $_SESSION["danger"]='Select Program';
      echo "<script>location.href = 'home.php';</script>";
  }
  else{
      // $index="";
      // if($b==1){$point=10;$index="Phd";}
      // elseif($b==2){$point=15;$index="Phd Thesis";}
      // elseif($b==3){$point=3;$index="Pg";}
      // elseif($b==4){$point=1;$index="Ug";}
      // $index=strtolower($index);
      // $index=str_replace(' ', '-', $index);

      if($_FILES['attachment']['name'] == "") {
          $sql = "UPDATE RAA10 SET candidate='$c',university='$e'  WHERE id='$a' AND name='$b'" ;
      }
      else{
          $fpdfname=$index."-RAA10.pdf";
          $attachment=$_FILES['attachment']['name'];
          $attachment_type=$_FILES['attachment']['type'];
          $attachment_size=$_FILES['attachment']['size'];
          $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
          $attachment_store="../../document/".$a."/".$attachment;
          move_uploaded_file($attachment_tem_loc,$attachment_store);
          $newpath="../../document/".$a."/".$fpdfname;
          rename($attachment_store, $newpath);
          $sql = "UPDATE RAA10 SET candidate='$c',university='$e',attachment='$fpdfname'  WHERE id='$a' AND name='$b'" ;
      }
      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]='RAA10 Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
      } else {
          $_SESSION["danger"]='RAA10 Not Updated Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      } 
  }
    
}

if(isset($_POST["editINV"])){
  $b=$_POST["nameIns"];
  $c=$_POST["levelIns"];
  $d=$_POST["date"];
  $e=$_POST["topic"];
  $point=0;
  $rol="";
  if($c==1){$point=5;$rol="international";}
  elseif($c==2){$point=3;$rol="national";}
  else{$point=2;$rol="local";}

  if($_FILES['attachment']['name'] == "") {
      $sql = "UPDATE INV SET name='$b',level='$rol',topic='$e',point='$point'  WHERE id='$a' AND date='$d'" ;
  }
  else{
      $fpdfname=$d."-INV.pdf";
      $attachment=$_FILES['attachment']['name'];
      $attachment_type=$_FILES['attachment']['type'];
      $attachment_size=$_FILES['attachment']['size'];
      $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
      $attachment_store="../../document/".$a."/".$attachment;
      move_uploaded_file($attachment_tem_loc,$attachment_store);
      $newpath="../../document/".$a."/".$fpdfname;
      rename($attachment_store, $newpath);
      $sql = "UPDATE INV SET name='$b',level='$rol',topic='$e',point='$point',attachment='$fpdfname'  WHERE id='$a' AND date='$d'" ;
  }

  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='INV Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='INV Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }
  

}

if(isset($_POST["editAO"])){
  $b=$_POST["title"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $fpdfname=$b."-AO.pdf";
  $attachment=$_FILES['attachment']['name'];
  $attachment_type=$_FILES['attachment']['type'];
  $attachment_size=$_FILES['attachment']['size'];
  $attachment_tem_loc=$_FILES['attachment']['tmp_name'];
  $attachment_store="../../document/".$a."/".$attachment;
  move_uploaded_file($attachment_tem_loc,$attachment_store);
  $newpath="../../document/".$a."/".$fpdfname;
  rename($attachment_store, $newpath);
  $sql = "UPDATE AO SET attachment='$fpdfname'  WHERE id='$a' AND title='$b'" ;
  
  if ($conn->query($sql) === TRUE) {
      $_SESSION["success"]='AO Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='AO Not Updated Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error updating record: " . $conn->error;
  }
  
}

/*Delete
if(isset($_POST["delTLP"])){
  $b=$_POST["delTLP"];
  $sql = "DELETE FROM TLP WHERE id='$a' AND subject='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='TLP Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='TLP Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  }
}

if(isset($_POST["delGR"])){
  $b=$_POST["delGR"];
  $sql = "DELETE FROM GR WHERE id='$a' AND subject='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='GR Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='GR Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error deleting record: " . mysqli_error($conn);
  }
}

if(isset($_POST["delDISC"])){
  $b=$_POST["delDISC"];
  $sql = "DELETE FROM DISC WHERE id='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='DISC Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='DISC Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error deleting record: " . mysqli_error($conn);
  }
}

if(isset($_POST["delDP"])){
  $b=$_POST["delDP"];
  $sql = "DELETE FROM DP WHERE id='$a' AND name='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='DP Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='DP Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error deleting record: " . mysqli_error($conn);
  }
}

if(isset($_POST["delIP"])){
  $b=$_POST["delIP"];
  $sql = "DELETE FROM IP WHERE id='$a' AND name='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='IP Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='IP Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error deleting record: " . mysqli_error($conn);
  }
}

if(isset($_POST["delINV"])){
  $b=$_POST["delINV"];
  $sql = "DELETE FROM INV WHERE id='$a' AND date='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='INV Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='INV Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error deleting record: " . mysqli_error($conn);
  }
}

if(isset($_POST["delAO"])){
  $b=$_POST["delAO"];
  $b=strtolower($b);
  $b=str_replace(' ', '-', $b);
  $sql = "DELETE FROM AO WHERE id='$a' AND title='$b'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION["success"]='AO Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
  } else {
      $_SESSION["danger"]='AO Not Deleted Successfully';
      echo "<script>location.href = 'home.php';</script>";
      //echo "Error deleting record: " . mysqli_error($conn);
  }
  
}*/

if(isset($_POST["del"])){
  $str=$_POST["del"];
  $arr = preg_split("/[_]+/", $str);
  if(count($arr)==3){
      $element=$arr[0];
      $elementField=$arr[1];
      $tt=$arr[2];
      $sql = "DELETE FROM $tt WHERE id='$a' AND $elementField='$element'" ;
      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]=$tt.' Deleted Successfully';
          echo "<script>location.href = 'home.php'; </script>";
      } else {
          $_SESSION["danger"]=$tt.' Not Deleted Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
  elseif(count($arr)==1){
      $tt=$arr[0];
      $sql = "DELETE FROM $tt WHERE id='$a'" ;
  
      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]=$tt.' Deleted Successfully';
          echo "<script>location.href = 'home.php'; </script>";
      } else {
          $_SESSION["danger"]=$tt.' Not Deleted Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}

if(isset($_POST["lock"])){
  $str=$_POST["lock"];
  $arr = preg_split("/[_]+/", $str);
  if(count($arr)==3){
      $element=$arr[0];
      $elementField=$arr[1];
      $tt=$arr[2];
      $sql = "UPDATE $tt SET locked=1 WHERE id='$a' AND $elementField='$element'" ;
      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]=$tt.' locked Successfully';
          echo "<script>location.href = 'home.php'; </script>";
      } else {
          $_SESSION["danger"]=$tt.' Not locked Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
  elseif(count($arr)==1){
      $tt=$arr[0];
      $sql = "UPDATE $tt SET locked=1 WHERE id='$a'" ;
  
      if ($conn->query($sql) === TRUE) {
          $_SESSION["success"]=$tt.' locked Successfully';
          echo "<script>location.href = 'home.php'; </script>";
      } else {
          $_SESSION["danger"]=$tt.' Not locked Successfully';
          echo "<script>location.href = 'home.php';</script>";
          //echo "Error updating record: " . $conn->error;
      }
  }
}


?>