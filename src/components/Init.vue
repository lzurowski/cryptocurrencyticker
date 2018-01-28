<template>
  <div class="baseApp container">
    <ul class="nav nav-tabs" id="baseAppTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="bitbay-tab" data-toggle="tab" href="#bitbay" role="tab" aria-controls="bitbay" aria-selected="true">BitBay</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="binance-tab" data-toggle="tab" href="#binance" role="tab" aria-controls="binance" aria-selected="false">Binance</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="wallet-tab" data-toggle="tab" href="#wallet" role="tab" aria-controls="wallet" aria-selected="false">Your Wallet</a>
      </li>
    </ul>
    <div class="tab-content" id="baseAppTabContent">
      <div id="bitbay" class="tab-pane fade show active" role="tabpanel" aria-labelledby="bitbay-tab">
        <div class="container">
          <div class="row hide575">
              <div class="col-sm-2 text-center border">WALUTA</div>
              <div class="col-sm-3 text-center border">KURS</div>
              <div class="col-sm-2 text-center border">KUPNO</div>
              <div class="col-sm-2 text-center border">SPRZEDAŻ</div>    
              <div class="col-sm-3 text-center border">WOLUMEN</div>  
          </div>
          <bit-bay-tick currency="BTC"></bit-bay-tick> 
          <bit-bay-tick currency="ETH"></bit-bay-tick>
          <bit-bay-tick currency="BCC"></bit-bay-tick>
          <bit-bay-tick currency="BTG"></bit-bay-tick>
          <bit-bay-tick currency="LTC"></bit-bay-tick>
          <bit-bay-tick currency="LSK"></bit-bay-tick>
          <bit-bay-tick currency="DASH"></bit-bay-tick>
          <bit-bay-tick currency="GAME"></bit-bay-tick>
        </div>
      </div>
      <div id="binance" class="tab-pane fade" role="tabpanel" aria-labelledby="binance-tab">
          <binance-tick-table></binance-tick-table>
      </div>
      <div id="wallet" class="tab-pane fade" role="tabpanel" aria-labelledby="wallet-tab">
        User wallet settings
      </div>
    </div>
  </div>
</template>

<script>
import {BinanceBookTicker} from "./services/BinanceBookTicker.js";

import BitBayTick from "./com/BitBayTick.vue";
import BinanceTickTable from "./com/BinanceTickTable.vue";

//get ticker data from binance service
//BinanceBookTicker.getinstance().start();
BinanceBookTicker.getInstance().start();


export default {
  components: {
    BitBayTick: BitBayTick,
    BinanceTickTable: BinanceTickTable
  },
  name: "Init",
  data() {
    return {
      msg: "Welcome to Your Vue.js App"
    };
  },
  methods: {
    init: function() {}
  }
};
</script>
<style>
@media only screen and (max-width: 575px) {
    .hide575{
      display: none;
    }
}
</style>