<?php
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if($_SESSION['alogin']!=''){
        $_SESSION['alogin']='';
    }
    if(isset($_POST['login']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $username, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
            $_SESSION['alogin']=$_POST['username'];
            echo "<script type='text/javascript'> document.location ='./dashboard.php'; </script>";
        } else{
            header('location:404.php');
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Lib | Admin Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="w-full h-screen bg-gradient-to-b from-indigo-500 via-purple-800 to-purple-900 flex justify-center items-center">
        <div class="bg-[#f0f1f0] w-[80%] h-[80%] rounded-[1.5rem] flex justify-center items-center gap-10">
            <div class="w-[30%] h-[80%] bg-white ml-10 rounded-[1rem] p-5">
                <div class="text-[1.5rem] font-medium">Staff Login</div>
                <!-- <div class="text-sm text-zinc-500 mt-2">Doesn't have an account yet? <span class="text-[#6366F1] underline font-medium"><a href="signup.php">Sign Up</a></span></div> -->
                <div class="form mt-3">
                    <form method="post">
                        <label class="block mt-5">
                          <span class="block text-sm font-medium text-slate-700">UserName</span>
                          <input type="text" placeholder="Enter your username" name="username"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
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
                          <button type="submit" name="login" class="group block w-full mt-5 mx-auto rounded-lg p-3 bg-purple-700 ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-purple-800">
                              <h3 class="text-white text-center text-sm font-semibold">Login</h3>
                          </button>
                      </form>
                </div>
            </div>
            <div class="w-1/2 h-[80%]">
              <img src="assets/img/Login/login.webp" alt="">
            </div>
        </div>
    </div>
</body>
</html>