// bank.js

var fs = require("fs");
var cheerio = require('cheerio');

// var helpers = require("./helpers.js");

var baseUrl = "someURL/someDir/somePage.asp?";

var method = "POST";

var banks_prices = [];

var banks = {
        'GALICIA': { buy : 0.0  , sell : 0.0 },
        'NACION':{ buy : 0.0  , sell : 0.0 },
        'CHINA':{ buy : 0.0  , sell : 0.0 },
        'BBVA':{ buy : 0.0  , sell : 0.0 },
        'SUPERVIELLE':{ buy : 0.0  , sell : 0.0 },
        'CIUDAD':{ buy : 0.0  , sell : 0.0 },
        'PATAGONIA':{ buy : 0.0  , sell : 0.0 },
        'SANTANDER':{ buy : 0.0  , sell : 0.0 },
        'BRUBANK':{ buy : 0.0  , sell : 0.0 },
        'HSBC':{ buy : 0.0  , sell : 0.0 },
        'CREDICOOP':{ buy : 0.0  , sell : 0.0 },
        'ITAU':{ buy : 0.0  , sell : 0.0 },
        'MACRO':{ buy : 0.0  , sell : 0.0 },
        'PIANO':{ buy : 0.0  , sell : 0.0 },
        'CAMBIOS ONLINE':{ buy : 0.0  , sell : 0.0 }
};


function getData( data ){ 
    
    let $ = cheerio.load( data );
    
    let tabla = $('table:contains("Cotizaciones")');
        
    if(tabla.length !== 0 ){
        
        // console.log($(tabla).text());
        tableRows = $('tr' , tabla).toArray();
        tableRows.forEach( el => {
                                let expression = new RegExp(`\\b(${Object.keys(banks).join('|')})\\b`, 'gi');

                // verify RegExp is well formed
				// console.log(`RegExp es ${expression}`);

				    let outputMatchRegExp = $('td:nth-child(1)' , el).contents().text().match(new RegExp(`\\b(${Object.keys(banks).join('|')})\\b`, 'gi'));

                                    let prices = [];
                                   

				    //console.log(`outputMatchRegExp ==> ${outputMatchRegExp[0]}`);

                                    if( outputMatchRegExp !== null )
                                    {
                                        
                                        $('td',el).each( (i,e) => {
                                        
                                            // if it's a Number and bigger than 0 ...
                                            if( parseFloat($(e).text()) > 0){
                                                //console.log(parseFloat($(e).text().trim() ));
                                                /* using slice() to set 2 digits after decimal punctutation */
                                                prices.push( $(e).text().trim().slice(0 , -1) );
                                            }
                                        });
                                        
                                        // check if there is prices loaded before dump data
                                        if(prices[0]){
                                            // looking just for the last entries
                                            // console.log(prices);
                                            prices.reverse();
                                            // outputMatchRegExp[0] !== 'CHINA' || 
                                            // console.log(outputMatchRegExp[0] );
                                            // console.log(`prices de compra es ${prices[1]}\n Venta ${prices[0]}`);
                                            banks_prices.push(
                                                    {
                                                        // replace pattern CHINA found in "industrial and commercial bank of CHINA" by ICBC
                                                        "banco": 
                                                        outputMatchRegExp[0] !== 'CHINA' ?
                                                                `${outputMatchRegExp[0]}` 
                                                                : "ICBC" ,
                                                               
                                                        "buy":`${prices[1]}`,
                                                        "sell":`${prices[0]}`
                                                    }
                                            );
                                        }
                                };
                            }
        );// END tableRows.forEach
        return banks_prices;   
    }
    else
        {
            // save to ERROR log file
            console.error('\x1b[31m%s\x1b[0m',"No se encuentra la tabla");
            process.exit(0);
        }
}

function saveToFile( data , dateRetrieved ){
    
    let dateString = "";
    
    console.log(dateRetrieved , typeof(dateretrieved ));
    if( dateRetrieved){
        dateString = dateRetrieved.toString().split('/').reverse().join('-');
    }
        else{
            dateString = new Date().split('/').reverse().toISOString().substring(0,10);
    }
    
    try {
        fs.writeFileSync(`./datos/dolar/${dateString}.json`, JSON.stringify(data));
        // file written successfully
        } catch (err) {
            console.error(err);
    }
}

// getData(datos); FX que ejecuta

// console.log(banks_prices);

module.exports = { baseUrl , method , getData , saveToFile }
