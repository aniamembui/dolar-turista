// getURL.js

var callBack = process.argv[2] ; 

var  dateDataRequested = process.argv[3] || new Date().toISOString().substring(0,10).split('-').reverse().join('/');

const { baseUrl , getData , method , saveToFile } = require('./' + callBack );


const https = require("https");
const agente = new https.Agent({
                    // Allow access to web page even if SSL certificates is not valid.
                    rejectUnauthorized: false
});

const fetch = (...args) => import('node-fetch').then(({default: fetch}) => fetch(...args));

async function processFromURL( options ){
    
  
    let currCode = options.currency === "euro" ? 98 // euro value
                                       : 2 ; // dollar value
                                       
    let dateRequired = options.date || dateDataRequested ;
//     console.log( "dateRequired : " + dateRequired);
  
    /**
     * URL parameters
     *   moneda=98&fecha=11/07/2022&B1=Enviar
     *   @moneda  98 = euro
     *          or 2 = dollar
     *   @fecha should be formatted as dd/mm/YYYY
     */
    let uri = `${baseUrl}moneda=${currCode}&fecha=${dateRequired}&B1=Enviar/` ; 
    
    //console.log(uri); //OK
      
    await fetch(`https://${uri}`, 
                          { 
                            agent: agente,
                            method: method ?? "GET"
                          })
    .then( res => res.text())
    .then( data => {  

               let extractedDataToJSON = getData(data);
               
               saveToFile(extractedDataToJSON , dateRequired);

    })
    .catch( err => console.log( err.message))
}

processFromURL( { date:dateDataRequested} );
