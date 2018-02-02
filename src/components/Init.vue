<template>
  <div class="baseApp">
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
          <tick-table symbols="BTCPLN,ETHPLN,LTCPLN,LSKPLN,BCCPLN,BTGPLN,DASHPLN,GAMEPLN"></tick-table>
      </div>
      <div id="binance" class="tab-pane fade" role="tabpanel" aria-labelledby="binance-tab">
         <tick-table symbols="ADAETH,XLMETH,IOTAETH,VENETH,REQETH,VIBEETH,XRPETH,NEOETH,BCCETH,LTCETH,EOSETH,DASHETH,XMRETH"></tick-table>
      </div>
      <div id="wallet" class="tab-pane fade" role="tabpanel" aria-labelledby="wallet-tab">
        User wallet settings
      </div>
    </div>
  </div>
</template>

<script>
//import {BinanceBookTicker} from "./services/BinanceBookTicker.js";
import {ServerTicker} from "./services/ServerTicker.js";

import BitBayTick from "./com/BitBayTick.vue";
import BinanceTickTable from "./com/BinanceTickTable.vue";
import TickTable from "./com/TickTable.vue";

//get ticker data from binance service
//BinanceBookTicker.getinstance().start();
//BinanceBookTicker.getInstance().start();
ServerTicker.getInstance().start();

export default {
  components: {
    BitBayTick: BitBayTick,
    BinanceTickTable: BinanceTickTable,
    TickTable: TickTable,
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
div.baseApp{
  margin: 0 5%;
}
</style>