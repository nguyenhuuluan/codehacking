@extends('layouts.admin')



@section('content')


<h1>Posts</h1>
<div class="table-responsive">


	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>User</th>
				<th>Category</th>
				<th>Photo</th>
				<th>Title</th>
				<th>Body</th>
				<th>Action</th>
				<th>Created</th>
				<th>Updated</th>
			</tr>
		</thead>

		<tbody>
			@if($posts)
			@foreach ($posts as $post)
			<tr>
				<td>{{ $post->id }}</td>
				<td><a href="{{ route('posts.edit', $post->id) }}">{{ $post->user->name }}</a></td>
				{{-- <td>{{ $post->category_id }}</td> --}}

				<td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>

				{{-- <td>{{ $post->photo_id }}</td> --}}

				<td><img height="50" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}"></td>


				<td>{{ $post->title }}</td>
				<td>{{ str_limit($post->body, 10)  }}</td>
				<td><a href="{{ route('home.post', $post->id) }}" class="btn btn-success">View Post</a>
					<a href="{{ route('comments.show', $post->id) }}" class="btn btn-info">View Comments</a></td>
					<td>{{ $post->created_at->diffForhumans() }}</td>
					<td>{{ $post->updated_at->diffForhumans() }}</td>
				</tr>

				@endforeach


				@endif
			</tbody>

		</table>
	</div>

	@endsection