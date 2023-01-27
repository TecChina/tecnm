//uso de scrip para dar click automatico al envio del form sin que el usuario de confirmar
    window.addEventListener("load",function(){
		formulario = document.formulario;
		id = document.formulario.id;
		campoError = document.getElementById("error");
		
		id.addEventListener("input",function(){
			campoError.innerHTML= "";
		});
		id.addEventListener("change",envioAutomatico);
	});

	function enviarFormulario(e){
		e = e || window.event;	//compatibilidad explorer
		if(id.value==""){ 
			e.preventDefault(); // parar la ejecución por defecto del evento.
			campoError.innerHTML ="rellene este campo";
		}else{
			console.log("se ha procedio al envío del formulario");
		};
	};

    function envioAutomatico(){
		formulario.addEventListener("submit",enviarFormulario);
		formulario.submit();
	}

    window.onload = function envioAutomatico(){//activa el envio automatico del valor post
		formulario.addEventListener("submit",enviarFormulario);
		formulario.submit();
	}
