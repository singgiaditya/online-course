<?php require_once "app/views/admin/header.php" ?>

    <div class="wrapper wrapper-content animated fadeInRight">


<div class="row">
    <div class="col-lg-12">

        <div class="ibox product-detail">
            <div class="ibox-content">
                <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-5">


                        <div class="product-images">

                            <div>
                                <div  style="height: 400px;">
                                    <img id="img" src="/onlineCourse/public/storage/<?php echo $course['picture'] ?>" style="height: 100%; width: 100%; background-color: gainsboro;">
                                </div>
                                <input onchange="file_changed()" name="image" id="image" class="btn btn-success" type="file" style="width: 100%; margin-top: 12px;">
                                </div>
                        </div>

                    </div>
                    <div class="col-md-7">

                        <div>
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="<?php echo $course['title'] ?>">
                        </div>
                        <div>
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"><?php echo $course['description'] ?></textarea>
                        </div>
                        <div>
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" class="form-control" value="<?php echo $course['price'] ?>">
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <select name="category" class="form-control">
                                <?php
                                foreach ($categories as $category) { ?>
                                <option value="<?php echo $category['id']?>" <?php if($category['id'] == $course['id_category']) echo 'selected' ?>><?php echo $category['category']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        
                        <div style="margin-top: 25px;">
                            <p>
                                <button class="btn btn-primary " type="submit"><i class="fa fa-check"></i>&nbsp;Save</button>
                            </p>
                        </div>



                    </div>
                </div>
                </form>


            </div>
        </div>

    </div>
</div>




</div>

    <script src="/onlineCourse/public/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/onlineCourse/public/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="/onlineCourse/public/js/inspinia.js"></script>
    <script src="/onlineCourse/public/js/plugins/pace/pace.min.js"></script>

    <!-- slick carousel-->
<script src="/onlineCourse/public/js/plugins/slick/slick.min.js"></script>

<script>
    $(document).ready(function(){


        $('.product-images').slick({
            dots: true
        });

    });

    function file_changed(){
    var selectedFile = document.getElementById('image').files[0];
    var img = document.getElementById('img')

    var reader = new FileReader();
    reader.onload = function(){
        img.src = this.result
    }
    reader.readAsDataURL(selectedFile);
    }

</script>

<?php require_once "app/views/admin/footer.php" ?>