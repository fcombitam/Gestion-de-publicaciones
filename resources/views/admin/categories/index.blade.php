@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@can('admin.categories.create')
<a href="{{route('admin.categories.create')}}" class="btn btn-secondary btn-sm float-right">Agregar Categoria</a>
@endcan
    <h1>Lista de categorias</h1>
@stop

@section('content')

@if(session('info'))

    <div class="alert alert-success">

        <strong>{{session('info')}}</strong>
        
    </div>

@endif
    


    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($categories as $category)

                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td width="10px">
                                @can('admin.categories.edit')
                                <a href="{{route('admin.categories.edit',$category)}}" class="btn btn-primary btn-sm">Editar</a>
                                @endcan
                            </td>
                            <td width="10px">
                                @can('admin.categories.destroy')
                                <form action="{{route('admin.categories.destroy',$category)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                @endcan
                            </td>
                        </tr>


                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@stop