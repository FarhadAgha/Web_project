<footer class="site-footer-main">
    <div class="footer-columns">
        <div class="footer-col">
            <h4>Gull Boutique</h4>
            <p>We are located at Cut peaice galli No, 3  Masjid road, Quetta.</p>
            <p>Call us: <a href="tel:03058973929">0305-8973929</a></p>
            <p>Email: <a href="mailto:infogullboutiquepk@gmail.com">infogullboutiquepk@gmail.com</a></p>
        </div>
        <div class="footer-col">
            <h4>Quick Links</h4>
            <a href="/gull_boutique/index.php">Home</a>
            <a href="/gull_boutique/products.php">Products</a>
            <a href="/gull_boutique/wishlist.php">Wishlist</a>
            <a href="/gull_boutique/about.php">About</a>
        </div>
        <div class="footer-col">
            <h4>Customer Service</h4>
            <a href="/gull_boutique/contact.php">Contact</a>
            <a href="/gull_boutique/shipping-policy.php">Shipping Policy</a>
            <a href="/gull_boutique/return-exchange.php">Return &amp; Exchange Policy</a>
            <a href="/gull_boutique/terms-of-service.php">Terms Of Service</a>
            <a href="/gull_boutique/cloth-care.php">Cloth Care</a>
        </div>
        <div class="footer-col">
            <h4>Information Links</h4>
            <a href="/gull_boutique/about.php">About Us</a>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Gull Boutique. All rights reserved.</p>
    </div>
</footer>

<?php include_once __DIR__ . '/../includes/chatbot_config.php'; ?>
<script>
const GULL_GEMINI_KEY = '<?php echo GEMINI_API_KEY; ?>';
</script>
<script src="/gull_boutique/js/main.js"></script>
<a href="https://wa.me/923352730073?text=Hi! I have a question about Gull Boutique." class="whatsapp-btn" target="_blank">
    <svg viewBox="0 0 32 32" width="30" height="30" fill="white">
        <path d="M16.001 3C9.107 3 3.5 8.607 3.5 15.5c0 2.36.653 4.57 1.789 6.454L3 29l7.234-2.247A12.44 12.44 0 0016 28c6.894 0 12.5-5.606 12.5-12.5S22.895 3 16.001 3zm0 22.75c-1.93 0-3.784-.516-5.409-1.492l-.388-.23-4.294 1.334 1.372-4.184-.253-.402A10.19 10.19 0 015.75 15.5c0-5.65 4.6-10.25 10.251-10.25 5.649 0 10.249 4.6 10.249 10.25S21.65 25.75 16.001 25.75z"/>
        <path d="M21.61 18.19c-.301-.15-1.783-.879-2.06-.979-.276-.101-.477-.15-.678.15-.201.301-.779.98-.955 1.181-.176.2-.352.226-.653.075-.301-.151-1.271-.469-2.421-1.494-.895-.798-1.5-1.784-1.676-2.085-.176-.301-.019-.464.132-.614.135-.135.301-.352.452-.528.15-.176.201-.301.301-.502.101-.201.05-.377-.025-.528-.075-.15-.678-1.634-.929-2.238-.245-.588-.494-.508-.678-.518-.176-.008-.377-.01-.578-.01-.201 0-.528.075-.804.377-.276.301-1.055 1.031-1.055 2.513 0 1.482 1.08 2.914 1.231 3.115.15.201 2.128 3.25 5.155 4.556.72.311 1.282.497 1.72.636.723.23 1.38.198 1.9.12.579-.087 1.783-.729 2.034-1.432.251-.703.251-1.306.176-1.432-.075-.126-.276-.201-.577-.351z"/>
    </svg>
</a>
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

async function getGeminiReply(userMsg) {
    const systemPrompt = "You are a friendly assistant for Gull Boutique, an online women's clothing store with categories: Wedding Guest, Graduation, Eid Special, Office Wear, Party Night, and Casual Home. Answer questions about the store helpfully and briefly (2-3 sentences max). If asked about specific stock, prices, or orders, politely say you'd recommend checking the Products page or contacting the store directly. Keep responses warm and on-brand for a boutique.";

    const url = "https://generativelanguage.googleapis.com/v1beta/interactions";
    const data = {
        model: "gemini-3.6-flash",
        system_instruction: systemPrompt,
        input: userMsg
    };

    const res = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'x-goog-api-key': GULL_GEMINI_KEY
        },
        body: JSON.stringify(data)
    });

    const result = await res.json();

    if (result.steps) {
        for (const step of result.steps) {
            if (step.type === 'model_output' && step.content && step.content[0] && step.content[0].text) {
                return step.content[0].text;
            }
        }
    }
    return "Sorry, I'm having trouble responding right now. Please try again or use our Contact page.";
}

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const msg = input.value.trim();
    if (!msg) return;

    addMessage(msg, 'user');
    input.value = '';
    addMessage('Typing...', 'bot typing');

    try {
        const reply = await getGeminiReply(msg);
        document.querySelector('.typing').remove();
        addMessage(reply, 'bot');
    } catch (err) {
        document.querySelector('.typing').remove();
        addMessage('Something went wrong. Please try again.', 'bot');
    }
});
</script>
</body>
</html>