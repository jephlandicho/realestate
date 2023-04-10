<?php include 'header.php'; ?>

<body>
    <style type="text/css">
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .chatbox {
        width: 900px;
        height: 500px;
        margin: 50px auto;
        background-color: #f2f2f2;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .chatlogs {
        padding: 10px;
        height: 350px;
        overflow-y: scroll;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }

    .chat {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 10px;
    }

    .chat .user-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
    }

    .chat .user-photo img {
        width: 100%;
    }

    .chat .chat-message {
        width: calc(20% - 50px);
        background-color: #d5f5e3;
        border-radius: 5px;
        padding: 5px;
        box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        line-height: 1.4em;
    }

    .chat.friend .chat-message {
        width: calc(20% - 50px);
        background-color: #b2d5ff;
        border-radius: 5px;
        padding: 5px;
        box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.1);
        font-size: 14px;
        line-height: 1.4em;
    }

    .chat.self .chat-message {
        background-color: #ffcc99;
        border-top-right-radius: 0px;
    }

    .chat.friend {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 10px;
    }

    .chat.friend .user-photo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 10px;
    }

    .chat.friend .user-photo img {
        width: 100%;
    }

    .chat.friend .chat-message {
        background-color: #b2d5ff;
        border-top-left-radius: 0px;
    }

    .chat.self {
        flex-direction: row-reverse;
    }

    .chat-form {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        padding: 10px;
    }

    .chat-form textarea {
        flex: 1;
        resize: none;
        border-radius: 5px;
        padding: 5px;
    }

    .chat-form button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 10px;
    }
    </style>

    <!-- HANGGANG DITO ANG KUKUNIN-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Message</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Chat</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="chatbox">
            <div class="chatlogs" id="chatlogs-container">
                <div class="chat friend">
                    <div class="user-photo"><img src="users.png"></div>
                    <p class="chat-message">Bili ako bahay at lupa pre</p>
                </div>
                <div class="chat self">
                    <div class="user-photo"><img src="user.png"></div>
                    <p class="chat-message">Sige pre</p>
                </div>
                <div class="chat friend">
                    <div class="user-photo"><img src="user.png"></div>
                    <p class="chat-message">Tama na 1M?</p>
                </div>
            </div>
            <div class="chat-form">
                <textarea placeholder="Type your message here..."></textarea>
                <button>Send</button>
            </div>
        </div>

    </main>
    <script>
    const sendButton = document.querySelector('button');
    const messageInput = document.querySelector('textarea');
    const chatLogsContainer = document.querySelector('#chatlogs-container');

    sendButton.addEventListener('click', () => {
        const message = messageInput.value;
        if (message.trim() !== '') {
            const chat = document.createElement('div');
            chat.classList.add('chat', 'self');
            chat.innerHTML = `
      <div class="user-photo"><img src="user.png"></div>
      <p class="chat-message">${message}</p>
    `;
            chatLogsContainer.appendChild(chat);
            messageInput.value = '';
        }
    });
    </script>

    <?php include 'footer.php'; ?>