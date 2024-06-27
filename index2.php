<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if($_SESSION['login']!=''){
        $_SESSION['login']='';
    }
    if(isset($_POST['login']))
    {
        $email=$_POST['emailid'];
        $password=md5($_POST['password']);
        $sql ="SELECT EmailId,Password,StudentId,Status FROM tblstudents WHERE EmailId=:email and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        if($query->rowCount() > 0)
        {
            foreach ($results as $result) {
                $_SESSION['stdid']=$result->StudentId;
                if($result->Status==1)
                {
                    $_SESSION['login']=$_POST['emailid'];
                    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                } else {
                    echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";
                }
            }

        } 

        else{
            echo '<script>
                    alert("Please Enter Valid Details");
                    setTimeout(function() {
                        window.location.href = "index2.php";
                    }, 100); 
                  </script>';
            exit(); 
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Lib | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="w-full h-screen bg-gradient-to-b from-indigo-500 via-purple-800 to-purple-900 flex justify-center items-center">
        <div class="bg-[#f0f1f0] w-[80%] h-[80%] rounded-[1.5rem] flex justify-center items-center gap-10">
            <div class="w-[30%] h-[80%] bg-white ml-10 rounded-[1rem] p-5">
                <div class="text-[1.5rem] font-medium">Login</div>
                <div class="text-sm text-zinc-500 mt-2">Doesn't have an account yet? <span class="text-[#6366F1] underline font-medium"><a href="signup.php">Sign Up</a></span></div>
                <div class="form mt-3">
                    <form method="post">
                        <label class="block mt-5">
                          <span class="block text-sm font-medium text-slate-700">Email Address</span>
                          <input type="email" placeholder="you@nitj.ac.in" name="emailid"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                            focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                            invalid:border-pink-500 invalid:text-pink-600
                            focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                          "/>
                        </label>
                        <label class="block mt-5">
                            <span class="block text-sm font-medium text-slate-700">Password</span>
                            <input type="password" placeholder="Enter 6 or more characters" name="password" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                              focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                              invalid:border-pink-500 invalid:text-pink-600
                              focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                            "/>
                        </label>
                        <label class="block mt-4 pl-1">
                            <input type="checkbox" class=" checked:bg-blue-500 mr-1" />
                            <span class="text-sm font-medium text-slate-700">Remember me</span>
                        </label>
                          <button href="#" name="login" class="group block w-full mt-5 mx-auto rounded-lg p-3 bg-purple-700 ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-purple-800">
                              <h3 class="text-white text-center text-sm font-semibold">Login</h3>
                          </button>
                      </form>
                </div>
            </div>
            <div class="w-1/2 h-[80%]">
              <img src="assets/img/login/login.png" alt="">
            </div>
        </div>
    </div>

    <script>
        function validateEmail(email) {
            // Regular expression to check if email ends with @nitj.ac.in
            const regex = /^[^\s@]+@nitj\.ac\.in$/;
            return regex.test(email);
        }

        const emailInput = document.querySelector('input[name="email"]');
        emailInput.addEventListener('input', function() {
            const isValid = validateEmail(this.value);
            if (isValid) {
                this.setCustomValidity('');
            } else {
                this.setCustomValidity('Please enter your valid offical email address');
            }
        });

       
    </script>



</body>
</html>