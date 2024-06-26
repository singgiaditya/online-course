<?php include('header.php'); ?>

<div class="wrapper wrapper-content">
            <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Courses</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo count($courses) ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Course Complete</h5>
                        </div>
                        <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $courseComplete?></h1>
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
                                    <h1 class="no-margins"><?php echo $courseComplete?></h1>
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
                                    <h1 class="no-margins"><?php echo $post ?></h1>
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
                                    <th data-hide="phone"></th>
                                    <th data-hide="phone">Title</th>
                                    <th data-hide="phone">Description</th>
                                    <th data-hide="phone">Category</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php   foreach ($courses as $key => $course) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $key+1 ?>
                                    </td>
                                    <td>
                                      <img height="60" src="/onlineCourse/public/storage/<?php echo $course['picture'] ?>" alt="">
                                    </td>
                                    <td>
                                      <?php echo $course['title']  ?>
                                    </td>
                                    <td>
                                        <?php echo $course['description']  ?>
                                    </td>
                                    <td>
                                        <?php echo $course['category']  ?>
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