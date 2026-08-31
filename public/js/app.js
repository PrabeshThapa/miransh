// Language Switcher Function (supports enBtn/jaBtn as well as btn-lang-en/btn-lang-ja and general .lang-btn selectors)
function setLanguage(language) {
    if (!document.body) return;

    document.body.classList.remove("en", "ja");
    document.body.classList.add(language);

    const enBtns = [
        document.getElementById("enBtn"),
        document.getElementById("btn-lang-en")
    ].filter(Boolean);

    const jaBtns = [
        document.getElementById("jaBtn"),
        document.getElementById("btn-lang-ja")
    ].filter(Boolean);

    if (language === "en") {
        enBtns.forEach(btn => btn.classList.add("active"));
        jaBtns.forEach(btn => btn.classList.remove("active"));
        document.documentElement.lang = "en";
        document.title = "MIRANSH LLC | International Human Resources & Student Support";
    } else {
        jaBtns.forEach(btn => btn.classList.add("active"));
        enBtns.forEach(btn => btn.classList.remove("active"));
        document.documentElement.lang = "ja";
        document.title = "MIRANSH合同会社 | 国際人材紹介・留学生紹介";
    }

    try {
        localStorage.setItem("miransh_language", language);
    } catch (e) {
        console.warn("Storage not accessible:", e);
    }
}

// Mobile Navigation Drawer Toggle
function toggleMobileNav() {
    const drawer = document.getElementById("mobile-nav-drawer");
    if (!drawer) return;
    drawer.classList.toggle("open");
    if (drawer.classList.contains("open")) {
        document.body.style.overflow = "hidden";
    } else {
        document.body.style.overflow = "";
    }
}

function closeMobileNavOnBackdrop(event) {
    if (event.target && event.target.id === "mobile-nav-drawer") {
        toggleMobileNav();
    }
}

// Sakana AI Navigator Chat Functions
function toggleSakanaChat() {
    const modal = document.getElementById("sakana-chat-modal");
    if (!modal) return;
    modal.classList.toggle("open");
    if (modal.classList.contains("open")) {
        const input = document.getElementById("sakana-user-input");
        if (input) setTimeout(() => input.focus(), 150);
    }
}

function closeSakanaOnBackdrop(event) {
    if (event.target && event.target.id === "sakana-chat-modal") {
        toggleSakanaChat();
    }
}

function resetSakanaChat() {
    const body = document.getElementById("sakana-messages-body");
    if (!body) return;
    body.innerHTML = `
        <div class="sakana-msg sakana-bot">
            <div class="sakana-msg-avatar">🐟</div>
            <div class="sakana-msg-bubble">
                <p class="lang-ja">こんにちは！<strong>MIRANSH合同会社</strong>採用コンサルタントです。</p>
                <p class="lang-en">Hello! I am the <strong>MIRANSH LLC</strong> talent consultant.</p>
                <p class="lang-ja" style="margin-top: 8px;">会話をリセットしました。外国人材の採用や在留資格について、何でもお尋ねください。</p>
                <p class="lang-en" style="margin-top: 8px;">Chat has been reset. Feel free to ask any question regarding international talent recruitment!</p>
                <div class="sakana-quick-chips">
                    <button type="button" class="sakana-chip" onclick="sendQuickPrompt('介護分野での特定技能採用について教えてください')">🏥 介護分野の採用</button>
                    <button type="button" class="sakana-chip" onclick="sendQuickPrompt('ネパール人材の特徴と強みは何ですか？')">🇳🇵 ネパール人材の強み</button>
                    <button type="button" class="sakana-chip" onclick="sendQuickPrompt('採用から入社までの期間と手続きの流れは？')">⏱️ 採用の流れと期間</button>
                    <button type="button" class="sakana-chip" onclick="sendQuickPrompt('費用やサポート料金の目安は？')">💰 費用・サポート料金</button>
                </div>
            </div>
        </div>
    `;
}

