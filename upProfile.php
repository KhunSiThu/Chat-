<?php


$uniqueId = $_GET['uniqueId'];

?>

<?php require_once "./Components/header.php"; ?>

<form enctype="multipart/form-data" action="./PHP/saveProfileImg.php?uniqueId=<?=$uniqueId ?>" method="post" class="flex items-center justify-center w-screen h-screen  ">
  <!-- Profile Card -->
  <div
    class=" p-10 relative">
    <!-- Header -->
    <h1 class=" text-3xl font-bold text-center text-gray-800 mb-8">
      Update Your Profile
    </h1>

    <!-- Profile Image -->
    <div class="flex p-6 justify-center mb-8">
      <div  class="relative group  profile-con">
        <img

          <?php if ($_GET['gender'] === "Male") { ?>
          src="./images/male.png"
          <?php } else { ?>
          src="./images/female.webp"
          <?php } ?>

          id="profile-image"
          alt="Profile Image"
          class="rounded-full border-4 border-gray-300 shadow-lg  object-cover transition-transform group-hover:scale-105" />
        <input id="image-input" name="image" type="file" accept="image/*" class="hidden" />
        <button type="button"
          onclick="document.getElementById('image-input').click()"
          class="absolute bottom-0 right-0 text-black text-sm  rounded-full shadow-md  transition flex flex-col items-center justify-end pb-5">
          Change
        </button>
      </div>
    </div>


    <!-- Action Buttons -->
    <div class="flex justify-evenly gap-8 space-x-6">
      <button
        id="cancel-button"
        class=" py-3 w-full bg-red-600 text-white rounded-lg text-lg font-medium shadow-md hover:bg-red-700 transition">
        Skip
      </button>
      <button
        type="submit"
        class=" py-3 w-full text-white rounded-lg text-lg font-medium shadow-md transition bg-cyan-400 hover:bg-cyan-500">
        Confirm
      </button>
    </div>

  </div>
</form>

</body>
<script>


  // Handle image preview
  document
    .getElementById("image-input")
    .addEventListener("change", (event) => {
      const spinner = document.getElementById("spinner");

      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
          document.getElementById("profile-image").src = e.target.result;
         
        };
        reader.readAsDataURL(file);
      } 
    });





  // Reset form
  document.getElementById("cancel-button").addEventListener("click", () => {
    // Reset profile image
    document.getElementById("profile-image").src =
      "https://via.placeholder.com/200";

    // Reset username
    document.getElementById("username").textContent = "Khun Si Thu";
    document.getElementById("username").classList.remove("hidden");
    document.getElementById("username-input").classList.add("hidden");
    document.getElementById("save-username").classList.add("hidden");

    // Clear image input
    document.getElementById("image-input").value = "";
  });

</script>

</html>