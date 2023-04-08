import React from "react";

export default class Map extends React.Component{
    constructor(props){
        /** 
         * 
         * Will be accepting following props:
         * 
        */
        super(props);
        this.state = {
            src: document.getElementById("source").value,
            dst: document.getElementById("destination").value,
            dst_geocode: null
        }
    }






    render(){
        return(
            <div>
            <div id="map"> 

            </div>
            <script src="maps.js">
                
            </script>
            
            <script async defer src={"https://maps.googleapis.com/maps/api/js?key="+"AIzaSyDJYCHEodV-BRyIe9tEt6VCIjq2E7L98qI"+"&callback=initMap"}>
            </script>
            
            </div>

        )
    }
}


