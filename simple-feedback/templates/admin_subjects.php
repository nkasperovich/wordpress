<?php
if (isset($_POST['add_new']) && $_POST['action'] == 'add_new_subject') {
    $subject = htmlspecialchars($_POST['subject']);
    $email = htmlspecialchars($_POST['subject_email']);

    try {
        global $wpdb;
        $table_name = $wpdb->prefix . 'subjects';
        $wpdb->insert($table_name, array(
            'subject' => $subject,
            'email' => $email
        ));
        echo 'Subject added';
    } catch (Exception $e) {
        echo $e;
    }

} elseif (isset($_POST['delete_subject'])) {
    $id = $_POST['delete_subject_id'];
    $table_name = $wpdb->prefix . 'subjects';

    try {
        $wpdb->delete($table_name, array('id' => $id));
        echo 'Subject deleted';
    } catch (Exception $e) {
        echo $e;
    }
}
else { ?>
<div class="wrap">
    <h1>Manage subjects</h1>
    <h3>Add Subject</h3>
    <form method="post" action="" name="add_author" enctype="multipart/form-data">
        <table >
            <thead>
            <tr valign="top">
                <th >Feedback subject title</th>
                <th >Feedback subject email</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" name="subject" value=""/></td>
                <td><input type="email" name="subject_email" value=""/></td>
                <input type="hidden" name="action" value="add_new_subject"/>
            </tr>
            </tbody>
        </table>
        <input type="submit" name="add_new" class="button button-primary" value="Add subject">
         <? $sql = "SELECT * FROM wp_subjects";
            $results = $wpdb->get_results($sql);
            ?>
            <? if (count($results)) : ?>
                <h3>List of subjects</h3>
            <table>
                <thead>
                <tr>
                    <th>Subject</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <input type="hidden" name="delete_subject_id" value="">
                <? foreach ($results as $result) :?>
                    <tr>
                        <td><? echo $result->subject; ?></td>
                        <td><? echo $result->email; ?></td>
                        <td><? echo '<input type="hidden" name="subject_id" value="' . $result->id . '"><input type="submit" name="delete_subject" class="button action" value="delete"/>' ?></td>
                    </tr>
                <? endforeach; ?>
            </table>
        <? else : ?>
            <h3>View Subjects</h3>
            <div>no data</div>
        <? endif;
        echo '</form></div>';
        }
        ?>
<script>
    jQuery('[name="delete_subject"]').click(function () {
        jQuery('[name="delete_subject_id"]').val(jQuery(this).prev().val());
    })
</script>
