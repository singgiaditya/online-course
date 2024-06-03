<?php include "header.php" ?>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="mb-3">
                                <h2><?php echo $course['title'] ?> Modules</h2>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Add New Module
                                </button>
                            </div>
                            <!-- modal -->
                            <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add New Module</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="title">Title</label> <input type="text" name="title" id="title" placeholder="Enter title" class="form-control"></div>
                                            <div class="form-group"><label for="content">Content</label> <input type="file" name="content" id="content" placeholder="Enter content" class="form-control"></div>
                                            <div class="form-group"><label for="video">Video</label> <input type="text" name="video" id="video" placeholder="Enter youtube video link" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Module</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->
        <form action="/onlineCourse/admin/course/<?php echo $course['id']?>/module/delete" method="post">
            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th data-hide="phone">Title</th>
                                    <th data-hide="phone">Content</th>
                                    <th data-hide="phone">Video</th>
                                    <th data-hide="phone">Delete</th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($modules as $index => $module) {    
                                ?>
                                <tr>
                                    <td>
                                      <?php echo $index+1?>
                                    </td>
                                    <td id="title">
                                      <?php echo $module['title']  ?>
                                    </td>
                                    <td>
                                        <a  href="/onlineCourse/public/storage/<?php echo $module['content']  ?>">Download Module</a>
                                    </td>
                                    <td>
                                    <iframe id="video" width="220" height="115"
                                    src="<?php echo $module['video']  ?>">
                                    </iframe>
                                    </td>
                                    <td>
                                        <input id="id" name="delete[]" type="checkbox" value="<?php echo $module['id']?>">
                                    </td>
                                    <td class="text-right">
                                        <button onclick="handleEditBtn(this)" class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal">Edit</button>
                                        <a href="/onlineCourse/admin/course/<?php echo $course['id']?>/module/<?php echo $module['id']?>/quiz" class="btn btn-success btn-sm">Quiz</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <button type="submit" class="btn btn-primary" style="margin-left: 95%;">Delete</button>
                        </form>
                        <!-- edit modal -->
                        <div class="modal inmodal" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form action="/onlineCourse/admin/course/<?php echo $course['id'] ?>/module/edit" method="post" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit Module</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="title">Title</label> <input type="text" name="title" id="title-edit" placeholder="Enter title" class="form-control"></div>
                                            <div class="form-group"><label for="content">Content</label> <input type="file" name="content" id="content-edit" placeholder="Enter content" class="form-control"></div>
                                            <div class="form-group"><label for="video">Video</label> <input type="text" name="video" id="video-edit" placeholder="Enter youtube video link" class="form-control"></div>
                                            <div class="form-group"><input style="display: none;" type="text" name="id" id="id-edit" class="form-control"></div>
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
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>


                            <script>
                                function handleEditBtn(el) {
                                    var parent = el.parentNode.parentNode;
                                    var title = parent.querySelector('#title');
                                    var video = parent.querySelector("#video");
                                    var id = parent.querySelector("#id");


                                    var titleField = document.getElementById('title-edit');
                                    var videoField = document.getElementById('video-edit');
                                    var idField = document.getElementById('id-edit');

                                    titleField.value = title.innerHTML.trim();
                                    videoField.value = video.src;
                                    idField.value = id.value;
                                }
                            </script>


<?php require_once "footer.php" ?>


