// objet d'automatisation de la validation
let validationProvider;

$(document).ready(function() {
    initValidation('loginForm');
});
function initValidation(formId) {
    validationProvider = new ValidationProvider(formId);
    validationProvider.addControl("Email", validate_Email);
    validationProvider.addControl("Password", validate_Password);
}
function validate_Email(){
    let TBX_Email = document.getElementById("Email");
    let EmailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (TBX_Email.value === "")
        return "Courriel manquant";

    if (!EmailRegex.test(TBX_Email.value))
        return "Courriel invalide";

    return "";
}
function validate_Password(){
    let TBX_Password = document.getElementById("Password");

    if (TBX_Password.value === "")
        return "Mot de passe manquant";

    return "";
}


