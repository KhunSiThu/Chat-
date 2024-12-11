<?php

session_start();

if (isset($_SESSION['unique_id'])) {

    include_once "db_connect.php";
    $uniqueId = $_SESSION['unique_id'];
    $chooseFri = $_SESSION['chooseFri'];


    $sql = "select * from messages left join users on users.unique_id = messages.send_id where (receive_id = $chooseFri and send_id = $uniqueId) or (receive_id = $uniqueId and send_id = $chooseFri) order by message_id";

    $query = mysqli_query($conn, $sql);

    

    $response = '';

    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['send_id'] === $uniqueId) {
                $response .= '
                    <div class="chat chat-end mb-3">
                    <div class="chat-image avatar">
                        <div class="w-8 rounded-full">
                            <img class=""
                            alt="Tailwind CSS chat bubble component"
                            src="'.$row['profile_image'].'" />
                        </div>
                    </div>
                    <div class="chat-header text-muted text-x">
                        '.$row['name'].'
                        
                    </div>
                        <div class="chat-bubble my-1 text-xl messText">'.$row['message'].'</div>
                        <time class="text-xs opacity-50 ">'.date("d M h : i A", strtotime($row['create_at'])).'</time>
                    </div>
                    
               
                            ';
            } else {
                $response .= '

                    <div class="chat chat-start mb-3">
                        <div class="chat-image avatar">
                            <div class="w-8 rounded-full">
                            <img
                                alt="Tailwind CSS chat bubble component"
                                src="'.$row['profile_image'].'" />
                            </div>
                        </div>
                        
                        <div class="chat-header text-muted text-xs">
                            '.$row['name'].'
                        </div>
                        <div class="chat-bubble my-1 text-xl messText">'.$row['message'].'</div>
                        
                       
                        
                    </div>
                    <time class="text-xs opacity-50 ">'.date("d M h : i A", strtotime($row['create_at'])).'</time>
                    
                            ';
            }
        }
    }

    echo $response;
}
