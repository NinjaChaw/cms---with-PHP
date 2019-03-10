$(document).ready(function () {
    //CKEditor
    ClassicEditor
    .create( document.querySelector( '#body' ), [
        
    ] )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );
    
    //Other function
    $('#selectAllBoxes').click(function(event) {
        if(this.checked){
            $('.checkBoxes').each(function() {
            this.checked = true;
            });
        }else{
            $('.checkBoxes').each(function() {
            this.checked = false;
            });
        }
    });
});