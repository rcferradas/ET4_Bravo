/*Comprueba si el campo es null o 0 y devuelve false, si existe algo devuelve true*/
function comprobarVacio( campo ) {
	if ( ( campo.value == null ) || ( campo.value.length == 0 ) ) {//comprueba si es null o 0
            campo.style.border = "2px solid red";
            return false;
	} else {//si existe algo devuelve true
            campo.style.border = "2px solid green";
            return true;
	}
}

/*Comprueba que sólo haya caracteres alfanuméricos*/
/*abc-es una expresión regular que comprueba si el carácter es alfanuméricos de principio a fin*/
function comprobarAlfabetico(campo, size) {
	var abc =/^\w*$/;
	if(!comprobarExpresionRegular(campo,abc,size)){//comprueba que la expresión enviada en abc sea cumplida por el campo enviado si no lo hace devuelve false
	return false;
	}
	return true;
}

/*Comprueba que el texto sea alfabético y que pueda tener espacios*/
/*comprueba- es una variable que se utiliza para la comprobación y observa que no haya carácteres no alfabéticos (también permite que haya espacios entre palabras)*/
function comprobarTexto( campo, size ) {
	var comprueba=/^[a-záéíóú]{1}[a-záéíóú ]*[a-záéíóú]$/i;
	if(!comprobarExpresionRegular(campo,comprueba,size)){//comprueba que la expresión enviada en comprueba sea cumplida por el campo enviado si no lo hace devuelve false
		return false;
	}//envía true en caso contrario
        else {
            campo.style.border = "2px solid green";
            return true;
	}
}

/*Comprueba si cumple la expresión reguladora enviada,si tiene valores diferentes al enviado devuelve false*/
function comprobarExpresionRegular(campo, exprreg, size) {
	if(!comprobarVacio(campo)){//si está vacío devuelve false
		return false;
	}
	else if ( exprreg.test( campo.value ) == false ) {//si no cumple la expresión regular devuelve false
            campo.style.border = "2px solid red";
            return false;
	}
	else if(!comprobarTamaño(campo,size)){//si es mayor que el tamaño indicado devuelve false
	return false;
	}//si cumple todas las condiciones devuelve true
        else {
            campo.style.border = "2px solid green";
            return true;
	}
}

/*Comprueba que no se exceda el tamaño máximo*/
function comprobarTamaño( campo, size ) {
	if(!comprobarVacio(campo)){//si está vacío devuelve false
		return false;
	}
	else if ( campo.value.length > size ) {//si no está vacío devuelve false si excede el tamaño máximo
            campo.style.border = "2px solid red";
            return false;
	}//si está correcto el tamaño y no excede devuelve true
        else {
            campo.style.border = "2px solid green";
            return true;
	}
}
/*Comprueba que el número real enviado está entre el valor menor y mayor, y que no sobreexceda los números decimales permitidos*/
/*Decimal-comprueba que el número enviado no sobreexceda los números decimales permitidos*/	
function comprobarReal(campo, numerodecimales, valormenor, valormayor) {
	var decimal= campo.value.substring( campo.value.indexOf('.' , ',')+ 1, campo.value.length);	
	
	if (!comprobarVacio(campo)){//comprueba si está vacío
		return false;
	}
	else if (campo.value < valormenor || campo.value > valormayor){//comprueba que le dígito enviado se haya entre sus valores menor y mayor
            campo.style.border = "2px solid red";
            return false;
	}
	else if ( decimal.length > numerodecimales){//si el numero de decimales que tiene el dígito es mayor que el numero de decimales indicado produce un error
            campo.style.border = "2px solid red";		
            return false;
	}
        else {
            campo.style.border = "2px solid green";
            return true;
	}
}

/*Comprueba que el telefono tenga un formato nacional o internacional*/
/*telef- permite comprobar que el teléfono tenga un formato de 9 dígitos, 34 y 9 dígitos, +34 y 9 dígitos o 0034 y 9 dígitos*/
function comprobarTelf( campo ) {
	var telef = /^(\+34|0034|34)?([0-9]){9}$/;
	if(!comprobarExpresionRegular(campo,telef,13)){//comprueba que la expresión enviada en telef sea cumplida por el campo enviado si no lo hace devuelve false
	return false;
	}
        else {
            campo.style.border = "2px solid green";
            return true;
	}
}

