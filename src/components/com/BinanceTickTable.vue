<template>
    <div class="container">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">PARA WALUTOWA</th>
              <th scope="col">BID</th>
              <th scope="col">ASK</th>
              <th scope="col">ZMIANA</th>
            </tr>
          </thead>
          <tbody>
              <tr v-for = "item in currArr">
                <th scope="row text-left">{{ item.getSymbol() }}</th>
                <td scope="col text-right"  v-bind:class="item.bidClass">{{ item.bid }} {{ item.baseCurr }}</td>
                <td scope="col text-right"  v-bind:class="item.askClass">{{ item.ask }} {{ item.baseCurr }}</td>
                <td scope="col"></td>
              </tr>
          </tbody>
        </table>
        </div>
    </div>   
</template>

<script>
import {BinanceCurrency} from './../services/BinanceCurrency.js';

export default {
  name: "BinanceTickTable",
  data() {
    return {
      tickUpdateInterval: 30,
      arrPair: [{c: 'ADA', b: 'ETH'},{c: 'REQ', b: 'ETH'},{c: 'XLM', b: 'ETH'}],
      currArr: []
    };
  },
  created: function(){
    for(var i = 0; i < this.arrPair.length; ++i){
        var p = this.arrPair[i];
        this.currArr.push(new BinanceCurrency(p.c,p.b));    
    }
    this.updateTicks();
  },
  methods:  {
    updateTicks : function(){
      for(var i = 0; i < this.currArr.length; ++i){
        var c = this.currArr[i];
        c.updateData();    
      }
      //udate new tick after interwl time
      var self = this;      
      setTimeout(function(){
         self.updateTicks();
      }, self.tickUpdateInterval*1000);
    }    
  }
};
</script>
<style>

</style>
