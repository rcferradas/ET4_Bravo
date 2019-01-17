/*La función setTimeout controla que la ventana de alerta no se quede en bucle infinito*/
/*Variable empleada para controlar el alert*/
var avisado = false;

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
	else if ( decimal.length > numerodecimales && decimal!=campo.value){//si el numero de decimales que tiene el dígito es mayor que el numero de decimales indicado produce un error//en el caso de que el numero que mandamos no haya decimales se cogerá el numero entero en decimal por eso debemos evitar esto
            campo.style.border = "2px solid red";		
            return false;
	}
        else if (campo.value < valormenor || campo.value > valormayor){//comprueba que le dígito enviado se haya entre sus valores menor y mayor
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
/*Comprueba que el CIF esté bien escrita*/
    function comprobarCIF( campo ) {
	var CIF = /^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/;//expresión que nos permite comprobar si el CIF está bien escrito
        var control=3;//lo utilizaremos para ver si es necesario una letra y/o numero
	if(!comprobarExpresionRegular(campo,CIF,9)){//comprueba que la expresión enviada en CIF sea cumplida por el campo enviado si no lo hace devuelve false
	return false;
	}
        else if ( (/[PQRSW]/.test(campo.value.charAt(0))) || ((/0/.test(campo.value.charAt(1))) && (/0/.test(campo.value.charAt(2))) ) ) {//en el caso de que empiece por PQRSW o sus dos primeros valores sean 00 comprobará si el codigo de control es una letra en caso erroneo devuelve false
        control=1;
        }
        else if ( (/[ABEH]/.test(campo.value.charAt(0))) ) {//en el caso de que empiece por ABEH comprobará si el codigo de control es una digito en caso erroneo devuelve false
        control=2;
        }// pasado lo anterior se sabrá que está bien escrito y se debe comprobar el codigo de control
	//Quitamos el primer caracter y el ultimo digito
        var sumaPar=parseInt(campo.value.substr(2,1))+parseInt(campo.value.substr(4,1))+parseInt(campo.value.substr(6,1));  
        var result=0;//para el for
        var i=0;//ya que empezaremos a coger a partir del primer numero impar        
        var sumaImpar=0;
        var sumatotal=0;
        var unidad=0;
        var codigo=0;
        var comprobar=0;//utilizaremos esto para comprobar con el dígito de control, ya que si es una letra tendremos que pasarlo a un número
 
	//Sumamos las cifras impares de la cadena
        
	  for(i=1;i<8;i=i+2){
          result=parseInt(campo.value.substr(i,1))*2;
          if(String(result).length==1){
            // Un solo caracter
            sumaImpar+=parseInt(result);
          }
          else{//Dos caracteres
          sumaImpar += parseInt(String(result).substr(0,1))+parseInt(String(result).substr(1,1));
          }
          }
	// Sumamos las dos sumas que hemos realizado
	sumatotal=sumaPar+sumaImpar;
        unidad=sumatotal%10;//nos intersa el segundo digito o en el caso de que haya sólo uno pues ese
        
        codigo =10-unidad;//conocemos el valor del codigo de controlJ = 0, A = 1, B = 2, C= 3, D = 4, E = 5, F = 6, G = 7, H = 8, I = 9
        
        if(control==2){
            comprobar=campo.value.charAt(8);
        }
        if(control==1){//si el control es 1 significa que el codigo de control debe ser una letra entre A-J, en el caso de que no sea así devuelve falso
            switch(campo.value.charAt(8)){
                case "J": comprobar = 0;
                          break;
                case "A": comprobar = 1;
                          break;
                case "B": comprobar = 2;
                          break;
                case "C": comprobar = 3;
                          break;
                case "D": comprobar = 4;
                          break;
                case "E": comprobar = 5;
                          break;
                case "F": comprobar = 6;
                          break;    
                case "G": comprobar = 7;
                          break;
                case "H": comprobar = 8;
                          break;
                case "I": comprobar = 9;
                          break;
                default: campo.style.border = "2px solid red";
                return false;
            }
        }
        if(control==3){//si el control es 3 significa que el codigo de control puede ser una letra entre A-J o un numero
            switch(campo.value.charAt(8)){
                case "J": comprobar = 0;
                          break;
                case "A": comprobar = 1;
                          break;
                case "B": comprobar = 2;
                          break;
                case "C": comprobar = 3;
                          break;
                case "D": comprobar = 4;
                          break;
                case "E": comprobar = 5;
                          break;
                case "F": comprobar = 6;
                          break;    
                case "G": comprobar = 7;
                          break;
                case "H": comprobar = 8;
                          break;
                case "I": comprobar = 9;
                          break;
                default:comprobar=campo.value.charAt(8);
            }
        }        
        if(codigo==comprobar){
            campo.style.border = "2px solid green";
            return true;    
        }
        if(codigo!=comprobar){
            campo.style.border = "2px solid red";
            return false;    
        }
}
/*Función que comprueba que la fecha fianl es mayor que la inicial y que la frecuencia es coherente entre estas*/
/*DateDiff nos permitirá hacer el calculo de días entre una fecha y la otra*/
    function comprobarFecha(fi,ff,frecuencia){
    var DateDiff = {
        inDays: function (d1, d2) {
            var t2 = d2.getTime();
            var t1 = d1.getTime();

            return parseInt((t2 - t1) / (24 * 3600 * 1000));
        }
    };
    var frecuency;//muestra los días que corresponden a la frecuencia
    switch (frecuencia.value) {//pasamos la frecuencia a un numero
        case "diaria":
            frecuency = 1;
            break;
        case "semanal":
            frecuency = 7;
            break;
        case "mensual":
            frecuency = 30;
            break;
        case "trimestral":
            frecuency = 90;
            break;
        case "anual":
            frecuency = 365;
            break;
        case "quinquenal":
            frecuency = 5475;
            break;
    }
    var d1 = new Date(fi.value);//cogemos la primera fecha
    var d2 = new Date(ff.value);//cogemos la segunda fecha
    var res=DateDiff.inDays(d1, d2);//calcula la diferencia entre las dos
    if(res>frecuency)return true;//si es mayor que la frecuencia devuelve true
    else return false;//en caso contrario false
}
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Centros_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarCentrosADD(Formu){
    var correcto=0;
        if(!comprobarTexto(Formu.nombre, 30)){
            correcto = 1;
        }
        if(!comprobarTexto(Formu.lugar, 30)){
            correcto = 1;
        }
        if(!comprobarVacio(Formu.usuarioAsignado)){
            correcto = 1;
        }
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }
	return true;
}

