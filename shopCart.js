function dragstartHandler(ev) {
    ev.dataTransfer.setData("text/plain", ev.target.id);
}

function dragoverHandler(ev) {
    ev.preventDefault();
}

function dropHandler(ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text/plain");
    let elem = document.getElementById(data);
    let cost = Number(elem.childNodes[3].innerHTML.split(" ")[0]);
    let name = elem.childNodes[2].innerHTML;
    $.post("postToCart.php", {cart_action:"add", item_n:name, item_c:cost}, refreshCart);
}

function refreshCart() {
    /**
     * Sends POST request to postToCart.php to refresh shopping cart session
     * and updates the shopping card tile on the webpage
     */
    $.post("postToCart.php", {cart_action:"get_contents"}, function(res) {
        let json = JSON.parse(res);
        var cart = document.getElementById("shopping-cart");
        cart.innerHTML = '';
        for (const key in json['items']) {
            const node = document.createElement("ul");
            var num = json['items'][key];
            node.innerHTML = `<li>${key} x${num}</li>`;
            cart.appendChild(node);
        }
        cart.innerHTML += "Total: "+json['total_cost'] + " CAD";
    })
}

function clearCart() {
    /**
     * Sends POST request to postToCart.php to clear shopping cart session
     */
    $.post("postToCart.php", {cart_action: "clear"}, refreshCart);
}

function listenDragstart() {
    /**
     * Adds "dragstart" event listener to every element of class "items"
     * and attaches the dragstartHandler function as the event handler
     */
    let items = document.getElementsByClassName("items");
    for (var i=0; i<items.length; i++){
        items[i].addEventListener("dragstart", dragstartHandler); 
    }   
}

/**
 * Restores shopping cart information and 
 * adds drag event listener and handler to items displayed in browse.php
 * only if the page loaded is browse.php
 */
document.addEventListener("DOMContentLoaded", function(event) {
    let loc = document.location.href.split("/");
    if (loc[loc.length-1]=='browse.php') {  
        refreshCart();
        listenDragstart();
    }
});