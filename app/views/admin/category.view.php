<?php include "header.php" ?>

<div class="wrapper wrapper-content animated fadeInRight ecommerce">
<div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div>
                                <form method="post">
                                    <table>
                                        <tr>
                                            <td>
                                                <Input type="text" class="form-control" name="category">
                                            </td>
                                            <td><div style="width: 25px;"></div></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </div>
        <form>
            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th data-hide="phone">Category</th>
                                    <th data-hide="phone"></th>
                                    <th class="text-right" data-sort-ignore="true">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $index => $category) {
                                    ?>
                                <tr>
                                    <td>
                                       <?php echo $index+1 ?>
                                    </td>
                                    <td>
                                        <input id="category" style="border: none;" type="text" name="category[]" value=<?php echo '"'.$category['category'].'"' ?> disabled>
                                    </td>
                                    <td>
                                        <input name="id[]" type="hidden" value=<?php echo '"'.$category['category'].'"'?>>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <button type="button" onclick="deleteHandler(this)" class="btn-white btn btn-xs">delete</button>
                                            <button type="button" onclick="editHandler(this)" class="btn-white btn btn-xs">Edit</button>
                                        </div>
                                    </td>
                                </tr>
                                <?php };?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
<script>
    function editHandler(el){
        var parent = el.parentNode.parentNode.parentNode;
        var category = parent.querySelector('#category')
        category.removeAttribute('disabled');
        category.style.border = "1px solid black";
        console.log(category);
    }

    function deleteHandler(el){
        
        swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal({
                                    title: "Good job!",
                                    text: "You clicked the button!",
                                    type: "success",
                                    closeOnConfirm:false,
                                },
                            function(isConfirm) {
                                if (isConfirm) {
                                    
                                }
                            }
                            );
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
    }
</script>
<!-- Sweet alert -->
<script src="../public/js/plugins/sweetalert/sweetalert.min.js"></script>

<?php include "footer.php" ?>


