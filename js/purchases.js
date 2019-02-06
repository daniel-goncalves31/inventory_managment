//dataTable variable
let table = null 
//purchase id variable
let purchaseId = null

$(document).ready(function(){

    //Get the data from the mysql database and put into the datatable
    fetchDataTable()

    //form validation
    $('#form').parsley()

    // On hide/close modal
    $('#modal').on('hide.bs.modal', function(){
        $('#form')[0].reset()
        $('#form').parsley().reset()

        purchaseId = null
    })

    //Add new purchase
    add_updated()

}) // /document.ready

/**
 * Function for fetch and get the data from mysql database
 */
function fetchDataTable(){
    table = $('#table').DataTable({
        responsive: true,
        processing: true,
        dom: "Bfrtip",
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5',
            'colvis'
        ],
        order: [],
        ajax: {
            url: 'php/fetch_purchase.php',
            type: 'POST'
            //handle errors
        }
    })
} // function fetchDataTable

/**
 * Add or Update a purchase in the mysql database
 */
function add_updated() {

    //when the add modal is opened get the products name from the database
    $('#openAddModal').on('click', function () {

        getProducts()

        $('#modal').modal('show')

    })

    // on form submit
    $('#form').on('submit', function(event){

        event.preventDefault()
        
        // check the id value for verify if is insert or update
        let url = purchaseId === null ? 'php/add_purchase.php' : 'php/edit_purchase.php'
        let text = purchaseId === null ? 'Added' : 'Updated'
        let data = $('#form').serialize() + '&id=' + purchaseId

        $.ajax({
            type: 'POST',
            data: data,
            url: url,
            success: function(result){

                if(result === 'OK') {
                    myAlert('Purchase ' + text + ' Succesfully', 'Success', 'green', 1, 'success')
                    $('#modal').modal('hide')
                    table.ajax.reload(null, false)    

                } else {
                    myAlert(result, 'Error', 'red', 0, 'danger')
                }

            },
            error: function(result){
                
                myAlert(result, 'Error', 'red', 0, 'danger')
            }
        }) // /ajax
    }) // /on submit
} // / function add

/**
 * Remove the purchase of the mysql database
 * @param {*} id 
 */
function del(id) {

    $.confirm({
        title: 'Do you really want to delete this record?',
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
                    console.log('yes')
                    $.ajax({

                        type: 'POST',
                        data: {'id': id},
                        url: 'php/delete_purchase.php',
                        success: function(result){
            
                            if(result === 'OK') {
                                myAlert('Purchase deleted Succesfully', 'Success', 'green', 1, 'success')
                                table.ajax.reload(null, false)    
            
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
}

/**
 * Function to edit the purchase
 */
function openEditModal(id, row) {
    
    $('.modal-title').text('Edit Purchase')

    //fill up the modal with the purchase data
    //convert date to Y-m-d
    let date = table.rows(row).data()[0][2].split('/')
    $('#date').val(date[2] + '-' + date[1] + '-' + date[0])
    $('#price').val(table.rows(row).data()[0][3].split('$ ')[1])
    $('#amount').val(table.rows(row).data()[0][4].split(' ')[0])

    getProducts(row)


    purchaseId = id
    
    // show the modal
    $('#modal').modal('show')


} // /function edit

/**
 * Display the alerts and the dialogs
 */
function myAlert(content, title, color, icon, button) {

    let icons = ['fas fa-times', 'fas fa-check', 'fas fa-exclamation-triangle', 'fas fa-question']

    $.alert({
        title: title,
        content: content,
        closeIcon: true,
        draggable: true,
        columnClass: 'col-md-4',
        backgroundDismiss: true,
        escapeKey: true,
        theme: 'modern',
        animation: 'scale',
        closeAnimation: 'RotateXR',
        type: color,
        typeAnimated: true,
        closeIcon: 'fas fa-times',
        icon: icons[icon],
        buttons: {
            ok: {
                text: 'OK',
                btnClass: 'btn-' + button                
            }
        }

    }) // /alert


} // /function myAlert

/**
 * Get the list of suppliers for put into combobox
 */
function getProducts(row = null) {

    $.ajax({
        type: 'POST',
        url: 'php/get_products.php',

        success: function (result) {

            $('#product').html(result)

            if (row !== null) {
                //Put the current product in the product field
                $('#product').val(table.rows(row).data()[0][0].split('$')[1])
            }
        },
        error: function (result) {

            myAlert(result, 'Error', 'red', 0, 'danger')
        }

    }) // /ajax


} // function getSuppliers
