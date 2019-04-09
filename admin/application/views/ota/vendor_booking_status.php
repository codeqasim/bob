
<?php foreach ($reports->response as $report){?>
<tr>
    <th><strong class="fosr"><?=strtoupper($report->name)?></strong></th>
    <th><?=$report->month_search?></th>
    <th><?=$report->bookings?></th>
    <th><?=$report->paid_booking?></th>
    <th><?=$report->unpaid_booking?></th>
    <th><?=$report->cancel_booking?></th>
    <th><?=$report->pending_booking?></th>
</tr>
<?php } ?>
<tr>
    <th><strong class="fosr">TOTAL</strong></th>
    <th><?=$reports->total_searching?></th>
    <th><?=$reports->total_booking?></th>
    <th><?=$reports->total_paid?></th>
    <th><?=$reports->total_unpaid?></th>
    <th><?=$reports->total_cancel?></th>
    <th><?=$reports->total_pending?></th>
</tr>