<table class='table table-hover'>
	<thead>
		<tr>
			<th>id</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>Correo</th>
			<th>Ban</th>
			<th>Fecha de ban</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($bannedusers as $banneduser)
		<tr>
			<td>{{ $banneduser->userid }}</td>
			<td>{{ $banneduser->username }}</td>
			<td>{{ $banneduser->userlastname }}</td>
			<td>{{ $banneduser->email }}</td>
			<td>{{ $banneduser->reason }}</td>
			<td>{{ $banneduser->date }}</td>
			<td><input class='btn btn-primary remove-user-ban' type='button' data-value='{{ $banneduser->userid }}' value='Quitar ban'></td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $bannedusers->render() !!}