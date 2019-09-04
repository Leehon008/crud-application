<?php
include 'includes/header.php';
?>

<div class="container" style="margin-top:30px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-9">Teacher List</div>
                <div class="col-md-3" align="right">
                    <button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <span class="text-success" id="message_operation"></span>
              <table class="table table-striped table-bordered" id="teacher_table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Teacher Name</th>
                        <th>Email Address</th>
                        <th>Grade</th>
                        <th>View</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                  <tbody>

                  </tbody>
              </table>
            </div>
        </div>
    </div>
</div>

</body>
<script>window.jQuery || document.write(
        '<script src="./../libraries/js/jquery-slim.min.js"><\/script>')</script>
<script src="./../libraries/js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
</script>
<div class="modal" id="formModal">
    <div class="modal-dialog">
        <form method="post" id="teacher_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--modal body -->
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Teacher Name <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name" />
                           <span id="error_teacher_name" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Address<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="teacher_address" name="teacher_address"></textarea>
                                <span id="error_teacher_address" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Email Address<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="teacher_emailid" name="teacher_emailid" />
                                <span id="error_teacher_emailid" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Password<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="teacher_password" name="teacher_password" />
                                <span id="error_teacher_password" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Qualification<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="teacher_qualification" name="teacher_qualification" />
                                <span id="error_teacher_qualification" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Grade<span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <select class="form-control" id="teacher_grade_id" name="teacher_grade_id">
                                    <option value="">Select Grade</option>
                                    <?php
                                    echo load_grade_list($connect);
                                    ?>
                                </select>
                                <span id="error_teacher_grade_id" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Date Of Joining
                                <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="text" name="teacher_doj" id="teacher_doj" class="form-control" readonly/>
                                <span id="error_teacher_doj" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-md-4 text-right">Image
                                <span class="text-danger">*</span> </label>
                            <div class="col-md-8">
                                <input type="file" name="teacher_image" id="teacher_image"/>
                                <span class="text-muted">Only .jpg and .png allowed</span><br/>
                                <span id="error_teacher_image" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--modal footer -->
                <div class="modal-footer">
                    <input type="hidden" id="hidden_teacher_image" name="hidden_teacher_image"/>
                    <input type="hidden" name="teacher_id" id="teacher_id"  />
                    <input id="action" name="action" type="hidden" value="Add" />
                    <input id="button_action" name="button_action" type="submit" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        var dataTable = $('#teacher_table').DataTable({
           "processing" : true,
           "serverside" : true,
           "order" : [],
           "ajax" : {
               url : "teacher_action.php",
               type : "POST",
               data : {action : 'fetch'}
           }
        });

    $('#teacher_doj').datepicker({
       format :  'yyyy-mm-dd',
        autoclose: true,
        container: '#formModal modal-body'
    });

    function clear_field() {
        $('#teacher_form')[0].reset();
        $('#error_teacher_name').text('');
        $('#error_teacher_address').text('');
        $('#error_teacher_emailid').text('');
        $('#error_teacher_password').text('');
        $('#error_teacher_qualification').text('');
        $('#error_teacher_doj').text('');
        $('#error_teacher_image').text('');
        $('#error_teacher_grade_id').text('');
    }

    $('#add_button').click(function () {
        $('#modal_title').text('Add Teacher');
        $('#button_action').text('Add');
        $('#action').text('Add');
        $('#formModal').text('show');
        clear_field();
    });

    });
</script>
</html>