/*Comprueba si el DNI enviado está bien escrito*/
/*letras-Comprueba que la letra del DNI enviado es correcta*/
function comprobarDni(campo) {
	var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
	if(!comprobarVacio(campo)){//comprueba si está vacío
		return false;
	}
	else if( !(/^\d{8}[A-Z]$/.test(campo.value)) ) {//comrueba que el DNI esté formado por 8 digitos y una letra
                    campo.style.border = "2px solid red";		
                    return false;
		
	}
	else if(campo.value.charAt(8) != letras[(campo.value.substring(0, 8))%23]) {//en el caso de que tenga los 8 digitos y la letra comprueba que la letra sea correcta
                    campo.style.border = "2px solid red";		
                    return false;
	}
        campo.style.border = "2px solid green";
	return true;
}
/*Comprueba si el CIF enviado está bien escrito*/
/*CIF-Comprueba que la expresión regular del CIF esté bien hecha*/
    function comprobarCIF( campo ) {
	var CIF = /^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/;
	if(!comprobarExpresionRegular(campo,CIF,9)){//comprueba que la expresión enviada en CIF sea cumplida por el campo enviado si no lo hace devuelve false
	return false;
	}
        else if ( (/[PQRSW]/.test(campo.value.charAt(0))) || ((/0/.test(campo.value.charAt(1))) && (/0/.test(campo.value.charAt(2))) ) ) {//en el caso de que empiece por PQRSW o sus dos primeros valores sean 00 comprobará si el codigo de control es una letra en caso erroneo devuelve false
        campo.style.border = "2px solid green";
        return true;//da siempre true hasta nuevo aviso
        }
        else if ( (/[ABEH]/.test(campo.value.charAt(0))) ) {//en el caso de que empiece por ABEH comprobará si el codigo de control es una digito en caso erroneo devuelve false
        campo.style.border = "2px solid green";
        return true;//da siempre true hasta nuevo aviso
        }
        else {// en el caso de que todo esté correctamente comprobará si el codigo de control es el correcto
            campo.style.border = "2px solid green";
            return true;
	}
}
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Empresas_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarEmpresasADD(Formu){
    var correcto=0;
	if(!comprobarCIF(Formu.CIFempresa)){//comprueba que el CIF esté correctamente escrito
            Formu.CIFempresa.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.nombreempresa,30)){//comprueba que el nombre esté correctamente escrito
            Formu.nombreempresa.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTelf(Formu.telefonoempresa)){//comprueba que el telefono esté correctamente escrito
            Formu.nombreempresa.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.localizacionempresa,50)){//comprueba que la localizacion esté correctamente escrito
            Formu.localizacionempresa.style.border = "2px solid red";		
            correcto=1;
	}                                                       	
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }	
	

	return true;
}
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Empresas_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarUsuariosADD(Formu){
    var correcto=0;
	if(!comprobarAlfabetico(Formu.login,15)){//comprueba que el CIF esté correctamente escrito
            Formu.login.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarAlfabetico(Formu.password,25)){//comprueba que el nombre esté correctamente escrito
            Formu.password.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarDni(Formu.DNI)){//comprueba que el telefono esté correctamente escrito
            Formu.DNI.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.nombre,30)){//comprueba que la localizacion esté correctamente escrito
            Formu.nombre.style.border = "2px solid red";		
            correcto=1;
	}  
	if(!comprobarTexto(Formu.apellidos,50)){//comprueba que la localizacion esté correctamente escrito
            Formu.apellidos.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTelf(Formu.telefono)){//comprueba que el telefono esté correctamente escrito
            Formu.telefono.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarExpresionRegular(Formu.email,/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/,60)){//comprueba que el telefono esté correctamente escrito
            Formu.email.style.border = "2px solid red";		
            correcto=1;
	}
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }	
	

	return true;
}
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Empresas_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarEmpresasEDIT(Formu){
    var correcto=0;
	if(!comprobarTexto(Formu.nombreempresa,30)){//comprueba que el nombre esté correctamente escrito
            Formu.nombreempresa.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTelf(Formu.telefonoempresa)){//comprueba que el telefono esté correctamente escrito
            Formu.nombreempresa.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.localizacionempresa,50)){//comprueba que la localizacion esté correctamente escrito
            Formu.localizacionempresa.style.border = "2px solid red";		
            correcto=1;
	}                                                       	
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }	
	

	return true;
}
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Empresas_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarUsuariosEDIT(Formu){
    var correcto=0;
	if(!comprobarAlfabetico(Formu.password,25)){//comprueba que el nombre esté correctamente escrito
            Formu.password.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarDni(Formu.DNI)){//comprueba que el telefono esté correctamente escrito
            Formu.DNI.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.nombre,30)){//comprueba que la localizacion esté correctamente escrito
            Formu.nombre.style.border = "2px solid red";		
            correcto=1;
	}  
	if(!comprobarTexto(Formu.apellidos,50)){//comprueba que la localizacion esté correctamente escrito
            Formu.apellidos.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTelf(Formu.telefono)){//comprueba que el telefono esté correctamente escrito
            Formu.telefono.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarExpresionRegular(Formu.email,/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/,60)){//comprueba que el telefono esté correctamente escrito
            Formu.email.style.border = "2px solid red";		
            correcto=1;
	}
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }	
	

	return true;
}
//A ESTO NI CASO






