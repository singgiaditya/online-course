<?php include "app/views/admin/header.php" ?>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="mb-3">
                                <h2>Courses</h2>
                                <a href="./course/create">Create a new Course</a>
                            </div>
        <form action="/onlineCourse/admin/course/delete" method="post">
            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th data-hide="phone"></th>
                                    <th data-hide="phone">Title</th>
                                    <th data-hide="phone">Description</th>
                                    <th data-hide="phone">Price</th>
                                    <th data-hide="phone">Category</th>
                                    <th data-hide="phone">Delete</th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                            <?php foreach ($courses as $index => $course) { ?>
                                <tr>
                                    <td>
                                      <?php echo $index+1 ?>
                                    </td>
                                    <td>
                                        <img src="/onlineCourse/public/storage/<?php echo $course['picture'] ?>" style="height: 50px;">
                                    </td>
                                    <td>
                                      <?php echo $course['title'] ?>
                                    </td>
                                    <td>
                                        <?php echo $course['description'] ?>  
                                    </td>
                                    <td>
                                        Rp.<?php echo $course['price'] ?>
                                    </td>
                                    <td><?php echo $categories[$index]['category'] ?></td>
                                    <td>
                                        <input name="delete[]" type="checkbox" value="<?php echo $course['id'] ?>">
                                    </td>
                                    <td class="text-right">
                                        <a href="/onlineCourse/admin/course/<?php echo $course['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
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
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>


<?php require_once "app/views/admin/footer.php" ?>


