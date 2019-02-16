// products selecteds
let selectedProducts = []
// products already in the cart
let cartProducts = []

$(document).ready(function(){

  // activate the tooltip
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]',
    html: true,
  })
  
  //transform the normal input into a multiselect dropdown input
  $('.selectpicker').selectpicker()
  
  getProducts()

  addToCart()

  // //Modal
  // $('.modal').on('show.bs.modal', openImageModal)
  // $(window).on("resize", function () {
  //   $('.modal:visible').each(openImageModal)
  // })
    
})

/**
 * Get a list of products from the database and put into the dropdown
 */
function getProducts() {

  $.ajax({
    type: 'POST',
    url: 'php/get_products.php',
    data: {sale: 'add_sale'},

    success: function (result) {
        
        $('.selectpicker').html(result)
        $('.selectpicker').selectpicker('refresh')

        getClients()

    },
    error: function (result) {

        myAlert(result, 'Error', 'red', 0, 'danger')
    }

  }) // /ajax

} // /function getProduct

/**
 * Get the list of clients from database
 */
function getClients() {

  $.ajax({
    type: 'POST',
    url: 'php/get_clients.php',

    success: function (result) {
        
        $('#clientName').html(result)

    },
    error: function (result) {

        myAlert(result, 'Error', 'red', 0, 'danger')
    }

  }) // /ajax

} // /function getClients

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

function addToCart(){

  $('#btnAddToCart').on('click', function(){

    selectedProducts = $('.selectpicker').val().map(Number)
    
    if(selectedProducts.length > 0) {

      let arr = arrayDiff(selectedProducts, cartProducts)
      
      arr.forEach(item => {

        $.ajax({
          type: 'POST',
          url: 'php/add_cart.php',
          data: {id: item},
          success: response => {

            response = JSON.parse(response)
            if(response['resp'] === 'OK') {

              $(response['content']).appendTo('tbody')
              cartProducts.push(item)
              $('.selectpicker').selectpicker('val', '')

            } else {
              myAlert(response['resp'], 'Error', 'red', 0, 'danger')
            }
          },
          error: response => {
            myAlert(response['resp'], 'Error', 'red', 0, 'danger')
          }

        }) // /ajax

      }) // /foreach

    }// /if

  })// /on.click

}// /function addToCart

/**
 * Return a array with only items that is in selectedProducts and not is in the cartProducts 
 */
function arrayDiff(selectedProducts, cartProducts) {
  let newArr = []

  selectedProducts.forEach(item => {
    if(cartProducts.indexOf(item) === -1) {
      newArr.push(item)
    }

  })

  return newArr
}


/**
 * Change the product quantity and the total
 * @param {*} input 
 */
function quantityAndTotalHandle(input) {

    let price = input.parent().siblings('#price').text().split('$ ')[1]
    let quantity = input.val()

    if(quantity > Number(input.attr('max'))) {
      input.val(Number(input.attr('max')))
      
    } else if(quantity < Number(input.attr('min'))) {
      input.val(Number(input.attr('min')))
    }

    quantity = input.val()
    let total = price * quantity

    input.parent().siblings('#total').text('$ ' + total)

}

/**
 * Remove the @param button row of table
 * @param {*} button 
 */
function removeRow(button) {

  button.parent().parent().parent().remove()

}