/*Comprueba si el CIF enviado está bien escrito*/
/*CIF-Comprueba que la expresión regular del CIF esté bien hecha*/
/*    function comprobarCIF( campo ) {
	var CIF = /^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/;
        var control=3;//lo utilizaremos para ver si es necesario una letra y/o numero
	if(!comprobarExpresionRegular(campo,CIF,9)){//comprueba que la expresión enviada en CIF sea cumplida por el campo enviado si no lo hace devuelve false
	return false;
	}
        else if ( (/[PQRSW]/.test(campo.value.charAt(0))) || ((/0/.test(campo.value.charAt(1))) && (/0/.test(campo.value.charAt(2))) ) ) {//en el caso de que empiece por PQRSW o sus dos primeros valores sean 00 comprobará si el codigo de control es una letra en caso erroneo devuelve false
        //campo.style.border = "2px solid purple";
        control=1;//debe ser letra
        //return false;
        }
        else if ( (/[ABEH]/.test(campo.value.charAt(0))) ) {//en el caso de que empiece por ABEH comprobará si el codigo de control es una digito en caso erroneo devuelve false
        //campo.style.border = "2px solid yellow";
        control=2;//debe ser digito
        //return false;
        }// pasado lo anterior se sabrá que está bien escrito y se debe comprobar el codigo de control
	//Quitamos el primer caracter y el ultimo digito
        
	var valueCif=campo.substr(1,campo.length-2);
 
	var suma=0;
 
	//Sumamos las cifras pares de la cadena
	for(var i=1;i<valueCif.length;i=i+2)
	{
		suma=suma+parseInt(valueCif.substr(i,1));
	}
 
	var suma2=0;
 
	//Sumamos las cifras impares de la cadena
	for(i=0;i<valueCif.length;i=i+2)
	{
		var result=parseInt(valueCif.substr(i,1))*2;
		if(String(result).length==1)
		{
			// Un solo caracter
			suma2=suma2+parseInt(result);
		}else{
			// Dos caracteres. Los sumamos...
			suma2=suma2+parseInt(String(result).substr(0,1))+parseInt(String(result).substr(1,1));
		}
	}
 
	// Sumamos las dos sumas que hemos realizado
	suma=suma+suma2;
 
	var unidad=String(suma).substr(1,1)
	unidad=10-parseInt(unidad);
        if(unidad==1){
                    campo.style.border = "2px solid purple";		
                    return true;            
        }
        else{
                    campo.style.border = "2px solid yellow";		
                    return false;            
        }
}*/
//            var sumaPar=campo.value.charAt(2)+campo.value.charAt(4)+campo.value.charAt(6);

/*
function comprobarCIF(cif) {
    var CIF_REGEX = /^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/;
    var match = cif.match( CIF_REGEX );
    var letter  = match[1],
        number  = match[2],
        control = match[3];

    var even_sum = 0;
    var odd_sum = 0;
    var n;

    for ( var i = 0; i < number.length; i++) {
      n = parseInt( number[i], 10 );

      // Odd positions (Even index equals to odd position. i=0 equals first position)
      if ( i % 2 === 0 ) {
        // Odd positions are multiplied first.
        n *= 2;

        // If the multiplication is bigger than 10 we need to adjust
        odd_sum += n < 10 ? n : n - 9;

      // Even positions
      // Just sum them
      } else {
        even_sum += n;
      }

    }

    var control_digit = (10 - (even_sum + odd_sum).toString().substr(-1) );
    var control_letter = 'JABCDEFGHI'.substr( control_digit, 1 );

    // Control must be a digit
    if ( letter.match( /[ABEH]/ ) ) {
      if(control == control_digit){
      campo.style.border = "2px solid green";
      return true;
      }
      else{
      campo.style.border = "2px solid red";
      return false;          
      }
    // Control must be a letter
    } else if ( letter.match( /[KPQS]/ ) ) {
      if(control == control_letter){
      campo.style.border = "2px solid green";
      return true;
      }
      else{
      campo.style.border = "2px solid red";
      return false;          
      }
    // Can be either
    } else {
      if(control == control_digit || control == control_letter){
      campo.style.border = "2px solid green";
      return true;
      }
      else{
      campo.style.border = "2px solid red";
      return false;          
      }
    }

  }*/