/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Centros_EDIT_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarCentrosEDIT(Formu){
    var correcto=0;
        if(!comprobarTexto(Formu.lugar, 30)){
            correcto = 1;
        }
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }	
	return true;
}
/*Comprueba que al menos un campo esté escrito, se envía en Centros_SEARCH_View*/
/*Campo-En el caso de que no haya ningún campo escrito se muestra un alert*/
function validarSearchCentros(Formu){
	var campo = false;
	if ( !( Formu.nombre.value == null ) && ( Formu.nombre.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if( !(Formu.lugar.value == null) && (Formu.lugar.value != 0 )) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.usuarioAsignado.value == null ) && ( Formu.usuarioAsignado.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if(campo==false){//en el caso de que estén todos los campos vacíos se muestra que hay que cubrir al menos uno
		alert("Cubra al menos un campo");
		avisado = true;
		setTimeout( 'avisado=false', 50 );
		return false;
	}
	return true;
}
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Contratos_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarContratosADD(Formu){
    var correcto=0;
        if(!comprobarVacio(Formu.centro)){
            correcto = 1;
        }
        if(!comprobarVacio(Formu.cifEmpresa)){
            correcto = 1;
        }
        if(!comprobarVacio(Formu.documento)){
            correcto = 1;
        } 
        if(!comprobarReal(Formu.importe,2,0,999999999)){
            correcto = 1;
        }        
	if(!comprobarFecha(Formu.periodoinicio,Formu.periodofin,Formu.frecuencia)){//comprueba que la fecha final esté correctamente escrito respeto a la inicial y a la frecuencia				
                alert("Fecha periodo mal introducida");
		avisado = true;
		setTimeout( 'avisado=false', 50 );
		return false;
	}
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }
	return true;
}

/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Contratos_EDIT_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarContratosEDIT(Formu){
    var correcto=0;
        if(!comprobarReal(Formu.importe,2,0,999999999)){
            correcto = 1;
        }        
	if(!comprobarFecha(Formu.periodoinicio,Formu.periodofin,Formu.frecuencia)){//comprueba que la fecha final esté correctamente escrito respeto a la inicial y a la frecuencia		
                alert("Fecha periodo mal introducida");
		avisado = true;
		setTimeout( 'avisado=false', 50 );
		return false;
	}
	if(correcto==0){	
            return true;
        }		
	else{
            return false;
        }	
	return true;
}

/*Comprueba que al menos un campo esté escrito, se envía en Contratos_SEARCH_View*/
/*Campo-En el caso de que no haya ningún campo escrito se muestra un alert*/
function validarSearchContratos(Formu){
	var campo = false;
	if ( !( Formu.centro.value == null ) && ( Formu.centro.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if( !(Formu.tipo.value == null) && (Formu.tipo.value != 0 )) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.cifEmpresa.value == null ) && ( Formu.cifEmpresa.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}        
	if ( !( Formu.periodoinicio.value == null ) && ( Formu.periodoinicio.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.periodofin.value == null ) && ( Formu.periodofin.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	} 
	if ( !( Formu.frecuencia.value == null ) && ( Formu.frecuencia.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}         
	if ( !( Formu.importe.value == null ) && ( Formu.importe.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	} 
	if ( !( Formu.estado.value == null ) && ( Formu.estado.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}         
	if(campo==false){//en el caso de que estén todos los campos vacíos se muestra que hay que cubrir al menos uno
		alert("Cubra al menos un campo");
		avisado = true;
		setTimeout( 'avisado=false', 50 );
		return false;
	}
	return true;
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
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Empresas_EDIT_view */
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

/*Comprueba que al menos un campo esté escrito, se envía en Empresas_SEARCH_View*/
/*Campo-En el caso de que no haya ningún campo escrito se muestra un alert*/
function validarSearchEmpresas(Formu){
	var campo = false;
	if ( !( Formu.cif.value == null ) && ( Formu.cif.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if( !(Formu.nombre.value == null) && (Formu.nombre.value != 0 )) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.tipo.value == null ) && ( Formu.tipo.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}        
	if ( !( Formu.telefono.value == null ) && ( Formu.telefono.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.localizacion.value == null ) && ( Formu.localizacion.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}        
	if(campo==false){//en el caso de que estén todos los campos vacíos se muestra que hay que cubrir al menos uno
		alert("Cubra al menos un campo");
		avisado = true;
		setTimeout( 'avisado=false', 50 );
		return false;
	}
	return true;
}

/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Usuarios_ADD_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarUsuariosADD(Formu){
    var correcto=0;
	if(!comprobarAlfabetico(Formu.login,15)){//comprueba que el login esté correctamente escrito
            Formu.login.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarAlfabetico(Formu.password,25)){//comprueba que el contraseña esté correctamente escrito
            Formu.password.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarDni(Formu.DNI)){//comprueba que el DNI esté correctamente escrito
            Formu.DNI.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.nombre,30)){//comprueba que la nombre esté correctamente escrito
            Formu.nombre.style.border = "2px solid red";		
            correcto=1;
	}  
	if(!comprobarTexto(Formu.apellidos,50)){//comprueba que la apellidos esté correctamente escrito
            Formu.apellidos.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTelf(Formu.telefono)){//comprueba que el telefono esté correctamente escrito
            Formu.telefono.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarExpresionRegular(Formu.email,/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/,60)){//comprueba que el email esté correctamente escrito
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
/*Comprueba que todos los campos obligatorios estén escritos y que todos los campos escritos estén cubiertos correctamente,se envía en Usuarios_EDIT_view */
/*En el momento que correcto sea 1 significará que algún campo no es correcto*/
function validarUsuariosEDIT(Formu){
    var correcto=0;
	if(!comprobarAlfabetico(Formu.password,25)){//comprueba que el contraseña esté correctamente escrito
            Formu.password.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarDni(Formu.DNI)){//comprueba que el DNI esté correctamente escrito
            Formu.DNI.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTexto(Formu.nombre,30)){//comprueba que la nombre esté correctamente escrito
            Formu.nombre.style.border = "2px solid red";		
            correcto=1;
	}  
	if(!comprobarTexto(Formu.apellidos,50)){//comprueba que la apellidos esté correctamente escrito
            Formu.apellidos.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarTelf(Formu.telefono)){//comprueba que el telefono esté correctamente escrito
            Formu.telefono.style.border = "2px solid red";		
            correcto=1;
	}
	if(!comprobarExpresionRegular(Formu.email,/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/,60)){//comprueba que el email esté correctamente escrito
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
/*Comprueba que al menos un campo esté escrito, se envía en Usuario_SEARCH_View*/
/*Campo-En el caso de que no haya ningún campo escrito se muestra un alert*/
function validarSearchUsuarios(Formu){
	var campo = false;
	if ( !( Formu.login.value == null ) && ( Formu.login.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if( !(Formu.DNI.value == null) && (Formu.DNI.value != 0 )) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.nombre.value == null ) && ( Formu.nombre.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}        
	if ( !( Formu.apellidos.value == null ) && ( Formu.apellidos.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.telefono.value == null ) && ( Formu.telefono.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}
	if ( !( Formu.email.value == null ) && ( Formu.email.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	} 
	if ( !( Formu.rol.value == null ) && ( Formu.rol.value.length != 0 ) ) {//comprueba si el campo está vacío o no
		campo=true;
	}         
	if(campo==false){//en el caso de que estén todos los campos vacíos se muestra que hay que cubrir al menos uno
		alert("Cubra al menos un campo");
		avisado = true;
		setTimeout( 'avisado=false', 50 );
		return false;
	}
	return true;
}