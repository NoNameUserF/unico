<?php 
include ('app/controllers/passport.php');?>
<div class="activity">
  <h2>Activity</h2>
  <p style='text-align:center; color:tomato'><?=$activityMessage ?></p>
  <table class="activity-table">
    <tr class="rows-names">
      <th class="transactions">Transactions</th>
      <th class="id-number">ID number</th>
      <th class="status">Status</th>
      <th class="date">Date</th>
      <th class="amound">Amuond</th>
    </tr>
     <tr class="one-action">
            <td class="transactions-cell">
              <img src="assets/img/bitcoin.svg" alt="" />BTC
            </td>
            <td class="id-number-cell">pok8341dg200349</td>
            <td class="status-cell">Buy</td>
            <td class="date-cell">04.09.22</td>
            <td class="amound-cell amound-cell-buy">+ 470</td>
          </tr>
          <tr class="one-action one-action-close">
            <td class="transactions-cell">
              <img src="assets/img/bitcoin.svg" alt="" />USDT
            </td>
            <td class="id-number-cell">pok8341dg200349</td>
            <td class="status-cell">Close</td>
            <td class="date-cell">04.09.22</td>
            <td class="amound-cell">- 470</td>
          </tr>
          <tr class="one-action one-action-deposit">
            <td class="transactions-cell">
              <img src="assets/img/bitcoin.svg" alt="" />ETH
            </td>
            <td class="id-number-cell">pok8341dg200349</td>
            <td class="status-cell">Dep</td>
            <td class="date-cell">04.09.22</td>
            <td class="amound-cell">+ 470</td>
          </tr>
          <tr class="one-action one-action-withdraw">
            <td class="transactions-cell">
              <img src="assets/img/bitcoin.svg" alt="" />GNC
            </td>
            <td class="id-number-cell">pok8341dg200349</td>
            <td class="status-cell">Wit</td>
            <td class="date-cell">04.09.22</td>
            <td class="amound-cell amound-cell-withdraw">+ 470</td>
          </tr>
  </table>
</div>
