import React from "react";

export default function MaintainSearch(props) {
    let form = new FormData();
 
    return(
        fetch('https://localhost/SCC_MaherRepo/Smart-Customer-Services-Web-App/backend/queryDB.php',{
            method: 'POST',
            body: form
        
        })
        .then(response => response.json())
        .then(data => {
            if (data){
                localStorage.setItem("user", JSON.stringify(data))
                props.setLoginState(true);
                props.setUser(data)
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

    )
}