export var ServerTicker = ( function() {
    
    var instance;

    function createInstance() {
        var o = {};
        
        o.apiUrl =  "http://cryptoc.zuro.pl/servicedata/getTick.php";//'https://www.binance.com/api/v3/ticker/bookTicker';
        o.interval = 60; //pobieranie danych co 60 sekund
        o.data = [];
        o.symbols = 'ADAETH,ADXETH,AIONETH,AMBETH,APPCETH,ARKETH,ARNETH,ASTETH,BATETH,BCCETH,BCCPLN,BCDETH,BCPTETH,BNBETH,BNTETH,BQXETH,BRDETH,BTCPLN,BTGETH,BTGPLN,BTSETH,CDTETH,CHATETH,CMTETH,CNDETH,CTRETH,DASHETH,DASHPLN,DGDETH,DLTETH,DNTETH,EDOETH,ELFETH,ENGETH,ENJETH,EOSETH,ETCETH,ETHPLN,EVXETH,FUELETH,FUNETH,GAMEPLN,GTOETH,GVTETH,GXSETH,HSRETH,ICNETH,ICXETH,INSETH,IOSTETH,IOTAETH,KMDETH,KNCETH,LENDETH,LINKETH,LRCETH,LSKETH,LSKPLN,LTCETH,LTCPLN,LUNETH,MANAETH,MCOETH,MDAETH,MODETH,MTHETH,MTLETH,NAVETH,NEBLETH,NEOETH,NULSETH,OAXETH,OMGETH,OSTETH,PIVXETH,POEETH,POWRETH,PPTETH,QSPETH,QTUMETH,RCNETH,RDNETH,REQETH,RLCETH,SALTETH,SNGLSETH,SNMETH,SNTETH,STEEMETH,STORJETH,STRATETH,SUBETH,TNBETH,TNTETH,TRIGETH,TRXETH,VENETH,VIBEETH,VIBETH,WABIETH,WAVESETH,WINGSETH,WTCETH,XLMETH,XMRETH,XRPETH,XVGETH,XZCETH,YOYOETH,ZECETH,ZRXETH,';

        o.updateData = function(){
            //console.log('Update data');
            $.getJSON(o.apiUrl,{symbols: o.symbols}, function(data){
               // console.log(data);
                o.data = data;
            });
        };

        o.getData = function(){
            return o.data;
        }; 

        o.getSymbolData = function(symbol){
            if(o.data.hasOwnProperty(symbol)){
                return o.data[symbol];
            }
            return null;
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