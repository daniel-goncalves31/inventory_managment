let table;

$(document).ready(function(){

    //Get the data from the mysql database and put into the datatable
    fetchDataTable()

    //Add new supplier
    add()

    //Mask for the CPF or CNPJ field
    maskCpfCnpj()
})

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
}

/**
 * Add a new supplier in the mysql database
 */
function add() {

    $('#addForm').parsley()

    $('#addForm').on('submit', function(event){

        event.preventDefault()        

        $.ajax({
            type: 'POST',
            data: $('#addForm').serialize(),
            url: 'php/add_supplier.php',
            success: function(response){

                alert(response)
                $('#addModal').modal('hide')
                $('#addForm').reset()
                table.ajax.reload(null, false)

            },
            error: function(response){
                alert(response)
            }
        }) // /ajax
    }) // /on submit
} // / function add

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

}