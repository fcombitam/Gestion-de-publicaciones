<x-app-layout>
	<div class="container py-8">
		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
			@foreach($posts as $post)
				<article class="w-full h-80 bg-cover bg-center @if($loop->first) md:col-span-2 @endif" style="background-image: url(@if($post->image){{Storage::url($post->image->url)}}@else https://cdn.pixabay.com/photo/2018/12/06/16/12/birds-3860034_960_720.jpg @endif);">
					<div class="w-full h-full px-8 flex flex-col justify-center">
						<div>
							@foreach($post->tags as $tag)
								<a href="{{route('posts.tag', $tag)}}" class="inline-block px-3 h-6 text-white rounded-full" style="background-color: {{$tag->color}}">{{$tag->name}}</a>
							@endforeach
						</div>
					
					
						<h1 class="text-4xl text-black leading-8 font-bold mt-2">
							<a href="{{route('posts.show', $post)}}">
								{{$post->name}}
							</a> 

							
						
						</h1>
						<h1>
							<a href="">Precio: {{$post->precio}}</a><br>
							<a href="">Cantidad: {{$post->cantidad}}</a>
						</h1>
						@auth
						<a href="{{route('posts.favorites', $post)}}" class="text-white font-bold py-2 px-4 rounded w-24 mt-10" style="background-color: #1d4ed8;font-size: 12px;">+ favoritos</a>
						@else
						<a href=""></a>
						@endauth


						
                            
                        
					</div>

					
				</article>

			@endforeach
		</div>
		<div class="mt-4">
			{{$posts->links()}}
		</div>

	</div>
</x-app-layout>