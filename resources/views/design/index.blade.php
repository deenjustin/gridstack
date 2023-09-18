@extends('layout.metronic')
@section('page','Content List')
@section('content')

<div class="row ">
    <div class="col-md-12">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('success') }}
            </div>
            @endif

    </div>

    <div class="col-md-12">
        <a href="{{ url('content/create') }}" class="btn btn-primary btn-sm pull-right">Create Design</a>
        <br><br><br>
    </div>
    <div class="col-md-12">
        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5px !important;"></th>
                    <th>Content Name</th>
                    <th style="width: 200px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($designs as $design)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $design->cname }}</td>
                    <td>
                        <form action="{{ url('') }}/content/{{encrypt( $design->id )}}" method="post">
                            @csrf
                            @method('DELETE')

                            <a class="btn btn-info btn-sm text-white" onclick="window.open('{{ url('') }}/content/{{encrypt( $design->id )}}','popUpWindow','height=500,width=500,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('') }}/content/{{encrypt( $design->id )}}/edit"  class="btn btn-warning btn-sm text-white">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                            </a>
                            <button href=""  class="btn btn-danger btn-sm " type="submit">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
    $page='content';
</script>
@include('layout.datatable')
@endsection
