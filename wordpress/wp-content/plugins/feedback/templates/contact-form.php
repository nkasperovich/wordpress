<form action="wp-content/plugins/feedback/save_feedback.php" method="post" ">
    <label for="name">Name</label>
    <input type="text" placeholder="Your Name" id="name" name="name" required>
    <label for="email">Email</label>
    <input type="email" placeholder="Your Email" id="email" name="email" required>
    <?
    global $wpdb;
    $sql = "SELECT * FROM wp_subjects";
    $results = $wpdb->get_results($sql);
    ?>
    <label for="subject">Subject of feedback</label>
    <select name="subject" class="form-field" style="width: 50%; padding: 1.5rem 1.8rem;">
    <?php foreach ($results as $result): ?>
        <option value="<? echo $result->subject ?>"><? echo $result->subject ?></option>
    <? endforeach; ?>
    </select>
    <label for="message">Feedback message</label>
    <textarea name="message" id="message" placeholder="Your Message" required></textarea>
    <br>
    <button type="submit">Submit</button>
</form>