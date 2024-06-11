<?php require_once 'header.php' ?>
    <div id="wrapper">
        <!-- Sidebar and other layout elements here -->

        <div id="page-wrapper" class="gray-bg">
            <!-- Navbar and other page elements here -->

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="container">
                    <table style="width: 100%;">
                        <th></th>
                        <th class="text-right"></th>
                        <tr>
                            <td><h2>Daftar Post dalam Forum</h2></td>
                            <td class="text-right"><button class="btn btn-primary" data-toggle="modal" data-target="#postModal">+</button></td>
                        </tr>
                    </table>
                    <div class="row">
                        <!-- Post -->
                        <?php foreach ($forum as $key => $post) { ?>
                        <a href="/onlineCourse/course/<?php echo $id ?>/forum/<?php echo $post['id'] ?>">
                        <div class="col-md-4">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="media">
                                        <img width="64px" src="<?php if(isset($forum[$key]['picture'])){ echo "/onlineCourse/public/storage/".$forum[$key]['picture'];}else{ echo 'https://via.placeholder.com/150';} ?>" class="mr-3" alt="user image">
                                        <div class="media-body">
                                            <h5 class="mt-0"><?php echo $post['name'] ?></h5>
                                            <p><?php echo $post['post'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        <?php } ?>
                        <!-- end post  -->
                    </div>
                </div>
            </div>

            <!-- edit modal -->
            <div class="modal inmodal" id="postModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form action="/onlineCourse/forum/post" method="post">
                                        <div class="modal-header">
                                         <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add Post</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="post">Post</label><textarea name="post" class="form-control"></textarea></div>
                                            <div class="form-group"><input style="display: none;" type="text" name="id_course"  class="form-control" value="<?php echo $id?>"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Module</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->



<?php require_once 'footer.php' ?>