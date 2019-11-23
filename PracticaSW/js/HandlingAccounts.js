function borrarUsuario(email){
	if(confirm('¿Seguro que desea borrar/activar a este usuario?')){
		location.href='../php/RemoveUser.php?email='+email;
	}
}
function cambiarEstado(email){
	if(confirm('¿Seguro que desea borrar/activar a este usuario?')){
		location.href='../php/ChangeState.php?email='+email;
	}	
}