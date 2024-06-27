<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include('includes/config.php');
    if(strlen($_SESSION['login'])==0){   
        header('location:index.php');
    }
    else{
        if(isset($_POST['update'])){
            $sid=$_SESSION['stdid'];  
            $fname=$_POST['fullname'];

            $sql="update tblstudents set FullName=:fname where StudentId=:sid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':sid',$sid,PDO::PARAM_STR);
            $query->bindParam(':fname',$fname,PDO::PARAM_STR);
            $query->execute();

            echo '<script>
                    alert("Your profile has been updated");
                    setTimeout(function() {
                        window.location.href = "dashboard.php";
                    }, 100); 
                  </script>';
            exit(); 
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Central Lib | Update</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        <div class="w-full h-screen bg-gradient-to-b from-indigo-500 via-purple-800 to-purple-900 flex justify-center items-center">
            <div class="bg-[#f0f1f0] w-[80%] h-[80%] rounded-[1.5rem] flex justify-center items-center gap-10">
                <div class="w-[30%] h-[90%] bg-white ml-10 rounded-[1rem] p-4">
                    <div class="text-[1.5rem] font-medium">Update Your Ceredentials</div>
                    <?php
                    $sid = $_SESSION['stdid'];
                    $sql="SELECT * from  tblstudents  where StudentId=:sid ";
                    $query = $dbh -> prepare($sql);
                    $query-> bindParam(':sid', $sid, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    if($query->rowCount() > 0){
                        foreach($results as $result){
                            $name =  $result->FullName;
                            $email =  $result->EmailId;
                            $status = $result->Status;
                        }
                    }

                    ?>
                    <div class="text-sm text-zinc-500 mt-2">Fill the correct details</div>
                    <div class="form mt-3">
                        <form method="post" name="signup">
                        <label class="block mt-4 flex items-center gap-2">
                        <span class="block text-sm font-medium text-slate-700">Profile Status: </span>
                            <?php if($status == 1){ ?>
                                <div class="inline py-1 text-sm font-normal rounded-full px-3 text-emerald-500 bg-emerald-100/60 gap-x-2 dark:bg-gray-800">
                                    Active
                                </div>
                            <?php } else { ?>
                                <div class="inline py-1 text-sm font-normal rounded-full px-3 text-gray-500 bg-gray-100 dark:bg-gray-800">
                                    Inactive
                                </div>
                            <?php } ?>
                        </label>

                            <label class="block mt-4">
                              <span class="block text-sm font-medium text-slate-700">Student ID</span>
                              <input disabled type="text" name="fullname"  placeholder="Enter your username" value="<?php echo htmlentities($sid) ?>" class="mt-1 block w-full px-3 py-2 bg-grey-100 border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                              "/>
                            </label>
                            <label class="block mt-4">
                              <span class="block text-sm font-medium text-slate-700">UserName</span>
                              <input type="text" name="fullname" value="<?php echo htmlentities($name) ?>" placeholder="Enter your username" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                                invalid:border-pink-500 invalid:text-pink-600
                                focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                              "/>
                            </label>
                            <label class="block mt-4">
                                <span class="block text-sm font-medium text-slate-700">Mobile Number</span>
                                <input type="text" placeholder="you@nitj.ac.in" value="7689012344" name="email"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                                  focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                                  invalid:border-pink-500 invalid:text-pink-600
                                  focus:invalid:border-pink-500 focus:invalid:ring-pink-500
                                "/>
                            </label>
                              <button type="submit" name="update" class="group block w-full mt-5 mx-auto rounded-lg p-3 bg-purple-700 ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-purple-800">
                                  <h3 class="text-white text-center text-sm font-semibold">Update</h3>
                              </button>
                          </form>
                    </div>
                </div>
                <div class="w-1/2 h-[80%] ml-10">
                  <img width="90%" height="auto" src="assets/img/signup/signup.png" alt="Signup">
                </div>
            </div>
        </div>
    </body>
    </html>

<?php } ?>





