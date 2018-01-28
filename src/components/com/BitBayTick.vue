<template>
    <div class="row">
      <div class="col-sm-2 text-left border cellT">
          <span class="icon" v-bind:class="tick.currency">{{tick.currency}}</span>
      </div>        
      <div class="col-sm-3 text-right border cellT" v-bind:class="tick.averageClass">{{tick.average | currencyFormat}} PLN </div>
      <div class="col-sm-2 text-right border cellT hide575" v-bind:class="tick.bidClass">{{tick.bid | currencyFormat}} PLN</div>
      <div class="col-sm-2 text-right border cellT hide575" v-bind:class="tick.askClass">{{tick.ask | currencyFormat}} PLN</div>    
      <div class="col-sm-3 text-right border cellT hide575">{{tick.volume | currencyFormat}} {{tick.currency}}</div>  
    </div>   
</template>

<script>
import {BitBayCurrency} from './../services/BitBayCurrency.js';

export default {
  name: "BitBayTick",
  props: { currency: { type: String, required: true } },
  data() {
    return {
      tickUpdateInterval: 30, //time in seconds
      tick: new BitBayCurrency(this.currency),     
    };
  },
  created: function(){
    this.updateTick();
  },
  methods:  {
    updateTick : function(){
      //update tick
      var d = new Date();
      //console.log("Update TICK:= "+this.currency+'  TIME: '+ d.toLocaleTimeString());
      this.tick.updateData();
      
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
span.icon.BTC{
  background: url("../../assets/currency/BTC.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.ETH{
  background: url("../../assets/currency/ETH.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.BCC{
  background: url("../../assets/currency/BCC.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.GAME{
  background: url("../../assets/currency/GAME.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.LTC{
  background: url("../../assets/currency/LTC.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.DASH{
  background: url("../../assets/currency/DASH.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.BTG{
  background: url("../../assets/currency/BTG.png") no-repeat left center;
  background-size: auto 100%;
}
span.icon.LSK{
  background: url("../../assets/currency/LSK.png") no-repeat left center;
  background-size: auto 100%;
}
div.cellT{
  padding: 5px 15px;
}
span.icon{
  padding-left: 25px;
}
</style>
