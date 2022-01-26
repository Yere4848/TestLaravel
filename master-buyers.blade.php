<!DOCTYPE html>
<html>
<head>
    <title>Test Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
</head>
<style type="text/css">
    .container{
        margin-top:150px;
    }
    h4{
        margin-bottom:30px;
    }
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Test Laravel 8</h4>
                </div>
                <div class="row">
                    <div class="col-md-6 text-left mb-5">
                        <!-- <a href="/product/cetak_pdf" class="btn btn-primary" target="_blank">CETAK PDF</a> -->
                        <!-- <a class="btn btn-primary" href="{{ URL::to('/product/pdf') }}">Export to PDF</a> -->
                    </div>
                    <div class="col-md-6 text-right mb-5">
                        <a class="btn btn-success" href="javascript:void(0)" id="createNewBuyer"> Create New Buyer</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>BuyerID</th>
                                <th>BuyerName</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
   
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="buyerForm" name="buyerForm" class="form-horizontal">
                    <!-- <input type="hidden" name="buyerID" id="buyerID"> -->

                    <div class="form-group">
                        <label for="buyerID" class="col-sm-2 control-label">Buyer ID</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="buyerID" name="buyerID" placeholder="Enter Buyer ID" value="" maxlength="50">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buyerName" class="col-sm-2 control-label">Buyer Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="buyerName" name="buyerName" placeholder="Enter Buyer Name" value="" maxlength="50" required="">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</body>
    
<script type="text/javascript">
    $(function () {
     
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('buyers.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                // {data: 'buyerID', name: 'buyerID'},
                {data: 'buyerName', name: 'buyerName'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        }); 

        $('#createNewBuyer').click(function () {
            $('#saveBtn').val("create-buyer");
            $('#buyerForm').trigger("reset");
            $('#modelHeading').html("Create New Buyer");
            $('#ajaxModel').modal('show');
        });
    
    $('body').on('click', '.editBuyer', function () {
        var buyerID = $(this).attr("data-id");
        $.get("{{ route('buyers.index') }}" +'/' + buyerID +'/edit', function (data) {
            $('#modelHeading').html("Edit Buyer");
            $('#saveBtn').val("edit-buyer");
            $('#ajaxModel').modal('show');
            $('#buyerID').val(data.buyerID);
            $('#buyerName').val(data.buyerName);
            $("#buyerID").attr('readonly','readonly');
        })
    });
    
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');
    
        $.ajax({
            data: $('#buyerForm').serialize(),
            url: "{{ route('buyers.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#buyerForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });

    $('body').on('click', '.deleteBuyer', function (){
        var buyerID = $(this).attr("data-id");
        var result = confirm("Are You sure want to delete !");
        if(result){
            $.ajax({
                type: "DELETE",
                url: "{{ route('buyers.store') }}"+'/'+buyerID,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }else{
            return false;
        }
    });


    
});
</script>
</html>