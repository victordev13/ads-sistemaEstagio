function validaTipoUsuario(){
	var tipoUsuario = document.getElementById("tipoUsuario");
	var campoCpf = document.getElementById("campoCpf");
	var campoUsuario = document.getElementById("campoUsuario");
	if(tipoUsuario.value == 0){
		campoCpf.style.display="block";
		campoUsuario.style.display="none";
		campoUsuario.value="";
	}else if(tipoUsuario.value == 1){
		campoUsuario.style.display="block";
		campoCpf.style.display="none";
		campoCpf.value="";
	}
}

