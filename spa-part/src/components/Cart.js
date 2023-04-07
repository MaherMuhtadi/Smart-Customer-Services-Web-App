import React from "react";
import { Link } from "react-router-dom";


export default class Cart extends React.Component {
    constructor(props){
        super(props);
        this.state = {
            items: localStorage.getItem('shopping_cart')? JSON.parse(localStorage.getItem('shopping_cart'))['items']: {},
            total_cost: localStorage.getItem('shopping_cart')? JSON.parse(localStorage.getItem('shopping_cart'))['total_cost']: 0
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
        console.log(this.state.total_cost)
        console.log(JSON.stringify(this.state.items))
        
        
     
        if (this.state.items[name]){
            this.setState({items: {...this.state.items, [name]: this.state.items[name]+1}, total_cost: this.state.total_cost + cost})
        }
        else{
            this.setState({ 
                    items: {...this.state.items, [name]:1}, total_cost: this.state.total_cost + cost})
        }

    }
    
    clearCart = () => {
        /**
         * Clear shopping cart data 
         */
        localStorage.removeItem('shopping_cart')
        this.setState({items: {}, total_cost:0})
    }

    refreshCart = () => {
        var cart = document.getElementById("shopping-cart");
        cart.innerHTML = '';
        for (const key in this.state.items) {
            const node = document.createElement("ul");
            var num = this.state['items'][key];
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
            let sc_obj = {'items': this.state.items, 'total_cost': this.state.total_cost};
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
                    <Link to={'/Shopping-cart'}>
                        <button>Checkout</button>

                    </Link>
        </div>
        )
    }
    
    
}