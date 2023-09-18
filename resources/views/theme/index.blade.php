@extends('layout.metronic')
@section('page','Layout List')
@section('content')

<div class="row">
    <div class="col-md-12">
            @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('success') }}
            </div>
            @endif

    </div>

    <div class="col-md-12">
        <a href="{{ url('layout/create') }}" class="btn btn-primary btn-sm pull-right">Create Layout</a>
        <br><br><br>
    </div>
    <div class="col-md-12 mb-5 ">
        <table id="example" class="table table-striped table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th style="width: 5px !important;"></th>
                    <th>File Name</th>
                    <th style="width: 200px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layouts as $layout)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $layout->fname }}</td>
                    <td>
                        <form action="{{ url('') }}/layout/{{encrypt( $layout->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-info btn-sm text-white" onclick="window.open('{{ url('') }}/layout/{{encrypt( $layout->id )}}','popUpWindow','height=500,width=700,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('') }}/layout/{{encrypt( $layout->id )}}/edit"  class="btn btn-warning btn-sm text-white">
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
        {{ $layouts->links() }}
    </div>

</div>
<script>
    $page='layout';
</script>
@include('layout.datatable')

@endsection
