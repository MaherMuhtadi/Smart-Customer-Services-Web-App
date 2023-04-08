import React, { useState } from 'react';
import { useEffect } from 'react';

function ShoppingCart() {
  const [cartContents, setCartContents] = useState({});
  //const [itemInfos, setItemInfos] = useState(localStorage.getItem('items_i'));

  const itemInfos = JSON.parse(localStorage.getItem('shopping_cart'))['items_i'];
  const itemQuantities = JSON.parse(localStorage.getItem('shopping_cart'))['items_q'];
  const totalCost = JSON.parse(localStorage.getItem('shopping_cart'))['total_cost'];
  const style1 = {
    textAlign:'right'
  }
  useEffect(() => {
     setCartContents(localStorage.getItem('items_q'));
  }, [cartContents])

  

  return (
    <main>
        <h1>
          ShoppingCart     
        </h1>
        <table>
          <thead>
          <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Unit Price</th>
              <th>Origin</th>
              <th>Department</th>
              <th>Store</th>
              <th>Quantity</th>
              <th>Subtotal</th>
          </tr>
          </thead>
          <tbody>
          {console.log(itemInfos)}
          {
            Object.keys(itemInfos).map((key) =>(
              <tr key={key}>
              <td>{key}</td>
              <td>{itemInfos[key]['image_url']}</td>
              <td>{itemInfos[key]['name']}</td>
              <td>{itemInfos[key]['price']}</td>
              <td>{itemInfos[key]['origin']}</td>
              <td>{itemInfos[key]['dept']}</td>
              <td>{itemInfos[key]['store']}</td>
              <td>{itemQuantities[itemInfos[key]['name']]}</td>
              <td>{Number(itemQuantities[itemInfos[key]['name']])*Number(itemInfos[key]['price'])}</td>
            </tr>
            ))
           
          }
          <h2 style={style1}>
            Total: {totalCost}
          </h2>

          </tbody>
        </table>
    </main>
  );
}

export default ShoppingCart;