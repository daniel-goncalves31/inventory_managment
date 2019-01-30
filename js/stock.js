//dataTable variable
let table; 
//product id variable
let stockId = null;

$(document).ready(function(){

    //Get the data from the mysql database and put into the datatable
    fetchDataTable()

    //form validation
    $('#form').parsley()

    // On hide/close modal
    $('#modal').on('hide.bs.modal', function(){
        $('#form')[0].reset()
        $('#form').parsley().reset()

        stockId = null
    })

    // on hide-close modal CSV
    $('#file-modal').on('hide.bs.modal', function(){
        $('#csv_form')[0].reset()
    })


    //Add new product
    add_updated()

    importCsv()

    getSuppliers()

    $('#table').dataTable().on('xhr.dt', function(){

    })

    // --- Notification systen
    // --- add product on the stock


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
            url: 'php/fetch_stock.php',
            type: 'POST'
            //handle errors
        }
    })
} // function fetchDataTable

/**
 * Add or Update a product in the mysql database
 */
function add_updated() {

    // on form submit
    $('#form').on('submit', function(event){

        event.preventDefault()
    
        // check the id value for verify if is insert or update
        let url = stockId === null ? 'php/add_stock.php' : 'php/edit_stock.php'
        let text = stockId === null ? 'Added' : 'Updated'
        let data = stockId === null ? $('#form').serialize() : $('#form').serialize() + '&id=' + stockId
        
        console.log(data) //add product/stock
        /*$.ajax({
            type: 'POST',
            data: data,
            url: url,
            success: function(result){

                if(result === 'OK') {
                    myAlert('Product ' + text + ' Succesfully', 'Success', 'green', 1, 'success')
                    $('#modal').modal('hide')
                    table.ajax.reload(null, false)    

                } else {
                    myAlert(result, 'Error', 'red', 0, 'danger')
                }

            },
            error: function(result){
                
                myAlert(result, 'Error', 'red', 0, 'danger')
            }

        }) // /ajax*/

    }) // /on submit

} // / function add

/**
 * Remove the product of the mysql database
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
                        url: 'php/delete_stock.php',
                        success: function(result){
            
                            if(result === 'OK') {
                                myAlert('Product deleted Succesfully', 'Success', 'green', 1, 'success')
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
 * Function to edit the product
 */
function openEditModal(id, row) {
    
    $('.modal-title').text('Edit Product')

    //fill up the modal with the product data
    $('#name').val(table.rows(row).data()[0][0])
    $('#cpf').val(table.rows(row).data()[0][1])
    $('#salary').val(table.rows(row).data()[0][2])

    //convert date to Y-m-d
    let date = table.rows(row).data()[0][3].split('/')
    $('#hir_date').val(date[2] + '-' + date[1] + '-' + date[0])

    if(table.rows(row).data()[0][4].search('Active') > 0) {
        $('#status').val(1)
    } else {
        $('#status').val(0)
    }

    stockId = id
    
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
 * Function that allows import CSV file and put into mysql database
 */
function importCsv(){

    $('#csv_form').on('submit', function(event){

        event.preventDefault()

        let csv = $('#csv_file').val()
        
        if(csv.search('.csv') > 0 || csv !== "") {

            $.ajax({
                type: 'POST',
                url: 'php/import_csv_stock.php',
                data: new FormData(this),
                contentType:false,
                cache:false,
                processData:false,

                success: function(result){
    
                    if(result.search('Total') === 0) {
                        myAlert('File Imported successfully </br>' + result, 'Success', 'green', 1, 'success')
                        $('#file-modal').modal('hide')
                        table.ajax.reload(null, false)    
    
                    } else {
                        alert('error')
                        myAlert(result, 'Error', 'red', 0, 'danger')
                    }
    
                },
                error: function(result){
                    
                    myAlert(result, 'Error', 'red', 0, 'danger')
                }

            })// /ajax

        } else {

            myAlert('Please select a CSV file for continue', 'Error', 'red', 0, 'danger')
        }

    }) // btn_csv.click

} // /function importCsv

/**
 * Get the list of suppliers for put into combobox
 */
function getSuppliers(){

    // on show modal
    $('#modal').on('shown.bs.modal', function(){

        $('#sale_price').attr('type', 'number')
        $('#amount').attr('type', 'number')
        $('#min_amount').attr('type', 'number')
    
        $.ajax({
            type: 'POST',
            url: 'php/get_suppliers.php',
    
            success: function(result){

                result = JSON.parse(result)

                // transform the input field into a combobox
                $('#supplier').inputpicker({
                    data:result,
                    fields: [
                        //{name:'id', text:'ID'},
                        {name:'name', text:'Supplier'},
                        {name:'cpf_cnpj', text:'CPF/CNPJ'}
                    ],
                    autoOpen: true,
                    headShow: true,
                    filterOpen: true,
                    fieldText : 'name',
                    fieldValue: 'id'
                    
                })
            },
            error: function(result){
                
                myAlert(result, 'Error', 'red', 0, 'danger')
            }
    
        })// /ajax
        
    }) // on show modal

    
} // function 