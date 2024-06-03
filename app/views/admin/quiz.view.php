<?php include "header.php" ?>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="mb-3">
                                <h2><?php echo $module['title'] ?> Modules</h2>
                                <form action="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>/quiz"  method="POST">
                                <table>
                                        <tr>
                                            <td>
                                                <Input id="question" type="text" class="form-control" name="question" placeholder="Question">
                                            </td>
                                            <td><div style="width: 25px;"></div></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </td>
                                        </tr>
                                    </table>
                                    </form>
                            </div>
        <form action="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>" method="post">
            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Question</th>
                                    <th data-sort-ignore="true">Delete</th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($quiz as $index => $question) {    
                                ?>
                                <tr>
                                    <td>
                                      <?php echo $index+1?>
                                    </td>
                                    <td id="question">
                                      <?php echo $question['question']  ?>
                                    </td>
                                    <td>
                                        <input id="id" name="delete[]" type="checkbox" value="<?php echo $question['id']?>">
                                    </td>
                                    <td class="text-right">
                                        <button onclick="handleEditBtn(this)" class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal">Edit</button>
                                        <a href="" class="btn btn-success btn-sm">Answer</a>
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
                                    <form action="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>/quiz/edit" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit Quiz</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="question">Question</label> <input type="text" name="question" id="question-edit" placeholder="Enter question" class="form-control"></div>
                                            <div class="form-group"><input style="display: none;" type="text" name="id" id="id-edit" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Quiz</button>
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
                                    var title = parent.querySelector('#question');
                                    var id = parent.querySelector("#id");


                                    var titleField = document.getElementById('question-edit');
                                    var idField = document.getElementById('id-edit');

                                    titleField.value = title.innerHTML.trim();
                                    idField.value = id.value;
                                }
                            </script>


<?php require_once "footer.php" ?>


