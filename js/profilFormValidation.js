// objet d'automatisation de la validation
let validationProvider;

$(document).ready(function(){
    initValidation('profilForm');
});
function initValidation(formId) {
    validationProvider = new ValidationProvider(formId);
    validationProvider.addControl("Name", validate_Name);
    validationProvider.addControl("Email", validate_Email);
    validationProvider.addControl("Password", validate_Password);
    validationProvider.addControl("Confirm", validate_Confirm);
}
function validate_Name(){
    let TBX_Name = document.getElementById("Name");

    if (TBX_Name.value === "")
        return "Nom d'usager manquant";

    return "";
}
function validate_Email(){
    let TBX_Email = document.getElementById("Email");
    let EmailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if (TBX_Email.value === "")
        return "Courriel manquante";

    if (!EmailRegex.test(TBX_Email.value))
        return "Courriel invalide";

    return "";
}
function validate_Password(){
    return "";
}
function validate_Confirm(){
    let TBX_Confirm = document.getElementById("Confirm");
    let TBX_Password = document.getElementById("Password");
    if (TBX_Confirm.value != TBX_Password.value)
        return "Différent du mot de passe."
    return "";
}

