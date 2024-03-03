<!DOCTYPE html>
<!-- -->
<html lang="en">
<link rel="stylesheet" href="{{ asset('/assets/web/css/patientdashboard.css') }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Patient Dashboard Panel</title>
    <style>
        .notification-link {
            position: relative;
            text-decoration: none;
        }

        .notification-icon {
            display: inline-block;
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -13.9px;
            /* Adjust the positioning as needed */
            right: -8px;
            /* Adjust the positioning as needed */
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 12px;
            /* Adjust the font size as needed */
        }

        /* .notification-list {
    display: none;
    position: absolute;
    top: 40px;
    left: 0;
    width: 100%;
    background-color: white;
    border: 1px solid #ccc;
    padding: 10px;
}

.notification-list li {
    list-style: none;
    padding: 10px;
}

.notification-link:hover .notification-list {
    display: block;
} */
    </style>

</head>

<body>
    <nav class="custom-background">
        <div class="logo-name">
            <div class="logo-image">
                <img src="images/logo.png" alt="">
            </div>

            <span class="logo_name">Smart Prescription</span>
        </div>

        <div class="menu-items" style="background-color: #2E3B4E; color: #fff; font-weight: bold; border-radius: 10px;">
            <ul class="nav-links">
                <li><a href="{{ route('patient.dashboard') }}">
                        <i class="uil uil-estate"></i>
                        <span class="link-name">Dashboard</span>
                    </a></li>
                <li><a href="{{route('dashboard.index')}}">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Profile</span>
                    </a></li>
                    <div class="notification-container" id="notificationContainer">
                        <a href="#" class="notification-link" id="notificationLink">
                            <i style="font-size: 25px; padding: 10px" class="uil uil-bell"></i>
                            <span class="link-name">Notifications</span>
                            <span class="notification-count">{{-- {{ count(auth()->user()->unreadNotifications) }} --}}</span>
                        </a>
                    
                        <ul class="notification-list dropdown-content" id="notificationList">
                            @if(auth()->user()->unreadNotifications->isNotEmpty())
                                <ul>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li>
                                            <p>{{ $notification->created_at->diffForHumans() }}: <strong>You have medication to be refilled{{-- : {{ $notification->data['message'] }} --}}</strong></p>
                                            
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p>No unread notifications.</p>
                            @endif
                        </ul>
                    </div>
                    
                    
                    
                    
                    
                    




                </li>

                <li>
                    <a href="{{ route('index') }}#appointment" class="appointment-link">
                        <i class="uil uil-calendar-alt"></i>
                        <span class="link-name">Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('chat_with_doctor') }}" class="">
                        <i class="uil uil-calendar-alt"></i>
                        <span class="link-name">Chat With Doctor</span>
                    </a>
                </li>

            </ul>

            <!-- ... (other sidebar code) -->

            <!-- ... (other sidebar code) -->

            <div style="flex-grow: 1;"></div> <!-- This creates a flexible space to push the content to the top -->

            <div class="logout-mode">
                <ul>
                    <li class="mode">
                        <a href="#">
                            <i class="uil uil-moon"></i>
                            <span class="link-name">Dark Mode</span>
                        </a>

                        <div class="mode-toggle">
                            <span class="switch"></span>
                        </div>
                    </li>

                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="uil uil-signout"></i>
                            <span class="link-name">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- ... (other sidebar code) -->

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>




        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <a href="#" class="notification-link">
                <i style="font-size: 25px;" class="uil uil-bell notification-icon"></i>
                <span class="notification-badge">{{ count($notifications) }}</span>
            </a>


            <!-- Message icon without route link -->
            <!-- Message icon with WhatsApp link -->
            <a href="https://wa.me/" target="_blank" class="message-link">
                <i style="font-size: 20px;" class="uil uil-comment-alt-message message-icon"></i>
            </a>



            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>

            <!--<img src="images/profile.jpg" alt="">-->
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-thumbs-up"></i>
                        <span class="text">Total Appointments</span>
                        <span class="number"></span>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Appointment pending</span>
                        <span class="number"></span>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-share"></i>
                        <span class="text">Total Prescription</span>
                        <span class="number"></span>
                    </div>
                </div>

            </div>

            {{-- <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Recent Prescription</span>
                </div>

                <div class="activity-data">
                    <div class="data names">
                        <span class="data-title">Name</span>

                    </div>
                    <div class="data email">
                        <span class="data-title">Email</span>


                    </div>
                    <div class="data joined">
                        <span class="data-title">Joined</span>

                    </div>
                    <div class="data type">
                        <span class="data-title">Type</span>


                    </div>
                    <div class="data status">
                        <span class="data-title">Status</span>

                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>
<script>
    function toggleDropdown() {
        var dropdownContent = document.getElementById("messageDropdown").getElementsByClassName("dropdown-content")[0];
        dropdownContent.classList.toggle("show");
    }

    function openWhatsApp() {
        window.open("https://wa.me/", "_blank");
    }

    function openTelegram() {
        window.open("https://t.me/", "_blank");
    }


    const body = document.querySelector("body"),
        modeToggle = body.querySelector(".mode-toggle");
    sidebar = body.querySelector("nav");
    sidebarToggle = body.querySelector(".sidebar-toggle");

    let getMode = localStorage.getItem("mode");
    if (getMode && getMode === "dark") {
        body.classList.toggle("dark");
    }

    let getStatus = localStorage.getItem("status");
    if (getStatus && getStatus === "close") {
        sidebar.classList.toggle("close");
    }

    modeToggle.addEventListener("click", () => {
        body.classList.toggle("dark");
        if (body.classList.contains("dark")) {
            localStorage.setItem("mode", "dark");
        } else {
            localStorage.setItem("mode", "light");
        }
    });

    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
        if (sidebar.classList.contains("close")) {
            localStorage.setItem("status", "close");
        } else {
            localStorage.setItem("status", "open");
        }
    })

    document.addEventListener("DOMContentLoaded", function() {
        const notificationCount = document.querySelector(".notification-count");
        const notificationContainer = document.getElementById("notificationContainer");

        notificationCount.addEventListener("click", function() {
            // Toggle the visibility of the notification container
            notificationContainer.classList.toggle("show");

            // Load notifications when the container is shown
            if (notificationContainer.classList.contains("show")) {
                // Use an AJAX request to load notifications from the server
                // Append the notifications to the notificationContainer
            }
        });
    });
    document.getElementById('notificationLink').addEventListener('click', function() {
        var notificationList = document.getElementById('notificationList');
        notificationList.style.display = notificationList.style.display === 'block' ? 'none' : 'block';
    });
</script>