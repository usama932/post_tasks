<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Title</td>
			<td>{{$post->title}}</td>
		</tr>
		<tr>
			<td>Body</td>
			<td>{{$post->body}}</td>
		</tr>
		
		<tr>
			<td>Created at</td>
			<td>{{$post->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>