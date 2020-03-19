<div class="wrap">
    <h1>View Feedbacks</h1>
</div>
<?php
$sql = "SELECT name, email, subject, text FROM wp_feedbacks";
$results = $wpdb->get_results($sql);?>
<?php if (count($results)) : ?>
    <table>
        <thead>
        <tr>
            <th>User Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
        </thead>
        <? foreach ($results as $result) :?>
            <tr>
                <td><? echo $result->name; ?></td>
                <td><? echo $result->email; ?></td>
                <td><? echo $result->subject; ?></td>
                <td><? echo $result->text; ?></td>
            </tr>
        <? endforeach;
        ?>
    </table>
<? else :?>
    <div>no data</div>
<? endif;
