<?php
    
    if(isset($_POST['SerialNumber'])){
        
        $server = "localhost";
        $username = "root";
        $password = "";

        
        $conn = mysqli_connect($server, $username, $password);

        
        if(!$conn){
            die("connection to this database failed due to" . mysqli_connect_error());
        }

        

        
       $stmt = "INSERT INTO `mygoodshoe`.`shoes`(`SerialNumber`, `ShoesName`, `Material`, `Gender`, `Description`, `Price`) VALUES (?,?,?,?,?,?)";
        $ok =$conn->prepare($stmt);
        $SerialNumber = $_POST['SerialNumber'];
        $ShoesName = $_POST['ShoesName'];
        $Price = $_POST['Price'];
        $Material = $_POST['Material'];
        $Gender = $_POST['Gender'];
        $Description = $_POST['Description'];
        $ok -> bind_param("sssssi",$SerialNumber,$ShoesName,$Material,$Gender,$Description,$Price);
        if (!$ok) { die("Bind param error");} 
        $ok->execute();
        if (!$ok) { die("Exec error"); }
        echo 'Data inserted <a href="index.php">OK</a>';

        $conn->close();
    }
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./style.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Storyboard</title>
</head>


<body>
    
    <nav class="navbar navbar-dark bg-dark">
        <h3 style="color: white;">SPORT GOOD X</h3>
        <h5 ><a style="color: white;" href="https://sites.google.com/view/sportgoodxhelp/home">Help</a></h5>
        
    </nav>

<div class="mainTitleDiv ">
    <div class="titleBar ">
        <div class="titleName text-center">
            <h1 style="margin-left: 30%; ">
                <strong>SPORT GOOD X</strong>
            </h1>
        </div>
        <div>
            <form action="">
                <div class=" bg-light rounded rounded-pill shadow-sm ">
                    <div class="input-group">
                        <div class="input-group-append">
                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                        </div>
                        <input type="search" placeholder="    Search" aria-describedby="button-addon1"
                            class="form-control border-0 bg-light " >
                        
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="buttonBar">
        <a class="btn btnID btn-outline-dark btn-lg active" href="./index.php" role="button">Shoes</a>
        <a class="btn btnID btn-outline-dark btn-lg" href="./Merchandise.php" role="button">Merchandise</a>
        <a class="btn btnID btn-outline-dark btn-lg" href="./Customer.php" role="button">Customer</a>
        <a class="btn btnID btn-outline-dark btn-lg" href="./Storage.php" role="button">Storage</a>
        <a class="btn btnID btn-outline-dark btn-lg" href="./Store.php" role="button">Store</a>
    </div>
</div>

<div class="tableArea">
    <table class="table table-bordered table-custom text-center">
        <thead class="thead-custom ">
            <tr >
                <th  class="text-center" scope="col">Serial Number</th>
                <th class="text-center" scope="col">Shoe Name</th>
                <th  class="text-center" scope="col">Material</th>
                <th class="text-center" scope="col">Gender</th>
                <th class="text-center" scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            
            <?php                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "mygoodshoe";

                
                $conn = new mysqli($servername, $username, $password, $dbname);
               
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM `shoes`";
                $result = $conn->query($sql);

                
                if ($result->num_rows > 0) {
                    
                    while($row = $result->fetch_assoc()) {
                    echo "<tr><th>".$row["SerialNumber"]."</th><td>".$row["ShoesName"]."</td><td>".$row["Material"]."</td><td>".$row["Gender"]."</td><td>".$row["Price"]."</td></tr>";
                    
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
            ?>
            
        </tbody>
    </table>

    <div class="addButton">
        <button type="button" class="btn btn-link btn-lg  btnAdd" data-toggle="modal" data-target="#exampleModal">+</button>
    </div>

    <div class="trzButton my-10">
        <div class="trapezoid">
            <button type="button" class="btn btn-link btn-lg"><h6 class="bottomTextSummer"> Spring/Summer</h6></button>
        </div>
        <div class="trapezoid">
            <button type="button" class="btn btn-link btn-lg bottomTextWinter"><h6>Fall/Winter</h6></button>
        </div>     
        
    </div>
</div>





<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Shoes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST">
                    <div class="row mt-5">
                        <div class="col">
                            <input name="SerialNumber" type="text" class="form-control" placeholder="Serial Number">
                        </div>
                        <div class="col">
                            
                            <select name ="Gender" id="inputState" class="form-control">
                                <option selected>Choose Gender...</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <input name ="ShoesName" type="text" class="form-control" placeholder="Shoes Name">
                        </div>
                        <div class="col">
                            <input name="Description" type="text" class="form-control" placeholder="Description">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col">
                            <input name ="Material" type="text" class="form-control" placeholder="Material">
                        </div>
                        <div class="col">
                            <input name="Price" type="text" class="form-control" placeholder="Price">
                        </div>
                    </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button  class="btn btn-primary">Add Shoe</button>
            </div>
            </form>
        </div>
    </div>
    
</div>

</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</html>


