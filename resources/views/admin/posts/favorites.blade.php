@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <a href="{{route('admin.posts.create')}}" class="btn btn-secondary btn-sm float-right">Agregar Producto</a>
@stop

@section('content')

@if(session('info'))

    <div class="alert alert-success">

        <strong>{{session('info')}}</strong>
        
    </div>

@endif
    <div class="card">

    <div class="card-header">
        <input type="text" class="form-control" placeholder="Busqueda" wire:model="search">
    </div>
    @if($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Categoria</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                        <tr>

                                <td>{{$post->name}}</td>
                                <td>{{$post->cantidad}}</td>
                                <td>{{$post->precio}}</td>
                                <td>{{$post->category->name}}</td>
                                <td width="10px">
                                    <a href="{{route('posts.show',$post)}}" class="btn btn-primary btn-sm">Detalle</a>
                                </td>
                                <td width="10px">
                                     
                                    <form action="{{route('admin.posts.eliminate',$post)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                    
                                </td>
                            </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>

        <div class="card-footer">
            {{$posts->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No existen registros...</strong>
        </div>
    @endif
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop