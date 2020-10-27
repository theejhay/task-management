
<!DOCTYPE html>
<html>
<head>
    <title>Manage Task</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>
<body>

<div class="row" style="padding-left: 50px;">
    <div class="col-md-10 offset-md-2">

        <h3 class="text-center mb-4"> Manage Task </h3>

        <a href="/home" class="btn btn-sm btn-info"> Dashboard </a>

        @include('flash-message')

        <a href="/create-task" class="btn btn-sm btn-info"> Create task <span class="fa fa-plus-circle"></span></a><br><br>
        <table id="table" class="table table-bordered">
            <thead>
            <tr>
                <th width="30px">#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Priority </th>
                <th>Project</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="tablecontents">
            @foreach($tasks as $task)
                <tr class="row1" data-id="{{ $task->id }}" id="tr_{{$task->id}}">
                <td class="pl-3"><i class="fa fa-sort"></i></td>
                    <td>{{ $task->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ ucfirst($task->priority) }}</td>
                    <td>{{ $task->project->title }}</td>
                    <td>{{ date('d-m-Y h:m:s',strtotime($task->created_at)) }}</td>
                    <td><a href="/edit-task/{{ $task->id }}" class="btn btn-sm btn-info"> Edit </a>
                        <a href="remove-task/{{ $task->id }}" class="btn btn-danger btn-sm"
                           data-tr="tr_{{$task->id}}"
                           data-toggle="confirmation"
                           data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                           data-btn-ok-class="btn btn-sm btn-danger"
                           data-btn-cancel-label="Cancel"
                           data-btn-cancel-icon="fa fa-chevron-circle-left"
                           data-btn-cancel-class="btn btn-sm btn-default"
                           data-title="Are you sure you want to delete ?"
                           data-placement="left" data-singleton="true">
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#table").DataTable();

        $( "#tablecontents" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index+1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('task-sortable') }}",
                data: {
                    order: order,
                    _token: token
                },
                success: function(response) {
                    if (response.status === "success") {
                        console.log(response);

                    } else {
                        console.log(response);
                    }
                }
            });
        }
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $('[data-toggle=confirmation]').confirmation({

            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
</body>
</html>