function sendQuickPrompt(text) {
    const input = document.getElementById("sakana-user-input");
    if (input) {
        input.value = text;
        const form = document.getElementById("sakana-chat-form");
        if (form) {
            form.dispatchEvent(new Event("submit", { cancelable: true, bubbles: true }));
        }
    }
}

async function handleSakanaSubmit(event) {
    if (event) event.preventDefault();
    const input = document.getElementById("sakana-user-input");
    const sendBtn = document.getElementById("sakana-send-btn");
    const body = document.getElementById("sakana-messages-body");
    if (!input || !body) return;

    const message = input.value.trim();
    if (!message) return;

    // Append User Message
    const userMsgDiv = document.createElement("div");
    userMsgDiv.className = "sakana-msg sakana-user";
    userMsgDiv.innerHTML = `<div class="sakana-msg-bubble"><p>${escapeUserHtml(message)}</p></div>`;
    body.appendChild(userMsgDiv);
    input.value = "";
    body.scrollTop = body.scrollHeight;

    if (sendBtn) sendBtn.disabled = true;

    // Append Loading indicator
    const loadingDiv = document.createElement("div");
    loadingDiv.className = "sakana-msg sakana-bot";
    loadingDiv.id = "sakana-loading-indicator";
    loadingDiv.innerHTML = `
        <div class="sakana-msg-avatar">🐟</div>
        <div class="sakana-msg-bubble" style="display: flex; align-items: center; gap: 8px; color: #64748B;">
            <span style="display: inline-block; animation: spin 1s linear infinite;">⏳</span>
            <span>回答を生成中... / Generating response...</span>
        </div>
    `;
    body.appendChild(loadingDiv);
    body.scrollTop = body.scrollHeight;

    try {
        const res = await fetch("/api/sakana/chat", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message })
        });
        const data = await res.json();
        const indicator = document.getElementById("sakana-loading-indicator");
        if (indicator) indicator.remove();

        const botReplyDiv = document.createElement("div");
        botReplyDiv.className = "sakana-msg sakana-bot";
        const replyText = (data && data.reply) ? data.reply : "申し訳ございません。応答の取得に失敗しました。";
        botReplyDiv.innerHTML = `
            <div class="sakana-msg-avatar">🐟</div>
            <div class="sakana-msg-bubble">
                <div>${formatBotReply(replyText)}</div>
            </div>
        `;
        body.appendChild(botReplyDiv);
        body.scrollTop = body.scrollHeight;
    } catch (err) {
        console.error("Sakana Chat Error:", err);
        const indicator = document.getElementById("sakana-loading-indicator");
        if (indicator) indicator.remove();

        const errDiv = document.createElement("div");
        errDiv.className = "sakana-msg sakana-bot";
        errDiv.innerHTML = `
            <div class="sakana-msg-avatar">🐟</div>
            <div class="sakana-msg-bubble" style="color: #DC2626;">
                <p>ネットワークエラーが発生しました。しばらく経ってから再度お試しください。</p>
            </div>
        `;
        body.appendChild(errDiv);
        body.scrollTop = body.scrollHeight;
    } finally {
        if (sendBtn) sendBtn.disabled = false;
    }
}

function escapeUserHtml(str) {
    return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");
}

function formatBotReply(text) {
    return escapeUserHtml(text)
        .replace(/\n\n/g, "<br><br>")
        .replace(/\n/g, "<br>")
        .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");
}

// Contact Form Handler
async function handleContactSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const btn = document.getElementById("btn-submit-inquiry");
    const successMsg = document.getElementById("contact-success-msg");

    if (btn) btn.disabled = true;

    const formData = new FormData(form);
    const payload = {};
    formData.forEach((value, key) => { payload[key] = value; });

    try {
        const res = await fetch("/contact", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(payload)
        });
        const result = await res.json();
        if (result.success) {
            form.reset();
            if (successMsg) successMsg.style.display = "block";
        } else {
            alert("送信に失敗しました: " + (result.error || "エラー"));
        }
    } catch (err) {
        console.error("Contact Form Error:", err);
        alert("送信に失敗しました。時間をおいて再度お試しください。");
    } finally {
        if (btn) btn.disabled = false;
    }
}

