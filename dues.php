<?php
    $jsonTotalFine = 0 ;
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include('includes/config.php');
    if(strlen($_SESSION['login'])==0)
    { 
        header('location:index.php');
    }
    else{?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dues Data</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="flex justify-center items-center min-h-screen bg-[#f0f1f0]">
<div id="fineCard" class="w-[80%]">
                
                <div
                    class="w-full min-h-[20vw] bg-white rounded-[1rem] p-5 hover:drop-shadow-xl transition-all duration-300">
                    <div class="w-full pb-5 border-b-[1.5px] border-[#ddd]">
                        <div class="flex justify-between items-center pr-10">
                            <div class="text-[1.25rem] font-medium">Uncleared Dues</div>
                            <div id="fine-container " class="flex justify-center items-center inline py-1 text-[17px] font-normal rounded-full px-3 text-emerald-500 bg-emerald-100/60 gap-x-2 dark:bg-gray-800">
                                <div><i class="fa-solid fa-indian-rupee-sign"></i></div>
                                <div id="totalFine">0</div>
                            </div>
                        </div>
                        
                        <div class="text-zinc-500 text-sm mt-2">Clear your uncleared dues!</div>
                    </div>
                    <div class="w-full">
                        <div class="flex flex-col mt-6">
                            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <div class="overflow-hidden border border-gray-200 md:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-slate-300">
                                                <tr>
                                                    <th scope="col"
                                                        class="py-3.5 px-4 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                        <button
                                                            class="flex items-center gap-x-3 focus:outline-none">
                                                            <span>Book</span>

                                                            <svg class="h-3" viewBox="0 0 10 11" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z"
                                                                    fill="currentColor" stroke="currentColor"
                                                                    stroke-width="0.1" />
                                                                <path
                                                                    d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z"
                                                                    fill="currentColor" stroke="currentColor"
                                                                    stroke-width="0.1" />
                                                                <path
                                                                    d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z"
                                                                    fill="currentColor" stroke="currentColor"
                                                                    stroke-width="0.3" />
                                                            </svg>
                                                        </button>
                                                    </th>
                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                        ISBN Number
                                                    </th>
                                                    <th scope="col"
                                                        class="px-12 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                        Date of Return
                                                    </th>

                                                    <th scope="col"
                                                        class="px-4 py-3.5 text-sm font-normal text-center rtl:text-right text-gray-500">
                                                        Fine(in Rs)
                                                    </th>
                                                    <th scope="col" class="relative py-3.5 px-4">
                                                        <span class="sr-only">Edit</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-[#f0f1f0] divide-y divide-gray-200">


                                                <!-- Table body content remains the same -->
                                                <?php
                                                    $sid = $_SESSION['stdid'];
                                                    $sql = "SELECT tblbooks.BookName,tblbooks.ISBNNumber,tblissuedbookdetails.IssuesDate, tblissuedbookdetails.ReturnDate, tblissuedbookdetails.BookId as rid, tblissuedbookdetails.RetrunStatus , tblissuedbookdetails.fine from  tblissuedbookdetails join tblstudents on tblstudents.StudentId=tblissuedbookdetails.StudentID join tblbooks on tblbooks.id=tblissuedbookdetails.BookId where tblstudents.StudentId=:sid";
                                                    $query = $dbh->prepare($sql);
                                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR); // Bind the parameter
                                                    $query->execute();

                                                    // Check for errors during execution
                                                    if ($query) {
                                                        // Fetch the results
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        
                                                        // Process the results...
                                                    } else {
                                                        // Handle any errors
                                                        echo "Error executing SQL query: " . $dbh->errorInfo()[2];
                                                    }

                                                    if ($query->rowCount() > 0) {
                                                        
                                                        $output = ""; // Initialize an empty string to store the HTML output
                                                        $totalFine = 0 ;

                                                        foreach ($results as $result) {
                                                            if($result->fine > 0){
                                                            $totalFine += $result->fine; 
                                                            $returnStatus = ($result->RetrunStatus == 1) ? 'Returned' : 'Pending';
                                                            $statusClass = ($result->RetrunStatus == 1) ? 'px-3 text-emerald-500 bg-emerald-100/60' : 'px-3 text-gray-500 bg-gray-100';

                                                            $timestamp = strtotime($result->ReturnDate);

                                                            // Format the Unix timestamp into "21st Feb 2024" format
                                                            $formattedDate = date('jS M Y', $timestamp);
                                                            $output .= <<<HTML

                                                            <tr>
                                                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                                                    <div class="font-medium text-gray-800"> {$result->BookName}</div>
                                                                </td>
                                                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                                                    <div class="text-gray-700 "> {$result->ISBNNumber} </div>
                                                                </td>
                                                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                                                    <div class="text-gray-700 ">{$formattedDate}</div>
                                                                </td>
                                                                <td class="px-12 py-4 text-sm font-medium whitespace-nowrap text-center">
                                                                <div id="fine-container " class="flex justify-center items-center inline py-1 text-sm font-normal rounded-full px-3 text-emerald-500 bg-emerald-100/60 gap-x-2 dark:bg-gray-800">
                                                                    <div><i class="fa-solid fa-indian-rupee-sign"></i></div>
                                                                    <div id="totalFine">{$result->fine}</div>
                                                                </div>
                                                                </td>
                                                                <td class="px-4 py-4 text-sm whitespace-nowrap text-center">
                                                                    <button class="px-1 py-1 text-gray-500 transition-colors duration-200 rounded-lg dark:text-gray-300 hover:bg-gray-100">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                    HTML;
                                                            }
                                                        }
                                                        
                                                        $jsonTotalFine = json_encode($totalFine);

                                                        echo $output; // Output the HTML after the loop
                                                    }                                            
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    <script src="https://kit.fontawesome.com/7679c1475f.js" crossorigin="anonymous"></script>

</body>
<script>
    var fine = <?php echo $jsonTotalFine; ?>;
    const fineId = document.getElementById("totalFine");
    fineId.innerHTML = `${fine}`
</script>
</html>

<?php } ?>