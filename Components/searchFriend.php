<?php
include_once "./PHP/db_connect.php";

session_start();

$search = isset($_GET["search"]) ? $_GET["search"] : '';
$uniqueId = $_SESSION['unique_id'];

$sql = "SELECT users.*, 
            (SELECT 'Request' FROM friendRequests WHERE request_id = ? AND forConfirm_id = users.unique_id LIMIT 1) AS request_status,
            (SELECT 'Confirm' FROM friendRequests WHERE forConfirm_id = ? AND request_id = users.unique_id LIMIT 1) AS confirm_status,
            (SELECT 'Friend' FROM friendList WHERE (request = ? AND confirm = users.unique_id) OR (confirm = ? AND request = users.unique_id) LIMIT 1) AS friend_status
        FROM users
        WHERE unique_id != ? AND (name LIKE ? OR ? = '')";

$stmt = $conn->prepare($sql);
$searchTerm = "%" . $search . "%";
$stmt->bind_param("iiiisss", $uniqueId, $uniqueId, $uniqueId, $uniqueId, $uniqueId, $searchTerm, $search);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="searchFriend-con">
    <div class="searchFriend">
        <div class="search-con">
            <form action="../main-page.php" class="searchForm flex justify-between relative my-6 p-3 rounded-md border border-color">
                <input class="text-sm outline-none bg-transparent px-1 w-[330px]" placeholder="Search Friends ..." name="search" value="<?= htmlspecialchars($search) ?>" />
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                </button>
            </form>
        </div>



        <div class="friList-con">
            <ul class="friend-list  mt-5">
                <?php while ($allUser = $result->fetch_assoc()) : ?>
                    <li class="flex items-center justify-between cursor-pointer">
                        <div class="flex items-center">
                            <img src="<?= htmlspecialchars($allUser['profile_image']) ?>" class="rounded-full border-color shrink-0 pro" />
                            <div class="ml-3">
                                <h1 class="text-sm whitespace-nowrap mb-1"><?= htmlspecialchars($allUser['name']) ?></h1>
                                <p class="text-xs whitespace-nowrap text-muted">Active free account</p>
                            </div>
                        </div>

                        <?php 
                        $status = $allUser['request_status'] ?: ($allUser['confirm_status'] ?: ($allUser['friend_status'] ?: 'Add'));
                        switch ($status) {
                            case 'Request':
                                echo '<a href="../PHP/friendRequest.php?friendId=' . $allUser['unique_id'] . '&search=' . urlencode($search) . '" class="btn-primary">Request</a>';
                                break;
                            case 'Confirm':
                                echo '<a href="../PHP/addFriend.php?friId='.$allUser['unique_id'].'&search=' . urlencode($search) .'" class="btn-primary">Confirm</a>';
                                break;
                            case 'Friend':
                                echo '<a href="../PHP/addFriend.php?friId='.$allUser['unique_id'].'&search=' . urlencode($search) .'" class="btn-primary">Unfriend</a>';
                                break;
                            default:
                                echo '<a href="../PHP/friendRequest.php?friendId=' . $allUser['unique_id'] . '&search=' . urlencode($search) . '" class="btn-primary">Friend</a>';
                                break;
                        }
                        ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>