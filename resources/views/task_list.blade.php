@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Task List</div>
                <div class="card-body">
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    <a class="btn btn-info" href="{{ route('tasks.create') }}" id="createNewPost"> Create New Task</a><br><br>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Task</th>
            <th>Description</th>
            <th>Status</th>
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
<script type="text/javascript">

$(function () {
        $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            ajax: "{{ route('tasks.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
</script>
@endsection
