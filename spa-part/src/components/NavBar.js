import React, {useState} from "react";
import {Link} from "react-router-dom";

class NavBar extends React.Component {
    constructor(props){
        super(props);
        this.state = {
          
        }
    }
    style2 = {
        textDecoration:'underline'
    };

    renderLoginBtn = () => {
        console.log(this.props.loggedIn);
        if (this.props.loggedIn){
            return (<Link to={"./Login"}>
                <button onClick={()=>{
                    this.props.setLoginState(false);
                }}>Sign Out</button>

            </Link>
            );
            
        }
        else{
            return (
                <Link to={"./Login"}>
                    <button>Sign In</button>
                </Link>
            )
        }
    }

    checkLogin = (route) => {
        if (this.props.loggedIn){
            return route;
        }
        else{
            return "./Login"
        }
    }   


    render(){
        return(
            <header>
                <h1>Smart Customer Services | SCS</h1>

            <div id='menu-row'>
                    <Link to={"./"}>
                        <button className='menu-item'>Home</button>
                    </Link>
                    <Link to={"./About"}>
                        <button className='menu-item'>About Us</button>
                    </Link>
                    <Link to={"./Contacts"}>
                        <button className='menu-item'>Contact Us</button>
                    </Link>
                    <Link to={"./Reviews"}>
                    <button className='menu-item'>Reviews</button>
                    </Link>

                    <div className='menu-item'>
                    <div id='dropdown'>
                        <button style={this.style2}>Services</button>
                        <div id='dropdown-menu'>
                            <Link to={"./Browse"}>
                                <button>Browse</button>
                            </Link>
                            <Link to={this.checkLogin("./Shopping-cart")}>
                                <button>Cart</button>
                            </Link>
                            <Link to={this.checkLogin("./Delivery")}>
                                <button>Delivery</button>
                            </Link>
                        </div>
                    </div>
                  
                    </div>

                    {this.renderLoginBtn()}

            </div>
            </header>
        )
    }
}

export default NavBar;