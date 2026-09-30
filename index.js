  function validSearchTerm() {
    const inputSearchValue = document.getElementById('search')?.value;
    if(!inputSearchValue) clearForm(false);
}

function clearForm(useConfirm = true) {
    const reloadPage = () => window.location='index.php';

    if(!useConfirm) reloadPage();

    if(useConfirm && confirm("Estas seguro que quieres cancelar la busqueda")) {
        reloadPage();
    } 
}