import {BinanceBookTicker} from "./BinanceBookTicker.js";


export function BinanceCurrency(currency, baseCurr){
    
    this.baseCurr = baseCurr;
    this.currency = currency;
   
    this.bid = 0;
    this.ask = 0;
    this.bidQty = 0;
    this.askQty = 0; 
    this.changeBid = 0;
    this.changeAsk = 0;
    this.bidClass = 'text-primary';
    this.askClass = 'text-primary'; 
    
    this.getSymbol = function(){
        return this.currency + this.baseCurr;
    }
  
    this.updateData = function(){
        var arrTicks = BinanceBookTicker.getInstance().getData();
        var symbol  = this.getSymbol();
        for(var i =0; i < arrTicks.length; ++i){
            var item = arrTicks[i];
            if(symbol === item.symbol){
                this.changeBid = parseFloat(item.bidPrice) - parseFloat(this.bid);
                this.changeAsk = parseFloat(item.askPrice) - parseFloat(this.ask);   
                //console.log(symbol+' bid: '+this.changeBid+' ask: '+ this.changeAsk);             
                this.bid = parseFloat(item.bidPrice);
                this.ask = parseFloat(item.askPrice);
                this.bidQty = parseFloat(item.bidQty);
                this.askQty = parseFloat(item.askQty); 
                this.bidClass = (this.changeBid > 0.0 && this.changeBid !== this.bid)? "text-success" : ( (this.changeBid === 0.0 || this.changeBid === this.bid)? "text-primary" : "text-danger" ) ; 
                this.askClass = (this.changeAsk > 0.0 && this.changeAsk !== this.ask)? "text-success" : ( (this.changeAsk === 0.0 || this.changeAsk === this.ask)? "text-primary" : "text-danger" ) ;      
            }
        }
    };

}