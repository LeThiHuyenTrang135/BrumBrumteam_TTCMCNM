<div id="chat-bubble" onclick="toggleChat()">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
    </svg>
</div>

<div id="chat-box" class="hidden">
    <div class="chat-header">
        <span>Virtual Assisstant</span>
        <button onclick="toggleChat()"
            style="background:none; border:none; color:white; cursor:pointer;">&times;</button>
    </div>
    <div id="chat-messages">
        <div class="message bot-message">Hello there! Welcome to BrumBrum! How can I assist you today?</div>
    </div>
    <div class="chat-input-area">
        <input type="text" id="user-input" placeholder="Enter..." onkeypress="handleEnter(event)">
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

<style>
    #chat-bubble {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }

    #chat-bubble {
        position: fixed;
        bottom: 20px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #E7AB3C;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        transition: transform 0.3s;
    }

    #chat-bubble:hover {
        transform: scale(1.1);
    }

    /* Chat Box */
    #chat-box {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 350px;
        height: 450px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        z-index: 9999;
        overflow: hidden;
    }

    .hidden {
        display: none !important;
    }

    /* Header */
    .chat-header {
        background-color: #252525;
        color: white;
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: bold;
    }

    /* Messages Area */
    #chat-messages {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    /* Bong bóng tin nhắn */
    .message {
        max-width: 80%;
        padding: 8px 12px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.4;
    }

    .bot-message {
        background-color: #e9ecef;
        align-self: flex-start;
        border-bottom-left-radius: 2px;
    }

    .user-message {
        background-color: #252525;
        color: white;
        align-self: flex-end;
        border-bottom-right-radius: 2px;
    }

    /* Input Area */
    .chat-input-area {
        padding: 10px;
        border-top: 1px solid #ddd;
        display: flex;
        gap: 5px;
    }

    .chat-input-area input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
    }

    .chat-input-area button {
        padding: 8px 15px;
        background-color: #252525;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
    }

    .chat-input-area button:disabled {
        background-color: #ccc;
    }
</style>

<script>
    const chatBox = document.getElementById('chat-box');
    const messagesContainer = document.getElementById('chat-messages');
    const userInput = document.getElementById('user-input');

    function toggleChat() {
        chatBox.classList.toggle('hidden');
        if (!chatBox.classList.contains('hidden')) {
            userInput.focus();
        }
    }

    function handleEnter(e) {
        if (e.key === 'Enter') sendMessage();
    }

    async function sendMessage() {
        const text = userInput.value.trim();
        if (!text) return;

        addMessage(text, 'user-message');
        userInput.value = '';


        const sendBtn = document.querySelector('.chat-input-area button');
        sendBtn.disabled = true;
        sendBtn.innerText = '...';

        try {
            const response = await fetch("{{ route('chatbot.ask') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    message: text
                })
            });

            const data = await response.json();

            if (data.reply) {
                addMessage(data.reply, 'bot-message');
            } else {
                addMessage("There was an error, please try again.", 'bot-message');
            }

        } catch (error) {
            console.error('Error:', error);
            addMessage("Server connection error.", 'bot-message');
        } finally {
            sendBtn.disabled = false;
            sendBtn.innerText = 'Send';
        }
    }

    function addMessage(text, className) {
        const div = document.createElement('div');
        div.classList.add('message', className);
        div.innerText = text;
        messagesContainer.appendChild(div);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
</script>
