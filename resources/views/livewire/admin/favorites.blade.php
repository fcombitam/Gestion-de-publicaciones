<div class="card">

    <div class="card-header">
        <input type="text" class="form-control" placeholder="Busqueda" wire:model="search">
    </div>
    @if($posts->count())
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
                    @foreach($posts as $post)
                        <tr>

                                <td>{{$post->user->id}}</td>
                                <td>{{$post->user->name}}</td>
                                <td>{{$post->name}}</td>
                                <td>{{$post->id}}</td>
                                <td width="10px">
                                     @can('admin.posts.destroy')
                                    <form action="{{route('admin.posts.destroy',$post)}}" method="POST">
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

        <div class="card-footer">
            {{$posts->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No existen registros...</strong>
        </div>
    @endif
</div>