// FAQ Filter & Search
function filterFaq(category, btnElement) {
    const buttons = document.querySelectorAll(".faq-filter-btn");
    buttons.forEach(b => b.classList.remove("active"));
    if (btnElement) btnElement.classList.add("active");

    const cards = document.querySelectorAll(".faq-card");
    cards.forEach(card => {
        const cardCat = card.getAttribute("data-category") || "";
        if (category === "all" || cardCat === category) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}

function searchFaq(event) {
    const q = (event.target.value || "").toLowerCase().trim();
    const cards = document.querySelectorAll(".faq-card");
    cards.forEach(card => {
        const searchTarget = (card.getAttribute("data-search") || "").toLowerCase();
        if (!q || searchTarget.includes(q)) {
            card.style.display = "";
        } else {
            card.style.display = "none";
        }
    });
}

// ==========================================================================
// Image Zoom Lightbox Modal (Up to 90% Viewport)
// ==========================================================================
function initImageZoomLightbox() {
    let overlay = document.getElementById("image-zoom-overlay");
    if (!overlay) {
        overlay = document.createElement("div");
        overlay.id = "image-zoom-overlay";
        overlay.className = "image-zoom-overlay";
        overlay.innerHTML = `
            <div class="image-zoom-container" onclick="event.stopPropagation()">
                <button type="button" class="image-zoom-close-btn" aria-label="画像を閉じる / Close" onclick="closeImageZoom()">✕</button>
                <img id="image-zoom-modal-img" class="image-zoom-img" src="" alt="Zoomed Image">
                <div id="image-zoom-caption" class="image-zoom-caption" style="display: none;"></div>
            </div>
        `;
        overlay.addEventListener("click", closeImageZoom);
        document.body.appendChild(overlay);
    }

    // Attach click listeners to all meaningful content images
    const targetImages = document.querySelectorAll(`
        .hero-image-wrap img,
        .ceo-photo-wrap img,
        .detail-banner-img,
        .story-card-img,
        .service-card-img,
        .admin-card img,
        .about-image-col img,
        .message-image-col img,
        .content-img,
        img.zoomable,
        main img
    `);

    targetImages.forEach(img => {
        // Skip tiny icons, flags, and logo icons
        if (img.classList.contains("brand-logo-img") || img.closest(".brand-wrapper") || img.closest(".lang-btn") || img.width < 50) {
            return;
        }

        img.classList.add("zoomable");
        img.setAttribute("title", "クリックで拡大表示 (Click to Zoom up to 90%)");

        img.addEventListener("click", function (e) {
            e.stopPropagation();
            openImageZoom(this.src, this.alt || this.getAttribute("title") || "");
        });
    });

    // Close on Escape key
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeImageZoom();
        }
    });
}

function openImageZoom(imgSrc, captionText) {
    const overlay = document.getElementById("image-zoom-overlay");
    const zoomImg = document.getElementById("image-zoom-modal-img");
    const captionEl = document.getElementById("image-zoom-caption");

    if (!overlay || !zoomImg) return;

    zoomImg.src = imgSrc;

    if (captionEl) {
        const cleanCaption = (captionText || "").replace(/クリックで拡大表示.*$/i, "").trim();
        if (cleanCaption) {
            captionEl.textContent = cleanCaption;
            captionEl.style.display = "block";
        } else {
            captionEl.style.display = "none";
        }
    }

    overlay.classList.add("active");
    document.body.style.overflow = "hidden"; // Prevent background scroll
}

function closeImageZoom() {
    const overlay = document.getElementById("image-zoom-overlay");
    if (!overlay) return;
    overlay.classList.remove("active");
    document.body.style.overflow = "";
}

// Initialize on DOM Ready
document.addEventListener("DOMContentLoaded", function () {
    let savedLanguage = "ja";
    try {
        savedLanguage = localStorage.getItem("miransh_language") || "ja";
    } catch (e) {}

    setLanguage(savedLanguage);
    initImageZoomLightbox();
});
