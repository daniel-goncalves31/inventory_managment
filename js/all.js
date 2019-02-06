$(document).ready(function(){

    onAjaxSend()

    onAjaxComplete()
    
    logOut()

}) // document.ready

/**
 * function for perform the logout process and redirect to the login page
 */
function logOut() {

    $('#logout').on('click', function(e){

        $.confirm({
            title: 'Do you really want to LogOut ?',
            closeIcon: true,
            draggable: true,
            columnClass: 'col-md-4',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            escapeKey: true,
            theme: 'modern',
            animation: 'scale',
            closeAnimation: 'RotateXR',
            type: 'red',
            typeAnimated: true,
            closeIcon: 'fas fa-times',
            icon: 'fas fa-question',
            buttons: {
                yes: {
                    text: 'Yes',
                    btnClass: 'btn-blue',
                    action: function(){
    
                        $.ajax({
                            type: 'POST',
                            data: {'yes': 'yes'},
                            url: 'php/logout.php',
                            success: function(result){
                
                                if(result === 'OK') {
                                    
                                    window.location.href = 'login.php'
                
                                } else {
                                    myAlert(result, 'Error', 'red', 0, 'danger')
                                }
                
                            },
                            error: function(result){
                                
                                myAlert(result, 'Error', 'red', 0, 'danger')
                            }
    
                        }) // /ajax
    
                    }// /yes-action
                },
                no: {
                    text: 'No',
                    btnClass: 'btn-red'
                }
            }
    
        }) // /confirm

    }) // onclick
    
} // function logout

/**
 * function to be executed before tje ajax request is send
 */
function onAjaxSend() {
    $(document).ajaxSend(function(event, xhr, opt){

        $('button').attr('disabled', 'true')
    })
}

/**
 * function to be executed after the ajax request is completed
 */
function onAjaxComplete() {
    $(document).ajaxComplete(function(event, xhr, opt){
        
        $('button').removeAttr('disabled')
    })
}