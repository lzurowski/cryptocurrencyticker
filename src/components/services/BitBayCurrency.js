export function BitBayCurrency(currency){
    
    this.baseCurr = 'PLN';
    this.currency = currency;
    this.service = 'ticker';

    this.max = '';
    this.min = '';
    this.last = '';
    this.bid = 0;
    this.ask = 0;
    this.vwap = '';
    this.average = 0; 
    this.volume  = '';
    this.changeBid = 0;
    this.changeAsk = 0;
    this.changeAverage = 0;
    this.averageClass = 'text-primary';
    this.bidClass = 'text-primary';
    this.askClass = 'text-primary'; 
    


    this.createUrl = function(){
        this.serviceUrl = 'https://bitbay.net/API/Public/'+this.currency+this.baseCurr+'/'+this.service + '.json';
    }
       
    this.getServiceUrl = function(){
        this.createUrl();
        return this.serviceUrl;
    }
     
    this.updateData = function(){
        var _this = this;
        $.getJSON(this.getServiceUrl(), function(obj){
            for (var key in obj) {
                // skip loop if the property is from prototype
                if (!obj.hasOwnProperty(key)) continue;
                if(_this.hasOwnProperty(key)){
                     if('average' === key){
                        var c = new Number(_this.average);
                        var n = new Number(obj[key]);
                        _this.changeAverage = new Number(n - c);
                        //console.log('Change avarage: '+_this.changeAverage);                        
                        if( '0' === _this.changeAverage.toString() || 0 === (_this.changeAverage - n) ){
                            _this.averageClass = 'text-primary';
                        }else if(_this.changeAverage > 0){
                            _this.averageClass = 'text-success';
                        }else{
                            _this.averageClass = 'text-danger';
                        }
                    }
                    if('bid' === key){
                        var c = new Number(_this.bid);
                        var n = new Number(obj[key]);
                        _this.changeBid = new Number(n - c);
                       // console.log('Change bid: '+_this.changeBid);                
                        if( '0'  === _this.changeBid.toString() || 0 ===  (_this.changeBid - n ) ){
                            _this.bidClass = 'text-primary';
                        }else if(_this.changeBid > 0){
                            _this.bidClass = 'text-success';
                        }else{
                            _this.bidClass = 'text-danger';
                        }
                    }
                    if('ask' === key){
                        var c = new Number(_this.ask);
                        var n = new Number(obj[key]);                       
                        _this.changeAsk = new Number(n - c);
                        //console.log('Change Ask: '+_this.changeAsk);                
                        if( '0' === _this.changeAsk.toString() || 0 === (_this.changeAsk - n) ){
                            _this.askClass = 'text-primary';
                        }else if(_this.changeAsk > 0){
                            _this.askClass = 'text-success';
                        }else{
                            _this.askClass = 'text-danger';
                        }
                    }
                    _this[key] = obj[key];    
                }                
            }
        });
    }

}