// objet d'automatisation de la validation
let validationProvider;

$(document).ready(function(){
    initValidation('addPhotoForm');
});
function initValidation(formId) {
    validationProvider = new ValidationProvider(formId);
    validationProvider.addControl("Title", validate_Title);
    validationProvider.addControl("Description", validate_Description);
}
function validate_Title(){
    let TBX_Title = document.getElementById("Title");

    if (TBX_Title.value === "")
        return "Titre manquant";

    return "";
}

function validate_Description(){
    let TBX_Description = document.getElementById("Description");

    if (TBX_Description.value === "")
        return "Description manquante";

    return "";
}

