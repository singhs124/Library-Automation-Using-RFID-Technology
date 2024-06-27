<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['signup'])) {
    try {
        // Increment student ID
        $studentIdFile = "studentid.txt";
        $studentId = file_get_contents($studentIdFile);
        if($studentId === false) {
            throw new Exception("Failed to read student ID file.");
        }
        $studentId++;
        $result = file_put_contents($studentIdFile, $studentId); 
        if($result === false) {
            throw new Exception("Failed to write student ID to file.");
        }

        // Get form data
        $fname = $_POST['fullname'];
        $rollNumber = $_POST['roll'];
        $email = $_POST['email']; 
        $password = md5($_POST['password']); 
        $status = 1;

        // Insert into database
        $sql = "INSERT INTO tblstudents (StudentId, FullName, RollNumber, EmailId, Password, Status) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$studentId, $fname, $rollNumber, $email, $password, $status]);

        // Check if insertion was successful
        $lastInsertId = $dbh->lastInsertId();
        if($lastInsertId) {
            echo '<script>
                    alert("Your registration was successful. Your student ID is ' . $studentId . '");
                    setTimeout(function() {
                        window.location.href = "index2.php";
                    }, 100); 
                  </script>';
            exit(); 
        } else {
            echo "<script>alert('Something went wrong. Please try again');</script>";
        }
    } catch(PDOException $e) {
        // Handle PDO exceptions
        echo "Error: " . $e->getMessage();
    } catch(Exception $e) {
        // Handle other exceptions
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Lib | Sign up</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        
    </style>
</head>
<body>
    <div class="w-full h-screen bg-gradient-to-b from-indigo-500 via-purple-800 to-purple-900 flex justify-center items-center">
        <div class="bg-[#f0f1f0] w-[80%] h-[85%] rounded-[1.5rem] flex justify-center items-center gap-10">
            <div class="w-[30%] h-[90%] bg-white ml-10 rounded-[1rem] p-4">
                <div class="text-[1.5rem] font-medium">Fill Your Ceredentials</div>
                <div class="text-sm text-zinc-500 mt-2">Already have an account? <span class="text-[#6366F1] underline font-medium"><a href="index2.php">Login</a></span></div>
                <div class="form mt-3">
                    <form method="post" name="signup">
                        <label class="block mt-4">
                          <span class="block text-sm font-medium text-slate-700">UserName</span>
                          <input type="text"  name="fullname" placeholder="Enter your username" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                            focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                            invalid:text-pink-600
                          " required/>
                        </label>
                        <label class="block mt-4">
                            <span class="block text-sm font-medium text-slate-700">Roll No.</span>
                            <input type="text" pattern="\d*" placeholder="Enter institute roll no." name="roll"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                              focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                               invalid:text-pink-600
                            " required/>
                        </label>
                        <label class="block mt-4">
                            <span class="block text-sm font-medium text-slate-700">Email Address</span>
                            <input type="email" required placeholder="you@nitj.ac.in" name="email"  class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                              focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                              invalid:text-pink-600
                            " />
                        </label>
                        <label class="block mt-4">
                            <span class="block text-sm font-medium text-slate-700">Password</span>
                            <input type="password" placeholder="Enter 6 or more characters" name="password" class="mt-1 block w-full px-3 py-2 bg-white border border-slate-300 rounded-md text-sm shadow-sm placeholder-slate-400
                              focus:outline-none focus:border-[#6366F1] focus:ring-1 focus:ring-sky-500
                              invalid:text-pink-600
                            " required minlength="6"/>
                        </label>
                          <button type="submit" name="signup" class="group block w-full mt-5 mx-auto rounded-lg p-3 bg-purple-700 ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-purple-800">
                              <h3 class="text-white text-center text-sm font-semibold">Sign up</h3>
                          </button>
                      </form>
                </div>
            </div>
            <div class="w-1/2 h-[80%] ml-10">
              <img width="90%" height="auto" src="assets/img/signup/signup.png" alt="Signup">
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