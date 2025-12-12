<section class="hide" id="amount-section">
    <div class="section">
        <label for="amount">Amount</label>
        <div class="input-group">
            <span class="send-icon">₦</span>
            <input
                type="text"
                class="input"
                id="amount"
                placeholder="0.00"
                inputmode="decimal"
                data-max="1000000" />
        </div>
        <span class="error" id="amount-error">The amount should be within ₦10.00 - ₦5,000,000.00</span>
    </div>

    <div class="section">
        <label for="description">Note</label>
        <input type="text" id="description" placeholder="What's this for? (Optional)" class="form-grp" />
    </div>

    <div class="quick-amounts">
        <button class="quick-btn" data-amount="500">₦500</button>
        <button class="quick-btn" data-amount="1000">₦1,000</button>
        <button class="quick-btn" data-amount="2000">₦2,000</button>
        <button class="quick-btn" data-amount="5000">₦5,000</button>
        <button class="quick-btn" data-amount="10000">₦10,000</button>
        <button class="quick-btn" data-amount="20000">₦20,000</button>
    </div>

    <button class="btn-send" id="sendMoneyBtn">
        <i class="ti ti-send"></i>
        Send Money
    </button>
</section>
</main>
<script type="module" src="src/main.js"></script>
</body>

</html>