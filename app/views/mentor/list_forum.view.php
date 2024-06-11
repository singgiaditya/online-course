<?php require_once 'header.php' ?>
<body>
    <div id="wrapper">
        <!-- Sidebar and other layout elements here -->

        <div id="page-wrapper" class="gray-bg">
            <!-- Navbar and other page elements here -->

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="container">
                    <h2>Daftar Forum</h2>
                    <ul class="list-group">
                        <!-- list forum -->
                        <?php foreach ($courses as $key => $course) {
                        ?>
                        <li class="list-group-item"><a href="/onlineCourse/course/<?php echo $course['id'] ?>/forum"><?php echo $course['title'] ?></a></li>
                        <?php } ?>
                        <!-- end list forum -->
                    </ul>
                </div>
            </div>

            <!-- Footer and other layout elements here -->

        </div>
    </div>
<?php require_once 'footer.php' ?>


