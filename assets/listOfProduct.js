import './styles/listOfProduct.scss';
import $ from "jquery";

$(document).ready( function (e) {

    let typeProduct = document.querySelectorAll('.product__unit_product[data-type-of-product]');

    typeProduct.forEach(function(product) {
        document.querySelector(".subtitle_"+product.dataset.typeOfProduct).setAttribute("style", "display: flex;");
    });
});