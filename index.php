<?php 

session_start();

if(isset($_SESSION['user'])){
	//build skeleton
	readfile("./template/head.html");
	readfile("./template/body.html");
	include("datatables.php");
	readfile("./template/footer.html");
}

else{
    echo 'you are not logged in, please login. </br> 
        <script type="text/javascript">
            window.setTimeout(function(){
                window.location.href = "login.php";
            }, 3000);
        </script>';
}
	


?>

