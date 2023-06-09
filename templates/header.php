<?php

//Cookies for managing member/admin authority 
    $check = $_COOKIE['role'] ?? Null;
    if($check == Null)
    {
        setcookie('role', 'guest', time() + 86400);
        header("Refresh:0");
    }

    if (@$_COOKIE['role'] == "guest")
    {
        echo '<style type="text/css">
            #member, #admin, #Logout { display: none;}
            </style>';
    }
    else if (@$_COOKIE['role'] == "member")
    {
        echo '<style type="text/css">
        #UserLogin, #SignUp, #admin { display: none; }
        </style>';
    }
    else if (@$_COOKIE['role'] == "admin")
    {
        echo '<style type="text/css">
        #AdminLogin, #SignUp, #member { display: none; }
        </style>';
    }

    if(isset($_POST['Logout']))
    {
        setcookie('role', 'guest', time() + 86400);
        header('location: index.php');
    }

?>

<head>
    <title>LMS</title>
    <link rel="icon" type="image/x-icon" href="./imgs/books.png" />
    <link href="fontawesome/css/all.css" rel="stylesheet" />
    <link href="datatables/CSS/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="bootstrap/CSS/bootstrap.min.css" rel="stylesheet" />
    <link href="CSS/customstylesheet.css" rel="stylesheet" />
    <script src="bootstrap/js/jquery-3.3.1.slim.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<!-- Table script (Datatable plugin) -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".table").each(function() {
                var $thead = $("<thead></thead>").append($(this).find("tr:first"));
                $(this).prepend($thead).DataTable();
            });         
        });
    </script>

<!-- Sidebar style -->
    <style>
        .sidebar {
            height: 100%;
            width: 230px;
            position: fixed;
            z-index: 1;
            left: 0;
            background-color: #009688;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 50px;
        }

            .sidebar h2{
                padding: 6px 6px 6px 30px;
                text-decoration: none;
                font-size: 26px;
                color: #fff;
                display: block;
                transition: 0.3s;
            }

            .sidebar .nav-link {
                padding: 6px 6px 6px 30px;
                text-decoration: none;
                font-size: 18px;
                color: #fff;
                display: block;
                transition: 0.3s;
            }

                .sidebar .nav-link:hover {
                    color: yellow !important;
                }

        .content {
            transition: margin-left .5s;
            padding: 16px;
            margin-left: 230px;
        }
        .toggleButton {
            font-size: 20px;
            background-color: #009688;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
        }

            .toggleButton:hover {
                background-color: grey;
            }

        @media screen and (max-width: 992px) {
            .sidebar {
                width: 0;
            }

            .content {
                margin-left: 0;
            }

        }     
    </style>

<!-- Sidebar script -->
    <script>
        $(document).ready(function (){
            if(window.innerWidth < 992 )
            {
                document.getElementById("toggleButton").onclick = openSidebar;
                document.getElementById("toggleButton").innerText = "☰";
            }
            else
            {
                document.getElementById("toggleButton").onclick = closeSidebar;
                document.getElementById("toggleButton").innerText = "X";
            }
        });
        function openSidebar() {
            document.getElementById("sidebar").style.width = "230px";
            document.getElementById("content").style.marginLeft = "230px";
            document.getElementById("toggleButton").onclick = closeSidebar;
            document.getElementById("toggleButton").innerText = "X";
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.width = "0";
            document.getElementById("content").style.marginLeft = "0";
            document.getElementById("toggleButton").onclick = openSidebar;
            document.getElementById("toggleButton").innerText = "☰";
        }
    </script>

</head>
<body>
<!-- NavBar -->
    <div id="NAV">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="index.php" style="color: white">
                <img src="imgs/logo.png" width="30" height="30" />
                E-Library
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php" style="color: white">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" id="AboutUs" href="index.php" style="color: white; cursor: pointer">About Us</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" id="ViewBooks" href="viewbooks.php" style="color: white; cursor: pointer">View Books</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" id="UserLogin" href="userlogin.php" style="color: white; cursor: pointer">User Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" id="AdminLogin" href="adminlogin.php" style="color: white; cursor: pointer">Admin Login</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" id="SignUp" href="register.php" style="color: white; cursor: pointer">Sign Up</a>
                    </li>
                    <li class="nav-item active">
                        <form action="#" method="POST">
                            <input class="nav-link" id="Logout" type="submit" name="Logout" value="Logout" style="color: white; cursor: pointer; background: none!important; border: none;"></input>
                        </form>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" id="member" href="profile.php" style="color: white; cursor: pointer">Hello <?php echo $_COOKIE['name']; ?></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" id="admin" href="admindashboard.php" style="color: white; cursor: pointer">Hello Admin</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>