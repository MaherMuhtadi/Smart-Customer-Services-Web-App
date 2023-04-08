import React from "react";
import { useState } from "react";
import { Navigate } from "react-router-dom";

export default function Login(props){
  
    const [usernameSu, setUserNameSu] = useState("");
    const [passwordSu, setPasswordSu] = useState("");
    const [fnSu, setFnSu] = useState("");
    const [lnSu, setLnSu] = useState("");
    const [telSu, setTelSu] = useState("");
    const [emailSu, setEmailSu] = useState("");
    const [addySu, setAddySu] = useState("");

    const [usernameSi, setUserNameSi] = useState("");
    const [passwordSi, setPasswordSi] = useState("");

    const [redirectHome, setRedirectHome] = useState(false);


    
    
    const handleSubmit = (e) => {
        e.preventDefault();
        
        let form = new FormData();
        form.append("signup", 1);
        form.append("login_id_new", usernameSu);
        form.append("password_new", passwordSu);
        form.append("first_name", fnSu);
        form.append("last_name", lnSu);
        form.append("tel_no", telSu);
        form.append("email", emailSu);
        form.append("address", addySu);

        fetch('https://localhost/SCC_MaherRepo/Smart-Customer-Services-Web-App/backend/queryDB.php',{
            method: 'POST',
            body: form
        }
        )
        .then(response => {
            console.log(response);
            return response.json()})
        .then(data => {
            if(data){
                localStorage.setItem("user", JSON.stringify(data));
                props.setLoginState(true);
                setRedirectHome(true);
            }
            else{
                alert("Something went wreng...");
                e.target.reset();
            }
        })
        .catch(err => {
            console.log(err);
        })
    }

    const handleSignIn = (e) => {
        e.preventDefault();
        let form = new FormData();
        form.append("signin", 1);
        form.append("login_id",usernameSi);
        form.append("password",passwordSi);
        fetch('https://localhost/SCC_MaherRepo/Smart-Customer-Services-Web-App/backend/queryDB.php',{
            method: 'POST',
            body: form
        
        })
        .then(response => response.json())
        .then(data => {
            if (data){
                localStorage.setItem("user", JSON.stringify(data))
                props.setLoginState(true);
                props.setAdminLoginState(data['admin'] == '1')
                setRedirectHome(true)
            
               
            }
            else{
                alert("Wrong Credentials");
                e.target.reset();
                console.log("invalid");
            }
        })
        .catch(err => console.log(err))
    }
    if (redirectHome){
         return <Navigate to='/'></Navigate>
    }

    return (
        <main>
            <h1>Sign In to an Account</h1>

            <div id="login_forms">
                <form onSubmit={handleSubmit}>
                    <h2>New user? Register below</h2>

                    <div className="input">
                        <label htmlFor="login_id1">Username:</label>
                        <input id="login_id1" name="login_id_new" type="text" maxLength="50" 
                        onChange={(e)=>{
                            setUserNameSu(e.target.value);
                        }}/>
                    </div>

                    <div className="input">
                        <label htmlFor="password1">Password:</label>
                        <input id="password1" name="password_new" type="password" maxLength="50"
                        onChange={(e)=>{
                            setPasswordSu(e.target.value);
                        }}/>
                    </div>
                    
                    <div className="input">
                        <label htmlFor="first_name">First Name:</label>
                        <input id="first_name" name="first_name" type="text" maxLength="50"
                        onChange={(e)=>{
                            setFnSu(e.target.value);
                        }}/>
                    </div>
                    
                    <div className="input">
                        <label htmlFor="last_name">Last Name:</label>
                        <input id="last_name" name="last_name" type="text" maxLength="50"
                        onChange={(e)=>{
                            setLnSu(e.target.value);
                        }}/>
                    </div>
                    
                    <div className="input">
                        <label htmlFor="tel_no">Phone:</label>
                        <input id="tel_no" name="tel_no" type="tel" maxLength="12"
                        onChange={(e)=>{
                            setTelSu(e.target.value);
                        }}/>
                    </div>
                    
                    <div className="input">
                        <label htmlFor="email">Email:</label>
                        <input id="email" name="email" type="email" maxLength="100"
                        onChange={(e)=>{
                            setEmailSu(e.target.value);
                        }}/>
                    </div>

                    <div className="input">
                        <label htmlFor="address">Address:</label>
                        <input id="address" name="address" type="text" maxLength="200"
                        onChange={(e)=>{
                            setAddySu(e.target.value);
                        }}/>
                    </div>

                    <div>
                        <button name="signup" type="submit">Sign Up</button>
                        <button className="negative-button" type="reset">Clear</button>
                    </div>
                </form>

                <form onSubmit={handleSignIn}>
                    <h2>Already have an account? Sign in below</h2>

                    <div className="input">
                        <label htmlFor="login_id2">Username:</label>
                        <input id="login_id2" name="login_id" type="text" maxLength="50"
                        onChange={(e)=>{
                            setUserNameSi(e.target.value);
                        }}/>
                    </div>

                    <div className="input">
                        <label htmlFor="password2">Password:</label>
                        <input id="password2" name="password" type="password" maxLength="50"
                        onChange={(e)=>{
                            setPasswordSi(e.target.value);
                        }}/>
                    </div>


                    <div>
                        <button name="signin" type="submit">Sign In</button>
                        <button className="negative-button" type="reset">Clear</button>
                    </div>
                </form>

            </div>
    </main>
    );
}