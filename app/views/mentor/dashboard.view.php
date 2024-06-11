<?php require_once 'header.php' ?>

<div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Courses</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo 10 ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Course Complete</h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo 2?></h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Course Uncomplete</h5>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="no-margins">8</h1>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Total Post</h5>
                            <div class="ibox-tools">
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-md-6">
                                    <h1 class="no-margins">1</h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                

                <div class="row">

                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>My Courses </h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>
                            <form method="post">
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-9 m-b-xs">
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                <tr>
                                    <th data-toggle="true">No.</th>
                                    <th data-hide="phone">Course</th>
                                    <th data-hide="phone">User</th>
                                    <th data-hide="phone">Project</th>
                                    <th data-hide="phone">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <!-- table  -->
                                <?php  foreach ($user_courses as $key => $course) { 
                                ?>
                                <tr>
                                    <td>
                                      <?php echo $key+1?>
                                      <input type="text" name="id_user_course[]" value="<?php echo $course['id'] ?>">
                                    </td>
                                    <td>
                                      <?php echo $course['title']  ?>
                                    </td>
                                    <td>
                                        <?php echo $course['name']   ?>
                                    </td>
                                    <td>
                                        <a href='<?php echo  $course['final_project'] ?>'><?php echo  $course['final_project'] ?></a>
                                    </td>
                                    <td>
                                        <select class="form-control" name="status[]">
                                            <option value="uncomplete" <?php if($course['status'] == 'uncomplete') echo 'selected'  ?>>uncomplete</option>
                                            <option value="review" <?php if($course['status'] == 'review') echo 'selected'  ?>>review</option>
                                            <option value="complete" <?php if($course['status'] == 'complete') echo 'selected'  ?>>complete</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php } ?>
                                <!-- end table  -->
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="8">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table> 
                            <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

</div>

 <?php include('footer.php'); ?>
 <script>
        $(document).ready(function() {

            $('.footable').footable();

        });

</script>
<?php require_once 'footer.php' ?>