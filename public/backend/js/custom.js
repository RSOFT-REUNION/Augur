/***********
 ***********
 ***********
 Permission
 ***********
 ***********
 ***********/
$("#checkPermissionAll").click(function(){
    if($(this).is(':checked')){
        // check all the checkbox
        $('input[type=checkbox]').prop('checked', true);
    }else{
        // un check all the checkbox
        $('input[type=checkbox]').prop('checked', false);
    }
});

function checkPermissionByGroup(className, checkThis){
    const groupIdName = $("#"+checkThis.id);
    const classCheckBox = $('.'+className+' input');

    if(groupIdName.is(':checked')){
        classCheckBox.prop('checked', true);
    }else{
        classCheckBox.prop('checked', false);
    }
    implementAllChecked();
}

function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
    const classCheckbox = $('.'+groupClassName+ ' input');
    const groupIDCheckBox = $("#"+groupID);

    // if there is any occurance where something is not selected then make selected = false
    if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
        groupIDCheckBox.prop('checked', true);
    }else{
        groupIDCheckBox.prop('checked', false);
    }
    implementAllChecked();
}

function implementAllChecked() {

    //  console.log((countPermissions + countPermissionGroups));
    //  console.log($('input[type="checkbox"]:checked').length);

    if($('input[type="checkbox"]:checked').length >= ($all_permissions + $permission_groups)){
        $("#checkPermissionAll").prop('checked', true);
    }else{
        $("#checkPermissionAll").prop('checked', false);
    }
}

/***********
 ***********
 ***********
 DataTable
 ***********
 ***********
 ***********/
$('.datatable').DataTable( {
    order: [],
    language: {
        processing:     "Traitement en cours...",
        search:         "<i class=\"fa-solid fa-magnifying-glass\"></i>",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "_TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "<i class=\"fa-solid fa-backward-fast\"></i>",
            previous:   "<i class=\"fa-solid fa-backward-step\"></i>",
            next:       "<i class=\"fa-solid fa-forward-step\"></i>",
            last:       "<i class=\"fa-solid fa-forward-fast\"></i>"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
} );

/***********
 ***********
 ***********
 Autohide Alert
 ***********
 ***********
 ***********/
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove();
    });
}, 3000);


/***********
 ***********
 ***********
 TomSelect (Mettre tout les script avant celui-ci.
 ***********
 ***********
 ***********/
new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
