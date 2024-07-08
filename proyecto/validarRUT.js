function checkRut(rut) {
    // Despejar Puntos y Guión
    var valor = rut.replace(/[.-]/g, '');
    
    // Aislar Cuerpo y Dígito Verificador
    var cuerpo = valor.slice(0, -1);
    var dv = valor.slice(-1).toUpperCase();
    
    // Si no cumple con el mínimo de caracteres
    if (cuerpo.length < 7) {
        return false;
    }
    
    // Calcular Dígito Verificador
    var suma = 0;
    var multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for (var i = cuerpo.length - 1; i >= 0; i--) {
        // Obtener su Producto con el Múltiplo Correspondiente
        suma += parseInt(cuerpo.charAt(i)) * multiplo;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if (multiplo < 7) {
            multiplo++;
        } else {
            multiplo = 2;
        }
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    var dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv === 'K') ? 10 : dv;
    dv = (dv === '0') ? 11 : dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvEsperado != dv) {
        return false;
    }
    
    return true;
}
