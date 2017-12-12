@extends('layouts.admin')

@section('content')

<h1>Media</h1>

@if ($photos)

<form action="delete/media" method="post" class="form-inline">
	{{ csrf_field() }}
	{{ method_field('delete') }}
	<div class="form-group">
		<select name="checkBoxArray" id="" class="form-control">

			<option value="delete">DELETE</option>
		</select>
	</div>
	<div class="form-group">
		<input type="submit" name="delete_all" class="btn btn-primary">
	</div>
	



	<table class="table">
		<thead>
			<tr>
				<th><input type="checkbox" id="options" ></th>
				<th>ID</th>
				<th>Name</th>
				<th>Created</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($photos as $photo)
			{{-- expr --}}
			<tr>
				<td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]"" value="{{ $photo->id }}"></td>
				<td>{{ $photo->id }}</td>
				<td><img src="{{ $photo->file }}" height="80px" alt=""></td>
				<td>{{ $photo->created_at ? $photo->created_at : 'No date' }}</td>
				<td>
					<input type="hidden" name="photo" value="{{ $photo->id }}">
					<div class="form-group">
						
						<input type="submit" name="delete_single" value="Delete" class="btn btn-danger">
					</div>

{{-- 					{!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediasController@destroy', $photo->id]]) !!}
					<div class="form-group">
						{!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
					</div>
					{!! Form::close() !!} --}}
				</td>
			</tr>
			@endforeach


		</tbody>
	</table>
</form>
@endif


@endsection

@section('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		
		$('#options').click(function(){

			if(this.checked){
				$('.checkBoxes').each(function(){
					this.checked = true
				});
			}else{
				$('.checkBoxes').each(function(){
					this.checked = false
				});
			}
		});

	});
</script>
@endsection