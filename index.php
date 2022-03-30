<?php
 $conn= mysqli_connect('localhost','root','','phplearn');
 //$conn= mysqli_connect('sql213.epizy.com','epiz_31406443','','epiz_31406443_test');
//if($conn){
//echo ('connection done');
//}else{
//echo ('dont connect');
 //} 

 if(isset($_POST['btn'])){
   $id=$_POST['id'];
   $first_name=$_POST['first_name'];
   $last_name=$_POST['last_name'];
   $user_email=$_POST['user_email'];

   if(!empty($id) && !empty($first_name) && !empty($last_name) && !empty($user_email)){
     $query= "INSERT INTO users(id, first_name,	last_name, user_email) VALUE ('$id' ,'$first_name','$last_name','$user_email')";
     $sql=mysqli_query($conn,$query);
     if($sql){
       echo "your data is submitted";
     }
   }else{
     echo "field should not be empty";
   }
 }
?>

<!--delete option -->
<?php
 if(isset($_GET['delete'])){
   $id=$_GET['delete'];
   $query="DELETE FROM users WHERE id={$id}";
   $deletequery=  mysqli_query($conn,$query);
   if($deletequery){
     echo "Data Remove successfully";
   }
 }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>CRUD PHP</title>
  </head>
  <body >
    <div class=" container text1 ">
      <h1>CRUD OPARETION</h1>
    </div>
    <div class="container shadow m-5 p-3 ">
        
        <form action=""  method="post" class= " form d-flex justify-content-around"> 
            <input class="form-control" type="text" name="first_name" placeholder="user first name" >
            <input class="form-control" type="text" name="last_name" placeholder="user last  name" >
            <input class="form-control" type="email" name="user_email" placeholder="user Email" >
            <input class="btn btn-warning" type="submit" name="btn" value="send"   >

        </form>
    </div>
    <div class="container  m-5 p-3 ">
        <form action=""  method="post" class= " form d-flex justify-content-around"> 
            <?php
            if(isset($_GET['edit'])){
              $id = $_GET['edit'];
              $query = "SELECT * FROM users WHERE id={$id}";
              $getdata= mysqli_query($conn,$query);
              while($rx=mysqli_fetch_assoc($getdata)){
                $id=$rx['id'];
                $first_name=$rx['first_name'];
                $last_name=$rx['last_name'];
                $user_email=$rx['user_email'];
         
            ?>
              <!-- edit option -->
            <input class="form-control" type="text" name="first_name" value="<?php echo $first_name; ?>" >
            <input class="form-control" type="text" name="last_name" value="<?php echo $last_name ;?>" >
            <input class="form-control" type="email" name="user_email" value="<?php echo $user_email; ?>" >
            <input class="btn btn-warning" type="submit" name="edit_btn" value="Edit"   >


            <?php   
            }}
            ?>
             <!-- edit option -->
<?php
 if(isset($_POST['edit_btn'])){
   $first_name=$_POST['first_name'];
   $last_name=$_POST['last_name'];
   $user_email=$_POST['user_email'];

  if(!empty($first_name) && !empty($last_name) && !empty($user_email)){
     $query="UPDATE users SET first_name='$first_name', last_name='$last_name', user_email= '$user_email' WHERE id= {$id}";
     $deletequery=  mysqli_query($conn,$query);
     if($deletequery){
     echo "Data Edit successfully";
    }
  }else{
    echo "field should not be empty";
  }
 }
?>


        </form>
    </div>
  <div class="container">
    <table class="table table-bordered">
      <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>User Email</th>
      </tr>
   
       <?php
        $query= "SELECT * FROM users";
        $readquery=mysqli_query($conn,$query);

        if($readquery-> num_rows> 0){
          while($rd=mysqli_fetch_assoc($readquery)){
            $id=$rd['id'];
            $first_name=$rd['first_name'];
            $last_name=$rd['last_name'];
            $user_email=$rd['user_email'];
        
       ?>
      <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo $first_name;  ?></td>
        <td><?php echo $last_name; ?></td>
        <td><?php echo $user_email; ?></td>
        <td><a class="btn btn-danger" href="index.php?delete= <?php echo $id;?>">Delete</a></td>
        <td><a class="btn btn-success" href="index.php?edit= <?php echo $id;?>">Edit</a></td>
      </tr>

      <?php   
        }}else{
          echo "no data to show";
        } 
       ?>
    </table>
  </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>