<?php
include_once "./PHP/db_connect.php";  // Include your database connection here

// Start the session to track user
session_start();

// Default profile image if gender is not set
$defaultImage = "./images/female.webp"; // Fallback to female image if gender is not provided
$uniqueId = isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : null;
$gender = isset($_GET['gender']) ? $_GET['gender'] : null;


// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   // Check if the form is submitted and an image is uploaded
//   if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
//     // Sanitize and validate file upload
//     $image = $_FILES['image'];
//     $fileName = basename($image['name']);
//     $fileTmpName = $image['tmp_name'];
//     $fileSize = $image['size'];
//     $fileError = $image['error'];
//     $fileType = $image['type'];

//     // Check if the file is an image
//     $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
//     if (in_array($fileType, $allowedTypes)) {
//       // Move the uploaded image to a designated folder
//       $uploadDirectory = './uploads/';
//       $uploadPath = $uploadDirectory . $fileName;

//       // Check if the file already exists
//       if (!file_exists($uploadPath)) {
//         move_uploaded_file($fileTmpName, $uploadPath);
//         // Save the new image path in the database (replace with appropriate SQL query)
//         $sql = "UPDATE users SET profile_image = '$fileName' WHERE unique_id = '$uniqueId'";
//         if (mysqli_query($conn, $sql)) {
//           // Successfully updated profile image
//           $_SESSION['profile_image'] = $uploadPath;
//           header("Location:./main-page.php?");
//         } else {
//           echo "Error updating profile image.";
//         }
//       } else {
//         echo "File already exists.";
//       }
//     } else {
//       echo "Invalid file type. Only JPG, PNG, JPEG, or WebP images are allowed.";
//     }
//   }
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {

  $image = $_FILES['image'];

  if ($image['error'] === 0) {

    $fileTmpPath = $image['tmp_name'];
    $fileName = $image['name'];
    $fileSize = $image['size'];
    $fileType = $image['type'];

    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newFileName = uniqid() . '.' . $fileExtension;

    $uploadDir = './uploads/';
    $destination = $uploadDir . $newFileName;

    if (move_uploaded_file($fileTmpPath, $destination)) {

      $sql = "UPDATE users SET profile_image = '$destination' WHERE unique_id = '$uniqueId'";
      if (mysqli_query($conn, $sql)) {
        header("Location:./main-page.php?");
      } else {
        echo "Error updating profile image.";
      }
    }
  }
}

// Get user profile image or default
$sql = "SELECT * FROM users WHERE unique_id = $uniqueId";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$profileImage = isset($row['profile_image']) ? $row['profile_image'] : $defaultImage;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <link rel="stylesheet" href="./CSS/output.css">
</head>

<style>
  .profile-con {

    button {
      width: 350px;
      opacity: 0;
      height: 350px;
      display: flex;
      justify-content: center;
      position: absolute;
      top: 0;
      color: white;
      font-size: 40px;
    }

    button:hover {
      background-color: rgba(0, 0, 0, 0.77);
      opacity: 1;
    }
  }
</style>

<body>

  <!-- Profile Update Form -->
  <form enctype="multipart/form-data" action="" method="POST" class="flex items-center justify-center w-screen h-screen">
    <!-- Profile Card -->
    <div class="p-10 relative">
      <h1 class="text-3xl font-bold text-center mb-8">Update Your Profile</h1>

      <!-- Profile Image -->
      <div class="flex p-6 justify-center mb-8">
        <div class="relative group profile-con" style="width: 350px; height: 350px;">
          <!-- Profile Image -->
          <img id="profile-image"
            src="<?= $profileImage ?>"
            alt="Profile Image"
            class="rounded-full border-4 border-gray-300 shadow-lg object-cover transition-transform group-hover:scale-105"
            style="object-fit: cover; width: 100%; height: 100%;" />
          <input id="image-input" name="image" type="file" accept="image/*" class="hidden" />
          <button type="button" onclick="document.getElementById('image-input').click()"
            class="absolute bottom-0 right-0 text-black text-sm rounded-full shadow-md transition flex flex-col items-center justify-end pb-5">
            Change
          </button>
        </div>
      </div>


      <!-- Action Buttons -->
      <div class="flex justify-evenly gap-8 space-x-6">
        <button id="cancel-button" type="button" class="py-3 w-full bg-red-600 text-white rounded-lg text-lg font-medium shadow-md hover:bg-red-700 transition">Skip</button>
        <button type="submit" class="py-3 w-full text-white rounded-lg text-lg font-medium shadow-md transition bg-cyan-400 hover:bg-cyan-500">Confirm</button>
      </div>
    </div>
  </form>

  <!-- Cancel Button JS to Reset Form -->
  <script>
    document.getElementById("cancel-button").addEventListener("click", () => {
      document.getElementById("profile-image").src = "https://via.placeholder.com/200";
      document.getElementById("image-input").value = "";
    });

    // Handle image preview
    document.getElementById("image-input").addEventListener("change", (event) => {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          document.getElementById("profile-image").src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>

</body>

</html>

<?php
$conn->close(); // Close database connection
?>