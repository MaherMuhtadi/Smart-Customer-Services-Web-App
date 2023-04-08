import React from "react";
import { useState } from "react";
export default function MaintainSearch(props) {
 
    const sendFetch = (form, formNum) => {

        fetch('https://localhost/SCC_MaherRepo/Smart-Customer-Services-Web-App/backend/admin.php',{
            method: 'POST',
            body: form
        
        })
        .then(response => {
        console.log("Success fetch request in MaintainInsert");
        if (formNum == 1){
            setForm1State(true);
        }
        if (formNum == 2){
            setForm2State(true);
        }
        if (formNum == 3){
            setForm3State(true);
        }
        if (formNum == 4){
            setForm4State(true);
        }
        })
        .catch(err => console.log(err))


    } 

    const [form1State, setForm1State] = useState(false);
    const [form2State, setForm2State] = useState(false);
    const [form3State, setForm3State] = useState(false);
    const [form4State, setForm4State] = useState(false);

    const [form1_1, setform1_1] = useState("");
    const [form1_2, setform1_2] = useState("");
    const [form1_3, setform1_3] = useState("");
    const [form1_4, setform1_4] = useState("");
    const [form1_5, setform1_5] = useState("");
    const [form1_6, setform1_6] = useState("");
    const [form1_7, setform1_7] = useState("");
    const [form1_8, setform1_8] = useState("0");

    const [form2_1, setform2_1] = useState("");
    const [form2_2, setform2_2] = useState("");
    const [form2_3, setform2_3] = useState("");
    const [form2_4, setform2_4] = useState("");
    const [form2_5, setform2_5] = useState("");
    const [form2_6, setform2_6] = useState("");
    


    return(
        <div>
            <h1>Insert New Data to SCS Database</h1>

<form onSubmit={
    (e)=>{
        e.preventDefault();
        let form = new FormData();
        form.append('user_submitted',1);
        form.append('login_id',form1_1);
        form.append('password',form1_2);
        form.append('first_name',form1_3);
        form.append('last_name',form1_4);
        form.append('tel_no',form1_5);
        form.append('email',form1_6);
        form.append('address',form1_7);
        form.append('admin',form1_8);
        sendFetch(form,1);
    }
} 
    method="post">
    <h2>Add a user:</h2>

    <label for="login_id">Username:</label>
    <input type="text" id="login_id" name="login_id" maxlength="50" onChange={(e)=>setform1_1(e.target.value)}/><br/>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" maxlength="50" onChange={(e)=>setform1_2(e.target.value)}/><br/>

    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" maxlength="50" onChange={(e)=>setform1_3(e.target.value)}/><br/>

    <label for="last_name">Last Name</label>
    <input type="text" id="last_name" name="last_name" maxlength="50" onChange={(e)=>setform1_4(e.target.value)}/><br/>

    <label for="tel_no">Phone:</label>
    <input type="tel" id="tel_no" name="tel_no" maxlength="12" onChange={(e)=>setform1_5(e.target.value)}/><br/>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" maxlength="100" onChange={(e)=>setform1_6(e.target.value)}/><br/>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" maxlength="200" onChange={(e)=>setform1_7(e.target.value)}/><br/>
    
    <label for="admin">Privilege:</label>
    <select id="admin" name="admin" onChange={(e)=>setform1_8(e.target.value)}>
        <option value="0">User</option>
        <option value="1">Admin</option>
    </select><br/>

    <button name="user_submitted" type="submit">Add User</button>
    <button type="reset">Clear</button>


</form>


<form onsubmit={
    () => {
        let form = new FormData();
        form.append('item_submitted',1);
        form.append('img',form2_1);
        form.append('item_name',form2_2);
        form.append('price',form2_3);
        form.append('made_in',form2_4);
        form.append('department',form2_5);
        form.append('store_name',form2_6);
        sendFetch(form, 2);
    }    
    } enctype='multipart/form-data' method='post'>
    <h2>Add an item:</h2>

    <label for="img">Image:</label>
    <input id="img" name="img" type="file"onChange={(e)=>setform2_1(e.target.value)}/><br/>
    
    <label for="item_name">Name:</label>
    <input id="item_name" name="item_name" type="text"  maxlength="100"onChange={(e)=>setform2_2(e.target.value)}/><br/>
    
    <label for="price">Price:</label>
    <input id="price" name="price" type="number"onChange={(e)=>setform2_3(e.target.value)}/><br/>
    
    <label for="made_in">Made In:</label>
    <input id="made_in" name="made_in" type="text"  maxlength="50"onChange={(e)=>setform2_4(e.target.value)}/><br/>
    
    <label for="department">Department:</label>
    <input id="department" name="department" type="text"  maxlength="50"onChange={(e)=>setform2_5(e.target.value)}/><br/>
    
    <label for="store_name">Store:</label>
    <input id="store_name" name="store_name" type="text"  maxlength="50"onChange={(e)=>setform2_6(e.target.value)}/><br/>

    <button name="item_submitted" type="submit">Add Item</button>
    <button type="reset">Clear</button>
</form>
{form2State?<div>Item Added Successfully</div>:""}

<form method="post">
    <h2>Add a delivery truck:</h2>
    
    <label for="truck_code">Truck Code:</label>
    <input id="truck_code" name="truck_code" maxlength="50"/>
    
    <button name="truck_submitted" type="submit">Add Truck</button>
    <button type="reset">Clear</button>
</form>

<form method="post">
    <h2>Add a warehouse:</h2>
    
    <label for="address">Warehouse address:</label>
    <input id="address" name="address" maxlength="200"/>
    
    <button name="warehouse_submitted" type="submit">Add warehouse</button>
    <button type="reset">Clear</button>
</form>


        </div>

    )
}