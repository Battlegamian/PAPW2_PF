<table class='table table-hover'>
	<thead>
		<tr>
			<th>id</th>
			<th>Nombre</th>
			<th>Ban</th>
			<th>Fecha de ban</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bannedvideos as $bannedvideo)
		<tr>
			<td>{{ $bannedvideo->videoid }}</td>
			<td>{{ $bannedvideo->name }}</td>
			<td>{{ $bannedvideo->reason }}</td>
			<td>{{ $bannedvideo->date }}</td>
			<td><input class='btn btn-primary remove-ban' type='button' data-value='{{ $bannedvideo->videoid }}' value='Quitar ban'></td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $bannedvideos->render() !!}