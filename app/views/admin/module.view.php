<?php include "header.php" ?>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="mb-3">
                                <h2><?php echo $course['title'] ?> Modules</h2>
                                <a href="./course/create">Create a new Module</a>
                            </div>
        <form action="/onlineCourse/admin/course/delete" method="post">
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
                                <tr>
                                    <td>
                                      <?php 0?>
                                    </td>
                                    <td>
                                      <?php  ?>
                                    </td>
                                    <td>
                                        <?php  ?>  
                                    </td>
                                    <td><?php  ?></td>
                                    <td>
                                        <input name="delete[]" type="checkbox" value="<?php  ?>">
                                    </td>
                                    <td class="text-right">
                                        <a href="/onlineCourse/admin/course/<?php  ?>" class="btn btn-primary btn-sm">Edit</a>
                                    </td>
                                </tr>
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


<?php require_once "footer.php" ?>


