<footer class="site-footer">
    <p>&copy; <?php echo date("Y"); ?> Gull Boutique. All rights reserved.</p>
    <p>Made with love for the modern woman.</p>
</footer>

<script src="/gull_boutique/js/main.js"></script>
<div id="chatbot-widget">
    <button id="chatbot-toggle">💬</button>
    <div id="chatbot-window" class="hidden">
        <div id="chatbot-header">Gull Boutique Assistant</div>
        <div id="chatbot-messages"></div>
        <form id="chatbot-form">
            <input type="text" id="chatbot-input" placeholder="Ask us anything..." autocomplete="off">
            <button type="submit">➤</button>
        </form>
    </div>
</div>

<script>
const toggleBtn = document.getElementById('chatbot-toggle');
const chatWindow = document.getElementById('chatbot-window');
const form = document.getElementById('chatbot-form');
const input = document.getElementById('chatbot-input');
const messages = document.getElementById('chatbot-messages');

toggleBtn.addEventListener('click', () => {
    chatWindow.classList.toggle('hidden');
});

function addMessage(text, sender) {
    const div = document.createElement('div');
    div.className = 'chat-msg ' + sender;
    div.textContent = text;
    messages.appendChild(div);
    messages.scrollTop = messages.scrollHeight;
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const msg = input.value.trim();
    if (!msg) return;

    addMessage(msg, 'user');
    input.value = '';
    addMessage('Typing...', 'bot typing');

    try {
        const res = await fetch('/gull_boutique/chatbot_handler.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: msg })
        });
        const data = await res.json();
        document.querySelector('.typing').remove();
        addMessage(data.reply, 'bot');
    } catch (err) {
        document.querySelector('.typing').remove();
        addMessage('Something went wrong. Please try again.', 'bot');
    }
});
</script>
</body>
</html>