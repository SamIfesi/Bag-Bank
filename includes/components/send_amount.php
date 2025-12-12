<section class="hide" id="amount-section">
    <div class="section">
        <label for="amount">Amount</label>
        <div class="input-group">
            <span class="send-icon">₦</span>
            <input
                type="number"
                class="input"
                id="amount"
                placeholder="0.00"
                min="0"
                step="0.01" />
        </div>
    </div>

    <div class="section">
        <label for="description">Description (Optional)</label>
        <span type="text" id="description" placeholder="What's this for?" class="form-grp" />
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