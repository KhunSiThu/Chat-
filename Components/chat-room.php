<?php
session_start();

// Redirect to login page if user is not logged in
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit;
}

// Check if chooseFri is set in the session
if (isset($_SESSION['chooseFri'])) {
    include_once "./PHP/db_connect.php";

    // Sanitize the unique ID of the selected friend
    $chooseFri = $_SESSION['chooseFri'];

    // Prepared statement to fetch user's details based on chosen friend's unique ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE unique_id = ?");
    $stmt->bind_param("i", $chooseFri);  // Bind the parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        // Handle case when no data is found
        echo "<p>Friend not found!</p>";
        exit;
    }
?>

<section class="chat-room">
    <div class="flex justify-between chat-nav items-center">
        <div class="flex items-center">
            <!-- Profile Image -->
            <img class="pro border-color" src="<?= htmlspecialchars($row['profile_image']) ?>"
                class="w-16 h-16 rounded-full border-color border-2 shrink-0" />
            <div class="ml-4">
                <!-- Friend's Name -->
                <h1 class="text-2xl whitespace-nowrap"><?= htmlspecialchars($row['name']) ?></h1>
                <p class="text-xs whitespace-nowrap 
                <?= $row['status'] === "Active now" ? "active" : "text-muted"; ?>">
                    <?= $row['status'] === "Active now" ? "Active now" : "Line Out"; ?>
                </p>
            </div>
        </div>
        <i class="fa-solid fa-ellipsis-vertical text-2xl"></i>
    </div>

    <div class="chat-container p-10">
        <!-- Chat content will be added here -->
    </div>

    <form id="send-message-form" action="../index.php" class="flex justify-center chat-box" method="post">
        <input hidden name="uniqueId" id="send" type="text" value="<?= htmlspecialchars($_SESSION['unique_id']) ?>">
        <input hidden name="receive" id="receive" type="text" value="<?= htmlspecialchars($chooseFri) ?>">

        <div class="flex justify-between border-color">
            <!-- Send Image Button -->
            <button class="sendImg-btn btn btn-primary">
                <i class="fa-solid fa-image"></i>
            </button>

            <!-- Message Input Field -->
            <input type="text" name="message" class="sendText">
        </div>

        <!-- Send Message Button -->
        <button class="send-message-btn btn btn-primary">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </form>
</section>

<?php
} else {
    // If chooseFri is not set, show a default message
    ?>

    <section class="no-chat-con">
        <div>
            <img src="../images/chat.png" alt="">
            <h1>Chat!</h1>
        </div>
    </section>

<?php } ?>
