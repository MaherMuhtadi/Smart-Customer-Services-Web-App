import React, { useEffect, useState } from 'react';
import Cart from '../components/Cart';

function Browse() {
  let form = new FormData();
  form.append('get_data', 'items');


  const getItems = () => {
    fetch('https://localhost/SCC_MaherRepo/Smart-Customer-Services-Web-App/backend/queryDB.php',
    {
      method: 'POST',
      body: form
    })
    .then(response => response.json())
    .then(data => {//console.log(data)
    console.log("Grabbed Items from DB")
    setItems(data)
    setLoadedState(true)
  })
  }

  //component states
  const [items, setItems] = useState(null);
  const [loadedState, setLoadedState] = useState(false);

  useEffect(()=>{
      if (!items){
        getItems();
      }}, [items])
  
  useEffect(()=>{
    let items = document.getElementsByClassName("items");
    //console.log(items)
    for (var i=0; i<items.length; i++){
      items[i].addEventListener("dragstart", (ev)=>{
        console.log("Dragging...")
        ev.dataTransfer.setData("text/plain", ev.target.id);
      }); 
    }   
  })
    
  if (loadedState){
    return (
      <main>
          <h1>Happy Shopping!</h1>
          <h2>Drag and drop to add to cart</h2>
          <table>
            <thead>
              <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Origin</th>
              <th>Department</th>
              <th>Store</th>
                
              </tr>
            </thead>
            <tbody>
              {
                items.map((row, index) => (
                  <tr key={index} id={row[0]} className='items' draggable={true}>
                  <td>{row[0]}</td>
                  <td draggable={false}><img draggable={false} src={row[1]} alt={row[2] + " pic"}/></td>
                  <td>{row[2]}</td>
                  <td>{row[3]}</td>
                  <td>{row[4]}</td>
                  <td>{row[5]}</td>
                  <td>{row[6]}</td>
                </tr>
                ))
              }
            </tbody>
  
          </table>
          <Cart/>
      </main>
    );

  }
}

export default Browse;