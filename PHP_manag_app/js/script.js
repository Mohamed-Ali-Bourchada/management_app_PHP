function testAlpha(str) {
    
    var regexAlpha = /[a-zA-Z]/;
    return regexAlpha.test(str);
}

    function formM() {
        var codemat = document.getElementById('codemat').value;
        var libelle = document.getElementById('libelle').value;
        var coef = document.getElementById('coef').value;

   

        if (!testAlpha(codemat)|| codemat.length!=3) {
            alert("code matiere doit etre 3 alpha .");
            return false;
        }

        if (!testAlpha(libelle)) {
            alert("libelle doit etre alpha");
            return false;
        }

        if (isNaN(coef) || parseFloat(coef) != coef) {
            alert("Le coefficient doit être un nombre flottant.");
            return false;
        }
    }
function formE(){
    var numep = document.getElementById('numep').value;
    var dateep = document.getElementById('dateep').value;
    var lieu = document.getElementById('lieu').value;
    var codemat = document.getElementById('codemat').value;
    if(numep==""){
        alert("donner le num epreuve svp")
        return false
    }
    if(dateep==""){
        alert("donner la date svp")
        return false
    }
    if(lieu==""){
        alert("donner le lieu svp")
        return false
    }
    if(codemat==""){
        alert("donner le code matiere svp")
        return false
    }
   
}

