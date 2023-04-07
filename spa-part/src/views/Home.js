import React from 'react';

function Home(props) {
  const loggedIn = props.loggedIn;
  const user = props.user;
  const renderAdditionalInfo = (user) => {
    //let e = JSON.parse(user)
    console.log(user.login_id)

  }

  return (
    <main>
    <div className='tiles'>
      <h1>Welcome {loggedIn?user.login_id+"#"+user.user_id:"Customer"}!</h1>
      <p>{loggedIn?"Your current balance is "+user.balance:""}</p>

    </div>

    <div className='info'>
        <img width="50%" src='./images/home_art.png' alt='Online Shopping'/>
        <div>
            <h1>Why SCS?</h1>
            <p>Smart Customer Services (SCS) is an online system that aims to plan for smart green
            trips inside the city and its neighborhood for online shopping and then delivery to destinations
            of your choice. Considering traffic as a serious threat to the quality of life, the world has been
            looking for various solutions to decrease the stress, frustration, delays and terrible air
            pollutions being caused through it. SCS attempts to provide a smart green solution on this
            regard by providing online shopping services and then delivery of the purchased items from the
            selected warehouses to your doorsteps.</p>
        </div>
    </div>
</main>
  );
}

export default Home;