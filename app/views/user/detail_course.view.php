<?php require_once "header.php" ?>

    <div class="wrapper wrapper-content animated fadeInRight">


<div class="row">
    <div class="col-lg-12">

        <div class="ibox product-detail">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="product-images">
                            <div>
                                <div  style="height: 400px;">
                                    <img id="img" src="/onlineCourse/public/storage/<?php echo $course['picture'] ?>" style="height: 100%; width: 100%; background-color: gainsboro;">
                                </div>
                                </div>
                        </div>

                    </div>
                    <div class="col-md-7">

                        <div>
                            <label for="title">Title</label>
                            <div class="form-control">
                                <?php echo $course['title'] ?>
                                </div>
                        </div>
                        <div>
                            <label for="description">Description</label>
                            <div class="form-control">
                                <?php echo $course['description'] ?>
                                </div>
                        </div>
                        <div>
                            <label for="price">Price</label>
                            <div class="form-control">
                            <?php echo $course['price'] ?>
                            </div>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <div class="form-control">
                                <?php echo $course['category'] ?>
                                </div>
                        </div>
                        
                        
                        <div style="margin-top: 25px;">
                            <form action="/onlineCourse/course/<?php echo $course['id'] ?>" method="post">
                                <input style="display: none;" name="id" value="<?php echo $course['id'] ?>">
                                <button class="btn btn-primary " type="submit">Buy</button>
                            </form>
                        </div>

                    </div>
                </div>
                </form>


            </div>
        </div>

    </div>
</div>




</div>


<?php require_once "footer.php" ?>