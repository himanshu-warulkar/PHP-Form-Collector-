<?php
require_once 'functions.php';

$name = $feedback = "";
$error = $success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $feedback = trim($_POST["feedback"]);

    if (validate_input($name, $feedback)) {
        if (save_feedback($name, $feedback)) {
            $success = "Feedback submitted successfully.";
            $name = $feedback = "";
        } else {
            $error = "Error saving feedback. Please try again.";
        }
    } else {
        $error = "Name and feedback are required.";
    }
}

$feedback_list = read_feedback();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Collector</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Feedback Collector</h1>
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="name" placeholder="Your Name" value="<?php echo htmlspecialchars($name); ?>">
            <textarea name="feedback" placeholder="Your Feedback"><?php echo htmlspecialchars($feedback); ?></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
        <h2>All Feedback</h2>
        <div class="feedback-list">
            <?php if ($feedback_list): ?>
                <?php foreach ($feedback_list as $entry): ?>
                    <div class="feedback-entry">
                        <strong><?php echo htmlspecialchars($entry["name"]); ?></strong> 
                        <em><?php echo htmlspecialchars($entry["timestamp"]); ?></em>
                        <p><?php echo htmlspecialchars($entry["feedback"]); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No feedback available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
