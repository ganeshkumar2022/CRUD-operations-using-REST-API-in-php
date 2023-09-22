
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert operation using rest api in php</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
$api_url="http://localhost/crud/api.php?id=".$_GET["id"];
$curl=curl_init($api_url);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
$response=curl_exec($curl);
$data=json_decode($response);
?>
<div class="container mt-4">
<h3 class="text-primary text-center">Edit Products</h3>
<form id="editItemForm">
  <input type="hidden" name="id" id="pid" value="<?=$data->id?>">
   <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" class="form-control" value="<?=$data->name?>" placeholder="Enter product name" id="name" name="name">
  </div>
  <div class="form-group">
  <label for="comment">Description:</label>
  <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter your description"><?=$data->description?></textarea>
</div>
  <div class="form-group">
    <label for="pwd">Price:</label>
    <input type="number" step="0.01" class="form-control" value="<?=$data->price?>" placeholder="Enter price" id="price" name="price">
  </div>
  <button type="submit" class="btn btn-primary">Edit</button>
</form>
</div>

<script>
    document.getElementById("editItemForm").addEventListener("submit",function(e){
        e.preventDefault();
        const name=document.getElementById("name").value;
        const description=document.getElementById("description").value;
        const price=document.getElementById("price").value;
        const pid=document.getElementById("pid").value;

        const formData={
            id:pid,
            name:name,
            description:description,
            price:price
        };
        fetch("api.php",{
            method:"PUT",
            body:JSON.stringify(formData),
            headers:{
                "Content-Type":"application/json"
            }

        })
        .then(response=>response.json())
        .then(data=>{
            if(data.message)
            {
                alert(data.message);
                window.location.replace(window.location.href);
            }
            else if(data.error)
            {
                alert("Error :"+data.error);
            }
        })
    });
</script>
</body>
</html>