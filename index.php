<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rest api using php</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <meta http-equiv="refresh" content="5">
</head>
<body>
<div class="container mt-5">
<div class="row">
<div class="col-md-8 offset-md-2">
  <h3 class="text-center my-2 font-weight-bold text-primary">Display all datas
    <a href="create.php" class="btn btn-primary float-right"><i class="fa-solid fa-plus"></i> Add products</a></h3>
<?php
$api_url="http://localhost/crud/api.php";
$curl=curl_init($api_url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$response=curl_exec($curl);
curl_close($curl);
if($response)
{
  $data=json_decode($response,true);
  if(!empty($data))
  {
    $i=1;
    echo "<table class='table table-bordered'>";
    echo "<thead class='thead-dark'><tr><th>S.No</th><th>Name</th><th>Description</th><th>Price</th>
    <th>Manage</th></tr></thead>";
    foreach($data as $row)
    {
      ?>
      <tr>
        <td><?=$i?></td>
        <td><?=$row["name"]?></td>
        <td><?=$row["description"]?></td>
        <td><?=$row["price"]?></td>
        <td>
          <a class="btn btn-success" href="edit.php?id=<?=$row['id']?>"><i class="fa-solid fa-pen"></i> Edit</a>
          <button class="btn btn-danger" onclick="fun(<?=$row['id']?>)"><i class="fa-solid fa-eraser"></i> Delete</button>
        </td>
      </tr>
      <?php
      $i++;
    }
    echo "</table>";
  }
}
?>
</div>
</div>
</div>
<script>
  function fun(id)
  {
    
    const xhttp=new XMLHttpRequest();
    xhttp.open("DELETE","api.php?id="+id,true);

    xhttp.onload=function(){
      const result=JSON.parse(this.responseText);
      alert(result["message"]);
      window.location.replace(window.location.href);
    }

    xhttp.send();
   
  }
</script>
</body>
</html>
