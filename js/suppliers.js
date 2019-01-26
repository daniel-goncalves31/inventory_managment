let table;

$(document).ready(function(){

    //Get the data from the mysql database and put into the datatable
    fetchDataTable()

    add()
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

function add() {

    $('#addForm').on('submit', function(event){

        $.validate()

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