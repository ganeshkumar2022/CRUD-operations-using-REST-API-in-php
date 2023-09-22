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
<div class="container mt-4">
<h3 class="text-primary text-center">Add Products</h3>
<form id="addItemForm">
  <div class="form-group">
    <label for="email">Name:</label>
    <input type="text" class="form-control" placeholder="Enter product name" id="name" name="name">
  </div>
  <div class="form-group">
  <label for="comment">Description:</label>
  <textarea class="form-control" rows="5" id="description" name="description" placeholder="Enter your description"></textarea>
</div>
  <div class="form-group">
    <label for="pwd">Price:</label>
    <input type="number" step="0.01" class="form-control" placeholder="Enter price" id="price" name="price">
  </div>
  <button type="submit" class="btn btn-primary">Add</button>
</form>
</div>

<script>
    document.getElementById("addItemForm").addEventListener("submit",function(e){
        e.preventDefault();
        const name=document.getElementById("name").value;
        const description=document.getElementById("description").value;
        const price=document.getElementById("price").value;

        const formData={
            name:name,
            description:description,
            price:price
        };
        fetch("api.php",{
            method:"POST",
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
                document.getElementById("addItemForm").reset();
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