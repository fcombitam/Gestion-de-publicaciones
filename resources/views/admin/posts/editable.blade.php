@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')
@if(session('info'))

    <div class="alert alert-success">

        <strong>{{session('info')}}</strong>
        
    </div>

@endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($post,['route' => ['admin.posts.update', $post],'autocomplete'=>'off', 'files' => true, 'method' =>'put']) !!}

                
                {!! Form::hidden('status', 2) !!}

                <div class="form-group">
                    {!! Form::label('name','Nombre') !!}
                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese nombre de Producto']) !!}


                    @error('name')

                        <span class="text-danger">{{$message}}</span>

                    @enderror

                </div>

                <div class="form-group">
                    {!! Form::label('slug','Slug') !!}
                    {!! Form::text('slug',null,['class'=>'form-control','placeholder'=>'Ingrese Slug de Producto','readonly']) !!}

                    @error('slug')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('precio','Precio') !!}
                    {!! Form::number('precio',null,['class'=>'form-control','placeholder'=>'Ingrese precio de Producto (solo numeros)']) !!}

                    @error('precio')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('cantidad','Cantidad') !!}
                    {!! Form::number('cantidad',null,['class'=>'form-control','placeholder'=>'Ingrese cantidad de Producto']) !!}

                    @error('cantidad')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category_id','Categoria') !!}
                    {!! Form::select('category_id',$categories,null,['class'=>'form-control']) !!}

                    @error('category_id')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>

                <div class="form-group">
                    
                    <p class="font-weight-bold">Etiquetas</p>

                    @foreach($tags as $tag)
                        <label class="mr-2">
                            {!! Form::checkbox('tags[]',$tag->id,null) !!}
                            {{$tag->name}}
                        </label>
                    @endforeach

                    @error('tags')
                        <br>
                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>

                
                    
                <div class="row mg-3">
                    <div class="col">
                        <div class="image-wrapper">
                            @isset($post->image)
                            <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">
                            @else
                            <img id="picture" src="https://cdn.pixabay.com/photo/2022/01/23/08/49/cat-6960183_960_720.jpg" alt="">
                            @endisset
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('file','Imagen que se mostrara en el post') !!}
                            {!! Form::file('file',['class' => 'form-controlfile','accept' => 'image/*']) !!}

                            @error('file')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description','Descripcion') !!}
                    {!! Form::text('description',null,['class'=>'form-control','placeholder'=>'Ingrese descripcion de Producto']) !!}

                    @error('description')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>

                 <div class="form-group">
                    {!! Form::label('long_description','Descripcion larga') !!}
                    {!! Form::textarea('long_description',null,['class'=>'form-control','placeholder'=>'Ingrese descripcion larga de Producto']) !!}

                    @error('long_description')

                        <span class="text-danger">{{$message}}</span>

                    @enderror
                </div>
                {!! Form::submit('Actualizar Producto',['class'=>'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <style>
        .image-wrapper{
            position:  relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

@section('js')
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
            });
        });

        ClassicEditor
        .create( document.querySelector( '#long_description' ) )
        .catch( error => {
            console.error( error );
        } );

        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection