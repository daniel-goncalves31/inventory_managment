//dataTable variable
let table = null
//product id variable
let stockId = null
// image croppie instance
let image = null
// url of the image in the database
let imageUrl = null

$(document).ready(function () {

    //Get the data from the mysql database and put into the datatable
    fetchDataTable()

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html: true,
    });
    //active the form validation
    $('#form').parsley()

    imageCroppie()

    modalsClose()

    add_updated()

    /*$('#table').dataTable().on('xhr.dt', function(){

    })*/

    // --- Notification systen


}) // /document.ready

/**
 * Function for fetch and get the data from mysql database
 */
function fetchDataTable() {

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
            type: 'POST',
            //handle errors
        }
    })

} // function fetchDataTable

/**
 * Add or Update a product in the mysql database
 */
function add_updated() {

    $('#openAddModal').on('click', function () {
        $('.show_hide').show()
        $('.show_hide input').attr('data-parsley-required', 'true')
        $('.alert').hide()

        getSuppliers()

        $('#modal').modal('show')

    })

    // on form submit
    $('#form').on('submit', function (event) {

        event.preventDefault()

        // var with all form data
        let data = new FormData(this)

        console.log($('#image').val())

        // check the id value for verify if is insert or update
        let url = stockId === null ? 'php/add_stock.php' : 'php/edit_stock.php'
        let text = stockId === null ? 'Added' : 'Updated'

        data.append('id', stockId)

        $.ajax({
            type: 'POST',
            data: data,
            url: url,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function (result) {

                if (result === 'OK') {
                    myAlert('Product ' + text + ' Succesfully', 'Success', 'green', 1, 'success')
                    $('#modal').modal('hide')
                    table.ajax.reload(null, false)

                } else {
                    myAlert(result, 'Error', 'red', 0, 'danger')
                }

            },
            error: function (result) {

                myAlert(result, 'Error', 'red', 0, 'danger')
            }

        }) // /ajax

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
                action: function () {
                    console.log('yes')
                    $.ajax({

                        type: 'POST',
                        data: {
                            'id': id
                        },
                        url: 'php/delete_stock.php',
                        success: function (result) {

                            if (result === 'OK') {
                                myAlert('Product deleted Succesfully', 'Success', 'green', 1, 'success')
                                table.ajax.reload(null, false)

                            } else {
                                myAlert(result, 'Error', 'red', 0, 'danger')
                            }

                        },
                        error: function (result) {

                            myAlert(result, 'Error', 'red', 0, 'danger')
                        }

                    }) // /ajax

                } // /yes-action
            },
            no: {
                text: 'No',
                btnClass: 'btn-red'
            }
        }

    }) // /confirm
} // function del

/**
 * Function to open the Modal with the informations of the product to edit
 */
function openEditModal(id, row) {

    $('.modal-title').text('Edit Product')

    $('.show_hide').hide()
    $('.show_hide input').removeAttr('data-parsley-required')
    $('.alert').show()

    getSuppliers(row)

    //fill up the modal with the product data
    $('#product').val(table.rows(row).data()[0][0].split('/>">')[1])
    $('#category').val(table.rows(row).data()[0][2])
    $('#sale_price').val(table.rows(row).data()[0][4].split('$ ')[1])
    $('#min_amount').val(table.rows(row).data()[0][6].split(' ')[0])
    $('#unit').val(table.rows(row).data()[0][6].split(' ')[1])

    //image url in the database
    imageUrl = table.rows(row).data()[0][0].split("src=")[1].split("' height")[0].split("'")[1]
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
 * Get the list of suppliers for put into combobox
 */
function getSuppliers(row = null) {

    $.ajax({
        type: 'POST',
        url: 'php/get_suppliers.php',

        success: function (result) {

            $('#supplier').html(result)

            if (row !== null) {
                //Put the current supplier in the supplier field
                $('#supplier').val(table.rows(row).data()[0][1].split('$')[1])
            }
        },
        error: function (result) {

            myAlert(result, 'Error', 'red', 0, 'danger')
        }

    }) // /ajax


} // function getSuppliers

/**
 * Handle the add and edit close/hide modal events
 */
function modalsClose() {

    // on hide/close the add/edit modal
    $('#modal').on('hide.bs.modal', function () {
        $('#form')[0].reset()
        $('#form').parsley().reset()

        stockId = null
    })

} // function modalsClose

/**
 * Handle the image croppie features
 */
function imageCroppie() {

    // initialize the image croppie
    image = $('#product_image').croppie({
        viewport: {width: 200, height: 200, type:'square'},
        boundary: {width: 300, height: 300},
        update: function(data) {

            //pick the image cropped and transform in BLOB for insert into the database
            image.croppie('result', {
                type: 'canvas',
                size: 'viewport',
                format: 'jpg',
                quality: 0.8,
                circle: false
            }).then(function(canvas){
                $('#image').val(canvas)
            })
        }

    }) // image croppie

    // on show/open the add/edit modal
    $('#modal').on('shown.bs.modal', function(){

        if (stockId === null) {
            imageUrl = 'images/noimage.png'
        }

        // necessary for avoid error on the modal
        image.croppie('bind', {
            url: imageUrl,
            zoom: 0.0
        })
    })

    // on change input type file-image, put the image selected in the image croppie
    $('#image_picker').on('change', function(){
        if (this.files && this.files[0]) {

            let reader = new FileReader()

            reader.onload = function (e) {
                image.croppie('bind', {
                    url: e.target.result
                })
            }
            reader.readAsDataURL(this.files[0])
        }

    }) //image-picker onChange

} // function imageCroppie