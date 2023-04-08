import React from "react";
import { Link } from "react-router-dom";


export default class Cart extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            items_q: localStorage.getItem('shopping_cart')? JSON.parse(localStorage.getItem('shopping_cart'))['items_q']: {},
            total_cost: localStorage.getItem('shopping_cart')? JSON.parse(localStorage.getItem('shopping_cart'))['total_cost']: 0,
            items_i: localStorage.getItem('shopping_cart')? JSON.parse(localStorage.getItem('shopping_cart'))['items_i']: {}

        }
    }
    dragoverHandler = (ev) => {
        ev.preventDefault();
    }
    
    dropHandler = (ev) => {
        ev.preventDefault();
        const data = ev.dataTransfer.getData("text/plain");
        console.log(data)
        let elem = document.getElementById(data);
        console.log(elem)
        let cost = Number(elem.childNodes[3].innerHTML.split(" ")[0]);
        let name = elem.childNodes[2].innerHTML;
        let id = elem.childNodes[0].innerHTML;
        console.log(this.state.total_cost)
        console.log(JSON.stringify(this.state.items_q))
        let item_obj = {
            "image_url":elem.childNodes[1].firstChild.src,
            "name": name,
            "price":cost,
            "origin": elem.childNodes[4].innerHTML,
            "dept":elem.childNodes[5].innerHTML,
            "store":elem.childNodes[6].innerHTML
        }
        
        
     
        if (this.state.items_q[name]){
            this.setState({items_q: {...this.state.items_q, [name]: this.state.items_q[name]+1},
                total_cost: this.state.total_cost + cost})
        }
        else{
            this.setState({ 
                    items_q: {...this.state.items_q, [name]:1},
                    total_cost: this.state.total_cost + cost,
                    items_i: {...this.state.items_i, [id]: item_obj}
                })
        }

    }
    
    clearCart = () => {
        /**
         * Clear shopping cart data 
         */
        localStorage.removeItem('shopping_cart')
        this.setState({items_q: {}, total_cost:0, items_i:{}})
    }

    refreshCart = () => {
        var cart = document.getElementById("shopping-cart");
        cart.innerHTML = '';
        for (const key in this.state.items_q) {
            const node = document.createElement("ul");
            var num = this.state['items_q'][key];
            node.innerHTML = `<li>${key} x${num}</li>`;
            cart.appendChild(node);
        }
        cart.innerHTML += "Total: "+this.state['total_cost'] + " CAD";
    }

    componentDidMount(){
        this.refreshCart()
    }

    componentDidUpdate(prevState){
        console.log("Current cost: "+this.state.total_cost)
        if (prevState.total_cost !=this.state.total_cost){
            let sc_obj = {'items_q': this.state.items_q, 'total_cost': this.state.total_cost, 'items_i': this.state.items_i};
            localStorage.setItem('shopping_cart', JSON.stringify(sc_obj));

            this.refreshCart();

        }
    }

    render(){

        return(
            <div className="tiles" onDrop={this.dropHandler} onDragOver={this.dragoverHandler}>
            <h2>Shopping Cart</h2>
                <div width="100%" id="shopping-cart">


                </div>
    
                <br/>
            <button className="negative-button" onClick={this.clearCart}>Clear</button>
            <Link to={'/Shopping-cart'}><button>Go</button></Link>
        </div>
        )
    }
    
    
}