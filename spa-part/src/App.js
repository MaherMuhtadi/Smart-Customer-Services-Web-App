import './App.css';
import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link, useNavigate } from 'react-router-dom';
import Home from './views/Home';
import About from './views/About';
import Contacts from './views/ContactUs';
import Reviews from './views/Reviews';
import ShoppingCart from './views/Shopping-cart';
import Browse from './views/Browse';
import Delivery from './views/Delivery.js';
import Login from './views/Login.js';
import NavBar from './components/NavBar';
import Footer from './components/Footer';
import Payment from './views/Payment';
import MaintainInsert from './views/MaintainInsert';

export default class App extends React.Component{
  constructor(props){
    /**
     * State is initialized here. 
     * Constructor is called before the component is actually mounted.
     */
    super(props);
    this.state = {
      logged_in: localStorage.getItem('user')?true:false,
      logged_in_admin: JSON.parse(localStorage.getItem('user'))?JSON.parse(localStorage.getItem('user'))['admin'] == '1':false,
      user: JSON.parse(localStorage.getItem('user')),
      loaded: 1
    }

  } 
  
  
  componentDidMount(){
    /*
    Method is invoked immediately after a component is mounted. 
    Iniitialization that requires DOM nodes should go here. 
    */

  }

componentDidUpdate(prevState){
  /**
   * Method is called when component is updated, i.e. change in states
   */
 
  if (prevState.logged_in != this.state.logged_in){
    if (!this.state.logged_in){
      localStorage.removeItem('user');
      localStorage.removeItem('shopping_cart');
      console.log("User logged out")
    }
  }
}


  setLoginState = (state) => {
    this.setState(() => ({logged_in: state}));
   
  }

  setUser = (current_user) => {
    this.setState(()=>({user: current_user}))
  }

  setAdminLoginState = (state) => {
    this.setState(()=>({logged_in_admin: state}))
  }

  render(){
    if (this.state.loaded == 1){
      {console.log(this.state.logged_in)
      console.log(JSON.stringify(this.state.user))}
      return (
       
        <Router>
          <NavBar loggedIn = {this.state.logged_in} setLoginState = {this.setLoginState} loggedInAdmin={this.state.logged_in_admin} setAdminLoginState={this.setAdminLoginState}/>
     
          <Routes>
            <Route path="/" element={<Home user={this.state.user} loggedIn = {this.state.logged_in}/>}/>
            <Route path="/about" element={<About/>}/>
            <Route path="/contacts" element={<Contacts/>}/>
            <Route path="/reviews" element={<Reviews/>}/>
            <Route path="/Shopping-cart" element={<ShoppingCart/>}/>
            <Route path='/browse' element={<Browse/>}/>
            <Route path='/delivery' element={<Delivery/>}/>
            <Route path='/login' element={<Login setLoginState = {this.setLoginState} setAdminLoginState={this.setAdminLoginState}
              setUser={this.setUser}/>}/>
            <Route path='/payment' element={<Payment/>}/>
            <Route path='/insert' element={<MaintainInsert/>}/>
            
          </Routes>
          <Footer/>
        </Router>
      );

    }
    


  }
}

/**
 * Source:
 * https://stackoverflow.com/questions/46640024/how-do-i-post-form-data-with-fetch-api
 * 
 */