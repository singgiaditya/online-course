<?php require_once 'header.php' ?>
    <div id="wrapper">
        <!-- Sidebar and other layout elements here -->

        <div id="page-wrapper" class="gray-bg">
            <!-- Navbar and other page elements here -->

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="container">
                    <h2>Detail Post</h2>

                    <form method="post" action="/onlineCourse/course/<?php echo $forum['id_course'] ?>/forum/<?php echo $forum['id'] ?>/edit">
                    <?php
                    if ($forum['id_user'] == $_SESSION['user']['id']) {
                    ?>
                    <div class="text-right" style="margin-bottom: 8px;">
                        <div class="btn-group">
                            <button onclick="handleEditBtn()" type="button" class="btn btn-warning">Edit</button>
                            <a href="/onlineCourse/course/<?php echo $forum['id_course'] ?>/forum/<?php echo $forum['id'] ?>/delete" class="btn btn-danger">Delete</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="media">
                                <img width="64" src="<?php if(isset($forum['picture'])){ echo "/onlineCourse/public/storage/".$forum['picture'];}else{ echo 'https://via.placeholder.com/150';} ?>" class="mr-3" alt="user image">
                                <div class="media-body">
                                    <h5 class="mt-0"><?php echo $forum['name'] ?></h5>
                                    <input id="edit-id" type="hidden" name="id" value="<?php echo $forum['id'] ?>" disabled>
                                    <textarea id="edit-post" name="post" class="form-control" disabled><?php echo $forum['post'] ?></textarea>
                                    <p class="card-text"><small class="text-muted">Posted by <?php echo $forum['name'] ?></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>

                    <div class="mt-4">
                        <h5>Komentar</h5>
                        <!-- comment  -->
                        <?php foreach ($comments as $key => $comment) { ?>
                        <form>
                        <div class="ibox media mb-3">
                            <div class="ibox-content media-body">
                            <?php if($comment['role'] == 'mentor'){ ?>
                            <h5 class=text-right>Mentor</h5>
                            <?php } ?>
                            <?php if($comment['id_user'] == $_SESSION['user']['id']){ ?>
                                <div class="text-right" style="margin-bottom: 8px;">
                                    <div class="btn-group">
                                        <button onclick="handleEditBtn()" type="button" class="btn btn-warning">Edit</button>
                                        <a href="" class="btn btn-danger">Delete</a>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            <?php } ?>
                            <img width="64" src="<?php if(isset($comment['picture'])){ echo "/onlineCourse/public/storage/".$comment['picture'];}else{ echo 'https://via.placeholder.com/150';} ?>" class="mr-3" alt="user image">
                                <h6 class="mt-0"><?php echo $comment['name'] ?></h6>
                                <textarea class="form-control" disabled><?php echo $comment['comment'] ?></textarea>
                            </div>
                        </div>
                        </form>
                        <?php } ?>
                        <!-- end comment  -->
                    </div>

                    <div class="mt-4">
                        <h5>Tambah Komentar</h5>
                        <form method="post">
                            <div class="form-group">
                                <label for="comment">Komentar:</label>
                                <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                            </div>
                            <input style="display: none;" name='id_course' value="<?php echo $forum['id'] ?>">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer and other layout elements here -->

        </div>
    </div>

    <script>
        function handleEditBtn(el){
            var formField = document.getElementById('edit-post');
            var idField = document.getElementById('edit-id');
            formField.removeAttribute('disabled');
            idField.removeAttribute('disabled');
        }
    </script>

<?php require_once 'footer.php' ?>
