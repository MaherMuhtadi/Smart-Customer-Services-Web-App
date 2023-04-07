import React from "react";

export default class Footer extends React.Component{
    render(){

        return(
            <footer>
            <div className='footer-item'>
                Our Team:
                <ul>
                    <li>Maher Muhtadi</li>
                    <li>Edward Sword</li>
                    <li>Arshpreet Singh</li>
                    <li>James Tan</li>
                </ul>
            </div>
            
            <div className='footer-item'>
                Contacts:
                <ul>
                    <li>mmuhtadi@torontomu.ca</li>
                    <li>edward.sword@torontomu.ca</li>
                    <li>arshpreet.singh@torontomu.ca</li>
                    <li>russelljames.tan@torontomu.ca</li>
                </ul>
            </div>
        </footer>
        )
    }
}