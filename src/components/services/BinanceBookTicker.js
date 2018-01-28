export var BinanceBookTicker = ( function() {
    
    var instance;

    function createInstance() {
        var o = {};
        
        o.apiUrl = 'https://www.binance.com/api/v3/ticker/bookTicker';
        o.interval = 60; //pobieranie danych co 60 sekund
        o.data = [];
        
        o.updateData = function(){
            //console.log('Update data');
            $.getJSON(o.apiUrl, function(data){
                o.data = data;
            });
        };

        o.getData = function(){
            return o.data;
        }; 

        o.start = function(){
            o.updateData();
            setTimeout(function(){
                o.start();
            }, o.interval * 1000);
        }

        return o;
    }
 
    return {
        getInstance: function () {
            if (!instance) {
                instance = createInstance();
            }
            return instance;
        }
    };
})();