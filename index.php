<!--6366F1-->
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    include('includes/config.php');

    $sql = "SELECT CategoryName, Count FROM tblcategory";
    $query = $dbh->query($sql);
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    $categoryData = [];
    foreach ($results as $row){
        // Assign count to category name index
        $categoryData[$row->CategoryName] = $row->Count;
    }

    $categoryName = 'Academic';
    $count = $categoryData[$categoryName];
    $jsonData = json_encode($categoryData) ;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Central Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <style>
    .app-form-group {
        margin-bottom: 20px;
    }

    .app-form-group.message {
        margin-top: 20px;
    }

    .app-form-group.buttons {
        margin-bottom: 0;
        text-align: right;
    }

    .app-form-control {
        width: 100%;
        padding: 10px 0;
        background: none;
        border: none;
        border-bottom: 1px solid #ddd;
        color: black;
        font-size: 14px;
        outline: none;
        transition: border-color .2s;
    }

    .app-form-control::placeholder {
        color: #666;
    }

    .app-form-control:focus {
        border-bottom-color: #666;
        outline: none;
    }
    </style>
</head>

<body class="bg-[#f0f1f0] min-h-screen flex">
<div class="flex flex-col w-full min-h-full">
    <div class="flex flex-1">
        <!-- Menu Bar  -->
        <div
            class="w-[15%] bg-gradient-to-b from-indigo-500 via-purple-800 to-purple-900 text-white py-5 rounded-tr-[1rem]">
            <div class="flex justify-center gap-2 " style="align-items: center;">
                <div><i class="fa-solid fa-book fa-lg" style="color: #ffffff;"></i></div>
                <div class="font-medium text-[1.25rem]"> Central Library</div>
            </div>
            <div class="pt-[4rem]">
                <a href="#" class="flex pl-10 gap-5 pb-[2rem]" style="align-items: center;">
                    <div><i class="fa-solid fa-house"></i></div>
                    <div>Home</div>
                </a>
                <a href="#" class="flex pl-10 gap-5 pb-[2rem]" style="align-items: center;">
                    <div><i class="fa-solid fa-book-open-reader"></i></div>
                    <div>Books</div>
                </a>
                <a href="index2.php" class="flex pl-10 gap-5 pb-[2rem]" style="align-items: center;">
                    <div><i class="fa-solid fa-receipt"></i></div>
                    <div>Students</div>
                </a>
                <a href="./admin" class="flex pl-10 gap-5 pb-[2rem]" style="align-items: center;">
                    <div><i class="fa-solid fa-users"></i></div>
                    <div>Staff</div>
                </a>
            </div>
        </div>
        <div class="flex-1 px-5 py-5">
            <!-- Page Title  -->
            <div>
                <div class="text-[1.5rem] mb-10">Home</div>

                <!-- 4 cards  -->
                <div class="flex w-full h-[10vw] justify-center gap-10" style="align-items: center;">
                    <div
                        class="w-1/4 h-full bg-white border rounded-[1rem] p-5 hover:drop-shadow-xl transition-all duration-300">
                        <div class="flex item-center justify-between">
                            <div class="text-[1.25rem]">New Books Added</div>
                            <div><i class="fa-solid fa-book-open-reader fa-2xl" style="color:rgb(99 102 241);"></i>
                            </div>
                        </div>
                        <div class="mt-10 text-zinc-500 text-sm">23 books are added !</div>
                    </div>
                    <div
                        class="w-1/4 h-full bg-white border rounded-[1rem] p-5 hover:drop-shadow-xl transition-all duration-300">
                        <div class="flex item-center justify-between">
                            <div class="text-[1.25rem]">Issued Books</div>
                            <div><i class="fa-solid fa-hourglass-half fa-2xl" style="color:rgb(99 102 241);"></i></div>
                        </div>
                        <div class="mt-10 text-zinc-500 text-sm">50 books are issued!</div>
                    </div>
                    <div
                        class="w-1/4 h-full bg-white border rounded-[1rem] p-5 hover:drop-shadow-xl transition-all duration-300">
                        <div class="flex item-center justify-between">
                            <div class="text-[1.25rem]">Available Books</div>
                            <div><i class="fa-solid fa-book-open-reader fa-2xl" style="color:rgb(99 102 241);"></i>
                            </div>
                        </div>
                        <div class="mt-10 text-zinc-500 text-sm">23 books are available!</div>
                    </div>
                    <div
                        class="w-1/4 h-full bg-white border rounded-[1rem] p-5 hover:drop-shadow-xl transition-all duration-300">
                        <div class="flex item-center justify-between">
                            <div class="text-[1.25rem]">Total Students</div>
                            <div><i class="fa-solid fa-receipt fa-2xl" style="color:rgb(99 102 241);"></i></div>
                        </div>
                        <div class="mt-10 text-zinc-500 text-sm">1000+ beneficiary students!</div>
                    </div>

                </div>

                <!-- Login Card + Notification + chart + feedback  -->
                <div class="w-full h-[50vw] mt-10  flex justify-center gap-10">
                    <div class="w-1/2">
                        <div class="w-full h-[24%] border rounded-[1rem] bg-white overflow-auto mb-5">
                            <div class="flex w-full h-full justify-center items-center gap-10">
                                <div class="icon flex justify-center items-center gap-10 overflow-auto">
                                    <a href="index2.php"
                                        class="w-[7vw] h-[7vw] rounded-full bg-[#f0f1f0] flex flex-col justify-center items-center">
                                        <div class="text-[#6366F1]"><i class="fa-solid fa-graduation-cap fa-2x"></i>
                                        </div>
                                        <div class="text-[15px]">Student</div>
                                    </a>
                                    <a href="./admin"
                                        class="w-[7vw] h-[7vw] rounded-full bg-[#f0f1f0] flex flex-col justify-center items-center">
                                        <div class="text-[#6366F1]"><i class="fa-solid fa-user-tie fa-2x"></i></div>
                                        <div class="text-[15px]">Staff</div>
                                    </a>
                                    <a href="signup.php"
                                        class="w-[7vw] h-[7vw] rounded-full bg-[#f0f1f0] flex flex-col justify-center items-center">
                                        <div class="text-[#6366F1]"><i class="fa-solid fa-user-plus fa-2x"></i></i>
                                        </div>
                                        <div class="text-[15px]">New User</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Notifications  -->
                        <div class="w-full h-[71%] border rounded-[1rem] bg-white overflow-hidden">
                            <div class="pt-5 px-5">
                                <div class="text-[1.25rem] font-medium">Notifications</div>
                            </div>
                            <div class="flex justify-around mt-7 text-[#6366F1] font-medium">
                                <button onclick="filterPeriod(this , 'today')" class="btn btn-today">Today</button>
                                <button onclick="filterPeriod(this , 'week')" class="btn btn-week">One Week</button>
                                <button onclick="filterPeriod(this , 'month')" class="btn btn-month">Older</button>
                            </div>
                            <div class="flex mt-3 items-center justify-center line-container">
                                <div class="w-1/3 h-[1.5px] bg-[#ddd] line line-today"></div>
                                <div class="w-1/3 h-[1.5px] bg-[#ddd] line line-week"></div>
                                <div class="w-1/3 h-[1.5px] bg-[#ddd] line line-month"></div>
                            </div>
                            <div class="data overflow-auto w-full h-[36vw] mt-2">
                                <div id="notifications" class="px-10">
                                    <!-- Notifications will be inserted here dynamically -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2 flex flex-col gap-5">
                        <!-- Chart  -->
                        <div class="w-full h-[60%] bg-white border rounded-[1rem] overflow-hidden">
                            <div class="pt-5 px-5 text-[1.25rem] font-medium">Total Books Reports</div>
                            <div class="flex justify-around items-center p-5 pt-9">
                                <div class="flex flex-col justify-center items-center">
                                    <div class="" id="issuePercentage">89%</div>
                                    <div class="text-[14px] text-zinc-500">Journals</div>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <div class="" id="pendingPercentage">44.4%</div>
                                    <div class="text-[14px] text-zinc-500">Magazines</div>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <div class="" id="returnedPercentage">44.4%</div>
                                    <div class="text-[14px] text-zinc-500">Academic</div>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <div class="" id="lostPercentage">44.4%</div>
                                    <div class="text-[14px] text-zinc-500">Others</div>
                                </div>
                            </div>
                            <div class="pb-10 h-[1px]">
                                <canvas id="myChart_book" style="padding-bottom: 10px;"></canvas>
                            </div>
                        </div>
                        <!-- feedback  -->
                        <div class="h-[40%] border rounded-[1rem] bg-white overflow-hidden">
                            <div class="flex justify-between bar px-4 py-1 bg-slate-300 w-full h-[2vw] ">
                                <div class="flex gap-1" style="align-items: center;">
                                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                    <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                    <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                </div>
                                <div class="flex gap-[2px]" style="align-items: center;">
                                    <div class="w-1 h-1 rounded-full bg-black"></div>
                                    <div class="w-1 h-1 rounded-full bg-black"></div>
                                    <div class="w-1 h-1 rounded-full bg-black"></div>
                                </div>
                            </div>
                            <div class="text h-[18vw] flex ">
                                <div class="w-1/2 h-full flex flex-col py-10 px-10">
                                    <div class="text-[1.5rem] font-medium">Say Something</div>
                                    <div class="text-zinc-500 text-sm">we are hearing you!</div>
                                    <div class="w-16 h-1 mt-2 bg-[#6366F1]"></div>
                                </div>
                                <div class="w-1/2 h-full pr-5 pt-5">
                                    <div class="app-form">
                                        <div class="app-form-group">
                                            <input class="app-form-control" placeholder="your mail id">
                                        </div>
                                        <div class="app-form-group message">
                                            <input class="app-form-control" placeholder="your message for us">
                                        </div>
                                        <div class="app-form-group buttons">
                                            <button
                                                class="app-form-button rounded-full px-3 py-2 text-sm hover:bg-[#f0f1f0] border-2">Send
                                                to us</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>

    <script src="https://kit.fontawesome.com/7679c1475f.js" crossorigin="anonymous"></script>
    <script>
    function filterPeriod(button, period) {
        const lineToday = document.querySelector('.line-today');
        const lineWeek = document.querySelector('.line-week');
        const lineMonth = document.querySelector('.line-month');
        const lines = document.querySelectorAll('.line');

        lines.forEach(line => {
            line.classList.remove('bg-[#6366F1]', 'h-[3.5px]')
            line.classList.add('bg-[#ddd]', 'h-[1.5px]')
        })
        if (period == 'today') {
            lineToday.classList.remove('bg-[#ddd]', 'h-[1.5px]')
            lineToday.classList.add('bg-[#6366F1]', 'h-[3.5px]')
        } else if (period == 'week') {
            lineWeek.classList.remove('bg-[#ddd]', 'h-[1.5px]')
            lineWeek.classList.add('bg-[#6366F1]', 'h-[3.5px]')
        } else if (period == 'month') {
            lineMonth.classList.remove('bg-[#ddd]', 'h-[1.5px]')
            lineMonth.classList.add('bg-[#6366F1]', 'h-[3.5px]')
        }
        fetchNotifications(period);
    }

    async function fetchNotifications(period) {
            try {
                const response = await fetch(`fetch_notifications.php?period=${period}`);
                const notifications = await response.json();
                displayNotifications(notifications);
            } catch (error) {
                console.error('Error fetching notifications:', error);
            }
        }

        function displayNotifications(notifications) {
            const notificationsContainer = document.getElementById('notifications');
            notificationsContainer.innerHTML = '';
            notifications.forEach(notification => {
                const notificationElement = document.createElement('div');
                notificationElement.classList.add('pb-5', 'pt-6', 'border-b-[1.5px]', 'border-[#ddd]', 'pt-2', 'text-sm', 'font-medium');
                notificationElement.textContent = notification.Description;
                notificationsContainer.appendChild(notificationElement);
            });
        }

        
    filterPeriod(null, 'today');

    var xValues = ["Journals", "Magazines", "Academic", "Others"];
    var yValues = [];
    var categoryData = <?php echo $jsonData; ?>;
    xValues.forEach(val => {
        if (categoryData[val] !== null) {
            yValues.push(parseInt(categoryData[val], 10));
        }
    });

    total = yValues.reduce((sum, value) => sum + value, 0);
    percentages = yValues.map(value => ((value / total) * 100).toFixed(2));

    var issuePer = document.getElementById('issuePercentage');
    issuePer.innerHTML = percentages[0] + "%";

    var pendPer = document.getElementById('pendingPercentage');
    pendPer.innerHTML = percentages[1] + "%";

    var retunPer = document.getElementById('returnedPercentage');
    retunPer.innerHTML = percentages[2] + "%";

    var lostPer = document.getElementById('lostPercentage');
    lostPer.innerHTML = percentages[3] + "%";

    const barColors = [
        "#71e38f",
        "#546de3",
        "#d85656",
        "#e2de54"
    ];

    new Chart("myChart_book", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues,
            }]
        },
        options: {
            cutoutPercentage: 80, // Optional: Adjust the size of the hole in the center of the doughnut
            legend: {
                position: 'right', // Position the legend to the right side
                labels: {
                    usePointStyle: true, // Use point style for legend items
                    padding: 20, // Set padding between legend items
                }
            },
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 20
                }
            }
        }
    });
    </script>
</body>

</html>