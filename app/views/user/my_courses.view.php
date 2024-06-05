<?php include "header.php" ?>
<div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <?php foreach ($courses as $key => $course) {
                ?>
                <div class="col-md-3">
                    <div class="ibox">
                        <div class="ibox-content product-box">
                        <div class="product-imitation" style="background-image: url('/onlineCourse/public/storage/<?php echo $course['picture'] ?>');">
                            </div>
                            <div class="product-desc">
                                <small class="text-muted"><?php echo $course['category'] ?></small>
                                <a href="/onlineCourse/my/course/<?php echo $course['id_course'] ?>" class="product-name"><?php echo $course['title'] ?></a>
                                <div class="small m-t-xs">
                                    <?php echo $course['description'] ?>
                                </div>
                                <div class="m-t text-righ">
                                    <a href="/onlineCourse/my/course/<?php echo $course['id_course'] ?>" class="btn btn-xs btn-outline btn-primary">Info <i class="fa fa-long-arrow-right"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
</div>
<?php include "footer.php" ?>
