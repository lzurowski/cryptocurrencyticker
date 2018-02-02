<template>
    <div class="">
          <div class="row hide575">
              <div class="col-xl-2 text-center border">WALUTA</div>
              <div class="col-xl-2 text-center border">KURS</div>
              <div class="col-xl-2 text-center border">KUPNO</div>
              <div class="col-xl-2 text-center border">SPRZEDAŻ</div>    
              <div class="col-xl-1 text-center border">5 min</div> 
              <div class="col-xl-1 text-center border">1 H</div> 
              <div class="col-xl-2 text-center border">24 H</div> 
          </div>
        <div class="row"  v-for="tick in arrTicks">
            <div class="col-xl-2 text-left border cellT">
                <span class="icon" v-bind:class="tick.currency">{{tick.currency}}</span>
            </div>        
            <div class="col-xl-2 text-right border cellT" v-bind:class="tick.averageClass">{{tick.average}} {{tick.base_currency}} </div>
            <div class="col-xl-2 text-right border cellT hide575" v-bind:class="tick.bidClass">{{tick.bid}} {{tick.base_currency}}</div>
            <div class="col-xl-2 text-right border cellT hide575" v-bind:class="tick.askClass">{{tick.ask}} {{tick.base_currency}}</div>    
            <div class="col-xl-1 text-right border cellT hide575" v-bind:class="tick.minCh5Class">{{tick.minCh5}} %</div>  
            <div class="col-xl-1 text-right border cellT hide575" v-bind:class="tick.minCh60Class">{{tick.minCh60}} %</div>  
            <div class="col-xl-2 text-right border cellT hide575" v-bind:class="tick.hourCh24Class">{{tick.hourCh24}} %</div>  
        </div>   
    </div>   
</template>

<script>
import {Currency} from './../services/Currency.js';

export default {
  name: "TickTable",
  props: { symbols: { type: String, required: true } },
  data() {
    return {  
      tickUpdateInterval: 60, //time in seconds
      arrTicks: [],     
    };
  },
  created: function(){
    this.arrSymbols = this.symbols.split(",");
    for(var i= 0; i< this.arrSymbols.length; i++){
        this.arrTicks.push( new Currency(this.arrSymbols[i]));
    }
    var self = this;
    setTimeout(function(){self.updateTick();},2000);
  },
  methods:  {
    updateTick : function(){
      //update tick
      for(var i=0; i < this.arrTicks.length; i++){
        this.arrTicks[i].updateData();
      }      
      //udate new tick after interwl time
      var self = this;      
      setTimeout(function(){
         self.updateTick();
      }, self.tickUpdateInterval*1000);
    },
    getTextClass : function(param){

    }
  }
};
</script>
<style>
div.cellT{
  padding: 5px 15px;
}
span.icon{
  padding-left: 25px;
}
</style>
