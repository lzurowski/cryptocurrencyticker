import {ServerTicker} from "./ServerTicker.js";


export function Currency(symbol){
    
    this.symbol= symbol;
    this.base_currency = '';
    this.currency = '';
   
    this.bid = 0;
    this.ask = 0;
    this.average = 0;
    this.create_time = 0; 
    this.date = 0;
    this.minCh5 = 0;
    this.minCh60 = 0;
    this.hourCh24 = 0;    
    

    this.bidClass = 'text-primary';
    this.askClass = 'text-primary'; 
    this.averageClass = 'text-primary';
    this.minCh5Class = 'text-primary';
    this.minCh60Class = 'text-primary';
    this.hourCh24Class = 'text-primary';   
    
    
    this.getSymbol = function(){
        return this.symbol;
    }
  
    this.updateData = function(){
        var data = ServerTicker.getInstance().getSymbolData(this.symbol);
        if(null !== data){
            if(0 !== this.bid){  
                this.bidClass = (parseFloat(data["bid"]) >= this.bid) ?  "text-success" : "text-danger"; 
            }
            if(0 !== this.ask){
                this.askClass = (parseFloat(data["ask"]) >= this.ask) ?  "text-success" : "text-danger"; 
            }
            if(0 !== this.average){
                this.averageClass = (parseFloat(data["average"]) >= this.average) ?  "text-success" : "text-danger"; 
            }
          
            this.base_currency = data["base_currency"];
            this.currency = data["currency"];
            this.bid = parseFloat(data["bid"]);
            this.ask = parseFloat(data["ask"]);
            this.average = parseFloat(data["average"]);
            this.create_time = data["create_time"]; 
            this.date = data["date"];
            this.minCh5 = parseFloat(data["5minChange%"]);
            this.minCh60 = parseFloat(data["60minChange%"]);
            this.hourCh24 = parseFloat(data["24hourChange%"]);

            this.minCh5Class = (this.minCh5 >= 0.0 )? "text-success" : "text-danger"; 
            this.minCh60Class = (this.minCh60 >= 0.0 )? "text-success" : "text-danger"; 
            this.hourCh24Class = (this.hourCh24 >= 0.0 )? "text-success" : "text-danger"; 
                        
        }        
    };

}