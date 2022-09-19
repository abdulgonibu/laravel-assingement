<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Responsive Sidebar Menu </title>
</head>
<style>
    li {
        list-style: none;
    }
</style>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxl-c-plus-plus'></i>
                <div class="logo_name">Abdul Goni</div>
            </div>
        </div>
        <i class='bx bx-menu' id="btn"></i>

        <ul>
            <li>
                <a href="#">
                    <i class='bx bx-search'></i>
                    <input type="text" placeholder="Search">
                </a>
                <span class="tooltip">Search</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                </a>
                <span class="tooltip">DashBoard</span>

            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">User</span>
                </a>
                <span class="tooltip">User</span>

            </li>
            <li>
                <a href="#">
                    <i class='bx bx-chat'></i>
                    <span class="links_name">Messages</span>
                </a>
                <span class="tooltip">Messages</span>

            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-analyse'></i>
                    <span class="links_name">Analytics</span>
                </a>
                <span class="tooltip">Analytics</span>

            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-folder'></i>
                    <span class="links_name">File Manager</span>
                </a>
                <span class="tooltip">Files</span>

            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cart-add'></i>
                    <span class="links_name">Order</span>
                </a>
                <span class="tooltip">Order</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-heart'></i>
                    <span class="links_name">Saved</span>
                </a>
                <span class="tooltip">Saved</span>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
                <span class="tooltip">Setting</span>
            </li>

        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="pp.jpg" alt="">
                    <div class="name_job">
                        <div class="name">Abdul Goni</div>
                        <div class="job">Web Designer</div>
                    </div>
                    <i class='bx bx-log-out' id="log_out"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="home_content">
        <div class="text">
            Home Content
        </div>
    <div>
        
    </div>

    </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector('.sidebar');
        let searchBtn = document.querySelector(".bx-search");

    </script>
</body>

</html>