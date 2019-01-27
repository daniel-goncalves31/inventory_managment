//dataTable variable
let table; 
//supplier id variable
let supplierId;

$(document).ready(function(){

    //Get the data from the mysql database and put into the datatable
    fetchDataTable()

    //form validation
    $('#form').parsley()

    // On hide/close modal
    $('#modal').on('hide.bs.modal', function(){
        $('#form')[0].reset()
        $('#form').parsley().reset()

        supplierId = ""
    })

    //Add new supplier
    add_updated()

    //Mask for the CPF or CNPJ field
    maskCpfCnpj()

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
            url: 'php/fetch_supplier.php',
            type: 'POST'
            //handle errors
        }
    })
} // function fetchDataTable

/**
 * Add a new supplier in the mysql database
 */
function add_updated() {

    // on form submit
    $('#form').on('submit', function(event){

        event.preventDefault()
        
        let url = supplierId === "" ? 'php/add_supplier.php' : 'php/edit_supplier.php'
        let text = supplierId === "" ? 'Added' : 'Updated'
        let data = supplierId === "" ? $('#form').serialize() : $('#form').serialize() + '&id=' + supplierId

        console.log(url)
        $.ajax({
            type: 'POST',
            data: data,
            url: url,
            success: function(result){

                //decode the result
                result = JSON.parse(result)

                if(result === 'OK') {
                    myAlert('alert', 'Supplier ' + text + ' Succesfully', 'Success', 'green', 1, 'success')
                    $('#modal').modal('hide')
                    table.ajax.reload(null, false)    

                } else {
                    myAlert('alert', result, 'Error', 'red', 0, 'danger')
                }

            },
            error: function(result){
                
                myAlert('alert', result, 'Error', 'red', 0, 'danger')
            }
        }) // /ajax
    }) // /on submit
} // / function add

/**
 * Function to edit the supplier
 */
function openEditModal(id, row) {
    
    $('.modal-title').text('Edit Supplier')

    //fill up the modal with the supplier data
    $('#name').val(table.rows(row).data()[0][0])
    $('#cpf_cnpj').val(table.rows(row).data()[0][1])
    $('#email').val(table.rows(row).data()[0][2])
    if(table.rows(row).data()[0][3].search('Active') > 0) {
        $('#status').val(1)
    } else {
        $('#status').val(0)
    }

    supplierId = id
    
    // show the modal
    $('#modal').modal('show')


} // /function edit

/**
 * Perform the mask for the field
 */
function maskCpfCnpj() {

    let options = {
        onKeyPress: function (cpf, ev, el, op) {
            let masks = ['000.000.000-000', '00.000.000/0000-00'];
            $('#cpf_cnpj').mask((cpf.length > 14) ? masks[1] : masks[0], op);
        }
    }
    
    $('#cpf_cnpj').length > 11 ? $('#cpf_cnpj').mask('00.000.000/0000-00', options) : $('#cpf_cnpj').mask('000.000.000-00#', options);

} // function maskCpfCnpj

/**
 * Display the alerts and the dialogs
 */
function myAlert(type, content, title, color, icon, button) {

    let icons = ['fas fa-times', 'fas fa-check', 'fas fa-exclamation-triangle', 'fas fa-question']

    if (type === 'alert') {

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

    } else if (type === 'confirm') {

        $.confirm({
            title: title,
            content: content,
            closeIcon: true,
            draggable: true,
            columnClass: 'col-md-4',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            escapeKey: true,
            theme: 'modern',
            animation: 'scale',
            closeAnimation: 'RotateXR',
            type: color,
            typeAnimated: true,
            closeIcon: 'fas fa-times',
            icon: icons[3],
            buttons: {
                yes: {
                    text: 'Yes',
                    btnClass: 'btn-Blue',
                    action: function(){}
                },
                no: {
                    text: 'No',
                    btnClass: 'btn-Red'
                }
            }

        }) // /confirm

    } // / if-else

} // /function myAlert