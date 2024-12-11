const sendMessageForm = document.querySelector("#send-message-form");
const sendMessageBtn = document.querySelector(".send-message-btn");
const receive_id = document.querySelector("#receive").value;
const uniqueId = document.querySelector("#send").value;

function scrollToBottom() {
  document.querySelector(".chat-container").scrollTop =
    document.querySelector(".chat-container").scrollHeight;
}

sendMessageForm.onsubmit = (e) => {
  e.preventDefault();
};

sendMessageBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./send-message.php", true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        document.querySelector(".sendText").value = "";
      }
    }
  };

  let formData = new FormData(sendMessageForm);
  xhr.send(formData);
  scrollToBottom();
};

setInterval(() => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "./get-messages.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        let data = xhr.response;
        document.querySelector(".chat-container").innerHTML = data;
        scrollToBottom();
      }
    }
  };

  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("receive_id=" + receive_id + "&uniqueId=" + uniqueId);
}, 500);
