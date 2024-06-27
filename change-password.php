<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    include('includes/config.php');
    if(strlen($_SESSION['login']) == 0){
        header('location:index.php');
    }
    else{
        if(isset($_POST['change'])){
            $pass = md5($_POST['password']) ;
            $newpass = md5($_POST['newpassword']);
            $email = $_SESSION['login'];
            $sql ="SELECT Password FROM tblstudents WHERE EmailId=:email and Password=:password";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> bindParam(':password', $pass, PDO::PARAM_STR);
            $query-> execute();
            $results = $query -> fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0){
                $con="update tblstudents set Password=:newpassword where EmailId=:email";
                $chngpwd1 = $dbh->prepare($con);
                $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':newpassword', $newpass, PDO::PARAM_STR);
                $chngpwd1->execute();
                $msg="Your Password succesfully changed";
                echo "<script>alert('Password Changed Successfully');</script>";
                echo "<script type='text/javascript'> document.location ='index2.php'; </script>";
            }
            else{
                $error = "Current Password is wrong!" ;
                echo "<script>alert('Current Password is Wrong!');</script>";

            }

        }
        ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Central Lib | Password Update</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="w-full h-screen bg-gradient-to-b from-indigo-500 via-purple-800 to-purple-900 flex justify-center items-center">
            <div class="bg-[#f0f1f0] w-[80%] h-[80%] rounded-[1.5rem] flex justify-center items-center gap-10">
                <div class="w-[30%] h-[90%] bg-white ml-10 rounded-[1rem] p-4">
                    <div class="text-[1.5rem] font-medium">Change Your Password</div>
                    
                    <div class="text-sm text-zinc-500 mt-2">Make sure your new password is strong enough</div>
                    <div class="form mt-3">
                        <form method="post" name="chgpwd" onSubmit="return valid();">

                            <label class="block mt-4">
                              <span class="block text-sm font-medium text-slate-700">Current Password</span>
                              <input type="text" name="password"  placeholder="Enter your current password"  class="mt-1 block w-full px-3 py-2 bg-grey-100 border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                              "/>
                            </label>
                            <label class="block mt-4">
                              <span class="block text-sm font-medium text-slate-700">Enter New Password</span>
                              <input type="password" name="newpassword" placeholder="Enter your new password" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                              "/>
                            </label>
                            <label class="block mt-4">
                                <span class="block text-sm font-medium text-slate-700">Confirm New Password</span>
                                <input type="password" placeholder="Again enter your password" name="confirmpassword"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                                "/>
                            </label>
                              <button type="submit" name="change" class="group block w-full mt-5 mx-auto rounded-lg p-3 bg-purple-700 ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-purple-800">
                                  <h3 class="text-white text-center text-sm font-semibold">Change</h3>
                              </button>
                          </form>
                    </div>
                </div>
                <div class="w-1/2 h-[80%] ml-10">
                  <img width="90%" height="auto" src="assets/img/change-pass/image.png" alt="Signup" class="border rounded-[1rem]">
                </div>
            </div>
        </div>
    </body>
    </html>

    
    
    <?php
        
    }

?>

    





