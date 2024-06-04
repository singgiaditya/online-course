<?php include "header.php" ?>
<link href="/onlineCourse/public/css/plugins/footable/footable.core.css" rel="stylesheet">

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
                                    <th data-toggle="true">No.</th>
                                    <th>Question</th>
                                    <th data-hide='all' data-sort-ignore="true"></th>
                                    <th data-sort-ignore="true"></th>
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
                                        <table class="table table-stripped">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Answer</th>
                                                    <th>Is Correct</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($answer[$index] as $key => $items) {
                                                ?>
                                                <tr>
                                                <td>
                                                    <?php echo $key+1 ?>
                                                    <input style="display: none;" id="id" value="<?php echo $items['id']?>">
                                                </td>
                                                <td id="answer"><?php echo  $items['answer']?></td>
                                                <td id="correct"><?php if($items['correct'] == 0){
                                                    echo 'False';
                                                }else{
                                                    echo 'True';
                                                } ?></td>
                                                <td class="text-right">
                                                    <button onclick="handleEditAnswerBtn(this)" class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editAnswerModal">Edit</button>
                                                    <a href="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>/quiz/answer/delete?id=<?php echo $items['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <input style="display: none;" id="id" name="delete[]" type="text" value="<?php echo $question['id']?>">
                                    </td>
                                    <td class="text-right">
                                        <button onclick="handleEditBtn(this)" class="btn btn-primary btn-sm" type="button"  data-toggle="modal" data-target="#editModal">Edit</button>
                                        <button onclick="handleAnswerBtn(this)" class="btn btn-success btn-sm" type="button"  data-toggle="modal" data-target="#addAnswerModal">Add Answer</button>
                                        <a href="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>/quiz/delete?id=<?php echo $question['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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

                            <!-- add answer modal -->
                        <div class="modal inmodal" id="addAnswerModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form action="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>/quiz/answer" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Add Answer</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="answer">Answer</label> <input type="text" name="answer"  placeholder="Enter Answer" class="form-control"></div>
                                            <div class="form-group">
                                            <label for="correct">Is Correct</label>
                                            <select name="correct" class="form-control">
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                            </div>
                                            <div class="form-group"><input style="display: none;"  type="text" name="id_quiz" id="id-answer" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Answer</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal -->

                            <!-- edit answer modal -->
                        <div class="modal inmodal" id="editAnswerModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form action="/onlineCourse/admin/course/<?php echo $course?>/module/<?php echo $module['id'] ?>/quiz/answer/edit" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Edit Answer</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label for="answer">Answer</label> <input type="text" name="answer" id="answer-editAnswer"  placeholder="Enter Answer" class="form-control"></div>
                                            <div class="form-group">
                                            <label for="correct">Is Correct</label>
                                            <select id="correct-editAnswer" name="correct" class="form-control">
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                            </div>
                                            <div class="form-group"><input style="display: ;"  type="text" name="id" id="id-editAnswer" class="form-control"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit Answer</button>
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

                                function handleAnswerBtn(el) {
                                    var parent = el.parentNode.parentNode;
                                    var id = parent.querySelector("#id");

                                    var idField = document.getElementById('id-answer');
                                    

                                    idField.value = id.value;
                                }

                                function handleEditAnswerBtn(el) {
                                    var parent = el.parentNode.parentNode;
                                    var id = parent.querySelector("#id");
                                    var answer = parent.querySelector("#answer");
                                    var correct = parent.querySelector("#correct");
                                    
                                    var idField = document.getElementById('id-editAnswer');
                                    var answerField = document.getElementById('answer-editAnswer');
                                    var correctSelect = document.getElementById('correct-editAnswer');

                                    idField.value = id.value;
                                    answerField.value =answer.innerHTML.trim();

                                    if (correct.innerHTML.trim() == 'False') {
                                        correctSelect.value = 0;
                                    }else{
                                        correctSelect.value = 1;
                                    }
                                }


                            </script>

<script src="/onlineCourse/public/js/plugins/footable/footable.all.min.js"></script>


<?php require_once "footer.php" ?>

<script>
        $(document).ready(function() {

            $('.footable').footable();

        });

    </script>


