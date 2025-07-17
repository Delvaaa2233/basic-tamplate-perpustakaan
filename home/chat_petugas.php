<?php if (session_status() === PHP_SESSION_NONE) { session_start(); } ?>
<section class="content">
  <div class="container-fluid">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">📘 Chatbot Petugas Perpustakaan</h3>
      </div>
      <div class="box-body">
        <style>
  #chatbox {
    width: 100%;
    max-width: 600px;
    margin: auto;
    background: #f0f0f0;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }

  #chatlog {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-height: 400px;
    overflow-y: auto;
    padding-bottom: 10px;
  }

  .message {
    padding: 10px 15px;
    border-radius: 20px;
    max-width: 80%;
    font-size: 14px;
    word-wrap: break-word;
  }

  .bot {
    align-self: flex-start;
    background-color: #e2f7d4;
    color: black;
    border-bottom-left-radius: 3px;
  }

  .user {
    align-self: flex-end;
    background-color: #cce5ff;
    color: black;
    border-bottom-right-radius: 3px;
  }

  textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 10px;
    border: 1px solid #ccc;
    resize: none;
    font-size: 14px;
  }

  button {
    margin-top: 10px;
    padding: 8px 18px;
    background: #007BFF;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
  }
</style>

<div id="chatbox">
  <div id="chatlog"></div>
  <form id="chatForm" method="POST">
    <textarea name="pesan" rows="2" placeholder="Tanyakan sesuatu..."></textarea>
    <button type="submit">Kirim</button>
  </form>
</div>

<script>
  document.getElementById('chatForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const userMsg = formData.get('pesan');

    fetch('home/bot_petugas.php', {
      method: 'POST',
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      const chatlog = document.getElementById('chatlog');
      chatlog.innerHTML += `<div class="message user">🧑 <b>Kamu:</b> ${userMsg}</div>`;
      chatlog.innerHTML += `<div class="message bot">🤖 <b>Bot:</b> ${data}</div>`;
      chatlog.scrollTop = chatlog.scrollHeight;
      document.getElementById('chatForm').reset();
    });
  });
</script>
      </div>
    </div>
  </div>
</section>