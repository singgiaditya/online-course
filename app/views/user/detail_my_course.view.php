<?php include 'header.php' ?>

<div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Status<small class="m-l-sm  btn 
                        <?php if($course['status'] == 'uncomplete'){
                            echo 'btn-warning';
                        }else if($course['status'] == 'complete'){
                            echo 'btn-primary';
                        }else if($course['status'] == 'review'){
                            echo 'btn-success';
                        } ?>
                         btn-xs"><?php echo $course['status'] ?></small></h5>
                         <div class="text-right"><a href="/onlineCourse/course/<?php echo $id ?>/forum" class="btn btn-primary">Forum</a></div>
                    </div>
                    <div class="ibox-content">
                        <h2>
                            <?php echo $course['title']?>
                        </h2>
                        <p>
                            <?php echo $course['description'] ?>                            
                        </p>
                        <form action="/onlineCourse/my/course/<?php echo $id ?>/project" method="post" style="max-width: 25%;">
                            <div style="margin-bottom: 12px;">
                                <input type="text" name="project" class="form-control" placeholder="link github" value="<?php echo $course['final_project'] ?>">
                            </div>
                            <input style="display: none;" type="text" name="id" class="form-control" value="<?php echo $course['id'] ?>">
                            <div class="text-right">
                                <button type="submit" class="btn btn-success" <?php if($course['status'] == 'complete' || $course['status'] == 'review') echo 'disabled' ?> >Submit Final Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h2>Modules</h2>
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                <tr>
                                    <th data-toggle="true">No.</th>
                                    <th data-hide="phone">Title</th>
                                    <th data-hide="phone">Content</th>
                                    <th data-hide="phone">Video</th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                    <th class="text-center">Score</th>
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
                                    <iframe id="video" width="220" height="115" allowfullscreen="true"
                                    src="<?php echo $module['video']  ?>">
                                    </iframe>
                                    </td>
                                    <td class="text-right">
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#quizModal<?php echo $index?>">Quiz</button>
                                    </td>
                                    <td class="text-center"><?php if (isset($scores[$index])) {
                                        echo $scores[$index];
                                    }else{echo 0;}?>/100</td>
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
                            </table>>
                            <?php foreach ($modules as $index => $module) {
                             ?>
                            <!-- modal  -->
                            <div class="modal inmodal" id="quizModal<?php echo $index?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                    <form action="/onlineCourse/my/course/<?php echo $id ?>/quiz" method="post">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Quiz</h4>
                                        </div>
                                        <div class="modal-body">
                                        <input type="text" style="display: none;" name="module" value="<?php echo $module['id'] ?>" >
                                            <?php foreach ($question[$index] as $key => $quiz) {
                                            ?>
                                            <div class="form-group">
                                                <p><?php echo $quiz['question'] ?></p>
                                                <select class="form-control" name="answer[]">
                                                <?php foreach($answer[$index][$key] as $baris => $value){ ?>
                                                <option value="<?php echo $value['correct']?>"><?php echo $value['answer'] ?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                            <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end modal  -->
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>
