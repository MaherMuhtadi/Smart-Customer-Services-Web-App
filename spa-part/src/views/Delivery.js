import React, { useEffect, useState } from 'react';
import { Navigate } from 'react-router';
import Map from '../components/Map';

function Delivery() {

  const shopping_cart = JSON.parse(localStorage.getItem('shopping_cart'));
  const user_info = JSON.parse(localStorage['user']);
  const total_cost = shopping_cart?Number(shopping_cart['total_cost']):0;
  const items_q = shopping_cart?shopping_cart['items_q']:{};

  const [deliverDst, setDeliverDst] = useState(localStorage.getItem('user')?localStorage.getItem('user')['address']:"");
  const [wareHouseInfo, setWareHouseInfo] = useState(null);
  const [WHQueryState, setWHQueryState] = useState(false);
  const style1 = {width:'70%'};
  let defaultMin = new Date();
  defaultMin.setDate(defaultMin.getDate()+3);
  const [minDate, setMinDate] = useState(defaultMin.toISOString().split('T')[0])

  const [payState, setPayState] = useState(false);
  const [genMap, setGenMapState] = useState(false);

  const getWareHouseInfo = () => {
    let form = new FormData();
        form.append("get_all_data", "warehouse");
        fetch('https://localhost/SCC_MaherRepo/Smart-Customer-Services-Web-App/backend/queryDB.php',{
            method: 'POST',
            body: form
        
        })
        .then(response => response.json())
        .then(data => {
            if (data){
                setWareHouseInfo(data);
                setWHQueryState(true);
               
            }
            else{
                console.log("Null data in Delivery.js");
            }
        })
        .catch(err => console.log(err))

  }

  
  const renderWarehouseOptions = () => {
    if (WHQueryState){
      return (
        Object.keys(wareHouseInfo).map((key) =>(
          <option value={wareHouseInfo[key]}>{wareHouseInfo[key]}</option>
          )))
        }}
      
      

    useEffect(
      ()=>{
      if (WHQueryState == false){
        getWareHouseInfo();
      }  
      })

    
    if (total_cost == 0){
      return (
        <main>
          <h2>
            You have nothing to be delivered
          </h2>
        </main>
      )
    }
    else if (payState){
      return <Navigate to='/Payment'/>
    }
    else{
        return (
        <main>
            <h1>Delivery Options</h1>
            <h2>How would you like your items to be delivered?</h2>

            <div id="map-container">
            <div id="map-form">
                <div id="map-input">
                    <label for="destination">Deliver to:</label>
                    <input id="destination" type="text" value={deliverDst} maxlength="200"
                    onChange={(e)=>{
                      setGenMapState(false);
                      setDeliverDst(e.target.value)
                                    }}/>
                </div>
                
                <div id="map-input">
                    <label for="source">Warehouse:</label>
                    <select id="source" onChange={()=>setGenMapState(false)}>
                      {renderWarehouseOptions()}
                    </select>
                </div>

                <button id="generate-button" onClick={()=>setGenMapState(true)}>Generate Map</button>

                <div id="map-input">
                    <label for="date">Delivery date:</label>
                    <div style={style1}>
                      <input id='date' type='date' value={minDate} min={minDate}
                      onChange={(e)=>{
                        setMinDate(e.target.value)
                      }}/>;
                    </div>
                </div>
                
                <div id="info" class="info"></div>
                <button onClick={()=>setPayState(true)}>Proceed to Pay</button>
            </div>
           {genMap?<div>Map Placeholder</div>:"Not genning"}
        </div>
        </main>
        
        );

    }
}

export default Delivery;