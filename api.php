<?php
header("Content-Type:application/json");
$host="localhost";
$username="root";
$password="";
$database="crud";
$con=mysqli_connect($host,$username,$password,$database);
if(!$con)
{
    die("Error to connect database :".mysqli_connect_error());
}



//read - retrieve items
if($_SERVER["REQUEST_METHOD"]==="GET")
{
    if(isset($_GET["id"]))
    {
        $sql="select * from products where id=".$_GET["id"];
        $result=mysqli_query($con,$sql);
        $row=mysqli_fetch_assoc($result);
        echo json_encode($row);
    }
    else
    {
        $sql="select * from products";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0)
        {
            $items=array();
            while($row=mysqli_fetch_assoc($result))
            {
            array_push($items,$row);
            }
            echo json_encode($items);
        }
        else
        {
            echo json_encode(array());
        }
    }
}

//create - insert a new item
if($_SERVER["REQUEST_METHOD"]==="POST")
{
$data=json_decode(file_get_contents("php://input"));
$name=$data->name;
$description=$data->description;
$price=$data->price;

$sql="insert into products values (NULL,'$name','$description','$price')";
if(mysqli_query($con,$sql))
{
    echo json_encode(array("message"=>"products created successfully"));
}
else
{
    echo json_encode(array("error"=>"Error :".mysqli_error($con)));
}
}

//update - update an existing item
if($_SERVER["REQUEST_METHOD"]==="PUT")
{
$data=json_decode(file_get_contents("php://input"));
$id=$data->id;
$name=$data->name;
$description=$data->description;
$price=$data->price;

$sql="update products set name='$name',price='$price',description='$description' where id=$id";
if(mysqli_query($con,$sql))
{
    echo json_encode(array("message"=>"products updated successfully"));
}
else
{
    echo json_encode(array("error"=>"Error :".mysqli_error($con)));
}
}

//update - update an existing item
if($_SERVER["REQUEST_METHOD"]==='DELETE')
{
$id=$_GET["id"];

$sql="delete from products where id=$id";
if(mysqli_query($con,$sql))
{
    echo json_encode(array("message"=>"Item Deleted successfully"));
}
else
{
    echo json_encode(array("error"=>"Error :".mysqli_error($con)));
}
}
?>