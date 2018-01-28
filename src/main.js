// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import 'bootstrap'

Vue.config.productionTip = false

Number.prototype.format = function(n, x, s, c) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
      num = this.toFixed(Math.max(0, ~~n));

  return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

Vue.filter('currencyFormat', function (value) {
  if (!value) return ''
  var v = new Number(value);
  return v.format(2, 3, ' ',',');
})


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
});
