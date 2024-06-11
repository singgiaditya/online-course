<?php
    if ($_SESSION['user']['role'] == 'user') {
        require_once 'user/header.php';
    }else if ($_SESSION['user']['role'] == 'admin') {
        require_once 'admin/header.php';
    }else{
        require_once 'mentor/header.php';
    }
?>

    <div id="wrapper">
        <!-- Sidebar and other layout elements here -->

        <div id="page-wrapper" class="gray-bg">
            <!-- Navbar and other page elements here -->

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="ibox">
                                <form method="post" enctype="multipart/form-data">
                                <div class="ibox-content text-center">
                                    <img style="height: 300px;" id="img" src="<?php if(isset($_SESSION['user']['picture'])){ echo "/onlineCourse/public/storage/".$_SESSION['user']['picture'];}else{ echo 'https://via.placeholder.com/150';} ?>" class="rounded-circle img-fluid" alt="Profile Image">
                                    <h2 class="mt-3"><?php echo $_SESSION['user']['name']?></h2>
                                    <p class="text-muted">Role: <?php echo $_SESSION['user']['role']?></p>
                                    <input onchange="file_changed()" id="image" name="image" class="btn btn-success" type="file">
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <h3>Bio Data</h3>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Email:</strong> <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['user']['email']?>"></li>
                                        <div style="height: 12px;"></div>
                                        <li class="list-group-item"><strong>Name:</strong> <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['user']['name']?>"></li>
                                        <div style="height: 12px;"></div>
                                        <li class="list-group-item"><strong>Telephone:</strong> <input type="text" name="telephone" class="form-control" value="<?php echo $_SESSION['user']['telephone']?>"></li>
                                        <div style="height: 12px;"></div>
                                        <li class="list-group-item"><strong>Role:</strong> <input type="text" name="" class="form-control" value="<?php echo $_SESSION['user']['role']?>" disabled></li>
                                    </ul>
                                    <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>
                                    <hr>
                                    <h3>Ganti Password</h3>
                                    <form action="/onlineCourse/profile/password" method="post">
                                        <div class="form-group">
                                            <label for="currentPassword">Password Sekarang</label>
                                            <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Masukkan password sekarang">
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword">Password Baru</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Masukkan password baru">
                                        </div>
                                        <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Ganti Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer and other layout elements here -->

        </div>
    </div>

    <script>
    function file_changed(){
    var selectedFile = document.getElementById('image').files[0];
    var img = document.getElementById('img')

    var reader = new FileReader();
    reader.onload = function(){
        img.src = this.result
    }
    reader.readAsDataURL(selectedFile);
    }

    </script>


<?php require_once 'user/footer.php'?>